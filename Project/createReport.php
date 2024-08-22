<?php
// Including the script that handles session management
require_once 'session.php';

// Redirect the user to login page if he is not logged in.
if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

require_once 'DBconnection.php';

// Get total types of items
$total_item_types_query  = "SELECT COUNT(*) as total FROM items";
$total_item_types_result = $conn->query($total_item_types_query);
$total_item_types_       = $total_item_types_result->fetch_assoc()['total'];

// Get total number of items
$total_inventory_items_query  = "SELECT SUM(quantity) as total FROM items";
$total_inventory_items_result = $conn->query($total_inventory_items_query);
$total_inventory_items        = $total_inventory_items_result->fetch_assoc()['total'];

// Get total number of categories
$total_categories_query  = "SELECT COUNT(*) as total FROM categories";
$total_categories_result = $conn->query($total_categories_query);
$total_categories        = $total_categories_result->fetch_assoc()['total'];

// Get the total value of all items
$total_value_query  = "SELECT SUM(price * quantity) as total_value FROM items";
$total_value_result = $conn->query($total_value_query);
$total_value        = $total_value_result->fetch_assoc()['total_value'];

// Pagination setup
$items_per_page = isset($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 5;
$items_per_page = max(1, $items_per_page); // Ensure it's at least 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Ensure it's at least 1
$offset = ($page - 1) * $items_per_page;

$all_items_result = $conn->query("
    SELECT items.id, items.name, items.description, items.quantity, items.price, categories.category AS category
    FROM items
    JOIN categories ON items.category_id = categories.id
    ORDER BY items.id ASC
    LIMIT $offset, $items_per_page
");

$total_items_result = $conn->query("SELECT COUNT(*) as total FROM items");
$total_items = $total_items_result->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// Handle CSV Export
if (isset($_POST['export_csv'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=inventory_report.csv');

    $output = fopen('php://output', 'w');

    // Add summary information
    fputcsv($output, array('Summary Information'));
    fputcsv($output, array('Total Types of Items', $total_item_types_));
    fputcsv($output, array('Total Number of Items', $total_inventory_items));
    fputcsv($output, array('Total Number of Categories', $total_categories));
    fputcsv($output, array('Total Value of Items', '$' . number_format($total_value, 2)));
    fputcsv($output, array('')); // Empty row for spacing

    // Add header row
    fputcsv($output, array('ID', 'Name', 'Description', 'Quantity', 'Price', 'Category'));

    // Add item rows
    $result = $conn->query("
        SELECT
            items.id,
            items.name,
            items.description,
            items.quantity,
            items.price,
            categories.category AS category
        FROM items
        JOIN categories ON items.category_id = categories.id
        ORDER BY items.id ASC
    ");

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}
?>

<style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        /* Prevent horizontal scroll */
    }

    .container {
        max-width: 1200px;
        /* Adjust max width as needed */
        margin: auto;
        padding: 0 15px;
        /* Add some padding inside the container */
    }

    .card,
    .table {
        margin-bottom: 20px;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>


<body>
    <?php require_once 'Components/navigation/navigation.php'; ?>

    <section id="hero" class="hero section dark-background">
        <div class="container text-center">
            <div class="row gy-4">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1>Your report is ready!</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-center">
                    <img src="images/L-Report.png" class="floating" alt="Home Image" />
                </div>
            </div>
            <h2>Take a look at your inventory report below to see how your business is doing!</h2>
        </div>
    </section>

    <div class="container">
        <hr>

        <!-- Inventory Overview Section -->
        <h3 class="mb-4 text-center">Inventory Overview</h3>
        <div class="row row-cols-1 row-cols-md-4 g-5">
            <div class="col">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h3 class="card-title">Items</h3>
                        <h4 class="card-text"><?php echo $total_inventory_items; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h3 class="card-title">Items Types</h3>
                        <h4 class="card-text"><?php echo $total_item_types_; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h3 class="card-title">Categories</h3>
                        <h4 class="card-text"><?php echo $total_categories; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-info">
                    <div class="card-body text-center">
                        <h3 class="card-title">Total Value</h3>
                        <h4 class="card-text">$<?php echo number_format($total_value, 2); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <!-- Display Items with Pagination -->
        <div class="card-header">
            <h3>Existing Inventory</h3>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="" class="mb-3">
                    <label for="items_per_page" class="form-label">Items per Page:</label>
                    <select class="form-select" id="items_per_page" name="items_per_page" onchange="this.form.submit()">
                        <option value="5" <?php echo ($items_per_page == 5) ? 'selected' : ''; ?>>5</option>
                        <option value="10" <?php echo ($items_per_page == 10) ? 'selected' : ''; ?>>10</option>
                        <option value="20" <?php echo ($items_per_page == 20) ? 'selected' : ''; ?>>20</option>
                    </select>
                </form>

                <?php if ($all_items_result->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($item = $all_items_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['name']; ?></td>
                                        <td><?php echo $item['description']; ?></td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td><?php echo $item['price']; ?></td>
                                        <td><?php echo $item['category']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Controls -->
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>&items_per_page=<?php echo $items_per_page; ?>">Previous</a>
                            </li>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&items_per_page=<?php echo $items_per_page; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                                <a class="page-link" href="?page=<?php echo min($total_pages, $page + 1); ?>&items_per_page=<?php echo $items_per_page; ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                <?php else: ?>
                    <p>No items found.</p>
                <?php endif; ?>
            </div>
        </div>
        <hr>

        <!-- Export to CSV and View Graph Buttons -->
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <h3 class="mb-4">Inventory Report</h3>
                    <form action="" method="POST">
                        <button type="submit" class="btn btn-success" name="export_csv">Export to CSV</button>
                    </form>
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <h3 class="mb-4">Inventory Graph</h3>
                    <form action="graph.php">
                        <button type="submit" class="btn btn-success" name="view_graph">View Graph</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once 'Components/footer.php';
    $conn->close();
    ?>
</body>

</html>