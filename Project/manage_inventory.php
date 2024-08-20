<?php
// Including the script that handles session management
require_once 'session.php';

if (!isset($_SESSION['loggedIn'])) {
    header('Location: login.php');
    exit();
}

require_once 'DBconnection.php';

$categories1 = $conn->query("SELECT id, category FROM categories");

// Fetch feedback message from URL parameters
$feedback_message = isset($_GET['feedback_message']) ? htmlspecialchars($_GET['feedback_message']) : '';

require_once 'Components/navigation/navigation.php';
?>

<body style="margin:0;">
    <section id="hero" class="hero section dark-background">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-1 order-lg-3 d-flex flex-column justify-content-center">
                    <h1>Manage Your Inventory!</h1>
                    <br />
                </div>
                <div class="col-lg-6 order-1 order-lg-2 justify-content-center" data-aos-delay="500">
                    <img src="images/L-Mnage.png" class="floating" alt="Home Image" />
                </div>
            </div>
            <br /><br />
            <h2>Here, you can add, update, and delete items from your inventory!</h2>
            <hr>
        </div>
    </section>

    <div class="container my-5">
        <!-- Feedback Message -->
        <?php if (!empty($feedback_message)): ?>
            <?php
            $alert_class = 'alert-info';
            if (str_contains($feedback_message, 'not')) {
                $alert_class = 'alert-warning';
            } elseif (str_contains($feedback_message, 'successfully')) {
                $alert_class = 'alert-success';
            } elseif (str_contains($feedback_message, 'Invalid') || str_contains($feedback_message, 'error')) {
                $alert_class = 'alert-danger';
            }
            ?>
            <div class="alert <?= $alert_class ?> alert-dismissible fade show" role="alert">
                <?= $feedback_message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h2 class="text-dark">Start Managing Your Inventory</h2>
        <br>

        <!-- Add Item Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-dark font-weight-bold">Add New Item</h3>
            </div>
            <div class="card-body">
                <form action="adddata.php" method="POST">
                    <div class="mb-3">
                        <label style="font-weight: 500; font-size:17px;" for="name">Item Name</label>
                        <input type="text" name="name" id="name" class="form-control" pattern="^[A-Za-z0-9\- ]+$" title="Only letters, digits, hypen and spaces are allowed" placeholder="Enter the item name" required>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 500; font-size:17px;" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" title="Maximum of 500 characters are allowed" maxlength="500" placeholder="Enter item description here" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 500; font-size:17px;" for="price">Price</label>
                        <input type="number" min="1" class="form-control" id="price" step="0.01" name="price" pattern="[0-9]+" title="Must be a digit" placeholder="Enter the price" required>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 500; font-size:17px;" for="quantity">Quantity</label>
                        <input type="number" min="1" class="form-control" id="quantity" step="1" name="quantity" pattern="[0-9]+" title="Must be a digit" placeholder="Enter the quantity" required>
                    </div>
                    <div class="mb-3">
                        <label style="font-weight: 500; font-size:17px;" for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            <?php while ($category = $categories1->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($category['id']); ?>"><?= htmlspecialchars($category['category']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-primary">Add Item</button>
                </form>
            </div>
        </div>

        <!-- Manage Categories Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="text-dark font-weight-bold">Manage Categories</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Add Category Form -->
                    <div class="col-md-6 mb-3">
                        <form method="POST" action="adddata.php">
                            <div class="mb-3">
                                <label style="font-weight: 500; font-size:17px;" for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" pattern="[A-Za-z ]+" title="Only letters and spaces are allowed" required>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-success">Add Category</button>
                        </form>
                    </div>

                    <!-- Delete Category Form -->
                    <div class="col-md-6 mb-3">
                        <form method="POST" action="deletedata.php">
                            <div class="mb-3">
                                <label style="font-weight: 500; font-size:17px;" for="delete_category_id">Select Category to Delete</label>
                                <select class="form-control" id="delete_category_id" name="delete_category_id" required>
                                    <option value="">Select a category</option>
                                    <?php
                                    $categories_result = $conn->query("SELECT id, category FROM categories");
                                    while ($category = $categories_result->fetch_assoc()):
                                    ?>
                                        <option value="<?= htmlspecialchars($category['id']); ?>"><?= htmlspecialchars($category['category']); ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <button type="submit" name="delete_category" class="btn btn-danger">Delete Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Items with Pagination -->
        <section>
            <div class="container">
                <?php
                // Pagination setup
                $items_per_page = isset($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 5;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $items_per_page;

                $all_items_result = $conn->query("SELECT items.id, items.name, items.description, items.quantity, items.price, categories.category AS category
                                                  FROM items
                                                  JOIN categories ON items.category_id = categories.id
                                                  ORDER BY items.id DESC
                                                  LIMIT $offset, $items_per_page");

                $total_items_result = $conn->query("SELECT COUNT(*) as total FROM items");
                $total_items = $total_items_result->fetch_assoc()['total'];
                $total_pages = ceil($total_items / $items_per_page);
                ?>

                <div class="card-body">
                    <!-- Items Per Page Selector -->
                    <form method="GET" action="">
                        <label style="font-weight: 500; font-size:18px;" for="items_per_page" class="form-label">Items per Page:</label>
                        <select class="selectpicker mb-3" id="items_per_page" name="items_per_page" onchange="this.form.submit()">
                            <option value="5" <?= ($items_per_page == 5) ? 'selected' : ''; ?>>5</option>
                            <option value="10" <?= ($items_per_page == 10) ? 'selected' : ''; ?>>10</option>
                            <option value="20" <?= ($items_per_page == 20) ? 'selected' : ''; ?>>20</option>
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
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($item = $all_items_result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['id']); ?></td>
                                            <td><?= htmlspecialchars($item['name']); ?></td>
                                            <td><?= htmlspecialchars($item['description']); ?></td>
                                            <td><?= htmlspecialchars($item['quantity']); ?></td>
                                            <td><?= htmlspecialchars($item['price']); ?></td>
                                            <td><?= htmlspecialchars($item['category']); ?></td>
                                            <td><button class="btn btn-primary btn-edit" data-id="<?= htmlspecialchars($item['id']); ?>">Edit</button></td>
                                            <td>
                                                <form method="POST" action="deletedata.php" style="display:inline;">
                                                    <input type="hidden" name="delete_item_id" value="<?= htmlspecialchars($item['id']); ?>">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Controls -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <!-- Previous Button -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= max(1, $page - 1); ?>&items_per_page=<?= $items_per_page; ?>">Previous</a>
                                </li>
                                <!-- Page Numbers -->
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?= $i; ?>&items_per_page=<?= $items_per_page; ?>"><?= $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <!-- Next Button -->
                                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?= min($total_pages, $page + 1); ?>&items_per_page=<?= $items_per_page; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    <?php else: ?>
                        <p>No items found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <!-- Update Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm">
                            <input type="hidden" id="updateId" name="id">
                            <div class="mb-3">
                                <label for="updateName" class="form-label">Item Name</label>
                                <input type="text" class="form-control" id="updateName" name="name" pattern="^[A-Za-z0-9\- ]+$" title="Only letters, digits, hypen and spaces are allowed" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="updateDescription" name="description" rows="3" title="Maximum of 500 characters are allowed" maxlength="500" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="updatePrice" class="form-label">Price</label>
                                <input type="number" min="1" class="form-control" id="updatePrice" step="0.01" name="price" pattern="[0-9]+" title="Must be a digit" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateQuantity" class="form-label">Quantity</label>
                                <input type="number" min="1" class="form-control" id="updateQuantity" step="1" name="quantity" pattern="[0-9]+" title="Must be a digit" required>
                            </div>
                            <div class="mb-3">
                                <label for="updateCategory" class="form-label">Category</label>
                                <select class="form-select" id="updateCategory" name="category_id" required>
                                    <!-- Options will be populated via JavaScript -->
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <div id="updateFeedback" class="mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AJAX Script -->
    <script>
        // Wait for the DOM to be loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap Modal
            const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));

            // Add event listener to 'Edit' buttons
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.dataset.id;
                    fetchItemData(itemId); // Fetch item data from the server
                });
            });

            // Event listener for the 'Update' form submission
            document.getElementById('updateForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('updatedata.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(text => {
                        document.getElementById('updateFeedback').innerText = text;
                        if (text.includes('successfully')) {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('updateFeedback').innerText = 'An error occurred. Please try again.';
                    });
            });


            function fetchItemData(id) {
                fetch(`get_item.php?id=${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Set the values of the update form fields
                        document.getElementById('updateId').value = data.id;
                        document.getElementById('updateName').value = data.name;
                        document.getElementById('updateDescription').value = data.description;
                        document.getElementById('updatePrice').value = data.price;
                        document.getElementById('updateQuantity').value = data.quantity;

                        // Populate the category select options
                        const categorySelect = document.getElementById('updateCategory');
                        categorySelect.innerHTML = '';
                        data.categories.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.text = category.category;

                            // Set the selected option
                            if (category.id === data.category_id) {
                                option.selected = true;
                            }

                            // Append the option to the select
                            categorySelect.appendChild(option);
                        });

                        // Show the modal
                        updateModal.show();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('updateFeedback').innerText = 'Failed to load item data. Please try again.';
                    });
            }
        });
    </script>

    <?php require_once "Components/footer.php"; ?>
</body>

</html>