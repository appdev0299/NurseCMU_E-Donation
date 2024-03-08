<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 mx-auto">
                    <form class="custom-form donate-form">
                        <center>
                            <div class="col-lg-12 col-12">
                                <h3 class="mb-3">ตรวจสอบรายละเอียด</h3>
                                <h5 class="mb-3">ยืนยันข้อมูล</h5>
                            </div>
                        </center>
                        <?php
                        require_once 'connection.php';

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $stmt = $conn->prepare("SELECT * FROM receipt_offline WHERE id = :id");
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>

                        <div class="row">
                            <div class="col-lg-6 col-12 mt-2">
                                <label class="control-label">หมายเลขอ้างอิงโครงการ</label>
                                <input type="text" name="ref1" value="<?= $row['ref1']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-lg-6 col-12 mt-2">
                                <label class="control-label">จำนวนเงิน</label>
                                <input type="text" name="rec_fullname" value="<?= number_format($row['amount'], 2, '.', ','); ?>" class="form-control" readonly>
                            </div>
                            <div class="col-lg-12 col-12 mt-2">
                                <label class="control-label">รายละเอียดโครงการ</label>
                                <input type="text" name="rec_fullname" value="<?= $row['edo_name']; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <hr>
                        <center>
                            <div class="col-lg-12 col-12">
                                <h5 class="mb-3">สแกนเพื่อชำระเงิน</h5>
                            </div>
                        </center>

                        <div class="container">
                            <div class="row">
                                <?php
                                require_once 'lib-crc16.inc.php';
                                require_once 'connection.php';

                                $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                if ($id <= 0) {
                                    echo "Invalid ID.";
                                    exit;
                                }

                                if (!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                $sql = "SELECT amount, rec_date_out, edo_pro_id, id, rec_time FROM receipt_offline WHERE id = :id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                                try {
                                    $stmt->execute();
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                    if ($row) {
                                        $amount = $row["amount"];
                                        $rec_date_out = $row["rec_date_out"];
                                        $edo_pro_id = $row["edo_pro_id"];
                                        $id = $row["id"];
                                        $rec_time = $row["rec_time"];

                                        $rec_date_out_year = (int)date('Y', strtotime($rec_date_out)) + 543;
                                        $lastTwoDigits = substr($rec_date_out_year, -2);

                                        $amountFormatted = number_format($amount, 2, '.', '');
                                        $amountWithPadding = str_pad($amountFormatted, 10, '0', STR_PAD_LEFT);
                                        $qrcode00 = '000201';
                                        $qrcode01 = '010212';
                                        $qrcode3000 = '30630016A000000677010112';
                                        $qrcode3001 = '0115099400258783792';
                                        $qrcode3002 = '0215' . $lastTwoDigits . $edo_pro_id . str_pad($id, 7, '0', STR_PAD_LEFT);
                                        $qrcode3003 = '03010';
                                        $qrcode30 = $qrcode3000 . $qrcode3001 . $qrcode3002 . $qrcode3003;

                                        $qrcode53 = '5303764';
                                        $qrcode54 = '5410' . ($amountWithPadding);
                                        $qrcode58 = '5802TH';
                                        $qrcode62 = '62100706SCB001';
                                        $qrcode63 = '6304';
                                        $qrcode = $qrcode00 . $qrcode01 . $qrcode30 . $qrcode53 . $qrcode54 . $qrcode58 . $qrcode63;
                                        $checkSum = CRC16HexDigest($qrcode);

                                        $qrcodeFull = $qrcode . $checkSum;
                                        require_once 'phpqrcode/qrlib.php';

                                        $codeContents = $qrcodeFull;

                                        $tempDir = "qrcodepayment/";

                                        if (!file_exists($tempDir)) {
                                            mkdir($tempDir, 0755, true);
                                        }

                                        $fileName = 'qrcode_' . md5($codeContents) . '.png';

                                        $pngAbsoluteFilePath = $tempDir . $fileName;

                                        $urlRelativeFilePath = $tempDir . $fileName;

                                        $qrCodeSize = 350;
                                        $qrCodeECLevel = QR_ECLEVEL_Q;
                                        if (!file_exists($pngAbsoluteFilePath)) {
                                            QRcode::png($codeContents, $pngAbsoluteFilePath, $qrCodeECLevel, $qrCodeSize);
                                        }
                                    } else {
                                        echo "No data found.";
                                    }
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                    $amount = 0;
                                }
                                ?>
                                <div class="col-lg-12 col-12 mt-1 text-center">
                                    <?php
                                    if (!empty($rec_time)) {
                                        $originalTime = strtotime($rec_time);
                                        $newTime = $originalTime + 10 * 60;
                                        $newTimeFormatted = date("H:i:s", $newTime);
                                        $currentTime = time();
                                        if (strtotime($newTimeFormatted) <= $currentTime) {
                                            echo '<div style="color: red;">หมดเวลาการชำระเงิน กรุณากรอกข้อมูลการบริจาคครั้งใหม่</div>';
                                        } else {
                                            echo '<div id="countdown" style="color: red;">กรุณาชำระเงินก่อน เวลา: ' . $newTimeFormatted . '</div>';
                                    ?>
                                            &nbsp;
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="text-center" style="position: relative;">
                                                    <img src="images/Thai_QR_Payment_Logo.png" alt="Thai QR Payment Logo" width="400" height="550">
                                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -40%);">
                                                        <img src="<?php echo $urlRelativeFilePath; ?>" width="<?php echo $qrCodeSize; ?>" height="<?php echo $qrCodeSize; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo "ไม่มีข้อมูลเวลา.";
                                    }
                                    ?>
                                </div>

                                <script>
                                    // JavaScript countdown timer
                                    var countdownElement = document.getElementById("countdown");
                                    var endTime = new Date("<?php echo date('M d, Y H:i:s', $newTime); ?>").getTime();

                                    var x = setInterval(function() {
                                        var now = new Date().getTime();
                                        var distance = endTime - now;

                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        countdownElement.innerHTML = "กรุณาชำระเงินก่อน เวลา: " + minutes + " นาที " + seconds + " วินาที";

                                        if (distance < 0) {
                                            clearInterval(x);
                                            countdownElement.innerHTML = "หมดเวลาการชำระเงิน กรุณากรอกข้อมูลการบริจาคครั้งใหม่";
                                            // รีโหลดหน้าเมื่อหมดเวลา
                                            setTimeout(function() {
                                                window.location.reload();
                                            }, 2000); // รีโหลดหน้าหลังจาก 2 วินาที
                                        }
                                    }, 1000);
                                </script>
                            </div>
                        </div>
                        <br>
                        <script>
                            var loopCount = 0;

                            function fetchData() {
                                var id = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
                                var amount = "<?php echo isset($_GET['amount']) ? $_GET['amount'] : ''; ?>";
                                var rec_date_out = "<?php echo isset($_GET['rec_date_out']) ? $_GET['rec_date_out'] : ''; ?>";
                                var ref1 = "<?php echo isset($_GET['ref1']) ? $_GET['ref1'] : ''; ?>";

                                if (amount !== '' && rec_date_out !== '' && ref1 !== '' && id !== '') {
                                    var data = {
                                        id: id,
                                        amount: amount,
                                        rec_date_out: rec_date_out,
                                        ref1: ref1
                                    };
                                    var xhr = new XMLHttpRequest();
                                    xhr.open("POST", "data_check.php", true);
                                    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                                    xhr.onreadystatechange = function() {
                                        if (xhr.readyState === 4 && xhr.status === 200) {
                                            var response = JSON.parse(xhr.responseText);
                                            console.log(response);
                                            if (response.message === 'success') {
                                                swal({
                                                    title: "ชำระเงินการบริจาคเสร็จสิ้น",
                                                    text: "ขอบคุณสำหรับการบริจาค",
                                                    type: "success",
                                                    timer: 6000,
                                                    showConfirmButton: false
                                                });
                                                setTimeout(function() {
                                                    window.location.href = "index#section_2";
                                                }, 5000);
                                            }
                                        }
                                    };
                                    xhr.send(JSON.stringify(data));
                                } else {
                                    console.log('ไม่ได้รับข้อมูลที่เรียกใช้งานไป');
                                }

                                loopCount++;
                                if (loopCount >= 100) {
                                    clearInterval(intervalId); // Stop the loop after 20 iterations
                                }
                            }

                            var intervalId = setInterval(fetchData, 5000);
                        </script>

                    </form>
                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
                    <script>
                        $(document).ready(function() {
                            swal({
                                title: "คำเตือน",
                                text: "เพื่อประโยชน์ในการลดหย่อนภาษี กรุณาใช้ บัญชีอิเล็กทรอนิกส์ ของตัวท่านเอง",
                                type: "warning",
                                showConfirmButton: true,
                                confirmButtonText: "ตกลง"
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </main>
    <?php require_once('footer.php'); ?>
    <script src=" js/main.js"></script>
</body>

</html>