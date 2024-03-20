<!doctype html>
<html lang="en">
<?php
// include('login_info.php');
include('conf/head.php');
?>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <?php
        include('conf/aside.php');
        ?>
        <div class="body-wrapper">
            <?php
            include('conf/header.php');
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <div class="card-body">
                                        <form id="formlog" method="post">
                                            <div class="row">
                                                <table id="log" class="table table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>หมายเลขออเดอร์</th>
                                                            <th>หมายเหตุ</th>
                                                            <th>ผู้ทำการ</th>
                                                            <th>จำนวน / ชิ้น</th>
                                                            <th>วันที่ / เวลา</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (isset($_GET['id'])) {
                                                            $id = $_GET['id'];
                                                            require_once 'conf/connection.php';
                                                            $stmt = $conn->prepare("SELECT * FROM `store_log` WHERE storage_id = :id");
                                                            $stmt->bindParam(':id', $id); // ใช้ค่า ID จาก URL
                                                            $stmt->execute();
                                                            $result_log = $stmt->fetchAll(); // รับผลลัพธ์ทั้งหมด
                                                            $countrow = 1; // ตั้งค่าลำดับแถวเริ่มต้น

                                                            // แสดงตารางเริ่มต้น
                                                        ?>
                                                            <table id="log" class="table table-striped" style="width:100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ลำดับ</th>
                                                                        <th>หมายเลขออเดอร์</th>
                                                                        <th>หมายเหตุ</th>
                                                                        <th>ผู้ทำการ</th>
                                                                        <th>จำนวน / ชิ้น</th>
                                                                        <th>วันที่ / เวลา</th>
                                                                        <th>#</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    // ลูปเพื่อแสดงข้อมูลที่ดึงมา
                                                                    foreach ($result_log as $log) {
                                                                        // แสดงข้อมูลของแต่ละรายการ
                                                                    ?>
                                                                        <tr>
                                                                            <td>
                                                                                <h6 class="fw-semibold mb-0"><?= $countrow ?></h6>
                                                                            </td>
                                                                            <td>
                                                                                <p class="mb-0 fw-normal"><?= $log['order_ref1']; ?></p>
                                                                            </td>
                                                                            <td>
                                                                                <p class="mb-0 fw-normal"><?= $log['comment']; ?></p>
                                                                            </td>
                                                                            <td>
                                                                                <p class="mb-0 fw-normal"><?= $log['name']; ?></p>
                                                                            </td>
                                                                            <td>
                                                                                <p class="mb-0 fw-normal"><?= $log['items']; ?></p>
                                                                            </td>
                                                                            <td>
                                                                                <p class="mb-0 fw-normal"><?= thai_date($log['dateCreate']); ?> เวลา <?= date('H:i:s', strtotime($log['dateCreate'])); ?></p>
                                                                            </td>
                                                                            <td>
                                                                                <div class="dropdown dropstart">
                                                                                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                        <i class="ti ti-dots-vertical fs-6"></i>
                                                                                    </a>
                                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                        <a class="dropdown-item d-flex align-items-center gap-3 details-link" href="#" data-bs-toggle="modal" data-bs-target="#transferModal<?= $log['id']; ?>" data-receipt-id="<?= $log['id']; ?>">
                                                                                            <i class="fs-4 ti ti-edit"></i>อัพเดทสต๊อก
                                                                                        </a>
                                                                                        <a class="dropdown-item d-flex align-items-center gap-3 details-link" href="#" data-bs-toggle="modal" data-bs-target="#historyModal<?= $log['id']; ?>" data-receipt-id="<?= $log['id']; ?>">
                                                                                            <i class="fs-4 ti ti-edit"></i>ประวัติการใช้งาน
                                                                                        </a>
                                                                                        <li>
                                                                                            <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0);" onclick="confirmcancel('<?= $log['user_id']; ?>')"><i class="fs-4 ti ti-trash"></i>ลบข้อมูล</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                        $countrow++; // เพิ่มค่าลำดับแถว
                                                                    } ?>
                                                                </tbody>
                                                            </table>
                                                        <?php
                                                            // แสดงตารางส่วนท้าย
                                                        } else {
                                                            echo "ไม่มีค่า ID ที่ส่งผ่าน URL";
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ลำดับ</th>
                                                            <th>หมายเลขออเดอร์</th>
                                                            <th>หมายเหตุ</th>
                                                            <th>ผู้ทำการ</th>
                                                            <th>จำนวน / ชิ้น</th>
                                                            <th>วันที่ / เวลา</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include('conf/footer.php');
                ?>
            </div>
        </div>
    </div>
    <?php
    function thai_date($date)
    {
        $months = [
            'ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย',
            'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'
        ];

        $timestamp = strtotime($date);
        $thai_year = date(' Y', $timestamp) + 543;
        $thai_date = date('j ', $timestamp) . $months[date('n', $timestamp) - 1] . ' ' . $thai_year;

        return $thai_date;
    }

    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
            $("#log").DataTable();
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>