<?php
// Include the header component for the page
require_once 'Components/header.php';

// Include the script that handles signup logic
require_once 'checkSignup.php';

// Retrieve feedback message from session, if available
$feedback_message = isset($_SESSION['feedback_message']) ? $_SESSION['feedback_message'] : '';
// Clear the feedback message from session after retrieving it
unset($_SESSION['feedback_message']);
?>

<body>
    <!-- Navigation bar at the top of the page -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" id="navbar">
        <div class="container">
            <!-- Brand logo and name -->
            <a class="navbar-brand" href="#">
                <img src="Components/navigation/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                <span class="letterS">S</span>wift<span class="letterS">S</span>tock
            </a>
            <!-- Button to redirect to the landing page -->
            <button type="button" class="btn btn-outline-primary" id="Back">Back</button>
        </div>
    </nav>

    <!-- Main content section for the signup page -->
    <section class="px-100" style="background-color: rgb(229, 235, 241);">
        <div id="alert">
            <?php if (!empty($feedback_message)): ?>
                <?php
                // Determine the alert type based on the feedback message content
                if (strpos($feedback_message, 'already') !== false || strpos($feedback_message, 'Invalid') !== false) {
                    $alert_class = 'warning'; // Warning alert for issues like existing usernames
                } elseif (strpos($feedback_message, 'successful') !== false) {
                    $alert_class = 'success'; // Success alert for successful signup
                } else {
                    $alert_class = 'info'; // Informational alert for general messages
                }
                ?>
                <!-- Display the alert with appropriate class and message -->
                <div class="alert alert-<?php echo $alert_class; ?> alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($feedback_message); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="background-color: rgb(229, 235, 241);">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <!-- Signup form section -->
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <h1 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign Up</h1>
                                    <!-- Signup form with method POST -->
                                    <form class="mx-1 mx-md-4" id="RLForm" action="checkSignup.php" method="POST">
                                        <!-- Hidden input to identify form submission -->
                                        <input type="hidden" name="register_user" value="1">
                                        <!-- Name input field -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="nameError" class="text-danger"></small>
                                                <input id="Name" name="name" class="form-control" type="text" pattern="[A-Za-z ]+" title="Only letters and spaces are allowed" placeholder="Enter your name" required />
                                                <label class="form-label" for="Name">Your Name</label>
                                            </div>
                                        </div>
                                        <!-- Username input field -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="usernameError" class="text-danger"></small>
                                                <input id="userName" name="username" class="form-control" type="text" minlength="3" pattern="[A-Za-z0-9]+" title="Only letters and numbers are allowed, and no spaces" placeholder="Choose a username" required />
                                                <label class="form-label" for="userName">User Name</label>
                                            </div>
                                        </div>
                                        <!-- Email input field -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="emailError" class="text-danger"></small>
                                                <input type="email" id="Email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Enter a valid email address" placeholder="Enter your email" required />
                                                <label class="form-label" for="Email">Your Email</label>
                                            </div>
                                        </div>
                                        <!-- Telephone number input field -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="telError" class="text-danger"></small>
                                                <input type="tel" pattern="[0-9]+" id="Telno" name="telephone" minlength="10" maxlength="10" class="form-control" placeholder="Enter your telephone number" title="Must be a ten digit number" />
                                                <label class="form-label" for="Telno">Your Telephone</label>
                                            </div>
                                        </div>
                                        <!-- Password input field -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="pswdError" class="text-danger"></small>
                                                <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password" id="Pswd" name="password" class="form-control" placeholder="Create a password" required />
                                                <label class="form-label" for="Pswd">Password</label>
                                            </div>
                                        </div>
                                        <!-- Confirm password input field -->
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="RpswdError" class="text-danger"></small>
                                                <input pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" type="password" id="Rpswp" name="confirm_password" class="form-control" placeholder="Repeat your password" required />
                                                <label class="form-label" for="Rpswp">Repeat your password</label>
                                            </div>
                                        </div>
                                        <!-- Checkbox to agree to terms and conditions -->
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <input required class="form-check-input me-2" type="checkbox" id="chBox" />
                                            <label class="form-check-label" for="chBox">
                                                I agree to all statements in <a href="SLA.php">Service Level Agreement</a>
                                            </label>
                                        </div>
                                        <!-- Submit button for the signup form -->
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" class="btn btn-primary btn-lg" value="Sign Up" />
                                        </div>
                                    </form>
                                </div>
                                <!-- Image for visual enhancement of the signup page -->
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="images/Sign Up.png" class="img-fluid" alt="Sign Up image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Include the footer component for the page -->
    <?php require_once 'Components/footer.php'; ?>
</body>
<script>
    // JavaScript to handle the Back button functionality
    document.getElementById('Back').addEventListener('click', function() {
        window.location.href = 'index.php'; // Redirect to the landing page
    });
</script>

</html>