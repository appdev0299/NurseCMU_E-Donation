<?php
require_once 'conf/connection.php';

session_start();

if (isset($_SESSION['login_info'])) {
    $json = $_SESSION['login_info'];

    $checkSql = "SELECT COUNT(*) as count, status FROM reg_login WHERE login_cmuaccount = :cmuitaccount";

    try {
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bindParam(':cmuitaccount', $json['cmuitaccount']);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            $status = $result['status'];

            switch ($status) {
                case 1:
                    $redirectURL = "../finance";
                    break;
                case 2:
                    $redirectURL = "../store";
                    break;
                case 3:
                    $redirectURL = "../allstatus";
                    break;
                default:
                    header("Location: ../oauth/login.php");
                    exit;
            }

            // Continue with the data insertion
            $insertSql = "INSERT INTO login_log (Name, Surname, Organization, CMU_IT_Account, IT_Account_Type_EN)
                VALUES (:firstname, :lastname, :organization, :cmuitaccount, :itaccounttype)";

            $stmt = $conn->prepare($insertSql);
            $stmt->bindParam(':firstname', $json['firstname_EN']);
            $stmt->bindParam(':lastname', $json['lastname_EN']);
            $stmt->bindParam(':organization', $json['organization_name_EN']);
            $stmt->bindParam(':cmuitaccount', $json['cmuitaccount']);
            $stmt->bindParam(':itaccounttype', $json['itaccounttype_EN']);
            $stmt->execute();

            $_SESSION['redirect_data'] = ['login_info' => $json, 'status' => $status];
            header("Location: $redirectURL");
            exit;
        } else {
            header("Location: ../oauth/login.php");
            // echo "ไม่มีข้อมูลใน";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: ../oauth/login.php");
    // echo "ไม่มีข้อมูลใน session";
}
