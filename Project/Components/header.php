<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Character encoding for the document -->
    <meta charset="UTF-8" />
    <!-- Viewport settings for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Title of the web page -->
    <title>SwiftStock</title>

    <!-- Icon for the web page, displayed in the browser tab -->
    <link href="images/logo.png" rel="icon" />

    <!-- Link to Bootstrap CSS for styling -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />

    <!-- Custom CSS files for additional styling -->
    <link rel="stylesheet" href="Components/navigation/navstyle.css" />
    <link rel="stylesheet" href="Components/footer.css" />
    <link rel="stylesheet" href="landing.css" />

    <!-- Internal CSS for specific page styles -->
    <style>
        /* Add space at the top of the body to avoid content overlap with the navbar */
        body {
            padding-top: 50px;
            /* Adjust this value based on your navbar height */
        }

        /* General margin for sections */
        section {
            margin: 5px;
        }

        /* Styles for main heading */
        h1 {
            font-size: 70px;
            font-weight: bold;
            text-align: center;
        }

        /* Styles for secondary headings */
        h2 {
            font-size: 45px;
            font-weight: bold;
            text-align: center;
            margin-top: 60px;
            color: rgb(13, 110, 251);
        }

        /* Styles for tertiary headings */
        h3 {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
        }

        /* Responsive styles for smaller screens */
        @media (max-width: 1000px) {

            /* Adjust font size for headings on smaller screens */
            h1 {
                font-size: 60px;
            }

            h2 {
                font-size: 30px;
            }

            h3 {
                font-size: 25px;
            }

            /* Adjust width of select options and dropdowns */
            option {
                width: 200px;
            }

            select {
                width: 50%;
            }
        }
    </style>

    <!-- Link to Bootstrap JS for functionality (loaded after page content) -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Link to jQuery (slim version) for additional JavaScript functionality -->
    <script defer src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Link to Popper.js for Bootstrap tooltips and popovers -->
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <!-- Link to jQuery for additional functionality -->
    <script
        defer
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>

    <!-- Link to Chart.js for rendering charts -->
    <script defer src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <!-- Link to custom JavaScript files for page-specific functionality -->
    <script defer src="verification.js"></script>
    <script defer src="main.js"></script>
</head>