<?php
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

  $getdate = date('dmY-His');
  $pay_code = "TPN-KH#".$_SESSION['login']['id']."-".$getdate;
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền qua MOMO</title>

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
                <h1>Quét mã QR để nạp tiền</h1>
            </div>
            <div class="form-note">
                <h4>Lưu ý</h4>
                <ul>
                    <li>Vui lòng kiểm tra lại thông tin thanh toán trước khi xác nhận thanh toán.</li>
                    <li>Quét mã QR_MOMO bên dưới để chuyển khoản</li>
                    <li>Chuyển khoản tối thiểu <b>20.000 VNĐ</b></li>
                    <li>Phần nội dung chuyển khoản bạn vui lòng ghi đúng: <b><?php echo $pay_code ?></b></li>
                </ul>
            </div>
            <div class="form-content">
                <h3 style = "margin-bottom: 25px;">Lựa chọn hình thức nạp tiền</h3>
                <section class="section location-city" style = "justify-content: center;">
                    <div class="location-momo">
                        <div class="location-bg" style = "height: 380px;">
                            <img src="./image/QR momo.jpg" alt="">
                        </div>
                        <span class="location-cat">
                            Nội dung chuyển khoản
                            <div class="text-copy"> 
                                <input type="text" name="" id="code-payND" value = "<?php echo $pay_code ?>" disabled style = "font-size: 16px;">
                                <button onclick="copyCodeND()"><i class="fa-regular fa-copy"></i></button>
                            </div>
                        </span>
                    </div>
                </section>
            </div>
        </div>
        <!-- /main-right -->
    </div>
     <!-- script -->
     <?php include('include/script.php');?>
    <!-- /script -->
</body>
</html>