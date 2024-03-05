<?php
// session_start();

// // ตรวจสอบสถานะการเข้าสู่ระบบ
// if (isset($_SESSION['login_info'])) {
//     // ผู้ใช้ล็อกอินแล้ว แสดงข้อมูลผู้ใช้
//     $login_info = $_SESSION['login_info'];
// } else {
//     // ผู้ใช้ยังไม่ได้ล็อกอิน นำกลับไปยังหน้า login
//     header("Location: login.php");
//     exit;
// }
// // ตรวจสอบการlogin
require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">รายชื่อบริจาคผ่านบุคลากร</strong>
                            </div>
                            <div class="card-body">
                                <a href="donate_details.php?id=<?= $edoId; ?>" class="custom-btn btn">บริจาค</a>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>โครงการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once 'connection.php';
                                        $stmt = $conn->prepare("SELECT * FROM pro_offline ");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        $countrow = 1;
                                        foreach ($result as $t1) {
                                            $id = $t1['id'];
                                        ?>
                                            <tr>
                                                <td><?= $countrow ?></td>
                                                <td>
                                                    <?= $t1['edo_name']; ?>
                                                </td>
                                                <td>
                                                    <a href="pro_edo.php?id=<?= $id; ?>" class="custom-btn btn">แก้ไข</a>
                                                </td>
                                            </tr>
                                        <?php $countrow++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php

        ?>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../edo_admin/assets/js/main.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../edo_admin/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../edo_admin/assets/js/init/datatables-init.js"></script>


</body>

</html>