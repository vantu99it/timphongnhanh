<?php
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");
     $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

    $getdate = date('dmY-His');
    $pay_code = "TPN-KH#".$_SESSION['login']['id']."-".$getdate;

    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

    $queryUser = $conn->prepare("SELECT * FROM tbl_user WHERE id = :id");
    $queryUser-> bindParam(':id', $id_user, PDO::PARAM_STR);
    $queryUser->execute();
    $resultsUser = $queryUser->fetch(PDO::FETCH_OBJ);
    $balance = (int) $resultsUser->balance;

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
                $total = $_GET['vnp_Amount']/100;
                $balanceHis = $balance + $total;
                // Cập nhật thông tin đã thanh toán
                $sqlDeposit = "INSERT INTO tbl_deposit_money (pay_code,pay_price,payments,user_id,status) VALUE (:pay_code,:pay_price, :payments,:user_id, 1)" ;
                $queryDeposit= $conn -> prepare($sqlDeposit);
                $queryDeposit->bindParam(':pay_code',$pay_code,PDO::PARAM_STR);
                $queryDeposit->bindParam(':pay_price',$total,PDO::PARAM_STR);
                $queryDeposit->bindParam(':payments',$pay,PDO::PARAM_STR);
                $queryDeposit->bindParam(':user_id',$id_user,PDO::PARAM_STR);
                $queryDeposit->execute();
                
                // Cập nhật lại tiền
                $sqlUser = "UPDATE tbl_user SET balance = :balance WHERE id = :id";
                $queryUser= $conn -> prepare($sqlUser);
                $queryUser->bindParam(':balance',$balanceHis,PDO::PARAM_STR);
                $queryUser->bindParam(':id',$id_user,PDO::PARAM_STR);
                $queryUser->execute();

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
    <title>Nạp tiền qua VNPAY</title>

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
                <h1>Nạp tiền vào tài khoản qua VNPAY</h1>
            </div>
            <div class="form-note">
                <h4>Lưu ý</h4>
                <ul>
                    <li>Vui lòng kiểm số tiền bạn muốn nạp vào tài khoản</li>
                    <li>Vui lòng nạp tối thiểu <b>50.000 VNĐ</b></li>
                    <li>Nội dung thanh toán của bạn là: <b>TPN-<?php echo $pay_code ?></b></li>
                </ul>
            </div>
            <form action="./deposit-vnpay.php" method="post" id = "frm-post">
                <div class="form-input form-validator">
                    <p class="item-name">Nhập số tiền bạn muốn nạp vào tài khoản</p>
                    <div class="input-detail boder-ra-5">
                        <input type="number" name="amount" class="input-content boder-ra-5 mask" id="price" value = "50000" style="margin: 0;" >
                        <span class="input-disabled">Đồng</span>
                    </div>  
                    <span class="form-message"></span>              
                </div>
                <input type="hidden" name="pay_code" value="<?php echo $pay_code ?>">
                <input type="submit" name="redirect" id="redirect" class="btn btn-submit"  value="Nạp tiền" style = "width:25%;height: 45px;font-size: 18px;">

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
            <a href="./deposit-money.php" class="btn" target="_blank">OK</a>
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
            <a href="./deposit-money.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
     <!-- script -->
     <?php include('include/script.php');?>
    <!-- /script -->
    <script>
        Validator({
            form: '#frm-post',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#price', 'Vui lòng nhập số tiền bạn muốn nạp'),
                Validator.numberMin('#price', 49999, 'Số tiền phải lớn hơn hoặc bằng 50.000 VNĐ')
                
            ],
        });
    </script>
</body>
</html>