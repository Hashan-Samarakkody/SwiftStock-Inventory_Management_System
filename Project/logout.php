<?php
// Including the script that handles session management
require_once 'session.php';

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header('Location: index.php');
exit();
?>