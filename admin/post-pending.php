<?php 
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  $err = "";
  $ok= "";

    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];
    $queryRoom = $conn->prepare("SELECT r.*, ca.classify, pay.pay_status, ci.fullname as city, dis.fullname as district, wa.fullname as ward FROM tbl_rooms r join tbl_categories ca on ca.id = r.category_id join tbl_payment_history pay on pay.id_rooms = r.id join tbl_city ci on ci.id = r.city_id join tbl_district dis on dis.id = r.district_id join tbl_ward wa on wa.id = r.ward_id WHERE pay.pay_status = 1 and  r.status = 1 and expired = 0 ORDER BY  r.id DESC");
    $queryRoom->execute();
    $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
    // var_dump($resultsRoom); die();


    if(isset($_GET['bro'])){
        $id_room = $_GET['bro'];
        $queryHide = "UPDATE tbl_rooms SET status = 2 WHERE id = :id";
        $queryHide= $conn -> prepare($queryHide);
        $queryHide->bindParam(':id',$id_room,PDO::PARAM_STR);
        $queryHide->execute();
        if($queryHide){
            $ok = 1;
            $message = "Duyệt bài thành công!";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }
    }
    // Nút hủy
    if(isset($_GET['del'])&&$_GET['del']){
        $id_room = $_GET['del'];

        $queryRooms = $conn->prepare("SELECT r.*, pay.pay_price FROM tbl_rooms r join tbl_payment_history pay on pay.id_rooms = r.id WHERE r.id = :id");
        $queryRooms-> bindParam(':id',$id_room, PDO::PARAM_STR);
        $queryRooms->execute();
        $resultsRooms = $queryRooms->fetch(PDO::FETCH_OBJ);

        $id_user = $resultsRooms->user_id ;
        $queryUser = $conn->prepare("SELECT * FROM tbl_user WHERE id = :id");
        $queryUser-> bindParam(':id', $id_user, PDO::PARAM_STR);
        $queryUser->execute();
        $resultsUser = $queryUser->fetch(PDO::FETCH_OBJ);

        // Cộng tiền
        $balance = (int) $resultsUser->balance;
        $pay_price = (int) $resultsRooms -> pay_price;
        $balanceHis = $balance + $pay_price;

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
                $sqlUserUp = "UPDATE tbl_user SET balance = :balance WHERE id = :id";
                $queryUserUp= $conn -> prepare($sqlUserUp);
                $queryUserUp->bindParam(':balance',$balanceHis,PDO::PARAM_STR);
                $queryUserUp->bindParam(':id',$id_user,PDO::PARAM_STR);
                $queryUserUp->execute();
                if($queryUserUp){
                    $ok = 1;
                    $message = "Hủy thành công!";
                }else{
                    $err = 1;
                    $message = "Có lỗi xảy ra, vui lòng thử lại";
                }
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
    <title>Admin | Quản lý bài viết chờ duyệt</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách tin đăng chờ duyệt</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý tin đã đăng chờ duyệt</h1>
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
                                        <a href="./post-pending.php?bro=<?php echo $value-> id?>" class="btn-pay" style = "color: #37a344;" onclick="return confirm('Bạn chắc chắn muốn duyệt bài này?');">
                                        <i class="fa-solid fa-rotate"></i>
                                            Duyệt
                                        </a>
                                        <a href="./post-pending.php?del=<?php echo $value-> id?>" class="btn-hide" style = "color: red;" onclick="return confirm('Bạn chắc chắn muốn hủy bài này?');">
                                            <i class="fa-solid fa-trash-arrow-up"></i>
                                            Hủy
                                        </a>
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
                                    <?php if($value->pay_status == 1 && $value->status == 1){?>
                                        <p style = "color: red;">Chờ duyệt</p>
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
    <!-- footer + js -->
    <?php include('include/footer.php');?>
    <!-- /footer + js -->

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
            <a href="./post-pending.php" class="btn">OK</a>
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
            <a href="./post-pending.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>