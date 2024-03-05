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
                <a class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" href="storage_add.php">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3" />
                        <path d="M4 6v6c0 1.657 3.582 3 8 3c.856 0 1.68 -.05 2.454 -.144m5.546 -2.856v-6" />
                        <path d="M4 12v6c0 1.657 3.582 3 8 3c.171 0 .341 -.002 .51 -.006" />
                        <path d="M19 22v-6" />
                        <path d="M22 19l-3 -3l-3 3" />
                    </svg> แก้ไขข้อมูลคลังสินค้า</i>
                </a>
                <div class="row">
                    <?php
                    require_once 'conf/connection.php';
                    $stmt = $conn->prepare("SELECT * FROM `storage`");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $t1) {
                        $id = $t1['id'];
                        $imageURL = "../assets/images/souvenir/" . $t1['img_file'];
                    ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="../assets/images/souvenir/<?= $t1['img_file']; ?>" class="custom-block-image img-fluid" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $t1['name'] ?> (<?= $t1['items_set'] ?>)</h5>
                                    <p class="card-text">ตั้งแต่ <?= number_format($t1['min'], 2); ?> บาท ถึง <?= number_format($t1['max'], 2); ?> บาท </p>
                                    <h5 class="card-title">จำนวนคงเหลือ <?= $t1['items'] ?> ชิ้น</h5>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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