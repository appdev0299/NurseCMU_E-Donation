<?php 
if ($updateResult) {
  $insertSql = "INSERT IGNORE INTO receipt (id, id_receipt, ref1, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate)
                SELECT id, id_receipt, ref1, name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code, rec_date_s, rec_date_out, amount, payby, edo_name, other_description, edo_pro_id, edo_description, edo_objective, comment, status_donat, status_user, status_receipt, resDesc, rec_time, pdflink, dateCreate
                FROM receipt_offline WHERE id = :id AND resDesc = 'success'
                ORDER BY dateCreate DESC
                LIMIT 1";
  $insertStmt = $pdo->prepare($insertSql);
  $insertStmt->bindParam(':id', $id);
  $insertResult = $insertStmt->execute();

  if ($insertResult) {
      // ตรวจสอบว่าข้อมูลถูกเพิ่มหรือไม่
      if ($insertStmt->rowCount() > 0) {
          // รายการถูกเพิ่มเข้าไป
          // ดำเนินการเพิ่ม id_receipt และอื่นๆ ตามที่คุณต้องการ
      } else {
          // ไม่มีการเพิ่มรายการใหม่เนื่องจากมีข้อมูลซ้ำกัน
          $response = [
              'message' => 'ข้อมูลซ้ำกัน'
          ];
      }
  } else {
      $response = [
          'message' => 'ไม่สามารถบันทึกข้อมูลในตาราง receipt ได้'
      ];
  }
}
