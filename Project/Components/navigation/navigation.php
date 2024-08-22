<?php
// Check if the user's full name is stored in the session, and sanitize it for security
$Name = isset($_SESSION['fullName']) ? htmlspecialchars($_SESSION['fullName']) : 'Name';

// Get the current page name to set the active class for the navigation links
$current_page = basename($_SERVER['PHP_SELF']);

// Include the header component
require 'Components/header.php';
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <!-- Navbar brand with logo and site name -->
        <a class="navbar-brand">
            <img
                src="Components/navigation/logo.png"
                alt=""
                width="30"
                height="24"
                class="d-inline-block align-text-top" />
            <span class="letterS">S</span>wift<span class="letterS">S</span>tock
        </a>

        <!-- Offcanvas menu for smaller screens -->
        <div
            class="offcanvas offcanvas-end"
            tabindex="-1"
            id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <!-- User's avatar and name displayed in the offcanvas menu header -->
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                    <img
                        src="images/profile.png"
                        alt="Avatar"
                        class="avatar" />
                    <?php echo $Name; ?>
                </h5>
                <!-- Button to close the offcanvas menu -->
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Navigation links in the offcanvas menu -->
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a
                            class="nav-link <?php echo ($current_page == 'home.php') ? 'active' : ''; ?>"
                            href="home.php"
                            aria-current="page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link <?php echo ($current_page == 'manage_inventory.php') ? 'active' : ''; ?>"
                            href="manage_inventory.php"
                            aria-current="page">Manage Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link <?php echo ($current_page == 'search.php') ? 'active' : ''; ?>"
                            href="search.php"
                            aria-current="page">Search Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link <?php echo ($current_page == 'createReport.php') ? 'active' : ''; ?>"
                            href="createReport.php"
                            aria-current="page">Create Reports</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link <?php echo ($current_page == 'aboutUs.php') ? 'active' : ''; ?>"
                            href="aboutUs.php"
                            aria-current="page">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link <?php echo ($current_page == 'my_account.php') ? 'active' : ''; ?>"
                            href="my_account.php"
                            aria-current="page">My Account</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Button to toggle the offcanvas menu on smaller screens -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>