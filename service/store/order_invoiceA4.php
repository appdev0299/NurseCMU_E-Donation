<?php
require 'conf/connection_pdf.php';
require('../TCPDF/tcpdf.php');
ob_start();

$selectedIds = isset($_GET['selectedIds']) ? $_GET['selectedIds'] : '';
$selectedIdsArray = explode(",", $selectedIds);

require_once 'conf/connection.php';

// Initialize PDF
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('thsarabunnew');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('thsarabunnew', '', 16);
$pdf->SetMargins(5, 8, 5);
$pdf->SetAutoPageBreak(true, 2);

// Prepare the SQL query to fetch receipt information
$placeholders = implode(',', array_fill(0, count($selectedIdsArray), '?'));
$stmt = $conn->prepare("SELECT receipt_id, ref1, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, amount, provinces, districts, rec_idname, address, road, amphures, zip_code FROM receipt WHERE `receipt_id` IN ($placeholders);");
$stmt->execute($selectedIdsArray);
$result = $stmt->fetchAll();

// Loop through selectedIdsArray
foreach (array_chunk($selectedIdsArray, 6) as $chunk) {
    // Add new page
    $pdf->AddPage();

    // Loop through chunk of selectedIds
    foreach ($chunk as $index => $selectedId) {
        // Prepare statement with only one ID
        $stmt = $conn->prepare("SELECT receipt_id, ref1, id_receipt, name_title, rec_name, rec_surname, rec_tel, rec_email, amount, provinces, districts, rec_idname, address, road, amphures, zip_code FROM receipt WHERE `receipt_id` = ?");
        $stmt->execute([$selectedId]);
        $row = $stmt->fetch();
        if ($row) {
            // Calculate position based on index
            $x = 5 + ($index % 2) * 100; // Set x position based on even or odd index
            $y = 6 + (floor($index / 2) * 90); // Set y position based on index

            // Draw rectangle as the text box
            $pdf->Rect($x, $y, 100, 80, 'D'); // 90x80 mm rectangle

            $pdf->SetXY($x + 5, $y + 5);

            // Write text inside the rectangle
            $content = '
                <table>
                    <tr>
                        <td>        <b>ผู้ส่ง: </b>คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ <br>110/406 ถนนอินทวโรรส ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200</td>
                    </tr>
                    <tr>
                        <td><b>โทรศัพท์: </b>053-949075</td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td>        <b>ชื่อผู้รับ: </b>' . $row['name_title'] . ' ' . $row['rec_name'] . ' ' . $row['rec_surname'] . '</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word;"><b>ที่อยู่จัดส่ง : </b>' . $row['address'] . ' ' . $row['road'] . '</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word;">' . $row['districts'] . ' ' . $row['amphures'] . ' ' . $row['provinces'] . ' ' . $row['zip_code'] . '</td>
                    </tr>
                    <tr>
                        <td><b>โทรศัพท์: </b>' . $row['rec_tel'] . '</td>
                    </tr>
                    <tr>
                        <td><b>หมายเลขออเดอร์: </b>' . $row['ref1'] . '</td>
                    </tr>
                </table>';

            $pdf->writeHTML($content);
        } else {
            // If the record for the selected ID is not found, handle it accordingly
            $pdf->writeHTML('<p>Record not found for selected ID: ' . $selectedId . '</p>');
        }
    }
}

// Output the PDF based on the action
if (isset($_GET['ACTION'])) {
    $action = $_GET['ACTION'];
    if ($action == 'VIEW') {
        $pdf->Output('output.pdf', 'I'); // I means Inline view
    } elseif ($action == 'DOWNLOAD') {
        $pdf->Output('output.pdf', 'D'); // D means download
    } elseif ($action == 'UPLOAD') {
        $pdf->Output('output.pdf', 'F'); // F means upload PDF file on some folder
        echo 'PDF generated successfully.';
    }
}

ob_end_flush();
