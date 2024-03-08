<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body class="theme_turquoise">

    <?php require_once('header.php');
    require_once('nav.php'); ?>
    <main>
        <section class="cta-section section-padding ">
            <div class="container-fluid">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/causes/poster_home1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/causes/poster_home2.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/causes/poster_home3.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/causes/poster_home4.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/causes/banner_tex2.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <section class="section-padding" id="section_2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center mb-4">
                        <h2>โครงการ</h2>
                    </div>
                    <?php
                    require_once 'connection.php';
                    $stmt = $conn->prepare("SELECT * FROM pro_offline");
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    foreach ($result as $t1) {
                        $edoId = $t1['id'];
                        $imageURL = "images/causes" . $t1['img_file'];
                    ?>
                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                            <div class="custom-block-wrap">
                                <img src="images/causes/<?= $t1['img_file']; ?>" class="custom-block-image img-fluid" alt="">
                                <div class="custom-block">
                                    <div class="custom-block-body" style="height: 200px;">
                                        <h5 class="mb-3"><?= $t1['edo_name']; ?></h5>
                                        <p><?= $t1['edo_tex']; ?></p>
                                    </div>
                                    <a href="donate_details?id=<?= $edoId; ?>" class="custom-btn btn">บริจาค</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- <section class="about-section section-padding" id="section_4">
            <div class="container">
                <center>
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <img src="images/causes/banner_web-03.jpg" class="custom-text-box-image img-fluid" alt="">
                    </div>
                </center>
            </div>
        </section> -->

    </main>
    <?php require_once('footer.php'); ?>
    <script src="js/main.js"></script>

</body>

</html>