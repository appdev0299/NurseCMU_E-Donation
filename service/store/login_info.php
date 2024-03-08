<?php
session_start();

if (isset($_SESSION['redirect_data'])) {
    $redirectData = $_SESSION['redirect_data'];

    if (isset($redirectData['status']) && ($redirectData['status'] == 2 || $redirectData['status'] == 3)) {
        $loginInfo = $redirectData['login_info'];
        // echo "codeid" . $loginInfo['organization_code'] . "";
        // echo "Welcome, " . $loginInfo['firstname_EN'] . " " . $loginInfo['lastname_EN'] . "!";
        // echo "Status: " . $redirectData['status'];
    } else {
        header("Location: ../oauth/login");
        exit;
    }
} else {
    header("Location: ../oauth/login");
    exit;
}
