<?php
require_once 'DBconnection.php';

// Initialize feedback message
$feedback_message = '';

// Handle item update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);

    // Validate data
    if (!$id || !$name || !$description || !$price || !$quantity || !$category_id) {
       echo "Invalid input. Please check your data and try again.";
        exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("UPDATE items SET name = ?, description = ?, price = ?, quantity = ?, category_id = ? WHERE id = ?");

    if ($stmt === false) {
        echo "An error occured. Please try again!";
        exit();
    }

    $stmt->bind_param("ssdisi", $name, $description, $price, $quantity, $category_id, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Item updated successfully!";
        } else {
            echo "No changes made to the item.";
        }
    } else {
        echo "Failed to update item. Please try again!";
    }

    $stmt->close();
    $conn->close();
    exit();
} else {
    echo "Invalid request method!";
    exit();
}
