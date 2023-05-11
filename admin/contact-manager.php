<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $queryCon = $conn->prepare("SELECT * FROM tbl_contact WHERE status = 1");
    $queryCon->execute();
    $resultsCon = $queryCon->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Quản lý phản hồi</title>
    <!-- link-css -->
    <?php include('include/link-css.php');?>
    <!-- /link-css -->
    
</head>
<body>
    <!-- header -->
    <?php 
     include('include/header.php');
    ?>
    <!-- /header -->
    <div id="main">
        <!-- sidebar -->
        <?php 
        include('include/sidebar.php');
        ?>
        <!-- /sidebar -->
        
        <!-- main-right -->
        <div id="main-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang quản trị</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý hệ thống</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý phản hồi</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý phản hồi</h1>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >ID</th>
                            <th style="width: 13%;" >Họ tên</th>
                            <th style="width: 10%;" >SĐT</th>
                            <th style="width: 10%;" >Email</th>
                            <th style="width: 15%;" >Vấn đề</th>
                            <th style="width: 30%;" >Nội dung</th>
                            <th style="width: 7%;" >Thời gian</th>
                            <th style="width: 10%;" >Trạng thái</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsCon as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <p><?php echo $value -> name ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> phone ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> email ?></p>
                                </td>
                                <td>
                                    <?php if($value -> problem == 1){ ?>
                                        <p>Giải đáp thắc mắc</p>
                                    <?php }if($value -> problem == 2){ ?>
                                        <p>Hỗ trợ đăng bài</p>
                                    <?php }if($value -> problem == 3){ ?>
                                        <p>Hỗ trợ thanh toán</p>
                                    <?php }if($value -> problem == 4){ ?>
                                        <p>Giải quyết khiếu nại</p>
                                    <?php } ?>
                                </td>
                                <td  style="text-align: left; ">
                                    <p><?php echo $value -> content ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value-> created_at?></p>
                                </td>
                                <td>
                                    <p style = "color: #37a344;">Đã giải quyết</p>
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
</body>
</html>