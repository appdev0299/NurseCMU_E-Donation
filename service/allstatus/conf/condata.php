<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edonation";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT
    month,
    SUM(CASE WHEN edo_pro_id = 121205 THEN total_amount ELSE 0 END) as total_amount_121205,
    SUM(CASE WHEN edo_pro_id = 121206 THEN total_amount ELSE 0 END) as total_amount_121206,
    SUM(CASE WHEN edo_pro_id = 121207 THEN total_amount ELSE 0 END) as total_amount_121207,
    SUM(CASE WHEN edo_pro_id = 121208 THEN total_amount ELSE 0 END) as total_amount_121208
  FROM (
    SELECT
      DATE_FORMAT(rec_date_out, '%Y-%m') as month,
      edo_pro_id,
      SUM(amount) as total_amount
    FROM receipt_2566
    GROUP BY month, edo_pro_id
  ) as monthly_data
  GROUP BY month
  ORDER BY month;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ส่งผลลัพธ์เป็น JSON กลับไปยัง JavaScript
    header('Content-Type: application/json');
    echo json_encode($data);
} catch (PDOException $e) {
    // กรณีเกิดข้อผิดพลาด
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
