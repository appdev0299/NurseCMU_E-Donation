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
    && isset($_POST['status_donat'])
    && isset($_POST['status_user'])
    && isset($_POST['status_receipt'])
) {
    require_once 'conf/connection.php';

    $stmt = $conn->prepare("UPDATE  `user` SET
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
    status_donat = :status_donat,
    status_user = :status_user,
    status_receipt = :status_receipt
    WHERE user_id = :user_id");

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
    $stmt->bindParam(':status_receipt', $_POST['status_receipt'], PDO::PARAM_STR);
    $stmt->bindParam(':status_donat', $_POST['status_donat'], PDO::PARAM_STR);
    $stmt->bindParam(':status_user', $_POST['status_user'], PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $_POST['user_id'], PDO::PARAM_INT);

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
        title: "อัพเดทข้อมูล สำเสร็จ", 
        text: "กรุณารอสักครู่",
        type: "success", 
        timer: 2000, 
        showConfirmButton: false 
    }, function(){
        window.location.href = "user_data"; 
    });
    </script>';
    } else {
        echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script>
    swal({
        title: "อัพเดทข้อมูล ไม่สำเสร็จ", 
        text: "กรุณารอสักครู่",
        type: "error", 
        timer: 2000, 
        showConfirmButton: false 
    }, function(){
        window.location.href = "user_data"; 
    });
    </script>';
    }
} //isset
