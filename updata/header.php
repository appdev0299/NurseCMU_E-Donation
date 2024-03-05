<?php
// ตรวจสอบสถานะการเข้าสู่ระบบ
// if (isset($_SESSION['login_info'])) {
//     // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
//     $login_info = $_SESSION['login_info'];
//     $_SESSION['last_activity'] = time(); // ตั้งค่าเวลาล่าสุดที่มีการใช้งาน

//     // เช็คเวลาไม่ใช้งาน
//     $inactive_time = 5 * 60; // 5 minutes
//     if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_time)) {
//         // ไม่มีการใช้งานเกินเวลาที่กำหนด
//         // ทำการลบข้อมูลเซสชัน
//         session_unset();
//         session_destroy();
//         header("Location: login.php");
//         exit;
//     }
// } else {
//     // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
//     header("Location: login.php");
//     exit;
// }
?>
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="../"><img src="../edo_admin/images/logo.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="../edo_admin/images/admin_logo.png" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <!-- <a class="nav-link"><i class="fa fa- user"></i> <?php echo $login_info['firstname_EN'] . "<br>"; ?></a> -->
                    <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>
                    <a class="nav-link" href="logout.php"><i class="fa fa-power -off"></i>Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>