<?php 
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  $err = "";
  $ok= "";

    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

    $queryPay = $conn->prepare("SELECT pay.*, r.name AS name_post FROM tbl_payment_history pay JOIN tbl_rooms r on r.id = pay.id_rooms WHERE pay.user_id = :user_id AND pay.pay_status = 1 ORDER BY pay.created_at DESC");
    $queryPay-> bindParam(':user_id', $id_user, PDO::PARAM_STR);
    $queryPay->execute();
    $resultsPay = $queryPay->fetchAll(PDO::FETCH_OBJ);
    // var_dump($resultsPay); die();

    if(isset($_GET['hide'])){
        $id_room = $_GET['hide'];
        $queryHide = "UPDATE tbl_rooms SET status = 0 WHERE id = :id";
        $queryHide= $conn -> prepare($queryHide);
        $queryHide->bindParam(':id',$id_room,PDO::PARAM_STR);
        $queryHide->execute();
        if($queryHide){
            $ok = 1;
            $message = "Đã ẩn bài viết";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử thanh toán</title>
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
        <?php include('include/sidebar.php')?>
        <!-- /sidebar -->
        
        <!-- main-right -->
        <div id="main-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tìm trọ nhanh</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lịch sử thanh toán</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Lịch sử thanh toán</h1>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 8%;" >STT</th>
                            <th style="width: 27%;" >Tên bài viết</th>
                            <th style="width: 25%;" >Mã thanh toán</th>
                            <th style="width: 15%;" >Số tiền TT</th>
                            <th style="width: 15%;" >Hình thức TT</th>
                            <th style="width: 10%;" >Ngày thực hiện</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsPay as $key => $value) {?>
                            <tr>
                                <td><?php echo $key + 1?></td>
                                <td>
                                    <p><?php echo $value-> name_post?></p>
                                </td>
                                <td style="text-align: left; ">
                                    <p><?php echo $value-> pay_code?></p>
                                </td>
                                <td>
                                    <div class="post_price">
                                        <?php
                                            $tien = (int) $value->pay_price;
                                            $bien =0;
                                            if(strlen($tien)>=7){
                                                $bien =  $tien/1000000;
                                                echo $bien." triệu đồng";
                                            }else {
                                                $bien = number_format($tien,0,",",".");
                                                echo $bien." đồng";
                                            }?>
                                    </div>
                                </td>
                                <td>
                                    <?php if($value->payments == 'account'){?>
                                        <p>Trừ tiền tài khoản</p>
                                    <?php }?>
                                    <?php 
                                        $str1 = $value->payments;
                                        $str2 = 'VNPAY-';
                                        $sub_str1 = substr($str1, 0, strlen($str2));
                                        if($sub_str1 == $str2){?>
                                        <p>Qua <?php echo $str1 ?></p>
                                    <?php }?>
                                </td>
                                <td>
                                    <p><?php echo  date_format(date_create($value->created_at ),"d-m-Y H:i:s") ?></p>
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
            <a href="./post-manage.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>