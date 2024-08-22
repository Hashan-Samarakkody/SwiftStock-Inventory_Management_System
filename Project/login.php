<?php

// Including the script that handles session management
require_once 'session.php';

// Redirect the users to home page if they are already logged in.
if (isset($_SESSION['loggedIn'])) {
    header('Location: home.php');
    exit();
}

require_once 'Components/header.php';

// Retrieve any messages from the query string
$message = "";
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'error') {
        $message = "Incorrect Username / Password";
    }
}
?>
<style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .h-custom {
        height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
        .h-custom {
            height: 100%;
        }
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand">
                <img
                    src="Components/navigation/logo.png"
                    alt=""
                    width="30"
                    height="24"
                    class="d-inline-block align-text-top" />
                <span class="letterS">S</span>wift<span class="letterS">S</span>tock
            </a>
            <button type="button" class="btn btn-outline-primary" id="Back">
                Back
            </button>
        </div>
    </nav>

    <section class="px-100" style="background-color: rgb(229, 235, 241);">
        <div id="loginMessage">
            <?php if (!empty($message)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> <?php echo htmlspecialchars($message); ?>
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
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <h1 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">
                                        Log In
                                    </h1>
                                    <br />
                                    <form class="mx-1 mx-md-4" action="checkLogin.php" method="POST" id="RLForm">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="usernameError"></small>
                                                <input required class="form-control" id="userName" name="username" pattern="[A-Za-z0-9]+" title="Only letters and numbers are allowed, and no spaces." />
                                                <label class="form-label" for="userName">User Name</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <small id="pswdError"></small>
                                                <input type="password" required class="form-control" id="Pswd" name="password" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
                                                <label class="form-label" for="Pswd">Password</label>
                                            </div>
                                        </div>

                                        <!-- Don't Have Account -->
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            Don't have an account? &nbsp
                                            <a href="register.php">Sign Up</a>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <input type="submit" value="Log In" class="btn btn-primary btn-lg" id="login" />
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="images/Log In.png" class="img-fluid" alt="Log In image" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once 'Components/footer.php' ?>
</body>
<script>
    // Button to redirect to the landing page
    document.getElementById('Back').addEventListener('click', function() {
        window.location.href = 'index.php';
    });
</script>

</html>