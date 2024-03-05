<?php

require_once 'conf/connection.php';

if (isset($_GET['receipt_id'])) {
    $receipt_id = $_GET['receipt_id'];
    $stmt = $conn->prepare("SELECT status_donat FROM receipt WHERE receipt_id = :receipt_id");
    $stmt->bindParam(':receipt_id', $receipt_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    header('HTTP/1.1 400 Bad Request');
    echo 'Error: receipt_id is missing in the request.';
}
