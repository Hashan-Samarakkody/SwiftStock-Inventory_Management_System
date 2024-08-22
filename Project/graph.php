<?php
// Including the script that handles session management
require_once 'session.php';


// Redirect the user to login page if he is not logged in.
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection file
require_once 'DBconnection.php';

// Query to get the total number of item types
$total_item_types_query  = "SELECT COUNT(*) as total FROM items";
$total_item_types_result = $conn->query($total_item_types_query);
$total_item_types_       = $total_item_types_result->fetch_assoc()['total'];

// Query to get the total quantity of inventory items
$total_inventory_items_query  = "SELECT SUM(quantity) as total FROM items";
$total_inventory_items_result = $conn->query($total_inventory_items_query);
$total_inventory_items        = $total_inventory_items_result->fetch_assoc()['total'];

// Query to get the total number of categories
$total_categories_query  = "SELECT COUNT(*) as total FROM categories";
$total_categories_result = $conn->query($total_categories_query);
$total_categories        = $total_categories_result->fetch_assoc()['total'];

// Query to get the total value of all items (price * quantity)
$total_value_query  = "SELECT SUM(price * quantity) as total_value FROM items";
$total_value_result = $conn->query($total_value_query);
$total_value        = $total_value_result->fetch_assoc()['total_value'];

// Array to store data points for the chart
$dataPoints = array();

// Query to get total quantity of items per category
$sql = "SELECT c.category, SUM(i.quantity) AS total_quantity
        FROM items i
        JOIN categories c ON i.category_id = c.id
        GROUP BY c.category;";

// Execute the query and fetch results
$result = $conn->query($sql);

// Check if there are results and populate the dataPoints array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($dataPoints, array("label" => $row['category'], "y" => $row['total_quantity']));
    }
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Include Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous" />
    <!-- Include Bootstrap JS -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <!-- Include CanvasJS library for charts -->
    <script defer src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
        // Create and render the chart when the page loads
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Items per category"
                },
                axisY: {
                    title: "Quantity"
                },
                axisX: {
                    title: "Category"
                },
                data: [{
                    type: "column",
                    yValueFormatString: "#,##0.## items",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</head>

<body style="margin: 10px 20px;">
    <!-- Alert message to inform about categories without items -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <h4 class="text-center">Categories with no items are not shown in the graph!</h4>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <br>
    <!-- Chart container for displaying the chart -->
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <br>
    <h3 class="mb-4 text-center">Inventory Overview</h3>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <!-- Card displaying total inventory items -->
            <div class="col">
                <div class="card border-info">
                    <div class="card-body">
                        <h2 class="card-title text-center">Items</h2>
                        <h3 class="card-text text-center"><?php echo $total_inventory_items; ?></h3>
                    </div>
                </div>
            </div>
            <!-- Card displaying total item types -->
            <div class="col">
                <div class="card border-info">
                    <div class="card-body">
                        <h2 class="card-title text-center">Items Types</h2>
                        <h3 class="card-text text-center"><?php echo $total_item_types_; ?></h3>
                    </div>
                </div>
            </div>
            <!-- Card displaying total categories -->
            <div class="col">
                <div class="card border-info">
                    <div class="card-body">
                        <h2 class="card-title text-center">Categories</h2>
                        <h3 class="card-text text-center"><?php echo $total_categories; ?></h3>
                    </div>
                </div>
            </div>
            <!-- Card displaying total value of all items -->
            <div class="col">
                <div class="card border-info">
                    <div class="card-body">
                        <h2 class="card-title text-center">Total Value</h2>
                        <h3 class="card-text text-center">$<?php echo number_format($total_value, 2); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- Button to navigate back to the create report page -->
    <div class="d-flex justify-content-center align-items-center">
        <button type="button" class="btn btn-outline-primary" id="Back">
            Back
        </button>
    </div>

    <script>
        // Redirect to the createReport.php page when the Back button is clicked
        document.getElementById('Back').addEventListener('click', function() {
            window.location.href = 'createReport.php';
        });
    </script>
</body>

</html>