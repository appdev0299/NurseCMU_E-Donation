<?php
require_once 'connection.php';

$data = json_decode(file_get_contents("php://input"));

if ($data && isset($data->password) && isset($data->receipt_id)) {
    $userPassword = $data->password;
    $receipt_id = $data->receipt_id;

    $sql = "SELECT rec_idname FROM receipt WHERE rec_idname = '$userPassword' AND receipt_id = $receipt_id";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {

        $response = array('success' => true, 'message' => 'กรุณากรอกมหายเลขบัตรที่ถูกต้อง');

        $pdfUrl = "pdf_maker?receipt_id=$receipt_id&ACTION=VIEW";

        $response['pdfUrl'] = $pdfUrl;
    } else {
        $response = array('success' => false, 'message' => 'กรุณากรอกมหายเลขบัตรที่ถูกต้อง');
    }
} else {
    $response = array('success' => false, 'message' => 'ยกเลิกการเปิดใบเสร็จรับเงิน');
}

header('Content-Type: application/json');
echo json_encode($response);
