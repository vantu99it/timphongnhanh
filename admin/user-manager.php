<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $queryUser = $conn->prepare("SELECT * FROM tbl_user");
    $queryUser->execute();
    $resultsUser = $queryUser->fetchAll(PDO::FETCH_OBJ);

    $err = "";
    $ok = "";
    $message = "";

    // Cập nhật
    $updateId = isset($_GET['id'])?$_GET['id']:'';
    if($updateId){
        $queryUpdate = $conn->prepare("SELECT * FROM tbl_user WHERE ID = $updateId");
        $queryUpdate->execute();
        $resultsUpdate = $queryUpdate->fetch(PDO::FETCH_OBJ);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-form'])){
        $status = $_POST['status'];
        
        $sql = "UPDATE tbl_user SET status = :status WHERE id = $updateId ";
        $query= $conn -> prepare($sql);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->execute();
        if($query){
            $ok = 1;
            $message = "Cập nhật thành công";
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
    <title>Admin | Quản lý tài khoản người dùng</title>
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
                    <li class="breadcrumb-item"><a href="#">Quản lý người dùng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý user</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý user</h1>
                </div>
                <div class="account-btn">
                    <a href="../register.php" class="btn btn-post btn-add">Tạo người dùng</a>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >STT</th>
                            <th style="width: 12%;" >Tên đẩy đủ</th>
                            <th style="width: 10%;" >Tên đăng nhập</th>
                            <th style="width: 12%;" >Email</th>
                            <th style="width: 10%;" >Số điện thoại</th>
                            <th style="width: 15%;" >Địa chỉ</th>
                            <th style="width: 10%;" >Số dư tk</th>
                            <th style="width: 10%;" >Ngày tạo</th>
                            <th style="width: 8%;" >Trạng thái</th>
                            <th style="width: 8%;" >Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsUser as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <p><?php echo $value -> fullname ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> username ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> email ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> phone ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> address ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> balance ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> created_at ?></p>
                                </td>
                                <td>
                                    <?php if( $value -> status == 1){ ?>
                                        <p style = "color: #37a344">Hoạt động</p>
                                    <?php }else{ ?>
                                        <p style = "color: red">Không hoạt động</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="./user-manager.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /main-right -->
        <?php if(isset($_GET['id'])){?>
        <div class="form-act form-animation" style ="display: block;">
            <div class="form-act-edit">
                <div class="form-close">
                    <a href="./user-manager.php"><i class="fa-solid fa-x"></i></a>
                </div>
                <form action="" method="post">
                    <h2>Chỉnh sửa người dùng</h2>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tên chuyên mục</lable>
                        <input type="text"  value = "<?php echo $resultsUpdate-> fullname ?>" disabled>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tên đăng nhập</lable>
                        <input type="text" value = "<?php echo $resultsUpdate->username ?>" disabled>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Email</lable>
                        <input type="text" value = "<?php echo $resultsUpdate->email ?>" disabled>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                    <lable class="contact-title">Email</lable>
                        <input type="text" value = "<?php echo $resultsUpdate->phone ?>" disabled>
                        <span class="form-message"></span>
                    </div>
                    <div class="status" style = "margin-top: 10px;">
                        <label style = "margin-right: 15px;">
                            <input type="radio" name="status" id="" value ="1" <?php if($resultsUpdate->status == 1) echo  "checked = 'Checked'" ?>> Hoạt động

                        </label>
                        <label>
                            <input type="radio" name="status" value ="0" <?php if($resultsUpdate->status == 0) echo  "checked = 'Checked'" ?> id="" > Ngừng hoạt động
                        </label>
                    </div>
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="update-form" value="Cập nhật" class="btn update-form " id = "update-form">
                    </div>
                </form>
            </div>
        </div>
        <?php }?>
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
                    Thành công
                </p>
            </div>
            <a href="./user-manager.php" class="btn">OK</a>
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
                    Có lỗi xảy ra, vui lòng thử lại!
                </p>
            </div>
            <a href="./user-manager.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>