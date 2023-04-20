<?php 
    include '../include/connect.php';
    include '../include/data.php';
    include '../include/func-slug.php';
    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

    $queryDep = $conn->prepare("SELECT * FROM tbl_deposit_money WHERE user_id = :user_id ORDER BY created_at DESC");
    $queryDep-> bindParam(':user_id', $id_user, PDO::PARAM_STR);
    $queryDep->execute();
    $resultsDep = $queryDep->fetchAll(PDO::FETCH_OBJ);

    $queryUser = $conn->prepare("SELECT * FROM tbl_user");
    $queryUser->execute();
    $resultsUser = $queryUser->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử nạp tiền</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Lịch sử nạp tiền</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Lịch sử nạp tiền</h1>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 8%;" >STT</th>
                            <th style="width: 30%;" >Mã giao dịch</th>
                            <th style="width: 15%;" >Hình thức</th>
                            <th style="width: 20%;" >Số tiền</th>
                            <th style="width: 15%;" >Ngày thực hiện</th>
                            <th style="width: 12%;" >Trạng thái</th>

                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsDep as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <p><?php echo $value -> pay_code ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value ->payments ?></p>
                                </td>
                                <td>
                                <div class="post_price">
                                        <?php
                                            $tien = (int) $value->pay_price;
                                            $bien = number_format($tien,0,",",".");
                                            echo $bien." đồng";
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <p><?php echo $value -> created_at ?></p>
                                </td>
                                <td>
                                    <?php if( $value -> status == 1){ ?>
                                        <p style = "color: #37a344;" >Đã hoàn thành</p>
                                    <?php }else{ ?>
                                        <p style = "color: red;">Khởi tạo</p>
                                    <?php } ?>
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
</body>
</html>
