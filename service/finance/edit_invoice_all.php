<?php
if (
    isset($_POST['name_title'])
    && isset($_POST['rec_name'])
    && isset($_POST['rec_surname'])
    && isset($_POST['rec_tel'])
    && isset($_POST['rec_email'])
    && isset($_POST['rec_idname'])
    && isset($_POST['address'])
    && isset($_POST['road'])
    && isset($_POST['provinces'])
    && isset($_POST['amphures'])
    && isset($_POST['districts'])
    && isset($_POST['zip_code'])
    && isset($_POST['rec_date_s'])
    && isset($_POST['rec_date_out'])
    && isset($_POST['amount'])
    && isset($_POST['payby'])
    && isset($_POST['edo_name'])
    && isset($_POST['other_description'])
    && isset($_POST['edo_pro_id'])
    && isset($_POST['edo_description'])
    && isset($_POST['edo_objective'])
    && isset($_POST['comment'])
    && isset($_POST['status_donat'])
    && isset($_POST['status_user'])
    && isset($_POST['status_receipt'])
    && isset($_POST['resDesc'])
    && isset($_POST['pdflink'])
    && isset($_POST['ref1'])
    && isset($_POST['id_receipt'])
    && isset($_POST['receipt_cc'])
) {

    require_once 'conf/connection.php';
    $stmt = $conn->prepare("UPDATE receipt SET
    name_title = :name_title,
    rec_name = :rec_name,
    rec_surname = :rec_surname,
    rec_tel = :rec_tel,
    rec_email = :rec_email,
    rec_idname = :rec_idname,
    address = :address,
    road = :road,
    provinces = :provinces,
    amphures = :amphures,
    districts = :districts,
    zip_code = :zip_code,
    rec_date_s = :rec_date_s,
    rec_date_out = :rec_date_out,
    edo_name = :edo_name,
    other_description = :other_description,
    amount = :amount,
    payby = :payby,
    edo_pro_id = :edo_pro_id,
    edo_description = :edo_description,
    edo_objective = :edo_objective,
    status_donat = :status_donat,
    status_user = :status_user,
    status_receipt = :status_receipt,
    resDesc = :resDesc,
    pdflink=:pdflink,
    ref1=:ref1,
    id_receipt=:id_receipt,
    receipt_cc=:receipt_cc,
    comment = :comment
    WHERE id = :id");
    $stmt->bindParam(':name_title', $_POST['name_title'], PDO::PARAM_STR);
    $stmt->bindParam(':rec_name', $_POST['rec_name'], PDO::PARAM_STR);
    $stmt->bindParam(':rec_surname', $_POST['rec_surname'], PDO::PARAM_STR);
    $stmt->bindParam(':rec_tel', $_POST['rec_tel'], PDO::PARAM_STR);
    $stmt->bindParam(':rec_email', $_POST['rec_email'], PDO::PARAM_STR);
    $stmt->bindParam(':rec_idname', $_POST['rec_idname'], PDO::PARAM_STR);
    $stmt->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
    $stmt->bindParam(':road', $_POST['road'], PDO::PARAM_STR);
    $stmt->bindParam(':provinces', $_POST['provinces'], PDO::PARAM_STR);
    $stmt->bindParam(':amphures', $_POST['amphures'], PDO::PARAM_STR);
    $stmt->bindParam(':districts', $_POST['districts'], PDO::PARAM_STR);
    $stmt->bindParam(':zip_code', $_POST['zip_code'], PDO::PARAM_STR);
    $stmt->bindParam(':rec_date_s', $_POST['rec_date_s'], PDO::PARAM_STR);
    $stmt->bindParam(':rec_date_out', $_POST['rec_date_out'], PDO::PARAM_STR);
    $stmt->bindParam(':edo_name', $_POST['edo_name'], PDO::PARAM_STR);
    $stmt->bindParam(':other_description', $_POST['other_description'], PDO::PARAM_STR);
    $stmt->bindParam(':amount', $_POST['amount'], PDO::PARAM_STR);
    $stmt->bindParam(':payby', $_POST['payby'], PDO::PARAM_STR);
    $stmt->bindParam(':edo_pro_id', $_POST['edo_pro_id'], PDO::PARAM_STR);
    $stmt->bindParam(':edo_description', $_POST['edo_description'], PDO::PARAM_STR);
    $stmt->bindParam(':edo_objective', $_POST['edo_objective'], PDO::PARAM_STR);
    $stmt->bindParam(':status_donat', $_POST['status_donat'], PDO::PARAM_STR);
    $stmt->bindParam(':status_user', $_POST['status_user'], PDO::PARAM_STR);
    $stmt->bindParam(':status_receipt', $_POST['status_receipt'], PDO::PARAM_STR);
    $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
    $stmt->bindParam(':resDesc', $_POST['resDesc'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->bindParam(':pdflink', $_POST['pdflink'], PDO::PARAM_STR);
    $stmt->bindParam(':ref1', $_POST['ref1'], PDO::PARAM_STR);
    $stmt->bindParam(':id_receipt', $_POST['id_receipt'], PDO::PARAM_STR);
    $stmt->bindParam(':receipt_cc', $_POST['receipt_cc'], PDO::PARAM_STR);
    $result = $stmt->execute();
    echo '
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($result) {
        // สำเร็จ
        echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script>
      swal({
        title: "อัปเดตข้อมูลบริจาคสำเร็จ", 
        text: "กรุณารอสักครู่",
        type: "success", 
        timer: 2000, 
        showConfirmButton: false 
      }, function(){
        var status_donat = "' . $_POST['status_donat'] . '";
        if (status_donat === "online") {
          window.location.href = "invoice"; 
        } else {
          window.location.href = "invoice";
        }
      });
    </script>';
    } else {
        // ไม่สำเร็จ
        echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script>
      swal({
        title: "เกิดข้อผิดพลาดในการอัปเดตข้อมูล",
        type: "error"
      }, function() {
        // เพิ่มเงื่อนไขการเปลี่ยนเส้นทางการนำทางตามค่า status_donat
        var status_donat = "' . $_POST['status_donat'] . '";
        if (status_donat === "online") {
          window.location.href = "invoice"; 
        } else {
          window.location.href = "invoice";
        }
      });
    </script>';
    }
} //isset
