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
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="text-center">
                                                    <a class="nav-link nav-icon-hover">
                                                        <?php
                                                        $firstname_EN = $loginInfo['firstname_EN'];
                                                        $imageFileName = "../assets/images/profile/" . $firstname_EN . ".jpg";
                                                        if (file_exists($imageFileName)) {
                                                            echo '<img src="' . $imageFileName . '" alt width="300" height="300" class="rounded-circle">';
                                                        } else {
                                                            echo '<img src="../assets/images/profile/default.jpg" alt width="300" height="300" class="rounded-circle">';
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                                <br>
                                                <hr>
                                                <br>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">ชื่อ-สกุล</label>
                                                        <input type="text" class="form-control" value="<?php echo $loginInfo['prename_id'] . " " . $loginInfo['firstname_EN'] . " " . $loginInfo['lastname_EN'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">หน่วยงาน</label>
                                                        <input type="text" class="form-control" value="<?php echo $loginInfo['organization_name_EN']  ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="rec_email" class="form-label">อีเมล์</label>
                                                        <input type="text" class="form-control" value="<?php echo $loginInfo['cmuitaccount'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">สถานะ</label>
                                                        <input type="text" class="form-control" value="<?php echo $loginInfo['itaccounttype_EN']  ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">#</label>
                                                        <input type="text" class="form-control" value="<?php echo $loginInfo['organization_code']  ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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