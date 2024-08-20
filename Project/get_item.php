<?php
require_once 'DBconnection.php';

// Sanitize and validate the ID from GET parameters
$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : 0;

if ($id !== false && $id > 0) {
    // Prepare and execute the query to fetch item details
    $stmt = $conn->prepare("SELECT id, name, description, price, quantity, category_id FROM items WHERE id = ?");

    if ($stmt === false) {
        echo json_encode(['error' => 'Database error: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $itemResult = $stmt->get_result();
    $item = $itemResult->fetch_assoc();
    $stmt->close();

    if ($item) {
        // Prepare and execute the query to fetch categories
        $categoriesStmt = $conn->prepare("SELECT id, category FROM categories");

        if ($categoriesStmt === false) {
            echo json_encode(['error' => 'Database error: ' . $conn->error]);
            exit;
        }

        $categoriesStmt->execute();
        $categoriesResult = $categoriesStmt->get_result();
        $categories = $categoriesResult->fetch_all(MYSQLI_ASSOC);
        $categoriesStmt->close();

        echo json_encode([
            'id' => $item['id'],
            'name' => $item['name'],
            'description' => $item['description'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'category_id' => $item['category_id'],
            'categories' => $categories
        ]);
    } else {
        echo json_encode(['error' => 'Item not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid ID']);
}

// Close the connection
$conn->close();
