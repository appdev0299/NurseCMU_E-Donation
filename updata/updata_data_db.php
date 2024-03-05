<?php
require_once 'connection.php';

if (
    isset($_POST['edo_tex'])
    && isset($_POST['edo_pro_id'])
    && isset($_POST['edo_name'])
    && isset($_POST['edo_description'])
    && isset($_POST['edo_objective'])
    && isset($_POST['edo_details_objective1'])
    && isset($_POST['edo_details_objective2'])
    && isset($_POST['edo_details_objective3'])
    && isset($_POST['edo_details_objective4'])
    && isset($_POST['edo_details'])
    && isset($_POST['dateCreate'])
) {
    $edo_tex = $_POST['edo_tex'];
    $edo_pro_id = $_POST['edo_pro_id'];
    $edo_name = $_POST['edo_name'];
    $edo_description = $_POST['edo_description'];
    $edo_objective = $_POST['edo_objective'];
    $edo_details_objective1 = $_POST['edo_details_objective1'];
    $edo_details_objective2 = $_POST['edo_details_objective2'];
    $edo_details_objective3 = $_POST['edo_details_objective3'];
    $edo_details_objective4 = $_POST['edo_details_objective4'];
    $edo_details = $_POST['edo_details'];
    $dateCreate = $_POST['dateCreate'];

    $stmt = $conn->prepare(
        "UPDATE pro_offline SET
        edo_tex = :edo_tex,
        edo_pro_id = :edo_pro_id,
        edo_name = :edo_name,
        edo_description = :edo_description,
        edo_objective = :edo_objective,
        edo_details_objective1 = :edo_details_objective1,
        edo_details_objective2 = :edo_details_objective2,
        edo_details_objective3 = :edo_details_objective3,
        edo_details_objective4 = :edo_details_objective4,
        edo_details = :edo_details,
        dateCreate = :dateCreate,
        img_file = :img_file,
        img_banner = :img_banner
        WHERE id = :id"
    );

    $stmt->bindParam(':edo_tex', $edo_tex, PDO::PARAM_STR);
    $stmt->bindParam(':edo_pro_id', $edo_pro_id, PDO::PARAM_STR);
    $stmt->bindParam(':edo_name', $edo_name, PDO::PARAM_STR);
    $stmt->bindParam(':edo_description', $edo_description, PDO::PARAM_STR);
    $stmt->bindParam(':edo_objective', $edo_objective, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective1', $edo_details_objective1, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective2', $edo_details_objective2, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective3', $edo_details_objective3, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details_objective4', $edo_details_objective4, PDO::PARAM_STR);
    $stmt->bindParam(':edo_details', $edo_details, PDO::PARAM_STR);
    $stmt->bindParam(':dateCreate', $dateCreate, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':img_file', $img_file_path, PDO::PARAM_STR);
    $stmt->bindParam(':img_banner', $img_banner_path, PDO::PARAM_STR);

    if (isset($_FILES['img_file']) && isset($_FILES['img_banner'])) {
        $img_file = $_FILES['img_file'];
        $img_banner = $_FILES['img_banner'];

        if ($img_file['error'] === UPLOAD_ERR_OK && $img_banner['error'] === UPLOAD_ERR_OK) {
            $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($img_file['type'], $allowed_image_types) && in_array($img_banner['type'], $allowed_image_types)) {
                $img_file_path = '../images/causes/' . $img_file['name'];
                $img_banner_path = '../images/causes/' . $img_banner['name'];

                if (move_uploaded_file($img_file['tmp_name'], $img_file_path) && move_uploaded_file($img_banner['tmp_name'], $img_banner_path)) {
                    $stmt->bindParam(':img_file', $img_file_path, PDO::PARAM_STR);
                    $stmt->bindParam(':img_banner', $img_banner_path, PDO::PARAM_STR);
                } else {
                    // แจ้งเตือนเมื่อเกิดข้อผิดพลาดในการอัปโหลดรูปภาพ
                    echo '
                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
                    <script>
                        swal({
                            title: "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ",
                            text: "โปรดแนบรูปภาพที่ถูกต้อง",
                            type: "error"
                        });
                    </script>';
                    exit();
                }
            } else {
                // แจ้งเตือนเมื่อประเภทของไฟล์ไม่ถูกต้อง
                echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
                <script>
                    swal({
                        title: "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ",
                        text: "โปรดแนบรูปภาพในรูปแบบ JPEG, PNG หรือ GIF เท่านั้น",
                        type: "error"
                    });
                </script>';
                exit();
            }
        } else {
            echo '
            <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
            <script>
                swal({
                    title: "เกิดข้อผิดพลาดในการอัปโหลดไฟล์",
                    text: "โปรดตรวจสอบไฟล์และลองใหม่อีกครั้ง",
                    type: "error"
                });
            </script>';
            exit();
        }
    }

    $result = $stmt->execute();

    if ($result) {
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
        <script>
            swal({
                title: "อัปเดตข้อมูลสำเร็จ",
                text: "",
                type: "success"
            }, function() {
                window.location = "updata_data.php";
            });
        </script>';
        exit();
    } else {
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> 
        <script>
            swal({
                title: "เกิดข้อผิดพลาดในการอัปเดตข้อมูล",
                text: "ไม่สามารถอัปเดตข้อมูลได้",
                type: "error"
            }, function() {
                window.location = "updata_data.php";
            });
        </script>';
    }
} else {
    echo "ข้อมูลไม่ครบถ้วน";
}
