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
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table id="myTable1" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>หมายเลขออเดอร์</th>
                                                <th>ชื่อผู้รับ</th>
                                                <th>รายการ</th>
                                                <th>สถานะ</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once 'conf/connection.php';
                                            $check = isset($_GET['check']) ? $_GET['check'] : '';

                                            if ($check == 'success') {
                                                $stmt_receipt = $conn->prepare("SELECT store.*, storage.name 
                                                FROM store 
                                                INNER JOIN storage ON store.storage_id = storage.id 
                                                WHERE store.status_order = 'success'");
                                                $stmt_receipt->execute();
                                                $result = $stmt_receipt->fetchAll();
                                            } elseif ($check == 'cancel') {
                                                $stmt_receipt = $conn->prepare("SELECT store.*, storage.name 
                                                FROM store 
                                                INNER JOIN storage ON store.storage_id = storage.id 
                                                WHERE store.status_order = 'cancel'");
                                                $stmt_receipt->execute();
                                                $result = $stmt_receipt->fetchAll();
                                            }

                                            $countrow = 1;
                                            foreach ($result as $t1) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <h6><?= $countrow ?></h6>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['order_ref1']; ?> </p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['order_name']; ?></p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['order_set']; ?> (<?= $t1['name']; ?>)</p>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($t1['status_order'] == 'success') {
                                                            echo '<span class="mb-1 badge text-bg-success">จัดส่งแล้ว</span>';
                                                        } else {
                                                            echo '<span class="mb-1 badge text-bg-danger">ยกเลิกออเดอร์</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown dropstart">
                                                            <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti ti-dots-vertical fs-6"></i>
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item d-flex align-items-center gap-3 details-link" href="#" data-bs-toggle="modal" data-bs-target="#transferModal<?= $t1['order_id']; ?>" data-receipt-id="<?= $t1['order_id']; ?>">
                                                                    <i class="fs-4 ti ti-edit"></i>รายละเอียด
                                                                </a>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                                $countrow++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>หมายเลขออเดอร์</th>
                                                <th>ชื่อผู้รับ</th>
                                                <th>รายการ</th>
                                                <th>สถานะ</th>
                                                <th>#</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php foreach ($result as $t1) { ?>
                                        <div class="modal fade" id="transferModal<?= $t1['order_id']; ?>" tabindex="-1" aria-labelledby="transferModalLabel<?= $t1['order_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="transferModalLabel<?= $t1['order_id']; ?>">
                                                            รายละเอียดการจัดส่งของที่ระลึง</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">ชื่อผู้รับ:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $t1['order_name']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">โทรศัพท์:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $t1['order_tel']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label class="form-label text-end col-md-3">ที่อยู่จัดส่ง:</label>
                                                                        <div class="col-md-9">
                                                                            <p class="form-control-static">
                                                                                <?= $t1['order_address']; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">หมายเลขออเดอร์:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $t1['order_ref1']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">รายการ:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $t1['order_set']; ?> (<?= $t1['name']; ?>)</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">โครงการ:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $t1['order_description']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">จำนวนเงิน:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= number_format($t1['amount'], 2); ?> บาท</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">สถานะ:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static">
                                                                            <?php if ($t1['status_order'] == 'success') : ?>
                                                                                <span class="mb-1 badge rounded-pill font-medium bg-success-subtle text-success">ยืนยันการจัดส่งของที่ระลึง เมื่อ ( <?= thai_date($t1['dateCreate']); ?>
                                                                                    เวลา <?= date('H:i:s', strtotime($t1['dateCreate'])); ?> )</span>
                                                                            <?php else : ?>
                                                                                <span class="mb-1 badge rounded-pill font-medium bg-danger-subtle text-danger">ของที่ระลึงถูกยกเลิกการจัดส่ง เมื่อ ( <?= thai_date($t1['dateCreate']); ?>
                                                                                    เวลา <?= date('H:i:s', strtotime($t1['dateCreate'])); ?> ) </span>
                                                                            <?php endif; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" href="order_invoice?selectedIds=<?= $t1['receipt_id']; ?>&ACTION=VIEW" target="_blank">
                                                                <i class="ti ti-printer fs-5"></i> พิมพ์ออเดอร์
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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

    ?>
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
            $("#myTable1").DataTable();
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