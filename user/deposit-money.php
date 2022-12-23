<?php
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền vào tài khoản</title>

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
                <h1>Nạp tiền vào tài khoản</h1>
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
                <h3 style = "margin-bottom: 25px;">Lựa chọn hình thức nạp tiền</h3>
                <section class="section location-city">
                    <a href="./deposit-money-transfer.php" class="location-item city-1">
                        <div class="location-bg">
                            <img src="./image/bank.png" alt="">
                        </div>
                        <span class="location-cat">
                            Chuyển khoản
                        </span>
                    </a>
                    <a href="./deposit-money-momo.php" class="location-item city-2">
                        <div class="location-bg">
                            <img src="./image/MoMo.png" alt="">
                        </div>
                        <span class="location-cat">
                            Qua MOMO
                        </span>
                    </a>
                    <a href="./deposit-money-vnpay.php" class="location-item city-3">
                        <div class="location-bg">
                            <img src="./image/vnpay_qr.png" alt="">
                        </div>
                        <span class="location-cat">
                           Qua VNPAY
                        </span>
                    </a>
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