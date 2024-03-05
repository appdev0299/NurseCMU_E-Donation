<?php
// require_once 'session.php';
require_once 'head.php'; ?>

<body>
    <?php require_once 'aside.php'; ?>
    <div id="right-panel" class="right-panel">
        <?php require_once 'header.php'; ?>
        <div class="content">
            <div class="animated fadeIn">
                <!-- แสดงโครงการ -->
                <div class="row">
                    <?php
                    require_once 'connection.php';
                    $stmt05 = $conn->prepare("SELECT COUNT(*) AS total_records05, SUM(amount) AS total_amount05 FROM receipt WHERE edo_pro_id = 121205 AND receipt_cc = 'confirm'");
                    $stmt05->execute();
                    $result05 = $stmt05->fetch();

                    $stmt06 = $conn->prepare("SELECT COUNT(*) AS total_records06, SUM(amount) AS total_amount06 FROM receipt WHERE edo_pro_id = 121206 AND receipt_cc = 'confirm'");
                    $stmt06->execute();
                    $result06 = $stmt06->fetch();

                    $stmt07 = $conn->prepare("SELECT COUNT(*) AS total_records07, SUM(amount) AS total_amount07 FROM receipt WHERE edo_pro_id = 121207 AND receipt_cc = 'confirm'");
                    $stmt07->execute();
                    $result07 = $stmt07->fetch();

                    $stmt08 = $conn->prepare("SELECT COUNT(*) AS total_records08, SUM(amount) AS total_amount08 FROM receipt WHERE edo_pro_id = 121208 AND receipt_cc = 'confirm'");
                    $stmt08->execute();
                    $result08 = $stmt08->fetch();

                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-heading">บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษา</div>
                                    <div class="stat-text">฿ <?php echo number_format($result05['total_amount05'], 2); ?> บาท</div>
                                    <div class="stat-heading"><?php echo $result05['total_records05']; ?> ราย</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-heading">บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่</div>
                                    <div class="stat-text">฿ <?php echo number_format($result06['total_amount06'], 2); ?> บาท</div>
                                    <div class="stat-heading"><?php echo $result06['total_records06']; ?> ราย</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-heading">บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ</div>
                                    <div class="stat-text"><?php echo number_format($result07['total_amount07'], 2); ?> บาท</div>
                                    <div class="stat-heading"><?php echo $result07['total_records07']; ?> ราย</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-heading">โครงการบริจาคเพิ่มเติม</div>
                                    <div class="stat-text">฿ <?php echo number_format($result08['total_amount08'], 2); ?> บาท</div>
                                    <div class="stat-heading"><?php echo $result08['total_records08']; ?> ราย</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- แสดงโครงการ -->
                <!-- แสดงโครงการ -->
                <div class="row">
                    <?php
                    require_once 'connection.php';

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

                    $sqltotal_amountsum = "SELECT SUM(amount) AS total_amountsum FROM receipt WHERE receipt_cc = 'confirm'";
                    $stmttotal_amountsum = $conn->prepare($sqltotal_amountsum);
                    $stmttotal_amountsum->execute();
                    $resulttotal_amountsum = $stmttotal_amountsum->fetch();
                    ?>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-heading">บริจากผ่านช่องทางบุคลากร</div>
                                    <div class="stat-text"><?php echo $resultRecordsoffline['total_records_offline']; ?> ราย</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-heading">บริจากผ่านช่องทาง QE-Code</div>
                                    <div class="stat-text"><?php echo $resultRecordsonline['total_records_online']; ?> ราย</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-heading">รวมผู้บริจาคทั้งหมด</div>
                                    <div class="stat-text"><?php echo $resulttotal_records['total_records']; ?> ราย</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="card" style="background-color: #ffc08c;">
                            <div class="card-body" style="height: 150px;">
                                <div class="stat-widget-five">
                                    <div class="stat-text">รวมยอดเงินทั้งหมด</div>
                                    <div class="stat-text"><?php echo number_format($resulttotal_amountsum['total_amountsum'], 2); ?> บาท</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p><?php
                        require_once 'connection.php';

                        $sql = "SELECT MAX(dateCreate) AS latest_dateCreate FROM receipt";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetch();

                        $latest_dateCreate = $result['latest_dateCreate'];
                        echo "ข้อมูลเมื่อ: " . $latest_dateCreate;
                        ?></p>
                </div>
                <!-- แสดงโครงการ -->

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>
</body>

</html>