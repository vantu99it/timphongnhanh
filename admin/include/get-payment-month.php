<?php
  include '../include/connect.php';

   if(isset($_POST['year'])){
      $year = $_POST['year'];

    }else {
      $year = date('Y');;
    }
  // Thực thi câu truy vấn
  $sql = "SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, SUM(COALESCE(pay_price, 0)) AS total_amount FROM tbl_payment_history WHERE created_at BETWEEN '{$year}-01-01 00:00:00' AND '{$year}-12-31 23:59:59' GROUP BY month;";
  $stmt = $conn->query($sql);

  // Tạo mảng dữ liệu
  $data = array();
  $months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $item = array(
          "month" => $row["month"],
          "total_amount" => $row["total_amount"],
      );
      array_push($data, $item);
      $index = array_search(substr($row['month'], -2), $months);
      if ($index !== false) {
          unset($months[$index]);
      }
  }

  foreach ($months as $month) {
      $item = array(
          "month" => $year . '-' . $month,
          "total_amount" => 0,
      );
      array_push($data, $item);
  }

  // Sắp xếp lại mảng dữ liệu theo tháng
  usort($data, function ($a, $b) {
      return strcmp($a["month"], $b["month"]);
  });

  echo json_encode($data);
?>