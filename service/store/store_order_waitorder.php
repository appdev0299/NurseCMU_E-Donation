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
                                <div class="text-end md-3">
                                    <a class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButtonA4">
                                        <i class="ti ti-printer fs-5"></i> พิมพ์ออเดอร์ ขนาด A4
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var printButtonA4 = document.getElementById("printButtonA4");

                                                printButtonA4.addEventListener("click", function() {
                                                    handlePrintButtonClickA4();
                                                });
                                            });

                                            function handlePrintButtonClickA4() {
                                                var selectedIds = [];
                                                var checkboxes = document.querySelectorAll(".form-check-input:checked");
                                                checkboxes.forEach(function(checkbox) {
                                                    selectedIds.push(checkbox.value);
                                                });

                                                if (selectedIds.length > 0) {
                                                    var printWindow = window.open("about:blank", '_blank');
                                                    printWindow.location.href = "order_invoiceA4.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
                                                } else {
                                                    alert("กรุณาเลือกข้อมูลที่ต้องการ Print");
                                                }
                                            }
                                        </script>
                                    </a>
                                    <a class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" id="printButtonform1">
                                        <i class="ti ti-printer fs-5"></i> พิมพ์ออเดอร์
                                    </a>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var printButtonform1 = document.getElementById("printButtonform1");

                                            printButtonform1.addEventListener("click", function() {
                                                handlePrintButtonClick();
                                            });
                                        });

                                        function handlePrintButtonClick() {
                                            var selectedIds = [];
                                            var checkboxes = document.querySelectorAll(".form-check-input:checked");
                                            checkboxes.forEach(function(checkbox) {
                                                selectedIds.push(checkbox.value);
                                            });

                                            if (selectedIds.length > 0) {
                                                var printWindow = window.open("about:blank", '_blank');
                                                printWindow.location.href = "order_invoice.php?selectedIds=" + selectedIds.join(",") + "&ACTION=VIEW";
                                            } else {
                                                alert("กรุณาเลือกข้อมูลที่ต้องการ Print");
                                            }
                                        }
                                    </script>

                                </div>
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ตัวเลือก</th>
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

                                            // ตรวจสอบค่าที่ส่งมาทาง URL
                                            $check = isset($_GET['check']) ? $_GET['check'] : '';

                                            if ($check == 'waitorder') {
                                                $stmt_receipt = $conn->prepare("SELECT DISTINCT receipt.*
                                                FROM receipt
                                                LEFT JOIN store ON receipt.ref1 = store.order_ref1
                                                WHERE receipt.status_receipt = 'yes' 
                                                AND receipt.resDesc = 'success' 
                                                AND receipt.amount > 999.99
                                                AND store.order_ref1 IS NULL
                                            ");

                                                $stmt_receipt->execute();
                                                $result_receipt = $stmt_receipt->fetchAll();
                                            }
                                            // ตรวจสอบค่า $result_receipt ก่อนที่จะใช้งาน
                                            if ($result_receipt) {
                                                $countrow = 1;
                                                foreach ($result_receipt as $t1) {
                                                    // ดึงข้อมูลจากตาราง receipt
                                                    $name = $t1['name_title'] . ' ' . $t1['rec_name'] . ' ' . $t1['rec_surname'];
                                                    $order_amount = $t1['amount'];
                                                    $order_address = $t1['address'] . ' ' . $t1['road'] . ' ' . $t1['districts'] . ' ' . $t1['amphures'] . ' ' . $t1['provinces'] . ' ' . $t1['zip_code'];
                                                    $order_description = $t1['edo_description'];
                                                    $status_order = isset($t1['status_order']) ? $t1['status_order'] : '';
                                                    $order_set = '';
                                                    $order_name = '';

                                                    // ดึงข้อมูลจากตาราง storage
                                                    $stmt_storage = $conn->prepare("SELECT * FROM storage ORDER BY max ASC");
                                                    $stmt_storage->execute();
                                                    $storage_result = $stmt_storage->fetchAll();

                                                    // หาค่า max ที่มี order_amount น้อยกว่า order_amount ปัจจุบัน
                                                    foreach ($storage_result as $storage_row) {
                                                        $max_value = $storage_row['max'];
                                                        $items_set = $storage_row['items_set'];
                                                        $order_name = $storage_row['name'];

                                                        if ($order_amount < $max_value) {
                                                            $order_set = $items_set;
                                                            break;
                                                        }
                                                    }
                                            ?>

                                                    <tr>
                                                        <td>
                                                            <h6><?= $countrow ?></h6>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="<?= $t1['receipt_id']; ?>" id="checkbox<?= $t1['receipt_id']; ?>">
                                                                <label class="form-check-label" for="checkbox<?= $countrow ?>"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fw-normal"><?= $t1['ref1']; ?> </p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fw-normal"><?= $name; ?></p>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0 fw-normal"><?= $order_set; ?> (<?= $order_name; ?>)</p>
                                                        </td>
                                                        <td>
                                                            <span class="mb-1 badge text-bg-warning">รอจัดส่ง</span>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown dropstart">
                                                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ti ti-dots-vertical fs-6"></i>
                                                                </a>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <a class="dropdown-item d-flex align-items-center gap-3 details-link" href="#" data-bs-toggle="modal" data-bs-target="#transferModal<?= $t1['receipt_id']; ?>" data-receipt-id="<?= $t1['receipt_id']; ?>">
                                                                        <i class="fs-4 ti ti-edit"></i>รายละเอียด
                                                                    </a>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                            <?php
                                                    $countrow++;
                                                }
                                            } else {
                                                echo "No data found";
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ตัวเลือก</th>
                                                <th>หมายเลขออเดอร์</th>
                                                <th>ชื่อผู้รับ</th>
                                                <th>รายการ</th>
                                                <th>สถานะ</th>
                                                <th>#</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php foreach ($result_receipt as $t1) { ?>
                                        <div class="modal fade" id="transferModal<?= $t1['receipt_id']; ?>" tabindex="-1" aria-labelledby="transferModalLabel<?= $t1['receipt_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="transferModalLabel<?= $t1['receipt_id']; ?>">
                                                            รายละเอียดการจัดส่งของที่ระลึง</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="card-body">
                                                        <?php
                                                        $order_amount = $t1['amount'];
                                                        $order_set = '';
                                                        $order_name = '';

                                                        // ดึงข้อมูลจากตาราง storage
                                                        $stmt_storage = $conn->prepare("SELECT * FROM storage ORDER BY max ASC");
                                                        $stmt_storage->execute();
                                                        $storage_result = $stmt_storage->fetchAll();

                                                        // หาค่า max ที่มี order_amount น้อยกว่า order_amount ปัจจุบัน
                                                        foreach ($storage_result as $storage_row) {
                                                            $max_value = $storage_row['max'];
                                                            $items_set = $storage_row['items_set'];
                                                            $order_name = $storage_row['name'];

                                                            if ($order_amount < $max_value) {
                                                                $order_set = $items_set;
                                                                break;
                                                            }
                                                        }
                                                        ?>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">ชื่อผู้รับ:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $t1['name_title'] . ' ' . $t1['rec_name'] . ' ' . $t1['rec_surname']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">โทรศัพท์:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $t1['rec_tel']; ?></p>
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
                                                                                <?= $t1['address'] . ' ' . $t1['road'] . ' ' . $t1['districts'] . ' ' . $t1['amphures'] . ' ' . $t1['provinces'] . ' ' . $t1['zip_code']; ?>
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
                                                                        <p class="form-control-static"><?= $t1['ref1']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">รายการ:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= $order_set; ?> (<?= $order_name; ?>)</p>
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
                                                                        <p class="form-control-static"><?= $t1['edo_description']; ?></p>
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
                                                                    <label class="form-label text-end col-md-3">วัน/เดือน/ปี:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static"><?= thai_date($t1['rec_date_out']); ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <label class="form-label text-end col-md-3">สถานะ:</label>
                                                                    <div class="col-md-9">
                                                                        <p class="form-control-static">
                                                                            <?php if ($t1['resDesc'] == 'success') : ?>
                                                                                <span class="mb-1 badge rounded-pill font-medium bg-success-subtle text-success">ยืนยันการชำระเงิน</span>
                                                                            <?php else : ?>
                                                                                <span class="mb-1 badge rounded-pill font-medium bg-danger-subtle text-danger">ยังไม่ได้รับการยืนยันการชำระเงิน กรุณาติดต่อผู้เกี่ยวข้อง</span>
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