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
                                <a class="btn btn-primary btn-circle btn-xl me-1 mb-3 mb-lg-3" href="#" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-playlist-add" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M19 8h-14" />
                                        <path d="M5 12h9" />
                                        <path d="M11 16h-6" />
                                        <path d="M15 16h6" />
                                        <path d="M18 13v6" />
                                    </svg>เพิ่ม</i>
                                </a>

                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">
                                                    เพิ่มของที่ระลึก</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?php
                                            require_once 'conf/connection.php';

                                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                                try {
                                                    $name = $_POST['name'];
                                                    $items = $_POST['items'];
                                                    $min = $_POST['min'];
                                                    $max = $_POST['max'];
                                                    $items_set = $_POST['items_set'];

                                                    // Check if the file input exists and has no errors
                                                    if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] === UPLOAD_ERR_OK) {
                                                        $image_file = $_FILES['img_file']['name'];
                                                        $type = $_FILES['img_file']['type'];
                                                        $size = $_FILES['img_file']['size'];
                                                        $temp = $_FILES['img_file']['tmp_name'];

                                                        $path = "../assets/images/souvenir/" . $image_file;

                                                        if (empty($name) || empty($items) || empty($min) || empty($max) || empty($items_set) || empty($image_file)) {
                                                            $errorMsg = "Please fill in all fields";
                                                        } elseif (!in_array($type, ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'])) {
                                                            echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>';
                                                            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>';
                                                            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
                                                            echo '<script>
                                                                $(document).ready(function() {
                                                                    swal({
                                                                        title: "อัปโหลดรูปแบบไฟล์ JPG, JPEG, PNG และ GIF เท่านั้น", 
                                                                        text: "กรุณารอสักครู่",
                                                                        type: "error", 
                                                                        timer: 2000, 
                                                                        showConfirmButton: false 
                                                                    }, function(){
                                                                        window.location.href = "storage_add"; 
                                                                    });
                                                                });
                                                            </script>';
                                                        } elseif ($size > 5000000) {
                                                            echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>';
                                                            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>';
                                                            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
                                                            echo '<script>
                                                                $(document).ready(function() {
                                                                    swal({
                                                                        title: "ไฟล์ต้องไม่ขนากไม่เกิน 5 MB", 
                                                                        text: "กรุณารอสักครู่",
                                                                        type: "error", 
                                                                        timer: 2000, 
                                                                        showConfirmButton: false 
                                                                    }, function(){
                                                                        window.location.href = "storage_add"; 
                                                                    });
                                                                });
                                                            </script>';
                                                        } elseif (file_exists($path)) {
                                                            echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>';
                                                            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>';
                                                            echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
                                                            echo '<script>
                                                                $(document).ready(function() {
                                                                    swal({
                                                                        title: "มีไฟล์รูปอยู่แล้ว ตรวจสอบชื่อไฟล์ให้ไม่ช้ำกัน", 
                                                                        text: "กรุณารอสักครู่",
                                                                        type: "error", 
                                                                        timer: 2000, 
                                                                        showConfirmButton: false 
                                                                    }, function(){
                                                                        window.location.href = "storage_add"; 
                                                                    });
                                                                });
                                                            </script>';
                                                        } else {
                                                            move_uploaded_file($temp, '../assets/images/souvenir/' . $image_file);

                                                            $insert_stmt = $conn->prepare('INSERT INTO `storage` (name, items, min, max, items_set, img_file, dateCreate) VALUES (:name, :items, :min, :max, :items_set, :img_file, :dateCreate)');
                                                            $insert_stmt->bindParam(':name', $name);
                                                            $insert_stmt->bindParam(':items', $items);
                                                            $insert_stmt->bindParam(':min', $min);
                                                            $insert_stmt->bindParam(':max', $max);
                                                            $insert_stmt->bindParam(':items_set', $items_set);
                                                            $insert_stmt->bindParam(':img_file', $image_file);
                                                            $insert_stmt->bindParam(':dateCreate', date('Y-m-d H:i:s'));

                                                            if ($insert_stmt->execute()) {
                                                                echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>';
                                                                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>';
                                                                echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
                                                                echo '<script>
                                                                    $(document).ready(function() {
                                                                        swal({
                                                                            title: "บันทึกข้อมูลสินค้าสำเร็จ", 
                                                                            text: "กรุณารอสักครู่",
                                                                            type: "success", 
                                                                            timer: 2000, 
                                                                            showConfirmButton: false 
                                                                        }, function(){
                                                                            window.location.href = "storage_add"; 
                                                                        });
                                                                    });
                                                                </script>';
                                                            } else {
                                                                echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>';
                                                                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>';
                                                                echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
                                                                echo '<script>
                                                                    $(document).ready(function() {
                                                                        swal({
                                                                            title: "บันทึกข้อมูลสินค้าไม่สำเร็จ", 
                                                                            text: "กรุณารอสักครู่",
                                                                            type: "error", 
                                                                            timer: 2000, 
                                                                            showConfirmButton: false 
                                                                        }, function(){
                                                                            window.location.href = "storage_add"; 
                                                                        });
                                                                    });
                                                                </script>';
                                                            }
                                                        }
                                                    } else {
                                                        $errorMsg = "Please select a valid file";
                                                    }
                                                } catch (PDOException $e) {
                                                    $errorMsg = "Error: " . $e->getMessage();
                                                }
                                            }
                                            ?>
                                            <div class="card-body">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">ชื่อของที่ระลึง</label>
                                                                <input type="text" id="name" class="form-control" name="name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="items" class="form-label">จำนวนคงเหลือ</label>
                                                                <input type="text" id="items" class="form-control" name="items">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="min" class="form-label">บริจาค
                                                                    เริ่มต้น</label>
                                                                <input type="number" id="min" class="form-control" name="min">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="max" class="form-label">บริจาค
                                                                    มากสุด</label>
                                                                <input type="number" id="max" class="form-control" name="max">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="items_set" class="form-label">ตัวย่อสินค้า</label>
                                                                <input type="text" id="items_set" class="form-control" name="items_set" maxlength="2" readonly>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            function generateRandomString() {
                                                                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                                                const numbers = '0123456789';
                                                                const randomLetter = characters.charAt(Math.floor(Math.random() * characters.length));
                                                                const randomNumber = numbers.charAt(Math.floor(Math.random() * numbers.length));
                                                                return randomLetter + randomNumber;
                                                            }
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const itemsSetInput = document.getElementById('items_set');
                                                                itemsSetInput.value = generateRandomString();
                                                            });
                                                        </script>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="img_file" class="form-label">รูปภาพ</label>
                                                                <input type="file" id="img_file" class="form-control" name="img_file">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="d-md-flex align-items-center">
                                                                <div class="ms-auto mt-3 mt-md-0">
                                                                    <button type="submit" class="btn btn-primary font-medium rounded-pill px-4">
                                                                        <div class="d-flex align-items-center">
                                                                            บันทึกการอัพเดท
                                                                        </div>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ</th>
                                            <th>จำนวน</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once 'conf/connection.php';
                                        $stmt = $conn->prepare("SELECT * FROM `storage`;
                                            ");
                                        $stmt->execute();
                                        $result = $stmt->fetchAll();
                                        $countrow = 1;
                                        foreach ($result as $t1) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <h6 class="fw-semibold mb-0"><?= $countrow ?></h6>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal"><?= $t1['name']; ?></p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal"><?= $t1['items']; ?></p>
                                                </td>
                                                <td>
                                                    <div class="dropdown dropstart">
                                                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical fs-6"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item d-flex align-items-center gap-3 details-link" href="#" data-bs-toggle="modal" data-bs-target="#transferModal<?= $t1['id']; ?>" data-receipt-id="<?= $t1['id']; ?>">
                                                                <i class="fs-4 ti ti-edit"></i>อัพเดทสต๊อก
                                                            </a>
                                                            <li>
                                                                <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0);" onclick="confirmcancel('<?= $t1['user_id']; ?>')"><i class="fs-4 ti ti-trash"></i>ลบข้อมูล</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $countrow++;
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อ</th>
                                            <th>จำนวน</th>
                                            <th>#</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php foreach ($result as $t1) { ?>
                                    <div class="modal fade" id="transferModal<?= $t1['id']; ?>" tabindex="-1" aria-labelledby="transferModalLabel<?= $t1['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="transferModalLabel<?= $t1['id']; ?>">
                                                        อัพเดทสต๊อก</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="card-body">
                                                    <form id="formadd" method="post" onsubmit="return confirmBeforeSubmit()">
                                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                                            <div class=" d-flex align-items-center justify-content-center" style="width: 210px; height: 210px;">
                                                                <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 200px; height: 200px;">
                                                                    <img src="../assets/images/souvenir/<?= $t1['img_file']; ?>" class="custom-block-image img-fluid" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">ชื่อของที่ระลึง</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="<?= $t1['name']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="items" class="form-label">จำนวนคงเหลือ</label>
                                                                    <input type="number" class="form-control" id="items" name="items" value="<?= $t1['items']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="min" class="form-label">บริจาค เริ่มต้น</label>
                                                                    <input type="number" class="form-control" id="min" name="min" value="<?= $t1['min']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="max" class="form-label">บริจาค มากสุด</label>
                                                                    <input type="number" class="form-control" id="max" name="max" value="<?= $t1['max']; ?>">
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="items_set" id="items_set" value="<?= $t1['items_set']; ?>">
                                                            <input type="hidden" name="img_file" id="img_file" value="<?= $t1['img_file']; ?>">
                                                            <input type="hidden" name="dateCreate" id="dateCreate" value="<?= date('Y-m-d H:i:s'); ?>">
                                                            <input type="hidden" name="id" id="id" value="<?= $t1['id']; ?>">

                                                            <div class="col-12">
                                                                <div class="d-md-flex align-items-center">
                                                                    <div class="ms-auto mt-3 mt-md-0">
                                                                        <button type="button" class="btn btn-primary font-medium rounded-pill px-4" onclick="confirmBeforeSubmit()">
                                                                            <div class="d-flex align-items-center">
                                                                                บันทึกการอัพเดท
                                                                            </div>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js">
                                                    </script>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

                                                    <script>
                                                        function confirmBeforeSubmit() {
                                                            swal({
                                                                    title: "คำเตือน",
                                                                    text: "คุณแน่ใจที่จะบันทึกการอัพเดทหรือไม่?",
                                                                    type: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#5d87ff",
                                                                    confirmButtonText: "ยืนยันการ",
                                                                    cancelButtonText: "เลิกทำ",
                                                                    closeOnConfirm: false
                                                                },
                                                                function(isConfirm) {
                                                                    if (isConfirm) {
                                                                        // Perform AJAX request to update data
                                                                        updateData();
                                                                    }
                                                                });
                                                        }

                                                        function updateData() {
                                                            // Extract data from the form
                                                            var formData = $("#formadd").serialize();
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "store_add.php",
                                                                data: formData,
                                                                dataType: "json",
                                                                success: function(response) {
                                                                    if (response.status === "success") {
                                                                        swal("สำเร็จ!",
                                                                            "บันทึกการอัพเดทเรียบร้อยแล้ว",
                                                                            "success");
                                                                    } else {
                                                                        swal("ผิดพลาด!",
                                                                            "เกิดข้อผิดพลาดในการอัพเดท: " +
                                                                            response.message, "error");
                                                                    }
                                                                },
                                                                error: function() {
                                                                    swal("ผิดพลาด!", "เกิดข้อผิดพลาดในการส่งคำขอ",
                                                                        "error");
                                                                }
                                                            });
                                                        }
                                                    </script>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>