<?php 
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  $err = "";
  $ok= "";

    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];
    $queryRoom = $conn->prepare("SELECT r.*, ca.classify, pay.pay_status, ci.fullname as city, dis.fullname as district, wa.fullname as ward, us.fullname as fullname, us.phone FROM tbl_rooms r join tbl_categories ca on ca.id = r.category_id join tbl_payment_history pay on pay.id_rooms = r.id join tbl_city ci on ci.id = r.city_id join tbl_district dis on dis.id = r.district_id join tbl_ward wa on wa.id = r.ward_id join tbl_user us on us.id = r.user_id WHERE pay.pay_status = 0 and  r.status = 1 and r.user_id = :user_id");
    $queryRoom-> bindParam(':user_id', $id_user, PDO::PARAM_STR);
    $queryRoom->execute();
    $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
    // var_dump($resultsRoom); die();

    if(isset($_GET['del'])&&$_GET['del']){
        $id_room = $_GET['del'];

        $queryImage = "DELETE FROM tbl_rooms_image WHERE id_rooms = :id";
        $queryImage= $conn -> prepare($queryImage);
        $queryImage->bindParam(':id',$id_room,PDO::PARAM_STR);
        $queryImage->execute();
        
        $queryPay = "DELETE FROM tbl_payment_history WHERE id_rooms = :id";
        $queryPay= $conn -> prepare($queryPay);
        $queryPay->bindParam(':id',$id_room,PDO::PARAM_STR);
        $queryPay->execute();

        if( $queryImage && $queryPay){
            $queryRoom = "DELETE FROM tbl_rooms WHERE id = :id";
            $queryRoom= $conn -> prepare($queryRoom);
            $queryRoom->bindParam(':id',$id_room,PDO::PARAM_STR);
            $queryRoom->execute();
            if($queryRoom){
                $ok = 1;
                $message = "Đã xóa bài viết";
            }else{
                $err = 1;
                $message = "Có lỗi xảy ra, vui lòng thử lại";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài đăng chưa thanh toán</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Bài đăng chưa thanh toán</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Bài đăng chưa thanh toán</h1>
                </div>
                <div class="account-btn">
                <a href="./create-post.php" class="btn btn-post">Đăng tin mới </a>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 8%;" >Mã tin</th>
                            <th style="width: 10%;" >Ảnh đại diện</th>
                            <th style="width: 42%;" >Tiêu đề</th>
                            <th style="width: 15%;" >Giá</th>
                            <th style="width: 15%;" >Thời gian</th>
                            <th style="width: 10%;" >Trạng thái</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsRoom as $key => $value) {?>
                            <tr>
                                <td>#<?php echo $value-> id?></td>
                                <td>
                                    <div class="post_thumb">
                                        <img class="thumb-img" src=".<?php echo $value-> image_logo?>" alt="" style=" object-fit: contain; width: 100%; height: 100%;">
                                    </div>
                                </td>
                                <td style="text-align: left; ">
                                    <span class="category"><?php echo $value-> classify?></span>
                                    <span class="title"><?php echo $value-> name?></span>
                                    <p class="address"><strong>Địa chỉ: </strong><?php echo $value-> apartment_number.", Đường  ".$value-> street.", ".$value-> ward.", ".$value->district.", ".$value->city ?> </p>
                                    <div class="btn-tool">
                                        <?php if($value->pay_status == 0){?>
                                            <a href="post-payment.php?id=<?php echo $value-> id?>" class="btn-pay" style = "color: red;">
                                                <i class="fa-solid fa-money-check-dollar"></i>
                                                Thanh toán tin
                                            </a>
                                        <?php }?>
                                            <a href="./edit-post.php?id=<?php echo $value-> id?>&edit=1" class="btn-fix" style = "color: #1266dd;">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                                Chỉnh sửa
                                            </a>
                                        <?php if($value->status == 1){?>
                                            <a href="./post-unpaid.php?del=<?php echo $value-> id?>" class="btn-hide" style = "color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa bài đăng này này?');">
                                            <i class="fa-solid fa-trash-arrow-up"></i>
                                                Xóa tin
                                            </a>
                                        <?php }?>
                                        </div>
                                </td>
                                <td>
                                    <div class="post_price">
                                        <?php
                                            $tien = (int) $value->price;
                                            $bien =0;
                                            if(strlen($tien)>=7){
                                                $bien =  $tien/1000000;
                                                echo $bien." triệu/tháng";
                                            }else {
                                                $bien = number_format($tien,0,",",".");
                                                echo $bien." đồng/tháng";
                                            }?>
                                    </div>
                                </td>
                                <td>
                                    <div class="post_date">Bắt đầu: <?php echo $value-> time_start?></div>
                                    <div class="post_date">Kết thúc: <?php echo $value-> time_stop?></div>
                                </td>
                                <td>
                                    <?php if($value->pay_status == 0){?>
                                        <p style = "color: #000;">Khởi tạo</p>
                                    <?php }?>
                                    <?php if($value->pay_status == 1 && $value->status == 1){?>
                                        <p style = "color: #1266dd;">Chờ duyệt</p>
                                    <?php }?>
                                    <?php if($value->pay_status == 1 && $value->status == 0){?>
                                        <p style = "color: red;">Không hoạt động</p>
                                    <?php }?>
                                    <?php if($value->pay_status == 1 && $value->status == 2){?>
                                        <p style = "color: #37a344;">Hoạt động</p>
                                    <?php }?>
                                    <?php if($value->pay_status == 1 && $value->status == 3){?>
                                        <p style = "color: #000;">Hết hạn</p>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /main-right -->
    </div>
    

    <!-- script -->
    <?php include('include/script.php');?>
    <!-- /script -->
    
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
            <a href="./post-unpaid.php" class="btn">OK</a>
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
            <a href="./post-unpaid.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>