<?php
require_once 'session.php';
require_once 'DBconnection.php';

$fullName = $_SESSION['fullName'];

// Check if the session is active
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

// Fetch user data
$query = "SELECT username, email, telephone_number FROM users WHERE name = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $fullName);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();  // Close the statement

$userName = $user['username'];
$Email = $user['email'];
$Phone = $user['telephone_number'];

$feedback_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_account'])) {
        $deleteQuery = "DELETE FROM users WHERE name = ?";
        $stmt = $conn->prepare($deleteQuery);
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("s", $fullName);
        $stmt->execute();
        $stmt->close();  // Close the statement

        session_destroy();
        header('Location: index.php');
        exit();
    } else {
        $newName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $newEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $newPhone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
        $newPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $errors = [];

        if (empty($newName) || !preg_match("/^[a-zA-Z ]+$/", $newName)) {
            $errors[] = 'Invalid name. Only letters and spaces are allowed.';
        }

        if (empty($newEmail) || !filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        } else {
            $emailCheckQuery = "SELECT COUNT(*) FROM users WHERE email = ? AND name != ?";
            $stmt = $conn->prepare($emailCheckQuery);
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("ss", $newEmail, $fullName);
            $stmt->execute();
            $stmt->bind_result($emailCount);
            $stmt->fetch();
            $stmt->close();  // Close the statement
            if ($emailCount > 0) {
                $errors[] = 'The email address is already in use!';
            }
        }

        if (empty($newPhone) || !preg_match("/^[0-9]{10}$/", $newPhone)) {
            $errors[] = 'Invalid phone number. It should be 10 digits.';
        }

        if (!empty($newPassword) && !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $newPassword)) {
            $errors[] = 'Invalid password. It must contain at least one number, one uppercase letter, one lowercase letter, and be at least 8 characters long.';
        }

        if (empty($errors)) {
            $updateQuery = "UPDATE users SET name = ?, email = ?, telephone_number = ?";
            $params = [$newName, $newEmail, $newPhone];

            if (!empty($newPassword)) {
                $updateQuery .= ", password = ?";
                $params[] = password_hash($newPassword, PASSWORD_DEFAULT);
            }

            $updateQuery .= " WHERE name = ?";
            $params[] = $fullName;

            $stmt = $conn->prepare($updateQuery);
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $types = str_repeat("s", count($params) - 1) . "s";
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $stmt->close();  // Close the statement

            $_SESSION['fullName'] = $newName;

            $stmt = $conn->prepare("SELECT username, email, telephone_number FROM users WHERE name = ?");
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param("s", $newName);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();  // Close the statement

            $userName = $user['username'];
            $Email = $user['email'];
            $Phone = $user['telephone_number'];

            $feedback_message = 'Profile updated successfully!';
        } else {
            $feedback_message = implode('<br>', $errors);
        }
    }
}

require_once 'Components/navigation/navigation.php';
?>

<style>
    body {
        background: rgba(185, 215, 233, 0.616);
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8;
    }

    .profile-button {
        background: rgb(13, 110, 251);
        box-shadow: none;
        border: none;
    }

    .profile-button:hover {
        background: rgb(15, 84, 187);
    }

    .profile-button:focus {
        background: rgb(15, 84, 187);
        box-shadow: none;
    }

    .profile-button:active {
        background: rgb(15, 84, 187);
        box-shadow: none;
    }

    .btn-logout {
        background: orange;
        color: white;
    }

    .btn-logout:hover {
        background: darkorange;
    }

    .btn-delete {
        background: red;
        color: white;
    }

    .btn-delete:hover {
        background: darkred;
        color: white;
    }


    .labels {
        font-size: 22px;
    }

    .profile-image-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-image {
        border-radius: 50%;
        width: 150px;
        margin-top: 20px;
    }

    .profile-info {
        text-align: center;
    }

    .form-container {
        padding: 40px;
        max-width: 60%;
        margin: auto;
    }

    @media (max-width: 700px) {
        .form-container {
            padding: 20px;
            max-width: 80%;
        }

        .labels {
            font-size: 18px;
        }
    }
</style>

<body>
    <!-- Profile settings form -->
    <form method="POST" action="">
        <div class="container rounded bg-white mt-5 mb-5 form-container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="profile-image-container">
                        <img class="profile-image" src="images/profile.png" alt="Profile Image" />
                    </div>
                    <div class="profile-info">
                        <h6 class="font-weight-bold">
                            <strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['fullName']); ?>
                        </h6>
                        <h6 class="font-weight-bold">
                            <strong>Username:</strong> <?php echo htmlspecialchars($userName); ?>
                        </h6>
                        <h6 class="font-weight-bold">
                            <strong>Email:</strong> <?php echo htmlspecialchars($Email); ?>
                        </h6>
                        <h6 class="font-weight-bold">
                            <strong>Phone number:</strong> <?php echo htmlspecialchars($Phone); ?>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <h3 class="text-center">Change Profile Settings</h3>
                        </div>
                        <p>Here you can change your profile settings. Leave the password field empty if you don't want to change it.
                            The user name cannot be changed.
                        </p>
                        <?php if (!empty($feedback_message)): ?>
                            <?php
                            if (str_contains($feedback_message, 'already')) {
                                $alert_class = 'warning';
                            } elseif (str_contains($feedback_message, 'successfully')) {
                                $alert_class = 'success';
                            } elseif (str_contains($feedback_message, 'Invalid')) {
                                $alert_class = 'danger';
                            } else {
                                $alert_class = 'info';
                            }
                            ?>
                            <div class="alert alert-<?php echo $alert_class; ?> alert-dismissible fade show" role="alert">
                                <?php echo htmlspecialchars($feedback_message); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Name</label>
                                <input
                                    title="Name cannot contain numbers or any special characters"
                                    pattern="[A-Za-z ]+"
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter new name"
                                    name="name"
                                    value="<?php echo htmlspecialchars($_SESSION['fullName']); ?>" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Email</label>
                                <input
                                    type="email"
                                    title="Only valid email addresses are allowed"
                                    class="form-control"
                                    placeholder="Enter new email"
                                    name="email"
                                    value="<?php echo htmlspecialchars($Email); ?>" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Phone Number</label>
                                <input
                                    maxlength="20"
                                    type="tel"
                                    title="Phone number must start with 0 and not contain 8 or more consecutive identical digits"
                                    class="form-control"
                                    placeholder="Enter new phone number"
                                    name="phone"
                                    value="<?php echo htmlspecialchars($Phone); ?>" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Password</label>
                                <input
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Must contain at least one number, one uppercase and lowercase letter, and at least 8 characters"
                                    type="password"
                                    class="form-control"
                                    placeholder="Enter new password"
                                    name="password" />
                            </div>
                        </div>
                        <br>
                        <div class="btn-container d-flex flex-column align-items-center justify-content-center">
                            <input class="btn btn-primary profile-button" type="submit" value="Save Changes" />

                            <a href="logout.php" class="btn btn-logout mt-2" role="button" style="text-decoration: none; color: white;">Logout</a>

                            <button class="btn btn-danger mt-2" type="submit" id="deletBtn">Delete Account</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <br>
    <?php require_once 'Components/footer.php'; // Close connection 
    ?>
</body>

<script>
    document.getElementById('deletBtn').addEventListener('click', function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Use confirm() to get the user's confirmation
        if (confirm("Are you sure you want to delete your account?")) {
            // If the user confirms, set a hidden input to indicate account deletion
            let form = this.closest('form');
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_account';
            form.appendChild(input);

            // Submit the form
            form.submit();
        }
    });
</script>

<?php $conn->close(); ?>

</html>