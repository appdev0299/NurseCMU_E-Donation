<?php
require_once 'conf/connection.php';

$receiptId = $_GET['receipt_id'];

$sql = "SELECT status_user FROM receipt WHERE receipt_id = :receiptId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':receiptId', $receiptId, PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    if ($result['status_user'] === 'person' || $result['status_user'] === 'corporation') {
        echo json_encode(['status_user' => $result['status_user']]);
    } else {
        echo json_encode(['error' => 'Invalid status_user']);
    }
} else {
    echo json_encode(['error' => 'No results']);
}
