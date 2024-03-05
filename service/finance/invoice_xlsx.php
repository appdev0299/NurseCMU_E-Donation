<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ดึงค่าจาก $_GET และนำมาใช้ตามต้องการ
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
    $selected_status_user = isset($_GET['status_user']) ? $_GET['status_user'] : null;
    $selected_status_receipt = isset($_GET['status_receipt']) ? $_GET['status_receipt'] : null;
    $selected_edo_pro_id = isset($_GET['edo_pro_id']) ? $_GET['edo_pro_id'] : null;
    $selected_receipt_cc = isset($_GET['receipt_cc']) ? $_GET['receipt_cc'] : null;
    $showall = isset($_GET['showall']) ? $_GET['showall'] : 'receipt'; // เริ่มต้นด้วย 'receipt' หากไม่มีค่า showall

    $sql = "SELECT id_receipt, status_user, rec_idname, name_title, rec_name, rec_surname, address, rec_tel, rec_date_out, rec_time, payby, amount, rec_email, road, districts, amphures, provinces, zip_code, rec_date_s, edo_name, other_description, edo_pro_id, edo_pro_id, edo_objective, comment, status_donat, status_receipt, resDesc,pdflink, receipt_cc, dateCreate FROM ";

    if (isset($showall) && !empty($showall)) {
        $sql .= $showall;
    } else {
        $sql .= "receipt"; // หากไม่มีค่า showall ให้ใช้ "receipt" เป็นค่าเริ่มต้น
    }

    $sql .= " WHERE 1=1";

    if (!empty($start_date)) {
        $sql .= " AND rec_date_out >= :start_date ";
    }

    if (!empty($end_date)) {
        $sql .= " AND rec_date_out <= :end_date ";
    }

    if (!empty($selected_status_user)) {
        $sql .= " AND status_user = :status_user ";
    }

    if (!empty($selected_status_receipt)) {
        $sql .= " AND status_receipt = :status_receipt ";
    }

    if (!empty($selected_edo_pro_id)) {
        $sql .= " AND edo_pro_id = :edo_pro_id ";
    }
    if (!empty($selected_receipt_cc)) {
        $sql .= " AND receipt_cc = :receipt_cc ";
    }

    $sql .= " ORDER BY rec_date_out ASC";

    require_once 'conf/connection.php';

    $stmt = $conn->prepare($sql);

    if (!empty($start_date)) {
        $stmt->bindParam(':start_date', $start_date);
    }

    if (!empty($end_date)) {
        $stmt->bindParam(':end_date', $end_date);
    }

    if (!empty($selected_status_user)) {
        $stmt->bindParam(':status_user', $selected_status_user);
    }

    if (!empty($selected_status_receipt)) {
        $stmt->bindParam(':status_receipt', $selected_status_receipt);
    }

    if (!empty($selected_edo_pro_id)) {
        $stmt->bindParam(':edo_pro_id', $selected_edo_pro_id);
    }
    if (!empty($selected_receipt_cc)) {
        $stmt->bindParam(':receipt_cc', $selected_receipt_cc);
    }

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // เช็คว่ามีข้อมูลหรือไม่ ถ้าไม่มีให้ดึงข้อมูลทั้งหมด
    if (empty($results)) {
        $sql = "SELECT id_receipt, status_user, rec_idname, name_title, rec_name, rec_surname, address, rec_tel, rec_date_out, rec_time, payby, amount, rec_email, road, districts, amphures, provinces, zip_code, rec_date_s, edo_name, other_description, edo_pro_id, edo_pro_id, edo_objective, comment, status_donat, status_receipt, resDesc,pdflink, receipt_cc, dateCreate FROM ";

        if (isset($showall) && !empty($showall)) {
            $sql .= $showall;
        } else {
            $sql .= "receipt"; // หากไม่มีค่า showall ให้ใช้ "receipt" เป็นค่าเริ่มต้น
        }

        $sql .= " ORDER BY id_receipt DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    if (!empty($results)) {
        require_once '../vendor/autoload.php';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = ['เลขที่ใบเสร็จ', 'หมายเลขโครงการ', 'เลขประจำตัวผู้เสียภาษี', 'ชื่อ-สกุล', 'ที่อยู่', 'เบอร์โทรศัพท์', 'อีเมล์', 'วันที่บริจาค', 'เวลา', 'ชำระโดย', 'จำนวนเงิน', 'ใบเสร็จ'];
        $col = 'A';

        foreach ($columns as $column) {
            $sheet->setCellValue($col . '1', $column);
            $col++;
        }
        $row = 2;
        $totalAmount = 0; // เริ่มต้นยอดรวมที่ 0

        foreach ($results as $result) {
            $col = 'A';
            $sheet->setCellValue($col . $row, $result['id_receipt']);
            $col++;
            $sheet->setCellValue($col . $row, $result['edo_pro_id']);
            $col++;
            $recIdName = $result['rec_idname'];
            $sheet->setCellValueExplicit($col . $row, $recIdName, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $col++;
            $sheet->setCellValue($col . $row, $result['name_title'] . ' ' . $result['rec_name'] . ' ' . $result['rec_surname']);
            $col++;
            $sheet->setCellValue($col . $row, $result['address'] . ' ' . $result['road'] . ' ' . $result['districts'] . ' ' . $result['amphures'] . ' ' . $result['provinces'] . ' ' . $result['zip_code']);
            $col++;
            $sheet->setCellValue($col . $row, $result['rec_tel']);
            $col++;
            $sheet->setCellValue($col . $row, $result['rec_email']);
            $col++;
            $originalDate = $result['rec_date_out'];
            $newDate = date('d/m/Y', strtotime($originalDate));
            $newDateParts = explode('/', $newDate);
            if (count($newDateParts) === 3) {
                $newDateParts[2] = intval($newDateParts[2]) + 543;
                $newDate = implode('/', $newDateParts);
            }
            $sheet->setCellValue($col . $row, $newDate);
            $col++;
            $sheet->setCellValue($col . $row, $result['rec_time']);
            $col++;
            $sheet->setCellValue($col . $row, $result['payby']);
            $col++;
            $sheet->setCellValue($col . $row, $result['amount']);

            // เพิ่มยอดเงินในรอบนี้ไปยังยอดรวม
            $totalAmount += $result['amount'];

            $col++;
            $sheet->setCellValue($col . $row, $result['pdflink']);
            $row++;
        }
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $sheet->setAutoFilter('A1:' . $highestColumn . $highestRow);

        // ตำแหน่งที่คุณต้องการแสดงยอดรวม (หลังสุดของข้อมูล)
        $col = 'I';
        $sheet->setCellValue($col . $row, 'ยอดรวม');
        $col = 'J'; // แนะนำตำแหน่งที่ยอดรวมจะแสดง (หลังจากข้อมูล amount)
        $sheet->setCellValue($col . $row, $totalAmount);

        // ตั้งค่าการส่งออกไฟล์ Excel
        $filename = 'DonationReport_' . date('Y-m-d') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // สร้าง Writer และส่งออกไฟล์ Excel
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    } else {
        echo "No data found.";
    }
}
