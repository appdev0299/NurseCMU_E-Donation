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
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="name_title" class="form-control" list="cars" placeholder="คำนำหน้าชื่อ *" required>
                            <datalist id="cars">
                                <option value="นาย" />
                                <option value="นาง" />
                                <option value="นางสาว" />
                            </datalist>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_name" class="form-control" placeholder="ชื่อ *" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_surname" class="form-control" placeholder="สกุล *" required>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="rec_tel" class="form-control" placeholder="เบอร์โทรศัพท์ *" required>
                            <script>
                                const recTelInput = document.querySelector('input[name="rec_tel"]');

                                recTelInput.addEventListener("input", function() {
                                    let value = this.value;
                                    value = value.replace(/\D/g, '');

                                    if (value.length < 8) {
                                        // หากมีน้อยกว่า 8 ตัวเลขให้แสดงข้อความแจ้งเตือน
                                        recTelInput.setCustomValidity("กรุณากรอกเบอร์โทรศัพท์ที่ถูกต้อง");
                                    } else if (value.length > 10) {
                                        // หากมีมากกว่า 10 ตัวเลขให้ตัดทิ้งส่วนที่เกิน
                                        value = value.slice(0, 10);
                                        recTelInput.setCustomValidity("");
                                    } else {
                                        recTelInput.setCustomValidity("");
                                    }

                                    this.value = value;
                                });
                            </script>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="number" name="rec_idname" id="rec_idname" class="form-control" placeholder="เลขบัตรประชาชน *" min="0" required>
                            <script>
                                const recIdnameInput = document.getElementById("rec_idname");

                                recIdnameInput.addEventListener("input", function() {
                                    let value = this.value;
                                    value = value.replace(/\D/g, '');

                                    if (value < 0) {
                                        value = '';
                                    }
                                    if (value.length > 13) {
                                        value = value.slice(0, 13);
                                    }

                                    if (value.length < 13) {
                                        recIdnameInput.setCustomValidity("กรุณากรอกเลขบัตรประชาชนให้ถูกต้อง");
                                    } else {
                                        recIdnameInput.setCustomValidity("");
                                    }

                                    this.value = value;
                                });
                            </script>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="email" name="rec_email" class="form-control" placeholder="อีเมล์ (ใช้สำหรับการส่งใบเสร็จผ่าน อีเมล์)">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="address" class="form-control" placeholder="ที่อยู่ *" required>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="road" class="form-control" placeholder="ถนน">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="districts" class="form-control" id="districtsInput" placeholder="ตำบล *" required>
                            <script>
                                document.getElementById('districtsInput').addEventListener('blur', function() {
                                    var inputElement = this;
                                    var inputValue = inputElement.value.trim();
                                    var prefix = 'ต. ';

                                    // ตรวจสอบว่าข้อมูลที่กรอกเข้ามาไม่ใช่ค่าว่าง และยังไม่มีคำนำหน้า "จ." อยู่แล้ว
                                    if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                        inputElement.value = prefix + inputValue;
                                    }
                                });
                            </script>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="amphures" class="form-control" id="amphuresInput" placeholder="อำเภอ *" required>
                            <script>
                                document.getElementById('amphuresInput').addEventListener('blur', function() {
                                    var inputElement = this;
                                    var inputValue = inputElement.value.trim();
                                    var prefix = 'อ. ';

                                    // ตรวจสอบว่าข้อมูลที่กรอกเข้ามาไม่ใช่ค่าว่าง และยังไม่มีคำนำหน้า "จ." อยู่แล้ว
                                    if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                        inputElement.value = prefix + inputValue;
                                    }
                                });
                            </script>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="text" name="provinces" class="form-control" id="provincesInput" placeholder="จังหวัด *" required>
                            <script>
                                document.getElementById('provincesInput').addEventListener('blur', function() {
                                    var inputElement = this;
                                    var inputValue = inputElement.value.trim();
                                    var prefix = 'จ. ';

                                    // ตรวจสอบว่าข้อมูลที่กรอกเข้ามาไม่ใช่ค่าว่าง และยังไม่มีคำนำหน้า "จ." อยู่แล้ว
                                    if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                        inputElement.value = prefix + inputValue;
                                    }
                                });
                            </script>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <input type="number" name="zip_code" id="zip_code" class="form-control" placeholder="รหัสไปรษณีย์">
                            <script>
                                document.getElementById("zip_code").addEventListener("input", function() {
                                    let value = this.value;
                                    value = value.replace(/\D/g, '');
                                    this.value = value;
                                });
                            </script>
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
                        <input type="text" name="status_receipt" value="yes" hidden>
                        <input type="text" name="id_receipt" value="<?= $id_receipt ?>" hidden>
                        <input type="text" name="rec_date_out" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" name="rec_date_s" value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" name="payby" value="QR CODE" hidden>
                        <input type="text" name="rec_date_s" hidden>
                        <input type="text" name="other_description" hidden>
                        <input type="text" name="resDesc" hidden>
                        <input type="text" name="comment" hidden>
                        <input type="text" name="pdflink" hidden>
                        <input type="text" name="id_receipt" value="0" hidden>
                        <input type="text" name="ref1" value="0" hidden>
                        <input type="hidden" name="receipt_cc" value="confirm">
                    </div>
                    <button type="submit" class="form-control">ยืนยัน</button>
                    <?php
                    require_once('donateion_db.php');
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