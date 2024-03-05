<!doctype html>
<html lang="en">
<?php
include('login_info.php');
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
                                <h5 class="card-title fw-semibold mb-4">ออกใบเสร็จรับเงิน สำหรับ นิติบุคคล/บริษัท</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" id="edoForm" onsubmit="return disableSaveButton()">
                                            <div class="mb-3">
                                                <h6 class="form-label">กรอกข้อมูลผู้บริจาค</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <div id="reg_urse" class="form-group">
                                                            <?php
                                                            require_once 'conf/connection.php';
                                                            $query = "SELECT name_title, rec_name, rec_surname, rec_tel, rec_email, rec_idname, address, road, districts, amphures, provinces, zip_code 
                                                                    FROM user 
                                                                    WHERE status_donat = 'offline' AND status_user = 'corporation'
                                                                    ORDER BY rec_name ASC";

                                                            $result = $conn->query($query);
                                                            ?>
                                                            <select class="form-control" id="userDropdown">
                                                                <option value="">รายชื่อผู้บริจาค</option>
                                                                <?php
                                                                foreach ($result as $row) {
                                                                    echo '<option value="' . $row["rec_name"] . '" 
                                                                                data-name-title="' . $row["name_title"] . '" 
                                                                                data-rec-name="' . $row["rec_name"] . '" 
                                                                                data-rec-surname="' . $row["rec_surname"] . '" 
                                                                                data-rec-idname="' . $row["rec_idname"] . '" 
                                                                                data-rec-tel="' . $row["rec_tel"] . '" 
                                                                                data-rec-email="' . $row["rec_email"] . '" 
                                                                                data-address="' . $row["address"] . '" 
                                                                                data-road="' . $row["road"] . '" 
                                                                                data-districts="' . $row["districts"] . '" 
                                                                                data-amphures="' . $row["amphures"] . '" 
                                                                                data-provinces="' . $row["provinces"] . '" 
                                                                                data-zip-code="' . $row["zip_code"] . '">
                                                                            ' . $row["rec_name"] . ' ' . $row["rec_surname"] . ' ' . $row["address"] . ' ' . $row["road"] . ' ' . $row["districts"] . ' ' . $row["amphures"] . ' ' . $row["provinces"] . ' ' . $row["zip_code"] . '
                                                                        </option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    document.getElementById('userDropdown').addEventListener('change', function() {
                                                        var selectedOption = this.options[this.selectedIndex];
                                                        console.log(selectedOption.dataset);

                                                        if (selectedOption) {
                                                            document.getElementById('selectedName').value = selectedOption.dataset.recName;
                                                            document.getElementById('selectedIdName').value = selectedOption.dataset.recIdname;
                                                            document.getElementById('selectedTel').value = selectedOption.dataset.recTel;
                                                            document.getElementById('selectedEmail').value = selectedOption.dataset.recEmail;
                                                            document.getElementById('selectedAddress').value = selectedOption.dataset.address;
                                                            document.getElementById('selectedRoad').value = selectedOption.dataset.road;
                                                            document.getElementById('provincesInput').value = selectedOption.dataset.provinces;
                                                            document.getElementById('amphuresInput').value = selectedOption.dataset.amphures;
                                                            document.getElementById('districtsInput').value = selectedOption.dataset.districts;
                                                            document.getElementById('selectedZipCode').value = selectedOption.dataset.zipCode;
                                                        }
                                                    });
                                                </script>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_name" class="form-label">นิติบุคลล/บริษัท</label>
                                                        <input type="text" name="rec_name" class="form-control" id="selectedName" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_idname" class="form-label">เลขประจำตัวผู้เสียภาษี</label>
                                                        <input type="text" name="rec_idname" class="form-control" id="selectedIdName" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_tel" class="form-label">เบอร์โทรศัพท์</label>
                                                        <input type="number" name="rec_tel" class="form-control" pattern="[0-9]*" id="selectedTel">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_email" class="form-label">อีเมล์</label>
                                                        <input type="text" name="rec_email" class="form-control" id="selectedEmail">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">ที่อยู่</label>
                                                        <input type="text" name="address" class="form-control" id="selectedAddress">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="road" class="form-label">ถนน</label>
                                                        <input type="text" name="road" class="form-control" id="selectedRoad">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="provinces" class="form-label">จังหวัด</label>
                                                        <input type="text" name="provinces" class="form-control" id="provincesInput">
                                                        <script>
                                                            document.getElementById('provincesInput').addEventListener('blur', function() {
                                                                var inputElement = this;
                                                                var inputValue = inputElement.value.trim();
                                                                var prefix = 'จ. ';
                                                                if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                                                    inputElement.value = prefix + inputValue;
                                                                }
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="amphures" class="form-label">อำเภอ</label>
                                                        <input type="text" name="amphures" id="amphuresInput" class="form-control">
                                                        <script>
                                                            document.getElementById('amphuresInput').addEventListener('blur', function() {
                                                                var inputElement = this;
                                                                var inputValue = inputElement.value.trim();
                                                                var prefix = 'อ. ';
                                                                if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                                                    inputElement.value = prefix + inputValue;
                                                                }
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="districts" class="form-label">ตำบล</label>
                                                        <input type="text" name="districts" id="districtsInput" class="form-control">
                                                        <script>
                                                            document.getElementById('districtsInput').addEventListener('blur', function() {
                                                                var inputElement = this;
                                                                var inputValue = inputElement.value.trim();
                                                                var prefix = 'ต. ';
                                                                if (inputValue !== '' && !inputValue.startsWith(prefix)) {
                                                                    inputElement.value = prefix + inputValue;
                                                                }
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="zip_code" class="form-label">รหัสไปรษณีย์</label>
                                                        <input type="text" name="zip_code" class="form-control" id="selectedZipCode">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_date_s" class="form-label">วันที่รับเงิน</label>
                                                        <input type="date" name="rec_date_s" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_date_out" class="form-label">วันที่ออกใบเสร็จ</label>
                                                        <input type="date" name="rec_date_out" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="amount" class="form-label">จำนวนเงินที่บริจาค</label>
                                                        <input type="text" name="amount" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="payby" class="form-label">ชำระโดย</label>
                                                        <input type="text" name="payby" class="form-control" list="pay" required>
                                                        <datalist id="pay">
                                                            <option value="เงินสด / Cash" />
                                                            <option value="โอน / Prompt Pay" />
                                                            <option value="เช็ค / Cheque" />
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="comment" class="form-label">หมายเหตุ</label>
                                                        <input type="text" name="comment" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="edo_name" class="form-label">โครงการ</label>
                                                        <select name="edo_name" id="edo_name" class="form-control" required>
                                                            <option value="">เลือกโครงการ</option>
                                                            <?php
                                                            require_once 'conf/connection.php';

                                                            try {
                                                                $query = "SELECT edo_name, edo_pro_id, edo_description, edo_objective FROM pro_offline";
                                                                $result = $conn->query($query);
                                                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                                                    echo "<option value='" . $row['edo_name'] . "' data-pro-id='" . $row['edo_pro_id'] . "' data-description='" . $row['edo_description'] . "' data-objective='" . $row['edo_objective'] . "'>" . $row['edo_name'] . "</option>";
                                                                }
                                                            } catch (PDOException $e) {
                                                                echo "Query failed: " . $e->getMessage();
                                                            }
                                                            ?>
                                                            <option value="">อื่นๆ</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3" id="otherFields" style="display: none;">
                                                        <label for="other_description" class="form-label">โครงการอื่นๆ</label>
                                                        <input type="text" name="other_description" class="form-control" placeholder="โปรดระบุชื่อโครงการ">
                                                    </div>
                                                </div>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var edoNameSelect = document.getElementById('edo_name');
                                                        var edoProIdInput = document.getElementsByName('edo_pro_id')[0];
                                                        var descriptionInput = document.getElementById('edo_description');
                                                        var objectiveInput = document.getElementById('edo_objective');
                                                        var otherDescriptionInput = document.getElementsByName('other_description')[0];
                                                        var otherFieldsDiv = document.getElementById('otherFields');

                                                        edoNameSelect.addEventListener('change', function() {
                                                            var selectedOption = edoNameSelect.options[edoNameSelect.selectedIndex];

                                                            descriptionInput.value = selectedOption.getAttribute('data-description');

                                                            if (selectedOption.value === '') {
                                                                otherFieldsDiv.style.display = 'block';
                                                                edoProIdInput.value = '121208';
                                                                objectiveInput.value = otherDescriptionInput.value; // รับค่าจาก otherDescriptionInput
                                                            } else {
                                                                otherFieldsDiv.style.display = 'none';
                                                                edoProIdInput.value = selectedOption.getAttribute('data-pro-id');
                                                                objectiveInput.value = selectedOption.getAttribute('data-objective');
                                                            }
                                                        });

                                                        otherDescriptionInput.addEventListener('input', function() {
                                                            descriptionInput.value = otherDescriptionInput.value;
                                                            objectiveInput.value = otherDescriptionInput.value;
                                                        });
                                                    });
                                                </script>
                                                <style>
                                                    input:required:invalid {
                                                        border: 1px solid red;
                                                    }

                                                    select:required:invalid {
                                                        border: 1px solid red;
                                                    }
                                                </style>
                                                <input type="hidden" name="name_title">
                                                <input type="hidden" name="rec_surname">
                                                <input type="hidden" name="status_donat" value="offline">
                                                <input type="hidden" name="status_user" value="corporation">
                                                <input type="hidden" name="status_receipt" value="yes">
                                                <input type="hidden" name="resDesc" value="success">
                                                <input type="hidden" name="ref1" value="0">
                                                <input type="hidden" name="id_receipt" value="0">
                                                <input type="hidden" name="pdflink" value="https://app.nurse.cmu.ac.th/edonation/service/finance/invoice_confirm.php?id=id&ACTION=VIEW">
                                                <input type="hidden" name="receipt_cc" value="confirm">
                                                <input type="hidden" name="edo_pro_id" id="edo_pro_id">
                                                <input type="hidden" name="edo_description" id="edo_description">
                                                <input type="hidden" name="edo_objective" id="edo_objective">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="saveButton">ยืนยันการกรอกข้อมูล</button>
                                            <script>
                                                function disableSaveButton() {
                                                    document.getElementById("saveButton").innerHTML = "กรุณารอสักครู่ ระบบกำลังจัดส่ง email ไปยังผู้บริจาาค";
                                                    document.getElementById("saveButton").disabled = true;
                                                    setTimeout(function() {
                                                        document.getElementById("saveButton").innerHTML = "ยืนยันการออกใบเสร็จ(บุคคล)";
                                                        document.getElementById("saveButton").disabled = false;
                                                    }, 5000);

                                                    return true;
                                                }
                                            </script>
                                        </form>
                                        <?php
                                        require_once 'invoice_add_all.php';
                                        require_once 'invoice_user_add.php';
                                        // echo '<pre>';
                                        // print_r($_POST);
                                        // echo '</pre>';
                                        ?>
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