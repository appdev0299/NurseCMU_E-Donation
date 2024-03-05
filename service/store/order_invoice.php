<?php
require 'conf/connection_pdf.php';
require('../TCPDF/tcpdf.php');
ob_start();

$selectedIds = isset($_GET['selectedIds']) ? $_GET['selectedIds'] : '';
$selectedIdsArray = explode(",", $selectedIds);

require_once 'conf/connection.php';
$placeholders = implode(',', array_fill(0, count($selectedIdsArray), '?'));
$stmt = $conn->prepare("SELECT receipt_id, ref1, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, amount, provinces, districts, rec_idname, address, road, amphures, zip_code FROM receipt WHERE `receipt_id` IN ($placeholders);");
$stmt->execute($selectedIdsArray);
$stmt_storage = $conn->prepare("SELECT * FROM storage ORDER BY max ASC");
$stmt_storage->execute();
$storage_result = $stmt_storage->fetchAll();

$result = $stmt->fetchAll();
$count = count($result);

if ($count > 0) {
    // Your existing PDF generation code
    $pdf = new TCPDF('L', PDF_UNIT, array(100, 100), true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('thsarabunnew');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, 1, PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(true, 10);
    $pdf->SetFont('thsarabunnew', '', 13);
    $pdf->SetMargins(5, 8, 5);
    $pdf->SetAutoPageBreak(true, 2);

    foreach ($result as $row) {
        $order_amount = $row['amount'];
        $order_set = '';

        // หาค่า max ที่มี order_amount น้อยกว่า order_amount ปัจจุบัน
        foreach ($storage_result as $storage_row) {
            $max_value = $storage_row['max'];
            $items_set = $storage_row['items_set'];

            if ($order_amount < $max_value) {
                $order_set = $items_set;
                break;
            }
        }

        // Add a new page for each record
        $pdf->AddPage();

        // Add the receipt_id to the header of the page
        $pdf->SetHeaderData('', '', 'Receipt ID: ' . $row['receipt_id'], '');

        // Your existing content generation code for each record
        $content = '
        <table>
            <tr>
                <td><b>ผู้ส่ง : </b>คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ <br>110/406 ถนนอินทวโรรส ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</td>
            </tr>
            <tr>
                <td><b>โทรศัพท์ : </b> 053-949075</td>
            </tr>
            <tr>
			    <td colspan="2" style="border-bottom: solid black 1px;"></td>
		    </tr>
            <br>
            
            <tr>
                <td><b>ชื่อผู้รับ : </b> คุณ ' . $row['rec_name'] . ' ' . $row['rec_surname'] . ' </td>
            </tr>
            <tr>
                <td><b>ที่อยู่จัดส่ง : </b>' . $row['address'] . ' ' . $row['road'] . ' ' . $row['districts'] . ' ' . $row['amphures'] . ' ' . $row['provinces'] . ' ' . $row['zip_code'] . '</td>
            </tr>
            <tr>
                <td><b>โทรศัพท์ : </b>' . $row['rec_tel'] . '</td>
            </tr>
            <tr>
                <td><b>หมายเลขออเดอร์ : </b>' . $row['ref1'] . '</td>
            </tr>
            <tr>
                <td><b>รายการ : </b>ชุดของที่ระลึก ' . $row['items_set'] . ' ' . $order_set . '</td>
            </tr>
        </table>
        ';

        $pdf->writeHTML($content);
    }

    // Your existing file handling code
    $file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/";
    date_default_timezone_set('Asia/Bangkok');
    $year = date('Y') + 543;
    $datetime_be = str_replace(date('Y'), $year, date('Y'));
    $file_name = "NurseCMU_" . "2567" . "-" . $inv_mst_data_row['edo_pro_id'] . "-" . $inv_mst_data_row['receipt_id'] . ".pdf";
    ob_end_clean();

    // Your existing code for different actions
    if ($_GET['ACTION'] == 'VIEW') {
        $pdf->Output($file_name, 'I'); // I means Inline view
    } else if ($_GET['ACTION'] == 'DOWNLOAD') {
        $pdf->Output($file_name, 'D'); // D means download
    } else if ($_GET['ACTION'] == 'UPLOAD') {
        $pdf->Output($file_location . $file_name, 'F'); // F means upload PDF file on some folder
        echo $file_location . $file_name; // Return the file path
    }

    //----- End Code for generate pdf
} else {
    echo 'Record not found for PDF.';
}
ob_end_flush();
