<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #3e1f47;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: calc(100% - 22px);
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #006466;
      border: none;
      border-radius: 4px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Sign Up</h2>
    <form id="signupForm">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required />

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required />

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required />

      <label for="confirmPassword">Confirm Password:</label>
      <input
        type="password"
        id="confirmPassword"
        name="confirmPassword"
        required />

      <button type="submit">Sign Up</button><br>
      <button type="submit" id ="loginbut">Login</button>
    </form>
  </div>
  <script>
    document
      .getElementById("signupForm")
      .addEventListener("submit", function(event) {
        event.preventDefault();

        let username = document.getElementById("username").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let confirmPassword =
          document.getElementById("confirmPassword").value;

        // Email validation using a regular expression
        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
          alert("Please enter a valid email address!");
          return;
        }

        // Password validation to ensure it contains letters, uppercase letters, and symbols
        let passwordPattern =
          /^(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>])[a-zA-Z0-9!@#$%^&*(),.?":{}|<>]{8,}$/;
        if (!passwordPattern.test(password)) {
          alert(
            "Password must contain at least one lowercase letter, one uppercase letter, one special character, and be at least 8 characters long!"
          );
          return;
        }
        if (password !== confirmPassword) {
          alert("Passwords do not match!");
          return;
        }

        // Submit the form via AJAX or proceed to server-side validation
        this.submit();
      });

      // Event listener for the Sign Up button
    document.getElementById("loginbut").addEventListener("click", function () {
      window.location.href = "lognup.php"; // Redirect to the login page
    });
  </script>
</body>

</html>

<?php
include 'config.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Server-side validation

  if (empty($username) || empty($email) || empty($password)) {
    die("All fields are required.");
  }

  // Check if username or email already exists
  
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
  $stmt->bind_param("ss", $username, $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    die("Username or email already exists.");
  }

  // Encrypt password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert user into the database
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $hashed_password);
  $stmt->execute();

  echo "User registered successfully.";
  header("Location: login.html");
  exit();
}
?>