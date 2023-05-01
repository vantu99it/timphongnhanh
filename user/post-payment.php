<?php
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");
    // Lấy thông tin bài viết
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
    
    // $date = (int) $_SESSION['time-day']['date'];
    // $typeId = $_SESSION['time-day']['type'];

    // lấy thông tin user
    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

    $queryUser = $conn->prepare("SELECT * FROM tbl_user WHERE id = :id");
    $queryUser-> bindParam(':id', $id_user, PDO::PARAM_STR);
    $queryUser->execute();
    $resultsUser = $queryUser->fetch(PDO::FETCH_OBJ);
    $balance = (int) $resultsUser->balance;

    //lấy thông tin loại tin
    $queryType = $conn->prepare("SELECT * FROM tbl_new_type WHERE id = :id");
    $queryType-> bindParam(':id', $typeId, PDO::PARAM_STR);
    $queryType->execute();
    $resultsType = $queryType->fetch(PDO::FETCH_OBJ);
    $price = (int)$resultsType -> price ;
    //tổng tiền cần thanh toán
    $total = $price * $date;

    $checkPrice = (int)($balance - $total);

 
    // Lấy id payment 
    $queryPaymentHis = $conn -> prepare("SELECT * FROM tbl_payment_history WHERE id_rooms = :id AND expired = 0");
    $queryPaymentHis-> bindParam(':id', $id, PDO::PARAM_STR);
    $queryPaymentHis-> execute();
    $resultsPaymentHis = $queryPaymentHis->fetch(PDO::FETCH_OBJ);
    $idPaymentHis =  $resultsPaymentHis->id;
    
    //tạo paycode
    $pay_code = "TPN-KH".$id_user."-BĐ".$id."/".$resultsType ->slug."/".$date."d";

    $err = "";
    $ok = "";
    $message = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $pay = $_POST['pay'];
        // Thanh toán qua tài khoản
        if($pay == 'account'){
            $balanceHis = $balance - $total;
            if($balanceHis > 0){
                $sqlPayment = "UPDATE tbl_payment_history SET pay_code = :pay_code, pay_price = :pay_price, payments = :payments, pay_status = 1 WHERE id = :id AND expired = 0";
                $queryPayment= $conn -> prepare($sqlPayment);
                $queryPayment->bindParam(':pay_code',$pay_code,PDO::PARAM_STR);
                $queryPayment->bindParam(':pay_price',$total,PDO::PARAM_STR);
                $queryPayment->bindParam(':payments',$pay,PDO::PARAM_STR);
                $queryPayment->bindParam(':id',$idPaymentHis,PDO::PARAM_STR);
                $queryPayment->execute();

                // Cập nhật lại tiền
                $sqlUser = "UPDATE tbl_user SET balance = :balance WHERE id = :id";
                $queryUser= $conn -> prepare($sqlUser);
                $queryUser->bindParam(':balance',$balanceHis,PDO::PARAM_STR);
                $queryUser->bindParam(':id',$id_user,PDO::PARAM_STR);
                $queryUser->execute();
                if($queryPayment && $queryUser){
                    $ok = 1;
                    $message = "Thanh toán thành công";
                }else{
                    $err = 1;
                    $message = "Có lỗi xảy ra, vui lòng thử lại";
                }
            }else{
                $err = 1;
                $message = "Tài khoản không đủ, vui lòng nạp thêm tiền vào tài khoản";
            }
        }
        if($pay == 'vnpay'){
            header('location: ./post-payment-vnpay.php?id='.$id);
            $_SESSION['pay']['pay-code'] =  $pay_code;
            $_SESSION['pay']['id-post'] =  $id;
            $_SESSION['pay']['id-user'] =  $id_user;
            $_SESSION['pay']['slug'] =  $resultsType ->slug;
            $_SESSION['pay']['name-room'] = $nameRooms;
            $_SESSION['pay']['time-start'] =   $time_start;
            $_SESSION['pay']['time-stop'] =  $time_stop;
            $_SESSION['pay']['total'] =  $total;
            $_SESSION['pay']['name-type'] = $resultsType -> name_type;
            $_SESSION['pay']['idPaymentHis'] = $idPaymentHis;
        }
        
    }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán bài đăng</title>

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
                    <h1>Thanh toán tin</h1>
                </div>
                <div class="form-note">
                    <h4>Lưu ý</h4>
                    <ul>
                        <li>Chọn hình thức thanh toán và tiến hành thanh toán.</li>
                        <li>Với phương thức chuyển khoản qua nhân hàng nhớ ghi đúng nội dung chuyển khoản hiện thị.</li>
                        <li>Nếu có thắc mắc hoặc cần giúp đỡ hãy liên hệ với chúng tôi ngay</li>
                    </ul>
                </div>
                <div class="form-content">
                    <h3><?php echo $nameRooms ?></h3>
                    <h4>Thời gian đăng bài: <b><?php echo $date ?> ngày </b> (<?php echo date_format(date_create($time_start),"H:i:s d-m-Y")?> đến <?php  echo  date_format(date_create($time_stop),"H:i:s d-m-Y")?>)</h4>
                    <h4>Loại tin đăng: <b><?php echo $resultsType -> name_type?></b></h4>
                    <h4>Tổng tiền thanh toán: <b>
                        <?php  $totals = number_format((int) $total,0,",",".");
                        echo $totals." đồng";?> </b>
                    </h4>
                    <h4>Mã thanh toán: </h4>
                    <div class="text-copy" style = "width: 500px;border: 1px solid #ccc; margin-left: 15px;"> 
                        <input type="text" name="" id="code-pay" value = "<?php echo $pay_code ?>" disabled>
                        <button onclick="copyCode()" style = "border-left: 1px solid #ccc;"><i class="fa-regular fa-copy"></i></button>
                    </div>
                </div>
                <form action="" method="post" id = "frm-post">
                <div class="form-list">
                    <h3>Lựa chọn hình thức thanh toán: </h3>
                    <div class="form-radio">
                        <input type="radio" name="pay" id="" value = "account" <?php if($balance <  $total){ echo 'disabled';} ?> > <span>Trừ tiền trong tài khoản Timphongnhanh (TK chính: <?php echo number_format((int) $balance,0,",",".")." đồng)"; ?></span>
                        <?php if($balance <  $total){ ?>
                            <p style="color:red;">Số tiền trong tài khoản của bạn không đủ để thực hiện thanh toán, vui lòng <a href="./deposit-money.php">nạp thêm</a> hoặc chọn phương thức khác bên dưới</p>
                        <?php }?>
                    </div>
                    <div class="form-radio">
                        <input type="radio" name="pay" id="" value = "momo"> <span>Thanh toán qua ví điện tử MoMo</span>
                        <img src="./image/MoMo.png" alt="momo">
                    </div>
                    <div class="form-radio">
                        <input type="radio" name="pay" id="" value = "vnpay"> <span>Thanh toán qua ví điện tử VNPAY</span>
                        <img src="./image/vnpay_qr.png" alt="momo">
                    </div>
                    <div class="form-radio">
                        <input type="radio" name="pay" id="" value = "bank"> <span>Chuyển khoản qua ngân hàng</span>
                        <p>Nội dung chuyển khoản: <b style = "color:red"><?php echo $pay_code ?></b></p>
                        <p>Số tiền cần chuyển khoản: <b style = "color: red">
                        <?php  $totals = number_format((int) $total,0,",",".");
                        echo $totals." đồng";?> </b></p>
                    </div>
                    
                </div>
                <div class="submit-form">
                    <input type="submit" name="submit-form" class="btn btn-submit"  value="Thanh toán" style = "width: 50%;height: 45px;font-size: 18px;">
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
            <a href="" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
     <!-- script -->
     <?php include('include/script.php');?>
    <!-- /script -->
</body>
</html>