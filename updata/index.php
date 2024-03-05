<?php
// session_start();
// $inactive_time = 10 * 60; // 5 minutes

// // ตรวจสอบสถานะการเข้าสู่ระบบ
// if (isset($_SESSION['login_info'])) {
//     // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
//     $login_info = $_SESSION['login_info'];

//     // เช็คเวลาไม่ใช้งาน
//     if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_time)) {
//         // ไม่มีการใช้งานเกินเวลาที่กำหนด
//         // ทำการลบข้อมูลเซสชัน
//         session_unset();
//         session_destroy();
//         header("Location: login.php");
//         exit;
//     }

//     // ตั้งค่าเวลาล่าสุดที่มีการใช้งาน
//     $_SESSION['last_activity'] = time();

//     // เชื่อมต่อฐานข้อมูล
//     $servername = "localhost";
//     $username = "edonation";
//     $password = "edonate@FON";
//     $dbname = "edonation";
//     // สร้างการเชื่อมต่อ
//     $conn = new mysqli($servername, $username, $password, $dbname);
//     // ตรวจสอบการเชื่อมต่อ
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // ตรวจสอบว่า cmuitaccount ตรงกับฐานข้อมูลหรือไม่
//     $cmuitaccount = $login_info['cmuitaccount'];
//     $sql = "SELECT * FROM cmuitaccount WHERE cmuitaccount = '$cmuitaccount'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         // cmuitaccount ตรงกับฐานข้อมูล
//         // เพิ่มข้อมูลผู้ใช้ลงในตาราง users
//         $firstname = $login_info['firstname_EN'];
//         $lastname = $login_info['lastname_EN'];
//         $cmuitaccount = $login_info['cmuitaccount'];
//         $login_time = date("Y-m-d H:i:s"); // เวลาที่ล็อกอิน

//         $sql = "INSERT INTO users (firstname, lastname, cmuitaccount,  login_time)
//                 VALUES ('$firstname', '$lastname', '$cmuitaccount', '$login_time')";

//         if ($conn->query($sql) === TRUE) {
//             // echo "User data has been saved to the database.";
//         } else {
//             echo "Error: " . $sql . "<br>" . $conn->error;
//         }
//     } else {
//         // cmuitaccount ไม่ตรงกับฐานข้อมูล
//         header("Location: login.php");
//         exit;
//     }
//     // ปิดการเชื่อมต่อฐานข้อมูล
//     $conn->close();
// } else {
//     // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
//     header("Location: login.php");
//     exit;
// }

require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <div class="animated fadeIn">

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../edo_admin/assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="../edo_admin/assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="../edo_admin/assets/js/init/fullcalendar-init.js"></script>
</body>

</html>