<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>login</title>

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #3e1f47;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: #fff;
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
    <h2>Login</h2>
    <form id="login" method="post">
      <label for="username">Username : </label>
      <input type="text" id="username" name="username" /><br />
      <label for="password">Password : </label>
      <input type="password" id="password " name="password" /><br /><br />

      <button type="submit"id="loginbutton">Login</button><br />
      <p>If you dont have an account, please sign</p>
      <button type="button" id="signinbutton">sign in</button><br />
    </form>
  </div>
  
  <script>
    document.getElementById("login").addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent form submission

      let username = document.getElementById("username").value.trim();
      let password = document.getElementById("password").value.trim();
      let errorMessage = document.getElementById("error-message");

      // Clear previous error message
      errorMessage.textContent = "";

      // Check if the username is empty
      if (!username) {
        errorMessage.textContent = "Please enter your username.";
        return;
      }

      // Check if the password is empty
      if (!password) {
        errorMessage.textContent = "Please enter your password.";
        return;
      }

      // If validation passes, submit the form
      this.submit();
    });

    // Event listener for the Sign Up button
    document.getElementById("signinbutton").addEventListener("click", function () {
      window.location.href = "signup.php"; // Redirect to the sign-up page
    });
  </script>
 
 
</body>

</html>



<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username_or_email = $_POST['username_or_email'];
  $password = $_POST['password'];

  // Server-side validation
  if (empty($username_or_email) || empty($password)) {
    die("All fields are required.");
  }

  // Fetch user from the database
  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
  $stmt->bind_param("ss", $username_or_email, $username_or_email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    die("Invalid username or password.");
  }

  $user = $result->fetch_assoc();

  if (password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    header("Location: home.php");
    exit();
  } else {
    die("Invalid username or password.");
  }
}
?>