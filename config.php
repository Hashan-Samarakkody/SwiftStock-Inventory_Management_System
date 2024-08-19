<?php
// Database configuration
$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password = "123456"; // Change this to your database password
$dbname = "webdev1"; // Change this to your database name

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//if (!$conn) {
 //   die("Connection failed: " . mysqli_connect_error());
//} else {
   // echo "Database connected successfully!";
//}

mysqli_close($conn);
?>
