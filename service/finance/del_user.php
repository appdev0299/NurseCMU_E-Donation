<?php
if (isset($_GET['user_id'])) {
    require_once 'conf/connection.php';
    $user_id = $_GET['user_id'];
    $stmt = $conn->prepare('DELETE FROM `user` WHERE user_id=:user_id');
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    //  sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->rowCount() == 1) {
        echo '<script>
        setTimeout(function() {
            swal({
                title: "ลบข้อมูลผู้ใช้งานสำเร็จ",
                type: "success",
                timer: 1000,
                showConfirmButton: false
            }, function() {
                window.location = "user_data";
            });
        }, 200);
        
        </script>';
    } else {
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลผู้ใช้งานไม่สำเร็จ",
                  type: "error"
              }, function() {
                  window.location = "user_data";
              });
            }, 200);
        </script>';
    }
    $conn = null;
} //isset
