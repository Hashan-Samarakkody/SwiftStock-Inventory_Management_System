<!-- include header.php -->
 <?php include 'header.php'; ?>

    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand me-auto" href="#">Inventory Management System</a>
                <div
                    class="offcanvas offcanvas-end"
                    tabindex="-1"
                    id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel"
                >
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <!-- Insert a samall Picture of user -->
                            <img
                                src="https://www.w3schools.com/howto/img_avatar.png"
                                alt="Avatar"
                                class="avatar"
                            />
                            <!-- Add username using PHP-->
                            <span>Username</span>
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul
                            class="navbar-nav justify-content-end flex-grow-1 pe-3"
                        >
                            <li class="nav-item">
                                <a
                                    class="nav-link mx-lg-Z active"
                                    aria-current="page"
                                    href="#"
                                    >Home</a
                                >
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-Z" href="#">Manage Inventory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-Z" href="#">Check Inventory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-Z" href="#">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mx-lg-Z" href="#">My Account</a>
                            </li>
                        </ul>
                    </div>
                </div>
                 <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar"
                    aria-controls="offcanvasNavbar"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

