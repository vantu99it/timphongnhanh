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
    <title>Document</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách tin đăng</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý tin đã đăng</h1>
                </div>
                <div class="account-btn">
                <a href="http://" class="btn btn-post">Đăng tin mới </a>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 8%;" >Mã tin</th>
                            <th style="width: 10%;" >Ảnh đại diện</th>
                            <th style="width: 42%;" >Tiêu đề</th>
                            <th style="width: 10%;" >Giá</th>
                            <th style="width: 10%;" >Ngày bắt đầu</th>
                            <th style="width: 10%;" >Ngày hết hạn</th>
                            <th style="width: 10%;" >Trạng thái</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <tr>
                            <td>#12245</td>
                            <td>
                                <div class="post_thumb">
                                    <img class="thumb-img" src="./image/author.png" alt="" style=" object-fit: contain; width: 100%; height: 100%;">
                                </div>
                            </td>
                            <td style="text-align: left; ">
                                <span class="category">Phòng trọ</span>
                                <span class="title">Cho thuê phòng trọ khép kín cách Đại Học vinh 500m </span>
                                <p class="address"><strong>Địa chỉ:</strong> 182 Lê Duẩn, Bến Thủy, Thành phố Vinh, Nghệ An Cho thuê phòng trọ khép kín cách Đại Học vinh</p>
                                <div class="btn-tool">
                                        <a href="" class="btn-pay" style = "color: red;">
                                            <i class="fa-solid fa-money-check-dollar"></i>
                                            Thanh toán tin
                                        </a>
                                        <a href="" class="btn-fix" style = "color: #1266dd;">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            Chỉnh sửa
                                        </a>
                                        <a href="" class="btn-hide" style = "color: #000;">
                                        <i class="fa-regular fa-eye-slash"></i>
                                            Ẩn tin
                                        </a>
                                        <p class="btn-type " style = "color: #37a344;">
                                            <i class="fa-solid fa-check "></i>
                                            <span>VIP 1</span>
                                        </p>
                                    </div>
                            </td>
                            <td>
                                <div class="post_price">1.2 triệu/tháng</div>
                            </td>
                            <td>
                                <div class="post_date">9/11/2022</div>
                            </td>
                            <td>
                                <div class="post_date">22/11/2022</div>
                            </td>
                            <td>
                                <div class="post-status">Đang hoạt động</div>
                            </td>
                        </tr>
                        <tr>
                            <td>#12246</td>
                            <td>
                                <div class="post_thumb">
                                    <img class="thumb-img" src="./image/author.png" alt="" style=" object-fit: contain; width: 100%; height: 100%;">
                                </div>
                            </td>
                            <td style="text-align: left; ">
                                <span class="category">Phòng trọ</span>
                                <span class="title">Cho thuê phòng trọ khép kín cách Đại Học vinh 500m </span>
                                <p class="address"><strong>Địa chỉ:</strong> 182 Lê Duẩn, Bến Thủy, Thành phố Vinh, Nghệ An Cho thuê phòng trọ khép kín cách Đại Học vinh</p>
                                    <div class="btn-tool">
                                        <a href="" class="btn-pay" style = "color: red;">
                                            <i class="fa-solid fa-money-check-dollar"></i>
                                            Thanh toán tin
                                        </a>
                                        <a href="" class="btn-fix" style = "color: #1266dd;">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            Chỉnh sửa
                                        </a>
                                        <a href="" class="btn-hide" style = "color: #000;">
                                        <i class="fa-regular fa-eye-slash"></i>
                                            Ẩn tin
                                        </a>
                                        <p class="btn-type " style = "color: #37a344;">
                                            <i class="fa-solid fa-check "></i>
                                            <span>VIP 1</span>
                                        </p>
                                    </div>
                            </td>
                            <td>
                                <div class="post_price">1.2 triệu/tháng</div>
                            </td>
                            <td>
                                <div class="post_date">9/11/2022</div>
                            </td>
                            <td>
                                <div class="post_date">22/11/2022</div>
                            </td>
                            <td>
                                <div class="post-status">Chờ thanh toán</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /main-right -->
    </div>
    

    <!-- script -->
    <?php include('include/script.php');?>
    <!-- /script -->
    
</body>
</html>