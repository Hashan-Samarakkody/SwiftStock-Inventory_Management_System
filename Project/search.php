<?php
// Including the script that handles session management
require_once 'session.php';

// Redirect to home page if not logged in
if (!isset($_SESSION['loggedIn'])) {
    header('Location: home.php');
    exit();
}

// Set the database connection
require_once 'DBconnection.php';

// Initialize variables for search parameters and pagination
$search_id       = isset($_GET['id']) ? intval($_GET['id']) : null;
$search_name     = isset($_GET['name']) ? $_GET['name'] : null;
$search_category = isset($_GET['category']) ? $_GET['category'] : null;

// Initialize feedback messages
$feedback_message = "";
$results_found    = false;

// Prepare SQL query based on search parameters and pagination
$query  = "";
$params = [];
$type   = '';


if ($search_id) {
    // Search by item ID
    $query = "SELECT items.id, items.name, items.description, items.quantity, items.price, categories.category
              FROM items
              LEFT JOIN categories ON items.category_id = categories.id
              WHERE items.id = ?";
    $params = [$search_id];
    $type   = 'i'; // Integer for ID, and two integers for offset and items_per_page

} elseif ($search_name) {
    // Search by item name
    $query = "SELECT items.id, items.name, items.description, items.quantity, items.price, categories.category
              FROM items
              LEFT JOIN categories ON items.category_id = categories.id
              WHERE items.name LIKE ?";
    $params = ["%$search_name%"];
    $type   = 's'; // String for name, and two integers for offset and items_per_page

} elseif ($search_category) {
    // Search by category
    $query = "SELECT items.id, items.name, items.description, items.quantity, items.price, categories.category
              FROM items
              LEFT JOIN categories ON items.category_id = categories.id
              WHERE categories.category LIKE ?";
    $params = ["%$search_category%"];
    $type   = 's'; // String for category, and two integers for offset and items_per_page

} else {
    $feedback_message = "Please provide a search criteria.";
}

// Execute the query if it's set
$all_items_result = null;
if ($query) {

    // Execute the query
    $stmt = $conn->prepare($query);

    // Bind parameters and execute the query
    if ($stmt) {
        $stmt->bind_param($type, ...$params);
        $stmt->execute();
        $all_items_result = $stmt->get_result();

        // Get the total number of items for pagination
        if ($search_id) {
            $count_query = "SELECT COUNT(*) as total FROM items WHERE id = ?";
        } elseif ($search_name) {
            $count_query = "SELECT COUNT(*) as total FROM items WHERE name LIKE ?";
        } elseif ($search_category) {
            $count_query = "SELECT COUNT(*) as total FROM items
                            JOIN categories ON items.category_id = categories.id
                            WHERE categories.category = ?";
        } else {
            $count_query = "SELECT COUNT(*) as total FROM items";
        }

        // Execute the count query
        $count_stmt = $conn->prepare($count_query);

        // Bind parameters and execute the count query
        if ($count_stmt) {
            if ($search_id) {
                $count_stmt->bind_param('i', $search_id);
            } elseif ($search_name) {
                $count_stmt->bind_param('s', $search_name);
            } elseif ($search_category) {
                $count_stmt->bind_param('s', $search_category);
            }
            $count_stmt->execute();
            $total_items_result = $count_stmt->get_result();
            $total_items = $total_items_result->fetch_assoc()['total'];

            // Check if any items were found
            if ($all_items_result->num_rows > 0) {
                $results_found = true;
            } else {
                $feedback_message = "No items found.";
            }
        }
    }
}

// Include the header
require_once 'Components/navigation/navigation.php';
?>

<body>
    <section id="hero" class="hero section">
        <div class="container">
            <div class="row gy-4">
                <div
                    class="col-lg-6 order-1 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>
                        Looking For Somthing?
                    </h1>
                    <br>
                </div>
                <div
                    class="col-lg-6 order-1 order-lg-2 justify-content-center"
                    data-aos-delay="200">
                    <img src="images/L-Search.png" class="floating" alt="Home Image" />
                </div>
            </div>
            <h2>
                Try searching for items by ID, name, or category!
            </h2>
            <br>
        </div>
    </section>
    <hr>
    <div class="container mt-5">
        <h3 class="text-center">Search Items</h3>
        <h4>You can only search by one criteria at a time. To search next time, please clear the search criteria,
            and then enter the new search criteria.
        </h4>
        <br>
        <form class="form-inline mb-4" method="GET" action="">
            <!-- Search Inputs -->
            <div>
                <label style="font-size: 20px; font-weight:500;" for="id">Search by Item ID:</label>
                <input type="search" id="id" name="id" min='1' pattern="[0-9]+" class="form-control w-50" value="<?php echo htmlspecialchars($search_id); ?>" placeholder="Enter item ID" title="Must contain numbers only">
            </div>
            <div>
                <label style="font-size: 20px; font-weight:500;" for="name">Search by Item Name:</label>
                <input type="search" id="name" name="name" pattern="[a-zA-Z]+" title="Must contain lowercase or uppercase letters only" class="form-control w-50" value="<?php echo htmlspecialchars($search_name); ?>" placeholder="Enter item name">
            </div>
            <div>
                <label style="font-size: 20px; font-weight:500;" for="category">Search by Category:</label>
                <input type="search" id="category" name="category" pattern="[a-zA-Z]+" title="Must contain lowercase or uppercase letters only" class="form-control w-50" value="<?php echo htmlspecialchars($search_category); ?>" placeholder="Enter category name">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Search</button>
            <button type="submit" id="clearBtn" class="btn btn-outline-secondary">Clear</button>
        </form>

        <div class="card-body">
            <!-- Display Feedback Messages -->
            <?php if (!empty($feedback_message)):
                if (str_contains($feedback_message, 'No')) {
                    $feedback_message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>" . $feedback_message . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                } else {
                    $feedback_message = "<div class='alert alert-info alert-dismissible fade show' role='alert'>" . $feedback_message . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
                echo $feedback_message;
            endif; ?>

            <?php if ($results_found): ?>
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
                                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td><?php echo htmlspecialchars($item['description']); ?></td>
                                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <br>
            <?php endif; ?>
        </div>
        <br>
        <br>
    </div>

    <script>
        // Clear button functionality
        document.getElementById('clearBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent form submission
            document.getElementById('id').value = '';
            document.getElementById('name').value = '';
            document.getElementById('category').value = '';
            this.form.submit(); // Submit form to clear query parameters
        });
    </script>

</body>
<?php
require_once 'Components/footer.php';
// Close the database connection
$conn->close();
?>

</html>