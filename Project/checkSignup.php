<?php
// Including the script that handles session management
require_once 'session.php';

// Include the database connection file
require_once 'DBconnection.php';

$feedback_message = "";

// Function to sanitize and validate inputs
function validate_input($data, $type)
{
    $data = trim($data);
    $data = htmlspecialchars($data);

    switch ($type) {
        case 'string':
            return filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
        case 'email':
            return filter_var($data, FILTER_VALIDATE_EMAIL);
        case 'tel':
            if (preg_match('/^0\d{9}$/', $data) && !preg_match('/(\d)\1{7,}/', $data)) {
                return $data;
            } else {
                return false;
            }
        default:
            return $data;
    }
}

// Check if a user exists by email or username
function user_exists_email($conn, $email)
{
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}


function user_exists_username($conn, $username)
{
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Register a new user
if (isset($_POST['register_user'])) {
    $name             = validate_input($_POST['name'], 'string');
    $username         = validate_input($_POST['username'], 'string');
    $email            = validate_input($_POST['email'], 'email');
    $password         = validate_input($_POST['password'], 'string');
    $confirm_password = validate_input($_POST['confirm_password'], 'string');
    $telephone        = validate_input($_POST['telephone'], 'tel');

    // Validate passwords and check if user exists
    if ($password !== $confirm_password) {
        $feedback_message = "Passwords do not match.";
    } elseif ($telephone === false) {
        $feedback_message = "Invalid telephone number. It must start with 0 and not contain 8 or more consecutive identical digits.";
    } elseif (user_exists_username($conn, $username)) {
        $feedback_message = "Username already exists. Please choose another!";
    } elseif (user_exists_email($conn, $email)) {
        $feedback_message = "Email already exists. Please choose another!";
    } else {
        // Hash the password for storage
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, telephone_number) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $telephone);

        if ($stmt->execute()) {
            $feedback_message = "Registration successful. You can now log in.";
        } else {
            $feedback_message = "An error occurred. Please try again!";
            exit();
        }

        $stmt->close();
    }

    // Pass feedback message to the front-end
    $_SESSION['feedback_message'] = $feedback_message;
    header("Location:register.php");
    exit();
}
$conn->close();
