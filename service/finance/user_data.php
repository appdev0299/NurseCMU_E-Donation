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
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ชื่อ-สกุล</th>
                                                <th>ที่อยู่</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once 'conf/connection.php';
                                            $stmt = $conn->prepare("SELECT * FROM `user` WHERE `status_donat` = 'offline' AND `status_receipt` = 'yes' ORDER BY rec_name ASC;
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
                                                        <div class="d-flex align-items-center">
                                                            <?php
                                                            $profileImage = '';
                                                            switch ($t1['name_title']) {
                                                                case 'นาย':
                                                                    $profileImage = 'user-1.jpg';
                                                                    break;
                                                                case 'นาง':
                                                                    $profileImage = 'user-2.jpg';
                                                                    break;
                                                                case 'นางสาว':
                                                                    $profileImage = 'user-3.jpg';
                                                                    break;
                                                                default:
                                                                    $profileImage = 'user-4.jpg';
                                                                    break;
                                                            }
                                                            ?>
                                                            <img src="../assets/images/profile/<?= $profileImage ?>" class="rounded-circle" width="40" height="40">
                                                            <div class="ms-3">
                                                                <h6 class="fs-4 fw-semibold mb-0"><?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?></h6>
                                                            </div>
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <p class="mb-0 fw-normal"><?= $t1['address']; ?> <?= $t1['road']; ?> <?= $t1['districts']; ?> <?= $t1['amphures']; ?> <?= $t1['provinces']; ?> <?= $t1['zip_code']; ?></p>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown dropstart">
                                                            <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti ti-dots-vertical fs-6"></i>
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <!-- <li>
                                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i class="fs-4 ti ti-plus"></i>Add</a>
                                                                </li> -->
                                                                <a class="dropdown-item d-flex align-items-center gap-3" href="<?php echo ($t1['status_user'] == 'corporation') ? 'update_user_corporation.php?user_id=' . $t1['user_id'] : 'update_user_person.php?user_id=' . $t1['user_id']; ?>">
                                                                    <i class="fs-4 ti ti-edit"></i>อัพเดทข้อมูล
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
                                                <th>ชื่อ-สกุล</th>
                                                <th>ที่อยู่</th>
                                                <th>#</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script>
        function confirmcancel(user_id) {
            swal({
                title: "คำเตือน",
                text: "เมื่อคุณกด 'ยืนยันการลบข้อมูล' ระบบจะทำการลบข้อมูล และจะไม่สามารถนำกลับมาได้อีก",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "ยืนยันการลบข้อมูล",
                cancelButtonText: "เลิกทำ",
                closeOnConfirm: false
            }, function(isConfirm) {
                if (isConfirm) {
                    window.location = "del_user.php?user_id=" + user_id;
                }
            });
        }
    </script>

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