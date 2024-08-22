<?php
// Including the script that handles session management
require_once 'session.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

// Include the navigation component
require_once 'Components/navigation/navigation.php';
?>

<style>
    /* General Flexbox settings for rows */
    .row {
        display: flex;
        flex-wrap: wrap;
    }

    /* Styling for team member cards */
    #team-member-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background-color: #fff;
        border-radius: 0.25rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        padding: 2rem;
        align-items: center;
    }

    .team-member-card img {
        max-width: 100%;
        border-radius: 50%;
        margin-bottom: 1rem;
    }

    .team-member-card h5 {
        margin-top: 0;
        font-size: 1.25rem;
    }

    .team-member-card p {
        margin-bottom: 0;
        font-size: 0.875rem;
        flex: 1;
    }

    .team-member img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
    }

    .team-member {
        text-align: center;
        margin-bottom: 30px;
    }

    .team-member h5 {
        margin-top: 10px;
        font-size: 1.2rem;
    }

    .team-member p {
        font-size: 0.9rem;
    }

    .contact-info a {
        display: block;
        margin-bottom: 10px;
    }

    .bg-light-custom {
        background-color: #f8f9fa;
    }

    .font-italic {
        font-style: italic;
    }
</style>

<body>
    <div class="bg-light">
        <div class="container py-5">
            <div class="row h-100 align-items-center py-5">
                <div class="col-lg-6">
                    <h1>Who we are?</h1>
                    <p class="lead mb-0">
                        SwiftStock is a leading provider of inventory
                        management solutions designed to help businesses
                        streamline their operations and drive growth. Our
                        innovative platform offers a comprehensive suite of
                        features that enable organizations to manage their
                        inventory with ease and efficiency. Whether you're a
                        small business or a large enterprise, SwiftStock is
                        here to support your inventory management needs.
                    </p>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img
                        src="images/About Us.png"
                        alt="SwiftStock team working on inventory management"
                        class="floating" />
                </div>
            </div>
        </div>
    </div>

    <!-- Content for the about us page -->
    <div class="bg-white py-5">
        <div class="container py-5">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <h2 class="font-weight-light">Our Story</h2>
                    <p class="font-italic mb-4">
                        At SwiftStock, our journey began with a vision to
                        revolutionize the way businesses handle inventory.
                        We saw the challenges that companies face with
                        managing stock levels, and we knew there had to be a
                        better way. Our platform was created to address
                        these challenges and provide a solution that
                        combines technology with user-centric design.
                    </p>
                    <p class="font-italic mb-4">
                        From our humble beginnings, we've focused on
                        creating a system that not only meets the needs of
                        today's businesses but also anticipates future
                        demands. Our team of experts is dedicated to
                        continuous innovation, ensuring that SwiftStock
                        evolves to stay ahead of industry trends and provide
                        our users with the best possible experience.
                    </p>
                    <p class="font-italic mb-4">
                        We are passionate about helping businesses of all
                        sizes optimize their inventory management processes.
                        Whether you're a small retailer or a large
                        enterprise, SwiftStock is here to support your growth
                        and success.
                    </p>
                </div>
                <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2">
                    <img
                        src="images/AB1.png"
                        alt="Team working together on inventory management software"
                        class="img-fluid mb-4 mb-lg-0" />
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 px-5 mx-auto">
                    <img
                        src="images/AB2.png"
                        alt="Vision and mission of the company depicted with graphics"
                        class="img-fluid mb-4 mb-lg-0" />
                </div>
                <div class="col-lg-6">
                    <h2 class="font-weight-light">Our Vision & Mission</h2>
                    <p class="font-italic mb-4">
                        <strong>Vision:</strong> To be the leading innovator
                        in inventory management solutions, empowering
                        businesses around the world with tools that drive
                        efficiency, growth, and success.
                    </p>
                    <p class="font-italic mb-4">
                        <strong>Mission:</strong> Our mission is to deliver
                        a powerful, user-friendly inventory management
                        platform that simplifies complex processes, enhances
                        decision-making, and integrates seamlessly with
                        existing systems. We strive to support businesses of
                        all sizes in achieving operational excellence and
                        fostering long-term success.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light py-5">
        <div class="container py-5">
            <div class="row mb-4">
                <div class="col-lg-5">
                    <h2>Our Team</h2>
                    <p class="font-italic">
                        Meet the dedicated professionals behind SwiftStock.
                    </p>
                </div>
            </div>

            <div class="row text-center">
                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D5603AQE-D9pC1FEyjg/profile-displayphoto-shrink_200_200/0/1713764021460?e=2147483647&v=beta&t=tnIA24_pFPKy6NbB3BY-fUcdut6VThhNy0Q4s4UuOm0"
                            alt="Dinan Jayasuriya, Founder & CEO of SwiftStock"
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Mr. Dinan Jayasuriya
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">
                            Founder & CEO
                        </span>
                        <br>
                        <p class="text-center mb-4">
                            With a passion for technology and innovation,
                            Dinan leads the SwiftStock team with a vision to
                            revolutionize inventory management. His
                            expertise in software development and business
                            strategy drives our mission forward.
                        </p>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D5603AQG-zzgrNFhlUw/profile-displayphoto-shrink_200_200/0/1718275589182?e=2147483647&v=beta&t=L4lMm3-VT1MPRbJ7M3RGZc-VmBPKwd1NkKfMY6liBKY"
                            alt="Smadhi Wadithya, Chief UI/UX Designer at SwiftStock"
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Ms. Smadhi Wadithya
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">
                            Chief UI/UX Designer
                        </span>
                        <br>
                        <p class="text-center mb-4">
                            Smadhi focuses on designing an intuitive and
                            engaging user experience for SwiftStock. Her
                            creative design approach ensures that our
                            platform is both functional and visually
                            appealing.
                        </p>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D5603AQErJx2_of9OlQ/profile-displayphoto-shrink_200_200/0/1711042500358?e=2147483647&v=beta&t=WUl12M9umNbBaNlWb3mfWpwB7N_BpZmleMAdkptwUTc"
                            alt="Mathumithan Manickaretnam, Lead Developer at SwiftStock"
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Mr. Mathumithan Manickaretnam
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">
                            Lead Developer
                        </span>
                        <br>
                        <p class="text-center mb-4">
                            Mathumithan's technical expertise and experience
                            in software development contribute to the
                            continuous improvement and enhancement of the
                            SwiftStock platform. He is dedicated to
                            delivering cutting-edge solutions.
                        </p>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D4E03AQEp0EnvSooBzA/profile-displayphoto-shrink_200_200/0/1712249396726?e=2147483647&v=beta&t=GL9d20uUCi-JA-psCjmucdi7S1vWlnIp8gKdL6Y8hDM"
                            alt="Nuzha Kitchilan, Product Manager at SwiftStock"
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Ms. Nuzha Kitchilan
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">
                            Product Manager
                        </span>
                        <br>
                        <p class="text-center mb-4">
                            Nuzha manages product development and ensures
                            that our system aligns with user needs and
                            market trends. Her keen eye for detail and
                            product vision drive our innovation.
                        </p>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D4E03AQGxDDN3CdHC_Q/profile-displayphoto-shrink_200_200/0/1711287985406?e=2147483647&v=beta&t=gHDIyVk04aCZoVeraCNBjEjpJR3_ZDZdlt5bs5Wnlgo"
                            alt="Shenal Fonseka, Marketing Director at SwiftStock"
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Mr. Shenal Fonseka
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">
                            Marketing Director
                        </span>
                        <br>
                        <p class="text-center mb-4">
                            Shenal is responsible for shaping our brand and
                            communicating the value of SwiftStock to our
                            audience. His strategic marketing efforts help
                            us connect with businesses and showcase our
                            unique offerings.
                        </p>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D4D03AQFH1C73ItpluQ/profile-displayphoto-shrink_200_200/0/1711026771775?e=2147483647&v=beta&t=NC-ljLPyVkHFu25jeTr7zw0ShON-9mmd427Gv0EVncQ"
                            alt="Hansini Ratnayaka, Customer Success Manager at SwiftStock"
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Ms. Hansini Ratnayaka
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">
                            Customer Success Manager
                        </span>
                        <br>
                        <p class="text-center mb-4">
                            Hansini ensures that our customers have a
                            seamless experience with SwiftStock. Her
                            dedication to customer support and satisfaction
                            helps us build lasting relationships and trust.
                        </p>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D4E03AQGfKbO4gDjLOA/profile-displayphoto-shrink_200_200/0/1711940738100?e=2147483647&v=beta&t=3llXaK_03Qz9lg0rAeHQwdD2sNvYrkSvuXOmt8taTxY"
                            alt=""
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Mr. Hashan Samarakkodi
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">Lead Software Engineer</span>
                        <br>
                        <p class="text-center mb-4">
                            Hashan's role involves developing and
                            maintaining the technical aspects of our
                            platform. His problem-solving skills and
                            programming expertise contribute to the system’s
                            reliability and performance.
                        </p>
                    </div>
                </div>
                <!-- End-->

                <!-- Team item-->
                <div class="col-xl-3 col-sm-6 mb-5">
                    <div
                        class="bg-white rounded shadow-sm py-5 px-4"
                        id="team-member-card">
                        <img
                            src="https://media.licdn.com/dms/image/D5603AQGfi-s7ChpvKA/profile-displayphoto-shrink_200_200/0/1712117739547?e=2147483647&v=beta&t=tNc1cfAcGLOFUSkfO9vPri8B_v4-lwAKmvilN1JYeRs"
                            alt="Githmi De Silva, Chief Operations Officer at SwiftStock"
                            width="100"
                            class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" />
                        <h4 class="text-center mb-0">
                            Ms. Githmi De Silva
                        </h4>
                        <span
                            class="small text-uppercase text-muted font-italic">
                            Chief Operations Officer
                        </span>
                        <br>
                        <p class="text-center mb-4">
                            Githmi oversees daily operations and ensures
                            that our inventory management system meets the
                            highest standards of quality and performance.
                            Her organizational skills and operational
                            insight are pivotal to our success.
                        </p>
                    </div>
                </div>
                <!-- End-->
            </div>
        </div>
    </div>
</body>
<?php require_once 'Components/footer.php'; ?>

</html>