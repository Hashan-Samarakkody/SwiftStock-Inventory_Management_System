<?php
// Including the script that handles session management
require_once 'session.php';

// Include database connection
require_once 'DBconnection.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

// Get the fullName from the session
$fullName = $_SESSION['fullName'];

// Handle account deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    $deleteQuery = "DELETE FROM users WHERE name = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $fullName);
    if ($stmt->execute()) {
        // Destroy session and redirect to login
        session_destroy();
        header('Location: login.php');
        exit();
    } else {
        // Redirect back with an error message
        $_SESSION['feedback_message'] = 'Failed to delete account. Please try again.';
        header('Location: my_account.php');
        exit();
    }
}

// Close connection
$conn->close();
