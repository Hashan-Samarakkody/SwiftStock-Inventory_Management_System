<?php
require_once 'DBconnection.php';

// Function to validate and sanitize input
function validate_input($data, $type)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    switch ($type) {
        case 'string':
            return filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        case 'int':
            return filter_var($data, FILTER_VALIDATE_INT);
        case 'float':
            return filter_var($data, FILTER_VALIDATE_FLOAT);
        default:
            return false;
    }
}

// Function to get the maximum ID from the items table
function get_max_item_id($conn)
{
    $stmt = $conn->prepare("SELECT MAX(id) AS max_id FROM items");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['max_id'] ? (int)$row['max_id'] : 0; // Return 0 if no rows are found
}

// Check if category already exists
function category_exists($conn, $category_name)
{
    $stmt = $conn->prepare("SELECT id FROM categories WHERE UPPER(category) = ?");
    $stmt->bind_param("s", strtoupper($category_name));
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Add new category to the database
if (isset($_POST['add_category'])) {
    $category_name = validate_input($_POST['category_name'], 'string');

    if ($category_name) {
        // Convert category name to uppercase
        $category_name = strtoupper($category_name);

        // Check if the category already exists
        if (category_exists($conn, $category_name)) {
            $feedback_message = "Category already exists. Please choose a different name.";
        } else {
            $stmt = $conn->prepare("INSERT INTO categories (category) VALUES (?)");
            $stmt->bind_param("s", $category_name);
            $stmt->execute();
            $stmt->close();

            $feedback_message = "Category added successfully!";
        }
    } else {
        $feedback_message = "Invalid category name. Please check your input!";
    }

    // Redirect with feedback message
    header("Location: manage_inventory.php?feedback_message=" . urlencode($feedback_message));
    exit();
}

// Check if an item exists by name or ID
function item_exists($conn, $id_or_name)
{
    if (is_numeric($id_or_name)) {
        $stmt = $conn->prepare("SELECT id FROM items WHERE id = ?");
        $stmt->bind_param("i", $id_or_name);
    } else {
        $stmt = $conn->prepare("SELECT id FROM items WHERE name = ?");
        $stmt->bind_param("s", $id_or_name);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists;
}

// Add new item to the database
if (isset($_POST['submit'])) {
    $name        = validate_input($_POST['name'], 'string');
    $description = validate_input($_POST['description'], 'string');
    $quantity    = validate_input($_POST['quantity'], 'int');
    $price       = validate_input($_POST['price'], 'float');
    $category_id = validate_input($_POST['category_id'], 'int');

    if ($name && $description && $quantity !== false && $price !== false && $category_id !== false) {
        // Check if item already exists
        if (item_exists($conn, $name)) {
            $feedback_message = "Item already exists. Please update the item instead.";
        } else {
            // Get the new ID (one greater than the current maximum)
            $new_id = get_max_item_id($conn) + 1;

            // Prepare and execute the INSERT query
            $stmt = $conn->prepare("INSERT INTO items (id, name, description, quantity, price, category_id) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("issidi", $new_id, $name, $description, $quantity, $price, $category_id);
                if ($stmt->execute()) {
                    $feedback_message = "Item added successfully!";
                } else {
                    $feedback_message = "An error occurred while adding the item. Please try again!";
                }
                $stmt->close();
            } else {
                $feedback_message = "An error occurred. Please try again!";
            }
        }
    } else {
        $feedback_message = "Invalid input data. Please check your input!";
    }

    // Redirect with feedback message
    header("Location: manage_inventory.php?feedback_message=" . urlencode($feedback_message));
    exit();
}

// Close the database connection
$conn->close();
