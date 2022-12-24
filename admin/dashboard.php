<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    // Đếm số bài chưa thanh toán
    $queryUnpaid = $conn->prepare("SELECT r.* FROM tbl_rooms r JOIN tbl_payment_history pay on pay.id_rooms = r.id WHERE pay.pay_status = 0 and  r.status = 1");
    $queryUnpaid->execute();
    $countUnpaid = $queryUnpaid->rowCount();

    // Đếm số bài chưa duyệt
    $queryPending = $conn->prepare("SELECT r.* FROM tbl_rooms r JOIN tbl_payment_history pay on pay.id_rooms = r.id WHERE pay.pay_status = 1 and  r.status = 1");
    $queryPending->execute();
    $countPending = $queryPending->rowCount();

    // Đếm số bài đã duyệt
    $queryApproved = $conn->prepare("SELECT r.* FROM tbl_rooms r JOIN tbl_payment_history pay on pay.id_rooms = r.id WHERE pay.pay_status = 1 and  r.status = 2  or r.status = 3");
    $queryApproved->execute();
    $countApproved = $queryApproved->rowCount();

    // Đếm số liên hệ chưa giải quyết
    $queryContact = $conn->prepare("SELECT * FROM tbl_contact WHERE status = 0");
    $queryContact->execute();
    $countContact = $queryContact->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Bảng điều khiển</title>
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
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Trang quản lý</h1>
                </div>
            </section>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <p>Tin chưa thanh toán</p>
                            <p class="count-number">
                                <?php echo $countUnpaid ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./post-unpaid.php">Xem ngay</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <p>Tin đang chờ duyệt</p>
                            <p class="count-number">
                                <?php echo $countPending ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./post-pending.php">Duyệt tin</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <p>Tin đã duyệt</p>
                            <p class="count-number">
                                <?php echo $countApproved ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./post-approved.php">Xem ngay</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <p>Phản hồi mới</p>
                            <p class="count-number">
                                <?php echo $countContact ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./contact-manager-new.php">Giải quyết</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /main-right -->
    </div>
    <!-- footer + js -->
    <?php include('include/footer.php');?>
    <!-- /footer + js -->
</body>
</html>