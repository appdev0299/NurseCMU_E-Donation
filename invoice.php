<!DOCTYPE html>
<html lang="en">

<?php require_once('head.php'); ?>
<?php require_once('header.php'); ?>

<body>

    <?php require_once('nav.php'); ?>

    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12 mx-auto">
                        <form class="custom-form donate-form" action="#" method="POST" role="form">
                            <table id="myTable" class="display" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>โครงการ</th>
                                        <th>รายละเอียดใบเสร็จ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once 'connection.php';
                                    $stmt = $conn->prepare("SELECT * FROM receipt WHERE status_donat = 'online' AND status_receipt = 'yes' AND resDesc = 'success'AND receipt_cc = 'confirm'");
                                    $stmt->execute();
                                    $result = $stmt->fetchAll();
                                    $result = array_reverse($result);
                                    $countrow = 1;
                                    foreach ($result as $t1) {
                                    ?>
                                        <tr>
                                            <td><?= $countrow ?></td>
                                            <td>
                                                <?= $t1['name_title']; ?> <?= $t1['rec_name']; ?> <?= $t1['rec_surname']; ?>
                                                <br>
                                                <span style="color: orange;"><?= thai_date($t1['rec_date_out']); ?></span> /
                                                <span style="color: orange;">E<?= str_pad($t1['receipt_id'], 4, '0', STR_PAD_LEFT); ?></span>
                                            </td>
                                            <td><?= $t1['edo_name']; ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-icon btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="javascript:void(0);" onclick="confirmPassword('<?= $t1['receipt_id']; ?>')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                                                        <path fill="currentColor" d="M3.5 8H3V7h.5a.5.5 0 0 1 0 1ZM7 10V7h.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H7Z" />
                                                        <path fill="currentColor" fill-rule="evenodd" d="M1 1.5A1.5 1.5 0 0 1 2.5 0h8.207L14 3.293V13.5a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 1 13.5v-12ZM3.5 6H2v5h1V9h.5a1.5 1.5 0 1 0 0-3Zm4 0H6v5h1.5A1.5 1.5 0 0 0 9 9.5v-2A1.5 1.5 0 0 0 7.5 6Zm2.5 5V6h3v1h-2v1h1v1h-1v2h-1Z" clip-rule="evenodd" />
                                                    </svg> <span class="btn-inner"></span>
                                                </a>
                                                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                <script>
                                                    async function confirmPassword(receipt_id) {
                                                        const {
                                                            value: password
                                                        } = await Swal.fire({
                                                            title: 'กรุณาใส่หมายเลขบัตรประชาชน',
                                                            input: 'password',
                                                            inputPlaceholder: 'หมายเลขบัตรประชาชน',
                                                            inputAttributes: {
                                                                maxlength: 13,
                                                                autocapitalize: 'off',
                                                                autocorrect: 'off',
                                                            },
                                                            showCancelButton: true,
                                                            confirmButtonText: 'ตกลง',
                                                            cancelButtonText: 'ยกเลิก',
                                                            allowOutsideClick: false,
                                                            inputValidator: (value) => {
                                                                if (!value) {
                                                                    return 'กรุณากรอกเลขบัตรประชาชน';
                                                                }
                                                            },
                                                        });

                                                        const data = {
                                                            password,
                                                            receipt_id,
                                                        };

                                                        fetch('check_password.php', {
                                                                method: 'POST',
                                                                headers: {
                                                                    'Content-Type': 'application/json',
                                                                },
                                                                body: JSON.stringify(data),
                                                            })
                                                            .then(response => response.json())
                                                            .then(result => {
                                                                if (result.success) {
                                                                    Swal.fire('Success', result.message, 'success');
                                                                    window.location.href = result.pdfUrl;
                                                                } else {
                                                                    Swal.fire('Error', result.message, 'error');
                                                                }
                                                            });

                                                    }
                                                </script>
                                            </td>

                                        </tr>
                                    <?php $countrow++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <?php
                function thai_date($date)
                {
                    $months = [
                        'ม.ค', 'ก.พ', 'มี.ค', 'เม.ย', 'พ.ค', 'มิ.ย',
                        'ก.ค', 'ส.ค', 'ก.ย', 'ต.ค', 'พ.ย', 'ธ.ค'
                    ];

                    $timestamp = strtotime($date);
                    $thai_year = date(' Y', $timestamp) + 543;
                    $thai_date = date('j ', $timestamp) . $months[date('n', $timestamp) - 1] . ' ' . $thai_year;

                    return $thai_date;
                }

                ?>
            </div>
        </section>
    </main>
    <?php require_once('footer.php'); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
<script>
    $(document).ready(function() {
        $("#myTable").DataTable();
    });
</script>

</html>