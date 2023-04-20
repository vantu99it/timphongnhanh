<?php
    include '../include/connect.php';
    if(isset($_POST['month']) && isset($_POST['year'])){
      $month = $_POST['month'];
      $year = $_POST['year'];

    }else {
      $month = date('n');
      $year = date('Y');;
    }

    if($month == 2){
      if (($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0) {
        $num_days = 29;
      } else {
        $num_days = 28;
      }
    }elseif ($month == 4 && $month == 6 && $month == 9 && $month == 11) {
      $num_days = 30;
    }else {
      $num_days = 31;
    }
    if($month > 9){
    $start_month = $year.'-'.$month.'-01';
    $end_month = $year.'-'.$month.'-'.$num_days;
    }else{
    $start_month = $year.'-0'.$month.'-01';
    $end_month = $year.'-0'.$month.'-'.$num_days;
    }
    // Thực thi câu truy vấn
    $sql = "SELECT date(created_at) as date_only, sum(pay_price) as total_amount FROM tbl_payment_history WHERE date(created_at) >= '$start_month' and date(created_at)<= '$end_month' GROUP BY date_only ";
    $result = $conn->query($sql);
    
      // Khởi tạo mảng để chứa dữ liệu
      $data = array();
      for ($day = 1; $day <= $num_days; $day++) {
        $data[$day] = 0;
      }

      // Lặp qua các kết quả từ câu truy vấn và gán vào mảng
      foreach ($result as $row) {
          $day = date('j', strtotime($row['date_only']));
          $data[$day] = $row['total_amount'];
      }
    echo json_encode($data);
?>