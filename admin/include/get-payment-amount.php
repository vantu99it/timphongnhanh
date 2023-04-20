<?php
    include '../include/connect.php';
    // Nhận năm từ phương thức POST
    if (isset($_POST['year'])) {
        $year = $_POST['year'];
    } else {
        $year = date("Y");
    }


// Thực thi câu truy vấn
$sql1 = "SELECT payments, DATE_FORMAT(created_at, '%Y-%m') AS month, SUM(COALESCE(pay_price, 0)) AS total_amount FROM tbl_payment_history WHERE created_at BETWEEN '{$year}-01-01 00:00:00' AND '{$year}-12-31 23:59:59' GROUP BY month, payments;";
$stmt1 = $conn->query($sql1);

    // Tạo mảng dữ liệu
    $data = array();
    $months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    $arr1 = array();
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $item1 = array(
            "month" => $row["month"],
            "payments" => $row["payments"],
            "total_amount" => $row["total_amount"],
        );
        array_push($arr1, $item1);
    }

    // Gán giá trị mặc định là 0 cho các tháng không có dữ liệu
    foreach ($months as $month) {
        $found = false;
        foreach ($arr1 as $item) {
            if ($item['month'] == "2023-{$month}") {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $item1 = array(
                "month" => "2023-{$month}",
                "payments" => "account",
                "total_amount" => 0,
            );
            array_push($arr1, $item1);
            $item2 = array(
                "month" => "2023-{$month}",
                "payments" => "VNPAY-NCB",
                "total_amount" => 0,
            );
            array_push($arr1, $item2);
        }
    }

    // Tạo mảng tạm để tính toán
    $tempArr = array();
    foreach ($arr1 as $item) {
        $month = $item['month'];
        $type = $item['payments'];
        $amount = $item['total_amount'];

        if (!array_key_exists($month, $tempArr)) {
            $tempArr[$month] = array(
                'month' => $month,
                'account' => null,
                'VNPAY-NCB' => null
            );
        }

        $tempArr[$month][$type] = $amount;
    }

    // Xóa các phần tử không có giá trị trong mảng tạm
    $tempArr = array_values(array_filter($tempArr, function($item) {
        return $item['account'] !== null && $item['VNPAY-NCB'] !== null;
    }));

    // Tạo mảng kết quả
    $data = array();
    foreach ($tempArr as $item) {
        $data[] = array(
            $item['month'],
            $item['account'],
            $item['VNPAY-NCB']
        );
    }

    // Thêm tiêu đề vào mảng kết quả
    array_unshift($data, array("Tháng", "Tài khoản", "VNPAY-NCB"));

    echo json_encode($data);

    ?>