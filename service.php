<!doctype html>
<html lang="en">
<?php require_once('head.php'); ?>

<body>
    <?php require_once('header.php');
    require_once('nav.php'); ?>
    <main>
        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-12 text-center mx-auto">
                                <h5 class="mb-2">ของที่ระลึก</h5>
                                <p class="mb-2">รายการของที่ระลึงนี้เป็นสิทธิ์พิเศษและสงวนสำหรับผู้ที่ได้บริจาคตามเงื่อนไขที่คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่กำหนดขึ้นเท่านั้น บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ และ บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ โปรดติดต่อฝ่ายบริจาคหรือฝ่ายสนับสนุนเพื่อขอข้อมูลเพิ่มเติมสำหรับข้อสงสัยเกี่ยวกับการบริจาค</p>
                            </div>
                            <?php
                            require_once 'connection.php';
                            $stmt = $conn->prepare("SELECT * FROM `storage`");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            foreach ($result as $t1) {
                                $edoId = $t1['id'];
                                $imageURL = "images/causes" . $t1['img_file'];
                            ?>
                                <div class="col-lg-4 col-md-6 col-6 mb-4 mb-lg-0 mb-md-4">
                                    <div class="featured-block d-flex justify-content-center align-items-center">
                                        <a class="d-block">
                                            <img src="service/assets/images/souvenir/<?= $t1['img_file']; ?>" class="featured-block-image img-fluid" alt="">
                                            <h5 class="featured-block-text"><?= $t1['name']; ?></h5>
                                            <p>บริจาค <?= $t1['min']; ?> บาท ถึง <?= $t1['max']; ?> บาท</p>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-10 col-12 text-center mx-auto">
                        <h5 class="mb-2">เครื่องราชอิสริยาภรณ์อันเป็นที่สรรเสริญยิ่งดิเรกคุณาภรณ์</h5>
                        <p class="mb-2">เป็นเครื่องราชอิศริยาภรณ์ที่พระบาทสมเด็จพระบรมชนกาธิเบศรมหาภูมิพลอดุลยเดชมหาราช บรมนาถบพิตร พระราชทานพระบรมราชานุญาตให้สร้างขึ้นสำหรับพระราชทานแก่ผู้กระทำความดีความชอบอันเป็นประโยชน์ แก่ประเทศ ศาสนาและประชาชนตามที่ทรงพระราชดำริเห็นสมควรโดยแบ่งเป็น 7 ลำดับชั้นตราดังนี้</p>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a class="d-block">
                                <img src="images/service/right1.jpg" class="featured-block-image img-fluid" alt="">
                                <h5 class="featured-block-text">ชั้นที่ 1 ปฐมติเรกคุณาภรณ์</h5>
                                <p>บริจาค 30,000,000 บาทขั้นไป</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a class="d-block">
                                <img src="images/service/right2.jpg" class="featured-block-image img-fluid" alt="">
                                <h5 class="featured-block-text">ชั้นที่ 2 ทุติยดิเรกคุณภรณ์</h5>
                                <p>บริจาค 14,000,000 บาทขึ้นไป</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a class="d-block">
                                <img src="images/service/right3.jpg" class="featured-block-image img-fluid" alt="">
                                <h5 class="featured-block-text">ชั้นที่ 3 ตติยดิเรกคุณาภรณ์</h5>
                                <p>บริจาค 6,000,000 บาทขั้นไป</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a class="d-block">
                                <img src="images/service/right4.jpg" class="featured-block-image img-fluid" alt="">
                                <h5 class="featured-block-text">ชั้นที่ 4 จตุตถติเรกคุณาภรณ์</h5>
                                <p>บริจาค 1,500,000 บาทขั้นไป</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a class="d-block">
                                <img src="images/service/right5.jpg" class="featured-block-image img-fluid" alt="">
                                <h5 class="featured-block-text">ชั้นที่ 5 เบจมดิเรกคุณาภรณ์</h5>
                                <p>บริจาค 500,000 บาทขั้นไป</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0 mb-md-4">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a class="d-block">
                                <img src="images/service/right6.jpg" class="featured-block-image img-fluid" alt="">
                                <h5 class="featured-block-text">ชั้นที่ 6 เหรียญทองแดงดิเรกคุณาภรณ์</h5>
                                <p>บริจาค 200,000 บาทขั้นไป</p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0">
                        <div class="featured-block d-flex justify-content-center align-items-center">
                            <a class="d-block">
                                <img src="images/service/right7.jpg" class="featured-block-image img-fluid" alt="">
                                <h5 class="featured-block-text">ชั้นที่ 7 เหรียญเงินดิเรกคุณาภรณ์</h5>
                                <p>บริจาค 100,000 บาทขั้นไป</p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>



    </main>
    <?php require_once('footer.php'); ?>
</body>

</html>