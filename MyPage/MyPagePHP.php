<?php
// profile_logic.php

// Database connection (replace with your credentials)
$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// // Retrieve user information (if available)
// $user_id = 1; // Replace with actual user ID logic
// $sql = "SELECT name, surname, email, mobile, country, state FROM users WHERE id = $user_id";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) > 0) {
//     $row = mysqli_fetch_assoc($result);
//     $name = $row["name"];
//     $surname = $row["surname"];
//     $email = $row["email"];
//     $mobile = $row["mobile"];
//     $country = $row["country"];
//     $state = $row["state"];

// } else {
//     // Handle case where user information not found
//     echo "Error: User information not found.";
// }

// Form submission handling (to be implemented)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $mobile = htmlspecialchars($_POST["mobile"]);
    $email = htmlspecialchars($_POST["email"]);

}

echo $name;

mysqli_close($conn);