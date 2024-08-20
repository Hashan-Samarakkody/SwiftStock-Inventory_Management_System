<?php
require_once 'DBconnection.php';

// Initialize feedback message
$feedback_message = '';

// Handle deleting an item
if (isset($_POST['delete_item_id'])) {
    $item_id = filter_var($_POST['delete_item_id'], FILTER_VALIDATE_INT);

    if ($item_id !== false && $item_id > 0) {
        $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");

        if ($stmt) {
            $stmt->bind_param("i", $item_id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $feedback_message = "Item deleted successfully!";
                } else {
                    $feedback_message = "No item found with the given ID.";
                }
            } else {
                $feedback_message = "Failed to execute the SQL statement: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $feedback_message = "Failed to prepare the SQL statement: " . $conn->error;
        }
    } else {
        $feedback_message = "Invalid item ID.";
    }
}

// Handle deleting a category
if (isset($_POST['delete_category_id'])) {
    $category_id = filter_var($_POST['delete_category_id'], FILTER_VALIDATE_INT);

    if ($category_id !== false && $category_id > 0) {
        // Check if there are items linked to this category
        $result = $conn->prepare("SELECT COUNT(*) as count FROM items WHERE category_id = ?");
        $result->bind_param("i", $category_id);
        $result->execute();
        $row = $result->get_result()->fetch_assoc();
        $item_count = $row['count'];
        $result->close();

        if ($item_count > 0) {
            $feedback_message = "Cannot delete category because there are items linked to it!";
        } else {
            // Prepare the SQL statement for deletion
            $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");

            if ($stmt) {
                $stmt->bind_param("i", $category_id);

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $feedback_message = "Category deleted successfully!";
                    } else {
                        $feedback_message = "No category found with the given ID.";
                    }
                } else {
                    $feedback_message = "Failed to execute the SQL statement: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $feedback_message = "Failed to prepare the SQL statement: " . $conn->error;
            }
        }
    } else {
        $feedback_message = "Invalid category ID!";
    }
}

$conn->close();
header("Location: manage_inventory.php?feedback_message=" . urlencode($feedback_message));
exit();
