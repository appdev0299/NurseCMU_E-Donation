<?php
// Include your database connection file
require_once 'conf/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $items = $_POST['items'];
    $min = $_POST['min'];
    $max = $_POST['max'];
    $items_set = $_POST['items_set'];
    $img_file = $_POST['img_file'];
    $dateCreate = $_POST['dateCreate'];

    $id = $_POST['id'];

    // Update query
    $stmt_update = $conn->prepare("UPDATE storage SET name = :name, items = :items, min = :min, max = :max, items_set = :items_set, img_file = :img_file, dateCreate = :dateCreate WHERE id = :id");

    $stmt_update->bindParam(':name', $name);
    $stmt_update->bindParam(':items', $items);
    $stmt_update->bindParam(':min', $min);
    $stmt_update->bindParam(':max', $max);
    $stmt_update->bindParam(':items_set', $items_set);
    $stmt_update->bindParam(':img_file', $img_file);
    $stmt_update->bindParam(':dateCreate', $dateCreate);
    $stmt_update->bindParam(':id', $id);

    try {
        $stmt_update->execute(); // Execute the update query
        // Optionally, you can redirect or send a success response
        echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
    } catch (PDOException $e) {
        // Handle database error
        echo json_encode(['status' => 'error', 'message' => 'Error updating data: ' . $e->getMessage()]);
    }
} else {
    // Handle non-POST requests (if needed)
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
