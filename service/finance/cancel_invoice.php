<?php
require_once 'conf/connection.php';
$receipt_id = $_GET['receipt_id'];
$pdflink = "https://app.nurse.cmu.ac.th/edonation/service/finance/invoice_cancel.php?receipt_id=$receipt_id&ACTION=VIEW";
$amount = 0;
$updateSql = "UPDATE receipt SET receipt_cc = 'cancel', amount = :amount, pdflink = :pdflink WHERE receipt_id = :receipt_id";
$statusSql = "SELECT status_donat FROM receipt WHERE receipt_id = :receipt_id";
$statusStmt = $conn->prepare($statusSql);
$statusStmt->bindParam(':receipt_id', $receipt_id);
$statusStmt->execute();
$statusResult = $statusStmt->fetch();

if ($statusResult) {
    $status_donat = $statusResult['status_donat'];
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':receipt_id', $receipt_id);
    $updateStmt->bindParam(':amount', $amount);
    $updateStmt->bindParam(':pdflink', $pdflink);
    $updateResult = $updateStmt->execute();
    if ($updateResult) {
        // สำเร็จ
        echo '
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script>
            function showSweetAlert() {
                $(document).ready(function () {
                    Swal.fire({
                        title: "ยกเลิกใบเสร็จ สำเร็จ", 
                        text: "ใบเสร็จนี้ถูกยกเลิกแล้ว",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function () {
                        // นำคุณไปยังเส้นทางที่ถูกต้องโดยตรวจสอบค่า status_donat และเปลี่ยนเส้นทางการนำทาง
                        var status_donat = "' . $status_donat . '";
                        if (status_donat === "online") {
                            window.location.href = "invoice"; 
                        } else {
                            window.location.href = "invoice";
                        }
                    });
                });
            }
            showSweetAlert();
        </script>';
    } else {
        // ไม่สำเร็จ
        echo '
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script>
            function showSweetAlert() {
                $(document).ready(function () {
                    Swal.fire({
                        title: "ยกเลิกใบเสร็จ ไม่สำเร็จ", 
                        text: "กรุณารอสักครู่",
                        icon: "error",
                        timer: 3000,
                        showConfirmButton: false
                    }).then(function () {
                        // นำคุณไปยังเส้นทางที่ถูกต้องโดยตรวจสอบค่า status_donat และเปลี่ยนเส้นทางการนำทาง
                        var status_donat = "' . $status_donat . '";
                        if (status_donat === "online") {
                            window.location.href = "invoice"; 
                        } else {
                            window.location.href = "invoice";
                        }
                    });
                });
            }
            showSweetAlert();
        </script>';
    }
} else {
    // ไม่พบค่า status_donat
    echo "ไม่พบค่า status_donat ในฐานข้อมูล";
}

// ปิดการเชื่อมต่อ
$conn = null;
