<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800&display=swap');
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

        body, footer {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            background-color: #333;
            color: #fff;
            padding: 5px;
            width: 100%;
            position: fixed;
            bottom: 0;
            box-sizing: border-box;
        }

        .footer-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-links, .social-media-icons {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li, .social-media-icons li {
            margin: 1px 0;
        }

        .footer-links a, .social-media-icons a {
            color: #fff;
            text-decoration: none;
            font-size: 10px; /* Font size for all links */
        }

        .footer-links a:hover, .social-media-icons a:hover {
            text-decoration: underline;
        }

        .social-media-icons {
            display: flex;
            justify-content: center;
            padding: 0;
        }

        .social-media-icons a {
            font-size: 12px;
            margin: 0 4px;
        }

        .footer-subscribe {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .footer-subscribe h4 {
            margin-bottom: 2px 0 /* Space below the heading */
            font-size: 10px; /* Match font size with other sections */
            font-weight: 600;
        }

        .footer-subscribe .description {
            margin: 0; /* Remove margin between description paragraphs */
            font-size: 10px; /* Match font size with other sections */
            max-width: 200px; /* Limit width for better alignment */
        }

        .footer-subscribe .description + .description {
            margin-top: 2px; /* Space between description lines */
        }

        .footer-subscribe form {
            margin-top: 50px; /* Space above the form */
        }

        .footer-subscribe input[type="email"] {
            padding: 4px;
            margin-right: 4px;
            border: none;
            border-radius: 4px;
            font-size: 10px;
        }

        .footer-subscribe button {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            background-color: #555;
            color: #fff;
            cursor: pointer;
            font-size: 10px;
        }

        .footer-subscribe button:hover {
            background-color: #777;
        }

        .footer-bottom {
            grid-column: span 3;
            text-align: center;
            font-size: 8px;
        }

        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <footer class="footer-container">
        <div class="footer-section">
            <h4>Company</h4>
            <ul class="footer-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Follow Us</h4>
            <ul class="social-media-icons">
                <li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
        <div class="footer-section footer-subscribe">
            <h4>Newsletter</h4>
            <p class="description">Subscribe to our newsletter for</p>
            <p class="description">a weekly dose of news, updates,</p>
            <p class="description">and handful of offers.</p>
            <form action="#" method="post">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> | SwiftStock | All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
