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
                                <h5 class="card-title fw-semibold mb-4">อัพเดทข้อมูล นิติบุคลล/บริษัท</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <?php
                                        if (isset($_GET['user_id'])) {
                                            require_once 'conf/connection.php';
                                            $stmt = $conn->prepare("SELECT * FROM `user` WHERE user_id=?");
                                            $stmt->execute([$_GET['user_id']]);
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        }
                                        ?>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="rec_name" class="form-label">นิติบุคลล/บริษัท</label>
                                                        <input type="text" name="rec_name" class="form-control" value="<?= $row['rec_name']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="rec_idname" class="form-label">เลขประจำตัวประชาชน/เลขประจำตัวผู้เสียภาษี</label>
                                                        <input type="text" name="rec_idname" id="rec_idname" value="<?= $row['rec_idname']; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_tel" class="form-label">เบอร์โทรศัพท์</label>
                                                        <input type="number" name="rec_tel" class="form-control" pattern="[0-9]*" value="<?= $row['rec_tel']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="rec_email" class="form-label">อีเมล์</label>
                                                        <input type="text" name="rec_email" class="form-control" value="<?= $row['rec_email']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">ที่อยู่</label>
                                                        <input type="text" name="address" class="form-control" value="<?= $row['address']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="road" class="form-label">ถนน</label>
                                                        <input type="text" name="road" class="form-control" value="<?= $row['road']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="provinces" class="form-label">จังหวัด</label>
                                                        <input type="text" name="provinces" class="form-control" value="<?= $row['provinces']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="amphures" class="form-label">อำเภอ</label>
                                                        <input type="text" name="amphures" class="form-control" value="<?= $row['amphures']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="districts" class="form-label">ตำบล</label>
                                                        <input type="text" name="districts" class="form-control" value="<?= $row['districts']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label for="zip_code" class="form-label">รหัสไปรษณีย์</label>
                                                        <input type="text" name="zip_code" class="form-control" value="<?= $row['zip_code']; ?>">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                                                <input type="hidden" name="name_title" value="<?= $row['name_title']; ?>">
                                                <input type="hidden" name="rec_surname" value="<?= $row['rec_surname']; ?>">
                                                <input type="hidden" name="status_donat" value="<?= $row['status_donat']; ?>">
                                                <input type="hidden" name="status_user" value="<?= $row['status_user']; ?>">
                                                <input type="hidden" name="status_receipt" value="<?= $row['status_receipt']; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary">อัพเดทข้อมูล</button>
                                        </form>
                                        <?php
                                        require_once 'update_user_add.php';
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