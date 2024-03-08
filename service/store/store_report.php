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
                                <h5 class="card-title fw-semibold mb-4">รายงาน</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" id="clear">
                                            <div class="mb-3">
                                                <h6 class="form-label">กรอกข้อมูลผู้บริจาค</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="receipt" class="form-label">ปีงบประมาณ</label>
                                                        <select class="form-control" name="showall" id="showall">
                                                            <option value="receipt" <?php if (isset($_POST['showall']) && $_POST['showall'] === 'receipt') echo 'selected'; ?>>2567</option>
                                                            <option value="receipt_2566" <?php if (isset($_POST['showall']) && $_POST['showall'] === 'receipt_2566') echo 'selected'; ?>>2566</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="start_date" class="form-label">วันที่เริ่ม</label>
                                                        <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
                                                        <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : ''; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="display_data" class="btn btn-primary">ค้นหา</button>
                                            <button type="button" id="export_data" class="btn btn-success">ออกรายงาน</button>
                                            <script>
                                                document.getElementById("export_data").addEventListener("click", function() {
                                                    var start_date = document.getElementById("start_date").value;
                                                    var end_date = document.getElementById("end_date").value;
                                                    var showall = document.getElementById("showall").value;

                                                    var url = "store_xlsx?";
                                                    if (start_date) {
                                                        url += "start_date=" + encodeURIComponent(start_date) + "&";
                                                    }
                                                    if (end_date) {
                                                        url += "end_date=" + encodeURIComponent(end_date) + "&";
                                                    }
                                                    if (showall) {
                                                        url += "showall=" + encodeURIComponent(showall);
                                                    }
                                                    window.location.href = url;
                                                });
                                            </script>
                                            <button type="button" id="clear_data" class="btn btn-danger">ล้างข้อมูล</button>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    var clearButton = document.getElementById("clear_data");
                                                    clearButton.addEventListener("click", function() {
                                                        var form = document.getElementById("clear");
                                                        var elements = form.elements;
                                                        for (var i = 0; i < elements.length; i++) {
                                                            if (elements[i].type === "text" || elements[i].type === "textarea" || elements[i].type === "select-one" || elements[i].type === "date") {
                                                                elements[i].value = "";
                                                            }
                                                        }
                                                    });
                                                });
                                            </script>
                                        </form>
                                        <br>
                                        <div class="col-lg-12 d-flex align-items-stretch">
                                            <div class="card w-100">
                                                <div class="card-body p-4">
                                                    <div class="table-responsive">
                                                        <?php
                                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                                            require_once 'conf/connection.php';
                                                            $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
                                                            $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
                                                            $showall = isset($_POST['showall']) ? $_POST['showall'] : 'receipt';

                                                            $sql = "SELECT * FROM ";
                                                            if (!empty($showall)) {
                                                                $selected_table = $showall;
                                                                $sql .= $selected_table;
                                                            } else {
                                                                $sql .= "receipt";
                                                            }
                                                            $sql .= " WHERE 1=1";

                                                            if (!empty($start_date) && !empty($end_date)) {
                                                                $sql .= " AND rec_date_out BETWEEN :start_date AND :end_date";
                                                            }
                                                            $sql .= " ORDER BY rec_date_out ASC";
                                                            $stmt = $conn->prepare($sql);
                                                            if (!empty($start_date) && !empty($end_date)) {
                                                                $stmt->bindParam(':start_date', $start_date);
                                                                $stmt->bindParam(':end_date', $end_date);
                                                            }
                                                            $stmt->execute();
                                                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                            if (count($results) > 0) {
                                                        ?>
                                                                <div class="table-responsive">
                                                                    <table id="myTable" class="table text-nowrap mb-0 align-middle">
                                                                        <thead class="text-dark fs-4">
                                                                            <tr>
                                                                                <th class="border-bottom-0">
                                                                                    <h6 class="fw-semibold mb-0">ลำดับ</h6>
                                                                                </th>
                                                                                <th class="border-bottom-0">
                                                                                    <h6 class="fw-semibold mb-0">ชื่อ-นามสกุล</h6>
                                                                                </th>
                                                                                <th class="border-bottom-0">
                                                                                    <h6 class="fw-semibold mb-0">รายการ</h6>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            $startIndex = 1;
                                                                            $stmt_receipt = $conn->prepare("SELECT DISTINCT receipt.*
                                                                            FROM receipt
                                                                            LEFT JOIN store ON receipt.ref1 = store.order_ref1
                                                                            WHERE receipt.status_receipt = 'yes' 
                                                                            AND receipt.resDesc = 'success' 
                                                                            AND receipt.amount > 999.99
                                                                            AND store.order_ref1 IS NULL");
                                                                            $stmt_receipt->execute();
                                                                            $dateResults = $stmt_receipt->fetchAll();

                                                                            $stmt_storage = $conn->prepare("SELECT * FROM storage ORDER BY max ASC");
                                                                            $stmt_storage->execute();
                                                                            $storage_result = $stmt_storage->fetchAll();

                                                                            foreach ($results as $row) {
                                                                                $order_amount = $row['amount'];
                                                                                $order_set = '';
                                                                                $order_name = '';
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
                                                                                    <td class="border-bottom-0">
                                                                                        <h6 class="fw-semibold mb-0"><?= $startIndex++; ?></h6>
                                                                                    </td>
                                                                                    <td class="border-bottom-0">
                                                                                        <h6 class="fw-semibold mb-1">
                                                                                            <?= $row['name_title']; ?> <?= $row['rec_name']; ?> <?= $row['rec_surname']; ?>
                                                                                        </h6>
                                                                                        <?php
                                                                                        if (!function_exists('formatThaiDate')) {
                                                                                            function formatThaiDate($dateString)
                                                                                            {
                                                                                                $dateTime = new DateTime($dateString);
                                                                                                $dateTime->modify('+543 years');
                                                                                                return $dateTime->format('d-m-Y');
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <span class="fw-normal">
                                                                                            <?= formatThaiDate($row['rec_date_out']); ?> | <?= $row['id_receipt']; ?>
                                                                                        </span>
                                                                                        <h6 class="fw-semibold mb-1">
                                                                                        </h6>
                                                                                        <span class="fw-normal<?= ($row['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                                                            <p class="mb-0 fw-normal"><?= $row['address']; ?> <?= $row['road']; ?> <?= $row['districts']; ?> <?= $row['amphures']; ?> <?= $row['provinces']; ?></p>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <p class="mb-0 fw-normal"><?= $order_set; ?> (<?= $order_name; ?>)</p>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                        <?php
                                                            } else {
                                                                echo "No data found.";
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>
</body>

</html>