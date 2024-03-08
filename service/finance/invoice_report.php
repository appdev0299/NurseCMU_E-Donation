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
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="status_user" class="form-label">ประเภทผู้บริจาค</label>
                                                        <select class="form-control" name="status_user" id="status_user">
                                                            <option value="" disabled <?php echo empty($_POST['status_user']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                            <?php
                                                            require_once 'conf/connection.php';
                                                            $sql = "SELECT DISTINCT status_user FROM receipt";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->execute();
                                                            $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($checkings as $checking) {
                                                                $status_user = $checking['status_user'];
                                                                $selected = isset($_POST['status_user']) && $_POST['status_user'] === $status_user ? 'selected' : '';
                                                                $status_user_text = ($status_user === 'person') ? 'บุคคลทั่วไป' : 'นิติบุคคล';
                                                                echo "<option value='$status_user' $selected>$status_user_text</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="status_receipt" class="form-label">ประเภทการบริจาค</label>
                                                        <select class="form-control" name="status_receipt" id="status_receipt">
                                                            <option value="" disabled <?php echo empty($_POST['status_receipt']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                            <?php
                                                            $sql = "SELECT DISTINCT status_receipt FROM receipt";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->execute();
                                                            $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($checkings as $checking) {
                                                                $status_receipt = $checking['status_receipt'];
                                                                $selected = isset($_POST['status_receipt']) && $_POST['status_receipt'] === $status_receipt ? 'selected' : '';
                                                                $status_receipt_text = ($status_receipt === 'no') ? 'ไม่ประสงค์ออกนาม' : 'บริจาคเพื่อรับใบเสร็จ';
                                                                echo "<option value='$status_receipt' $selected>$status_receipt_text</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="receipt_cc" class="form-label">สถานะใบเสร็จรับเงิน</label>
                                                        <select class="form-control" name="receipt_cc" id="receipt_cc">
                                                            <option value="" disabled <?php echo empty($_POST['receipt_cc']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                            <?php
                                                            $sql = "SELECT DISTINCT receipt_cc FROM receipt";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->execute();
                                                            $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($checkings as $checking) {
                                                                $receipt_cc = $checking['receipt_cc'];
                                                                $selected = isset($_POST['receipt_cc']) && $_POST['receipt_cc'] === $receipt_cc ? 'selected' : '';

                                                                $status_receipt_cc_text = ($receipt_cc === 'cancel') ? 'ใบเสร็จที่ยกเลิก' : 'ปกติ';

                                                                echo "<option value='$receipt_cc' $selected>$status_receipt_cc_text</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="edo_pro_id" class="form-label">โครงการ</label>
                                                        <select class="form-control" name="edo_pro_id" id="edo_pro_id">
                                                            <option value="" disabled <?php echo empty($_POST['edo_pro_id']) ? 'selected' : ''; ?>>แสดงทั้งหมด</option>
                                                            <?php
                                                            $sql = "SELECT DISTINCT edo_pro_id FROM receipt ORDER BY edo_pro_id ASC";
                                                            $stmt = $conn->prepare($sql);
                                                            $stmt->execute();
                                                            $checkings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($checkings as $checking) {
                                                                $edo_pro_id = $checking['edo_pro_id'];
                                                                $selected = isset($_POST['edo_pro_id']) && $_POST['edo_pro_id'] === $edo_pro_id ? 'selected' : '';
                                                                $additional_info = '';

                                                                // เพิ่มข้อมูลเพิ่มเติมตาม edo_pro_id ที่คุณต้องการ
                                                                switch ($edo_pro_id) {
                                                                    case '121205':
                                                                        $additional_info = 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่';
                                                                        break;
                                                                    case '121206':
                                                                        $additional_info = 'บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่';
                                                                        break;
                                                                    case '121207':
                                                                        $additional_info = 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ';
                                                                        break;
                                                                    case '121208':
                                                                        $additional_info = 'โครงการบริจาคเพิ่มเติม';
                                                                        break;
                                                                }
                                                                echo "<option value='$edo_pro_id' $selected>$edo_pro_id - $additional_info</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" name="display_data" class="btn btn-primary">ค้นหา</button>
                                            <button type="button" id="export_data" class="btn btn-success">ออกรายงาน</button>
                                            <script>
                                                document.getElementById("export_data").addEventListener("click", function() {
                                                    var start_date = document.getElementById("start_date").value;
                                                    var end_date = document.getElementById("end_date").value;
                                                    var status_user = document.getElementById("status_user").value;
                                                    var status_receipt = document.getElementById("status_receipt").value;
                                                    var edo_pro_id = document.getElementById("edo_pro_id").value;
                                                    var receipt_cc = document.getElementById("receipt_cc").value;
                                                    var showall = document.getElementById("showall").value; // เพิ่มการดึงค่า showall

                                                    var url = "invoice_xlsx.php?";
                                                    if (start_date) {
                                                        url += "start_date=" + encodeURIComponent(start_date) + "&";
                                                    }
                                                    if (end_date) {
                                                        url += "end_date=" + encodeURIComponent(end_date) + "&";
                                                    }
                                                    if (status_user) {
                                                        url += "status_user=" + encodeURIComponent(status_user) + "&";
                                                    }
                                                    if (status_receipt) {
                                                        url += "status_receipt=" + encodeURIComponent(status_receipt) + "&";
                                                    }
                                                    if (edo_pro_id) {
                                                        url += "edo_pro_id=" + encodeURIComponent(edo_pro_id) + "&";
                                                    }
                                                    if (receipt_cc) {
                                                        url += "receipt_cc=" + encodeURIComponent(receipt_cc) + "&";
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
                                                        // รองรับทุกชนิดของฟิลด์อินพุต เช่น text, textarea, select
                                                        var form = document.getElementById("clear");
                                                        var elements = form.elements;

                                                        for (var i = 0; i < elements.length; i++) {
                                                            if (elements[i].type === "text" || elements[i].type === "textarea" || elements[i].type === "select-one") {
                                                                elements[i].value = ""; // ล้างค่าข้อมูลในฟิลด์
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
                                                        $startIndex = 1;
                                                        $allDataSql = "SELECT COUNT(*) as total FROM ";
                                                        $allDataSql .= isset($_POST['showall']) && !empty($_POST['showall']) ? $_POST['showall'] : "receipt";
                                                        $allDataSql .= " WHERE 1=1";
                                                        $allDataStmt = $conn->prepare($allDataSql);
                                                        $allDataStmt->execute();
                                                        // Fetch data for the current page
                                                        $sql = "SELECT * FROM ";

                                                        if (isset($_POST['showall']) && !empty($_POST['showall'])) {
                                                            $selected_table = $_POST['showall'];
                                                            $sql .= $selected_table;
                                                        } else {
                                                            $sql .= "receipt";
                                                        }

                                                        $sql .= " WHERE 1=1";

                                                        if (isset($_POST['start_date']) && !empty($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['end_date'])) {
                                                            $start_date = $_POST['start_date'];
                                                            $end_date = $_POST['end_date'];
                                                            $sql .= " AND rec_date_out BETWEEN :start_date AND :end_date";
                                                        }

                                                        if (isset($_POST['status_user']) && !empty($_POST['status_user'])) {
                                                            $selected_status_user = $_POST['status_user'];
                                                            $sql .= " AND status_user = :status_user";
                                                        }

                                                        if (isset($_POST['status_receipt']) && !empty($_POST['status_receipt'])) {
                                                            $selected_status_receipt = $_POST['status_receipt'];
                                                            $sql .= " AND status_receipt = :status_receipt";
                                                        }

                                                        if (isset($_POST['edo_pro_id']) && !empty($_POST['edo_pro_id'])) {
                                                            $selected_edo_pro_id = $_POST['edo_pro_id'];
                                                            $sql .= " AND edo_pro_id = :edo_pro_id";
                                                        }

                                                        if (isset($_POST['receipt_cc']) && !empty($_POST['receipt_cc'])) {
                                                            $selected_receipt_cc = $_POST['receipt_cc'];
                                                            $sql .= " AND receipt_cc = :receipt_cc";
                                                        }

                                                        $sql .= " ORDER BY rec_date_out ASC";

                                                        $stmt = $conn->prepare($sql);

                                                        if (isset($start_date) && isset($end_date)) {
                                                            $stmt->bindParam(':start_date', $start_date);
                                                            $stmt->bindParam(':end_date', $end_date);
                                                        }

                                                        if (isset($selected_status_user)) {
                                                            $stmt->bindParam(':status_user', $selected_status_user);
                                                        }

                                                        if (isset($selected_status_receipt)) {
                                                            $stmt->bindParam(':status_receipt', $selected_status_receipt);
                                                        }

                                                        if (isset($selected_edo_pro_id)) {
                                                            $stmt->bindParam(':edo_pro_id', $selected_edo_pro_id);
                                                        }

                                                        if (isset($selected_receipt_cc)) {
                                                            $stmt->bindParam(':receipt_cc', $selected_receipt_cc);
                                                        }

                                                        $stmt->execute();
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        if (count($results) > 0) {
                                                        ?>
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
                                                                            <h6 class="fw-semibold mb-0">ที่อยู่</h6>
                                                                        </th>
                                                                        <th class="border-bottom-0">
                                                                            <h6 class="fw-semibold mb-0">รายละเอียด</h6>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($results as $row) {
                                                                    ?>
                                                                        <tr>
                                                                            <td class="border-bottom-0">
                                                                                <h6 class="fw-semibold mb-0"><?= $startIndex++; ?></h6>
                                                                            </td>
                                                                            <td class="border-bottom-0 <?= ($row['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                                                <h6 class="fw-semibold mb-1">
                                                                                    <?= $row['name_title']; ?> <?= $row['rec_name']; ?> <?= $row['rec_surname']; ?>
                                                                                </h6>
                                                                                <span class="fw-normal<?= ($row['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                                                    <?= formatThaiDate($row['rec_date_out']); ?> | <?= $row['id_receipt']; ?>
                                                                                </span>
                                                                                <h6 class="fw-semibold mb-1"></h6>
                                                                                <span class="fw-normal<?= ($row['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                                                    <?= number_format($row['amount'], 2, '.', ','); ?> บาท | <?= $row['payby']; ?>
                                                                                </span>
                                                                            </td>
                                                                            <td class="border-bottom-0 <?= ($row['receipt_cc'] == 'cancel') ? ' text-decoration-line-through' : ''; ?>">
                                                                                <p class="mb-0 fw-normal"><?= $row['address']; ?> <?= $row['road']; ?> <?= $row['districts']; ?> <?= $row['amphures']; ?> <?= $row['provinces']; ?></p>
                                                                            </td>
                                                                            <td class="border-bottom-0">
                                                                                <div class="dropdown">
                                                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu">
                                                                                        <a class="dropdown-item" href="<?= ($row['receipt_cc'] == 'cancel') ? 'invoice_cancel?receipt_id=' . $row['receipt_id'] : 'invoice_confirm?receipt_id=' . $row['receipt_id'] ?>&ACTION=VIEW" target="_blank">
                                                                                            <i class="bx bx-file-pdf me-1"></i> PDF
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        <?php
                                                        } else {
                                                            echo "No data found.";
                                                        }
                                                        ?>
                                                    </div>

                                                    <?php
                                                    function formatThaiDate($dateString)
                                                    {
                                                        $dateTime = new DateTime($dateString);
                                                        $dateTime->modify('+543 years');
                                                        return $dateTime->format('d-m-Y');
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