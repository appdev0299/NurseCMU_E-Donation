<?php
require_once 'conf/connection.php';
$receiptId = $_GET['receipt_id'];
$stmt = $conn->prepare("SELECT receipt_cc FROM receipt WHERE receipt_id = :receiptId");
$stmt->bindParam(':receiptId', $receiptId, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    header('Content-Type: application/json');
    echo json_encode($row);
} else {
    echo "0 results";
}
