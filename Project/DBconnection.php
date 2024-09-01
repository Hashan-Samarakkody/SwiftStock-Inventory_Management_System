<?php
// Hostname
define('DB_HOST', 'YOUR-HOST-NAME'); // <-- Enter your hostname, usually 'localhost'

// DB user
define('DB_USER', 'YOUR-USERNAME'); // <-- Enter your MySQL username

// DB password
define('DB_PASSWORD', 'YOUR-PASSWORD'); // <-- Enter your MySQL password

// Database name
define('DB_NAME', 'swiftstock'); // <-- Enter the name of your database

// Create connection using mysqli
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Test
echo "h1";