<?php
// Including the script that handles session management
require_once 'session.php';

// Include the database connection file
require_once 'DBconnection.php';

// Function to sanitize input
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input values
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        // Redirect to login page with an error message
        header('Location: login.php?action=empty');
        exit();
    }

    // Prepare the SQL query
    $sql = "SELECT * FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the hashed password
            if (password_verify($password, $row['password'])) {
                // Valid credentials. Hence, start the session
                $_SESSION['loggedIn'] = '1';
                $_SESSION['fullName'] = $row['name'];

                // Redirect to home page
                header('Location: home.php');
                exit();
            } else {
                // Incorrect password
                header('Location: login.php?action=error');
                exit();
            }
        } else {
            // Incorrect username
            header('Location: login.php?action=error');
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        // Query preparation failed
        die("An error occurred. Please try again later!");
    }

    // Close the connection
    $conn->close();
} else {
    // Not a POST request
    header('Location: login.php');
    exit();
}
