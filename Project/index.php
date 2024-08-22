<?php require_once 'Components/header.php' ?>
<body>
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg bg-body-tertiary fixed-top"
        id="navbar"
    >
        <div class="container">
           <a class="navbar-brand" >
                    <img
                        src="Components/navigation/logo.png"
                        alt="Logo"
                        width="30"
                        height="24"
                        class="d-inline-block align-text-top"
                    />
                    <span class="letterS">S</span>wift<span class="letterS">S</span>tock
            </a>
             <button id="loginbtn"> Log In </button>
        </div>
    </nav>
        <section id="hero" class="hero section dark-background">
        <div class="container">
            <div class="row gy-4">
                <div
                    class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                >
                    <h1>
                        <a
                            class="typewrite"
                            data-period="2000"
                            data-type='[ "Welcome To SwiftStock!","SwiftStock Makes It Easy","Fast, Efficient, Reliable"]'
                        >
                            <span class="wrap"></span>
                        </a>
                    </h1>
                    <br />

                    <div class="d-flex justify-content-center">
                        <button id="getstartedbtn">Get Started!</button>
                    </div>
                </div>
                <div
                    class="col-lg-6 order-1 order-lg-2 justify-content-center"
                    data-aos-delay="200"
                >
                    <img src="images/Landing.png" class="floating" alt="" />
                </div>
            </div>
            <h5 class="justify-content-center">
                At Swift Stock, we understand the complexities of managing
                inventory in today's fast-paced world. Our state-of-the-art
                platform simplifies inventory management by offering real-time
                tracking, seamless integration with your existing systems, and
                insightful analytics. Whether you're handling a small business
                or a large enterprise, Swift Stock helps you maintain optimal
                stock levels, reduce excess inventory, and enhance your overall
                efficiency. Start transforming your inventory management today
                with Swift Stock!
            </h5>
        </div>
        </section>
    <br />
    <br />
    <br />
    <!-- /Hero Section -->
    <hr />
    <!-- Why Us Section -->
    <section class="hidden-cls" id="why-us">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="my-3">Why SwiftStock</h2>
            </div>
        </div>
        <div class="container">
            <div class="row gy-4">
                <!-- Card 1 -->
                <div class="col-lg-4 card">
                    <div class="card-body">
                        <h4 class="card-title">SwiftStock</h4>
                        <p class="card-text">
                            SwiftStock is a cloud-based inventory management
                            system that helps businesses of all sizes manage
                            their inventory in real-time. It is a powerful tool
                            that allows you to keep track of your inventory,
                            sales, and purchases from anywhere in the world.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 card">
                    <div class="card-body">
                        <h4 class="card-title">Benefits</h4>
                        <p class="card-text">
                            SwiftStock lets you manage inventory, sales, and
                            purchases in real time. Generate reports, track
                            stock levels, and receive low-stock alerts, all
                            while saving time and money through automation.
                            All these features make SwiftStock the ultimate
                            solution.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 card">
                    <div class="card-body">
                        <h4 class="card-title">Features</h4>
                        <p class="card-text">
                            SwiftStock features real-time inventory tracking,
                            sales and purchase management, report generation,
                            low stock alerts, and more. It is a comprehensive
                            solution that helps you streamline your inventory
                            management processes and improve efficiency.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <hr>

    <!-- Services Section -->
    <section class="hidden-cls" id="services">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="my-3">Our Services</h2>
            </div>
        </div>
        <div class="card-group">
            <!-- Service Card 1 -->
            <div class="card custom-card">
                <img
                    src="images/Manage.png"
                    class="card-img-top"
                    alt="Manage Inventory"
                />
                <div class="card-body">
                    <h5 class="card-title">Manage Inventory</h5>
                    <p class="card-text">
                        Efficiently track and organize your stock with
                        SwiftStock. Update quantities, monitor stock levels, and
                        set reorder points with real-time updates.
                    </p>
                </div>
            </div>
            <!-- Service Card 2 -->
            <div class="card custom-card">
                <img
                    src="images/Search.png"
                    class="card-img-top"
                    alt="Search Inventory"
                    id="fix-img"
                />
                <div class="card-body">
                    <h5 class="card-title">Search Inventory</h5>
                    <p class="card-text">
                        Quickly find any item with SwiftStock's search
                        functionality. Filter by category, SKU, or keyword to
                        locate products effortlessly.
                    </p>
                </div>
            </div>
            <!-- Service Card 3 -->
            <div class="card custom-card">
                <img
                    src="images/Report.png"
                    class="card-img-top"
                    alt="Create Reports"
                    id="fix-img"
                />
                <div class="card-body">
                    <h5 class="card-title">Create Reports</h5>
                    <p class="card-text">
                        Generate comprehensive reports to analyze your inventory
                        and sales data.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <br>

    <hr>
    <!-- Reviews Section -->
    <section class="hidden-cls" id="reviews">
        <div class="testimonial1 py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h2 class="my-3">Customer Reviews</h2>
                    </div>
                </div>
                <div class="owl-carousel owl-theme testi1 mt-4">
                    <!-- Testimonial 1 -->
                    <div class="item">
                        <div class="card card-shadow border-0 mb-4">
                            <div class="card-body">
                                <div
                                    class="position-relative thumb bg-success-gradiant d-inline-block text-black mb-4"
                                >
                                    <img
                                        src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/1.jpg"
                                        alt="Michelle Anderson"
                                        class="thumb-img position-absolute rounded-circle"
                                    />
                                    Michelle Anderson
                                </div>
                                <h5 class="font-weight-light">
                                    ⭐⭐⭐⭐⭐<br />
                                    "Absolutely loved my experience! The product
                                    exceeded my expectations, and the customer
                                    service was top-notch. I will definitely be
                                    returning!"
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="item">
                        <div class="card card-shadow border-0 mb-4">
                            <div class="card-body">
                                <div
                                    class="position-relative thumb bg-success-gradiant d-inline-block text-black mb-4"
                                >
                                    <img
                                        src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/2.jpg"
                                        alt="Jessica Smith"
                                        class="thumb-img position-absolute rounded-circle"
                                    />
                                    Jessica Smith
                                </div>
                                <h5 class="font-weight-light">
                                    ⭐⭐⭐⭐⭐<br />
                                    "Great quality and fast shipping! I was
                                    impressed with how quickly my order arrived,
                                    and the item was exactly as described.
                                    Highly recommend!"
                                </h5>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="item">
                        <div class="card card-shadow border-0 mb-4">
                            <div class="card-body">
                                <div
                                    class="position-relative thumb bg-success-gradiant d-inline-block text-black mb-4"
                                >
                                    <img
                                        src="https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/testimonial/4.jpg"
                                        alt="Sarah Wilson"
                                        class="thumb-img position-absolute rounded-circle"
                                    />
                                    Sarah Wilson
                                </div>
                                <h5 class="font-weight-light">
                                    ⭐⭐⭐⭐⭐<br />
                                    "A fantastic purchase! The quality is
                                    superb, and the delivery was swift. I am
                                    thrilled with my order and will definitely
                                    be back for more!"
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once 'Components/footer.php' ?>
</body>
</html>