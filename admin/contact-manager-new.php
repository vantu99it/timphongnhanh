<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $queryCon = $conn->prepare("SELECT * FROM tbl_contact WHERE status = 0");
    $queryCon->execute();
    $resultsCon = $queryCon->fetchAll(PDO::FETCH_OBJ);

    $err = "";
    $ok = "";
    $message = "";
    // cập nhật
    $updateId = isset($_GET['id'])?$_GET['id']:'';
    if($updateId){
        $queryUpdate = $conn->prepare("SELECT * FROM tbl_contact WHERE ID = $updateId");
        $queryUpdate->execute();
        $resultsUpdate = $queryUpdate->fetch(PDO::FETCH_OBJ);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-form'])){
        $status = $_POST['status'];
        if($status == 1){
            $sql = "UPDATE tbl_contact SET status = :status WHERE id = $updateId ";
            $query= $conn -> prepare($sql);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->execute();
            if($query){
                $ok = 1;
                $message = "Đã lưu xử lý!";
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
                    <li class="breadcrumb-item"><a href="#">Quản lý phản hồi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chưa giải quyết</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Phản hồi chưa giải quyết</h1>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >ID</th>
                            <th style="width: 10%;" >Họ tên</th>
                            <th style="width: 10%;" >SĐT</th>
                            <th style="width: 10%;" >Email</th>
                            <th style="width: 10%;" >Vấn đề</th>
                            <th style="width: 30%;" >Nội dung</th>
                            <th style="width: 7%;" >Thời gian</th>
                            <th style="width: 8%;" >Trạng thái</th>
                            <th style="width: 10%;" >Hành động</th>
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
                                    <p><a href="tel:+<?php echo $value -> phone ?>" target="_blank"><?php echo $value -> phone ?></a></p>
                                </td>
                                <td>
                                    <p><a href="mailto:<?php echo $value -> email ?>" target="_blank"><?php echo $value -> email ?></a></p>
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
                                    <p style = "color: red">Chưa giải quyết</p>
                                </td>
                                <td>
                                    <a href="./contact-manager-new.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
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
                    <a href="./contact-manager-new.php"><i class="fa-solid fa-x"></i></a>
                </div>
                <form action="" method="post">
                    <h2>Thông tin liên hệ</h2>
                    <div class="form-half">
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Họ tên</lable>
                            <input type="text" name="name"  id="name" value = "<?php echo $resultsUpdate->name ?>" disabled>
                        </div>
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Số điện thoại</lable>
                            <input type="text" name="title"  id="title"  value = "<?php echo $resultsUpdate->phone ?>" disabled>
                        </div>
                    </div>
                    <div class="form-half">
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Email</lable>
                            <input type="text" name="title"  id="title"  value = "<?php echo $resultsUpdate->email ?>" disabled>
                        </div>
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Loại vấn đề</lable>
                            <input type="text" name="classify"  id="classify" 
                            value = "<?php if($resultsUpdate -> problem == 1){ 
                                echo'Giải đáp thắc mắc';
                                }if($resultsUpdate -> problem == 2){ 
                                echo 'Hỗ trợ đăng bài';
                                }if($resultsUpdate -> problem == 3){ 
                                echo 'Hỗ trợ thanh toán';
                                }if($resultsUpdate -> problem == 4){ 
                                echo 'Giải quyết khiếu nại';
                                } 
                            ?>
                            " disabled>
                        </div>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Mô tả</lable>
                        <textarea name="description" id="description" cols="30" rows="6" disabled><?php echo $resultsUpdate->content?></textarea >
                    </div>
                    <div class="status" style = "margin-top: 10px;">
                        <label style = "margin-right: 15px;">
                            <input type="radio" name="status" value ="1" <?php if($resultsUpdate->status == 1) echo  "checked = 'Checked'"?>> Đã giải quyết
                        </label>
                        <label>
                            <input type="radio" name="status" value ="0" <?php if($resultsUpdate->status == 0) echo  "checked = 'Checked'"?>> Chưa giải quyết
                        </label>
                    </div>
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="update-form" value="Lưu" class="btn update-form " id = "update-form">
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
            <a href="./contact-manager-new.php" class="btn">OK</a>
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
            <a href="./contact-manager-new.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>