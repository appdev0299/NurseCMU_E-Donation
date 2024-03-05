<?php
if (
    isset($_POST['name_title']) &&
    isset($_POST['rec_name']) &&
    isset($_POST['rec_surname']) &&
    isset($_POST['rec_tel']) &&
    isset($_POST['rec_email']) &&
    isset($_POST['rec_idname']) &&
    isset($_POST['address']) &&
    isset($_POST['road']) &&
    isset($_POST['provinces']) &&
    isset($_POST['amphures']) &&
    isset($_POST['districts']) &&
    isset($_POST['status_user']) &&
    isset($_POST['status_donat']) &&
    isset($_POST['zip_code'])
) {
    require_once 'conf/connection.php';

    $checkDuplicateStmt = $conn->prepare("SELECT COUNT(*) FROM `user` WHERE rec_name = :rec_name");
    $checkDuplicateStmt->bindParam(':rec_name', $_POST['rec_name'], PDO::PARAM_STR);
    $checkDuplicateStmt->execute();
    $duplicateCount = $checkDuplicateStmt->fetchColumn();

    if ($duplicateCount > 0) {
        echo '';
    } else {
        try {
            $conn->beginTransaction();
            $stmt = $conn->prepare("INSERT INTO `user`
            (name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, provinces, amphures, districts, zip_code, status_user, status_donat)
            VALUES
            (:name_title, :rec_name, :rec_surname, :rec_tel, :rec_email, :rec_idname, :address, :road, :provinces, :amphures, :districts, :zip_code, :status_user, :status_donat)");
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
            $stmt->bindParam(':status_user', $_POST['status_user'], PDO::PARAM_STR);
            $stmt->bindParam(':status_donat', $_POST['status_donat'], PDO::PARAM_STR);

            $result = $stmt->execute();

            if ($result) {
                $conn->commit();
                echo '';
            } else {
                $conn->rollback();
                echo 'เกิดข้อผิดพลาดในการบันทึกข้อมูลในตาราง user';
            }
        } catch (PDOException $e) {
            $conn->rollback();
            echo 'เกิดข้อผิดพลาดในการทำงาน';
            echo "Error: " . $e->getMessage();
        }
    }
}
