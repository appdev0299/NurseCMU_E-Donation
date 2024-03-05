<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body id="section_1">

    <?php require_once('header.php');
    require_once('nav.php'); ?>
    <main>
        <section class="cta-section section-padding section-bg">
            <?php
            if (isset($_GET['id'])) {
                require_once 'connection.php';
                $stmt = $conn->prepare("SELECT * FROM pro_offline WHERE id=?");
                $stmt->execute([$_GET['id']]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $imageURL = "images/causes/" . $row['img_banner'];
            ?>
                    <div class="container">
                        <img src="<?= $imageURL; ?>" class="custom-text-box-image img-fluid" alt="">
                    </div>
            <?php
                }
            }
            ?>
            <div class="col-lg-8 col-12 mx-auto">
                <form class="custom-form contact-form" onsubmit="return validateForm()" method="post">
                    <h5 class="mb-4"><?= $row['edo_name']; ?>
                        <p><?= $row['edo_tex']; ?></p>
                    </h5>
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12">
                            <input type="text" name="rec_name" value="ไม่ประสงค์ออกนาม" class="form-control" readonly>
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <input type="number" id="amount" name="amount" class="form-control" placeholder="จำนวนเงิน *" required step="0.01">
                            <script>
                                function validateForm() {
                                    var amountInput = document.getElementById("amount");
                                    var amountValue = parseFloat(amountInput.value);
                                    amountValue = amountValue.toFixed(2);

                                    // เงื่อนไข 1: มีจุดทศนิยมได้ไม่เกิน 2 ตำแหน่ง
                                    if (!(/^\d+(\.\d{1,2})?$/.test(amountValue))) {
                                        alert("กรุณากรอกจำนวนเงินที่มีจุดทศนิยมไม่เกิน 2 ตำแหน่ง");
                                        amountInput.focus();
                                        return false;
                                    }

                                    // เงื่อนไข 2: ค่าไม่สามารถเป็นติดลบได้
                                    if (amountValue < 0) {
                                        alert("กรุณากรอกจำนวนเงินที่ไม่เป็นติดลบ");
                                        amountInput.focus();
                                        return false;
                                    }

                                    // เงื่อนไข 3: ไม่สามารถใช้ตัวอักษรในจำนวนเงินได้
                                    if (isNaN(amountValue)) {
                                        alert("กรุณากรอกจำนวนเงินที่เป็นตัวเลข");
                                        amountInput.focus();
                                        return false;
                                    }

                                    // เงื่อนไข 4: ไม่สามารถใส่จำนวนเงินเกิน 100,000 บาทได้
                                    if (amountValue > 100000) {
                                        alert("กรุณากรอกจำนวนเงินที่ไม่เกิน 100,000 บาท");
                                        amountInput.focus();
                                        return false;
                                    }

                                    // เงื่อนไข 5: จำนวนเงินต้องเริ่มที่ 1 บาทขึ้นไป
                                    if (amountValue < 1) {
                                        alert("กรุณากรอกจำนวนเงินที่เริ่มต้นที่ 1 บาทขึ้นไป");
                                        amountInput.focus();
                                        return false;
                                    }

                                    // ถ้าผ่านทุกเงื่อนไข
                                    return true;
                                }
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" name="edo_name" value="<?= $row['edo_name']; ?>" hidden>
                        <input type="text" name="edo_pro_id" value="<?= $row['edo_pro_id']; ?>" hidden>
                        <input type="text" name="edo_description" value="<?= $row['edo_description']; ?>" hidden>
                        <input type="text" name="edo_objective" value="<?= $row['edo_objective']; ?>" hidden>
                        <input type="text" name="status_donat" value="online" hidden>
                        <input type="text" name="status_user" value="person" hidden>
                        <input type="text" name="status_receipt" value="no" hidden>
                        <input type="text" name="other_description" hidden>
                        <input type="text" name="rec_date_s" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" name="rec_date_out" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" name="payby" value="QR CODE" hidden>
                        <input type="text" name="rec_date_s" hidden>
                        <input type="text" name="name_title" hidden>
                        <input type="text" name="rec_surname" hidden>
                        <input type="text" name="rec_tel" hidden>
                        <input type="text" name="rec_idname" hidden>
                        <input type="text" name="rec_email" hidden>
                        <input type="text" name="address" hidden>
                        <input type="text" name="road" hidden>
                        <input type="text" name="provinces" hidden>
                        <input type="text" name="amphures" hidden>
                        <input type="text" name="districts" hidden>
                        <input type="text" name="zip_code" hidden>
                        <input type="text" name="comment" hidden>
                        <input type="text" name="resDesc" hidden>
                        <input type="text" name="pdflink" hidden>
                        <input type="text" name="ref1" value="0" hidden>
                        <input type="text" name="id_receipt" value="0" hidden>
                        <input type="hidden" name="receipt_cc" value="confirm">
                    </div>
                    <button type="submit" class="form-control">ยืนยัน</button>
                    <?php
                    require_once('donateion_no_db.php');
                    // echo '<pre>';
                    // print_r($_POST);
                    // echo '</pre>';
                    ?>
                </form>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>
</body>

</html>