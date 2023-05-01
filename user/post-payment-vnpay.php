<?php
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $queryRoom= $conn -> prepare("SELECT * FROM tbl_rooms WHERE id = :id");
    $queryRoom-> bindParam(':id', $id, PDO::PARAM_STR);
    $queryRoom-> execute();
    $resultsRoom = $queryRoom->fetch(PDO::FETCH_OBJ);
    $nameRooms = $resultsRoom -> name;
    $time_start = $resultsRoom -> time_start;
    $time_stop = $resultsRoom -> time_stop;
    $date = (strtotime($time_stop) - strtotime($time_start))/60/60/24;
    $typeId = $resultsRoom -> news_type_id;
    }

    // Lấy các thông tin cần thiết từ session
    $pay_code = $_SESSION['pay']['pay-code'] ;
    $id = $_SESSION['pay']['id-post'];
    $id_user = $_SESSION['pay']['id-user'] ;
    $slug = $_SESSION['pay']['slug'] ;
    $nameRooms = $_SESSION['pay']['name-room'];
    $time_start = $_SESSION['pay']['time-start'];
    $time_stop = $_SESSION['pay']['time-stop'];
    $date = (strtotime($time_stop) - strtotime($time_start))/60/60/24;
    $total = $_SESSION['pay']['total'] ;
    $name_type = $_SESSION['pay']['name-type'] ;
    $idPaymentHis = $_SESSION['pay']['idPaymentHis'];

    $err = "";
    $ok = "";
    $message = "";

    if(isset($_GET['vnp_SecureHash'])){
        // Code của VNPAY
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, 'GLGPOAQECUHWSECPJHSDHXLQGMMDWQZE');

        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $pay = 'VNPAY-'.$_GET['vnp_BankCode'];
                // Cập nhật thông tin đã thanh toán
                $sqlPayment = "UPDATE tbl_payment_history SET pay_code = :pay_code, pay_price = :pay_price, payments = :payments, pay_status = 1 WHERE id = :id AND expired = 0";
                $queryPayment= $conn -> prepare($sqlPayment);
                $queryPayment->bindParam(':pay_code',$pay_code,PDO::PARAM_STR);
                $queryPayment->bindParam(':pay_price',$total,PDO::PARAM_STR);
                $queryPayment->bindParam(':payments',$pay,PDO::PARAM_STR);
                $queryPayment->bindParam(':id',$idPaymentHis,PDO::PARAM_STR);
                $queryPayment->execute();
                
                $ok = 1;
                $message = "Thanh toán thành công";
            } else {
                $err = 1;
                $message = "Giao dịch không thành công!";
            }
        } else {
            $err = 1;
            $message = "Chữ ký không hợp lệ! Thanh toán thất bại";
        }
    }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán bài đăng qua VNPAY</title>

    <!-- link-css -->
    <?php include('include/link-css.php');?>
    <!-- /link-css -->
</head>
<body>
    <!-- header -->
    <?php include('include/header.php');?>
    <!-- /header -->
    <div id="main">
        <!-- sidebar -->
        <?php include('include/sidebar.php');?>
        <!-- /sidebar -->

        <!-- main-right -->
        <div id="main-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tìm trọ nhanh</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đăng tin mới</li>
                </ol>
            </nav>
            <div class="form-title">
                <h1>Thanh toán tin qua VNPAY</h1>
            </div>
            <div class="form-note">
                <h4>Lưu ý</h4>
                <ul>
                    <li>Vui lòng kiểm tra lại thông tin thanh toán trước khi xác nhận thanh toán.</li>
                    <li>Điền đầy đủ thông tin thanh toán vào form thanh toán VNPAY.</li>
                    <li>Bạn vui lòng hoàn tất các bước để tiến hành thanh toán thành công.</li>
                </ul>
            </div>
            <div class="form-content">
                <h3>Thông tin thanh toán</h3>
                <h4><?php echo $nameRooms ?></h4>
                <h4>Thời gian đăng bài: <b><?php echo $date ?> ngày </b> (<?php echo date_format(date_create($time_start),"H:i:s d-m-Y")?> đến <?php  echo  date_format(date_create($time_stop),"H:i:s d-m-Y")?>)</h4>
                <h4>Loại tin đăng: <b><?php echo $name_type?></b></h4>
                <h4>Tổng tiền thanh toán: <b>
                    <?php  $totals = number_format((int) $total,0,",",".");
                    echo $totals." đồng";?> </b>
                </h4>
                <h4>Hình thức thanh toán: <b>Thanh toán qua VNPAY</b></h4>
                <h4>Mã thanh toán: <b style = "color: red;"><?php echo $pay_code ?></b> </h4>
            </div>
            <form action="./payment-vnpay.php" method="post">
                <div class="submit-form">
                    <input type="hidden" name="pay_code" value="<?php echo $pay_code ?>">
                    <input type="hidden" name="amount" value="<?php echo $total ?>">
                    <input type="submit" name="redirect" id="redirect" class="btn btn-submit"  value="Xác nhận thanh toán" style = "width: 50%;height: 45px;font-size: 18px;">
                </div>
            </form>
        </div>
        <!-- /main-right -->
    </div>
    <!-- Thông báo thành công -->
    <?php if($ok == 1){ ?>
    <div class="noti">
        <div class="success-checkmark">
            <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
            <div class="notification">
                <p>
                    <?php echo $message ?>
                </p>
            </div>
            <a href="./post-manage.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
    <!-- Thông báo thất bại -->
    <?php if($err == 1){ ?>
    <div class="noti">
        <div class="error-banmark">
            <div class="ban-icon">
                <span class="icon-line line-long-invert"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
            <div class="notification">
                <p>
                    <?php echo $message ?>
                </p>
            </div>
            <a href="./post-payment-vnpay.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
     <!-- script -->
     <?php include('include/script.php');?>
    <!-- /script -->
</body>
</html>