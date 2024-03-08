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
                    <?php
                    require_once 'conf/connection.php';
                    $stmt05 = $conn->prepare("SELECT 
                    SUM(CASE WHEN status_donat = 'online' THEN amount ELSE 0 END) AS total_online_amount,
                    SUM(CASE WHEN status_donat = 'offline' THEN amount ELSE 0 END) AS total_offline_amount,
                    COUNT(CASE WHEN status_donat = 'online' THEN 1 ELSE NULL END) AS total_online_records,
                    COUNT(CASE WHEN status_donat = 'offline' THEN 1 ELSE NULL END) AS total_offline_records,
                    COUNT(*) AS total_records05,
                    SUM(amount) AS total_amount05
                    FROM receipt WHERE edo_pro_id = 121205 AND receipt_cc = 'confirm'");
                    $stmt05->execute();
                    $result05 = $stmt05->fetch();

                    $stmt06 = $conn->prepare("SELECT 
                    SUM(CASE WHEN status_donat = 'online' THEN amount ELSE 0 END) AS total_online_amount,
                    SUM(CASE WHEN status_donat = 'offline' THEN amount ELSE 0 END) AS total_offline_amount,
                    COUNT(CASE WHEN status_donat = 'online' THEN 1 ELSE NULL END) AS total_online_records,
                    COUNT(CASE WHEN status_donat = 'offline' THEN 1 ELSE NULL END) AS total_offline_records,
                    COUNT(*) AS total_records06,
                    SUM(amount) AS total_amount06
                    FROM receipt WHERE edo_pro_id = 121206 AND receipt_cc = 'confirm'");
                    $stmt06->execute();
                    $result06 = $stmt06->fetch();

                    $stmt07 = $conn->prepare("SELECT 
                    SUM(CASE WHEN status_donat = 'online' THEN amount ELSE 0 END) AS total_online_amount,
                    SUM(CASE WHEN status_donat = 'offline' THEN amount ELSE 0 END) AS total_offline_amount,
                    COUNT(CASE WHEN status_donat = 'online' THEN 1 ELSE NULL END) AS total_online_records,
                    COUNT(CASE WHEN status_donat = 'offline' THEN 1 ELSE NULL END) AS total_offline_records,
                    COUNT(*) AS total_records07,
                    SUM(amount) AS total_amount07
                    FROM receipt WHERE edo_pro_id = 121207 AND receipt_cc = 'confirm'");
                    $stmt07->execute();
                    $result07 = $stmt07->fetch();

                    $stmt08 = $conn->prepare("SELECT 
                    SUM(CASE WHEN status_donat = 'online' THEN amount ELSE 0 END) AS total_online_amount,
                    SUM(CASE WHEN status_donat = 'offline' THEN amount ELSE 0 END) AS total_offline_amount,
                    COUNT(CASE WHEN status_donat = 'online' THEN 1 ELSE NULL END) AS total_online_records,
                    COUNT(CASE WHEN status_donat = 'offline' THEN 1 ELSE NULL END) AS total_offline_records,
                    COUNT(*) AS total_records08,
                    SUM(amount) AS total_amount08
                    FROM receipt WHERE edo_pro_id = 121208 AND receipt_cc = 'confirm'");
                    $stmt08->execute();
                    $result08 = $stmt08->fetch();

                    ?>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษา </h5>
                                        <h6 class="fw-semibold mb-5">
                                            รวมยอดเงิน (ผ่านเว็บไซต์ E-Donation) : <span style="color: red;"><?php echo number_format($result05['total_online_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result05['total_online_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงิน (ผ่านเจ้าหน้าที่) : <span style="color: red;"><?php echo number_format($result05['total_offline_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result05['total_offline_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงินทั้งหมด : <span style="color: red;"><?php echo number_format($result05['total_amount05'], 2); ?></span> บาท <br>
                                            รายการทั้งหมด : <span style="color: red;"><?php echo $result05['total_records05']; ?></span> ราย
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ </h5>
                                        <h6 class="fw-semibold mb-3">
                                            รวมยอดเงิน (ผ่านเว็บไซต์ E-Donation) : <span style="color: red;"><?php echo number_format($result06['total_online_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result06['total_online_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงิน (ผ่านเจ้าหน้าที่) : <span style="color: red;"><?php echo number_format($result06['total_offline_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result06['total_offline_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงินทั้งหมด : <span style="color: red;"><?php echo number_format($result06['total_amount06'], 2); ?></span> บาท <br>
                                            รายการทั้งหมด : <span style="color: red;"><?php echo $result06['total_records06']; ?></span> ราย
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น </h5>
                                        <h6 class="fw-semibold mb-3">
                                            รวมยอดเงิน (ผ่านเว็บไซต์ E-Donation) : <span style="color: red;"><?php echo number_format($result07['total_online_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result07['total_online_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงิน (ผ่านเจ้าหน้าที่) : <span style="color: red;"><?php echo number_format($result07['total_offline_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result07['total_offline_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงินทั้งหมด : <span style="color: red;"><?php echo number_format($result07['total_amount07'], 2); ?></span> บาท <br>
                                            รายการทั้งหมด : <span style="color: red;"><?php echo $result07['total_records07']; ?></span> ราย
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> โครงการบริจาคเพิ่มเติม </h5>
                                        <h6 class="fw-semibold mb-3">
                                            รวมยอดเงิน (ผ่านเว็บไซต์ E-Donation) : <span style="color: red;"><?php echo number_format($result08['total_online_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result08['total_online_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงิน (ผ่านเจ้าหน้าที่) : <span style="color: red;"><?php echo number_format($result08['total_offline_amount'], 2); ?></span> บาท <br>
                                            จำนวน : <span style="color: red;"><?php echo $result08['total_offline_records']; ?></span> ราย <br>
                                            <br>
                                            รวมยอดเงินทั้งหมด : <span style="color: red;"><?php echo number_format($result08['total_amount08'], 2); ?></span> บาท <br>
                                            รายการทั้งหมด : <span style="color: red;"><?php echo $result08['total_records08']; ?></span> ราย
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $sqlRecordsoffline = "SELECT COUNT(*) AS total_records_offline FROM receipt WHERE status_donat = 'offline' AND receipt_cc = 'confirm'";
                    $stmtRecordsoffline = $conn->prepare($sqlRecordsoffline);
                    $stmtRecordsoffline->execute();
                    $resultRecordsoffline = $stmtRecordsoffline->fetch();

                    $sqlRecordsonline = "SELECT COUNT(*) AS total_records_online FROM receipt WHERE status_donat = 'online' AND receipt_cc = 'confirm'";
                    $stmtRecordsonline = $conn->prepare($sqlRecordsonline);
                    $stmtRecordsonline->execute();
                    $resultRecordsonline = $stmtRecordsonline->fetch();

                    $sqltotal_records = "SELECT COUNT(*) AS total_records FROM receipt WHERE receipt_cc = 'confirm'";
                    $stmttotal_records = $conn->prepare($sqltotal_records);
                    $stmttotal_records->execute();
                    $resulttotal_records = $stmttotal_records->fetch();

                    $sql_total_amount = "SELECT 
                    SUM(CASE WHEN status_donat = 'online' THEN amount ELSE 0 END) AS total_online_amount,
                    SUM(CASE WHEN status_donat = 'offline' THEN amount ELSE 0 END) AS total_offline_amount
                    FROM receipt WHERE receipt_cc = 'confirm'";

                    $stmt_total_amount = $conn->prepare($sql_total_amount);
                    $stmt_total_amount->execute();
                    $result_total_amount = $stmt_total_amount->fetch();

                    $total_amount = $result_total_amount['total_online_amount'] + $result_total_amount['total_offline_amount'];

                    ?>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจากผ่านช่องทางบุคลากร </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo $resultRecordsoffline['total_records_offline']; ?> ราย</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> บริจากผ่านช่องทาง QE-Code </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo $resultRecordsonline['total_records_online']; ?> ราย</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> รวมผู้บริจาคทั้งหมด </h5>
                                        <h6 class="fw-semibold mb-3"><?php echo $resulttotal_records['total_records']; ?> ราย</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> รวมยอดเงิน (ผ่านเว็บไซต์ E-Donation) </h5>
                                        <h6 class="fw-semibold mb-3"><span style="color: red;"><?php echo number_format($result_total_amount['total_online_amount'], 2); ?></span> บาท</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> รวมยอดเงิน (ผ่านเจ้าหน้าที่) </h5>
                                        <h6 class="fw-semibold mb-3"><span style="color: red;"><?php echo number_format($result_total_amount['total_offline_amount'], 2); ?></span> บาท</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start" style="height: 85px;">
                                    <div class="col-12">
                                        <h5 class="card-title mb-12 fw-semibold"> รวมยอดเงินทั้งหมด </h5>
                                        <h6 class="fw-semibold mb-3"><span style="color: red;"><?php echo number_format($total_amount, 2); ?></span> บาท</h6>
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
</body>

</html>