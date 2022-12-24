<?php
  include '../include/connect.php';
  include '../include/func-slug.php';

    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];
    // Gọi ra thông tin user
    $queryUser = $conn->prepare("SELECT * FROM tbl_user WHERE status = 1 AND id = :user_id");
    $queryUser-> bindParam(':user_id', $id_user, PDO::PARAM_STR);
    $queryUser->execute();
    $resultsUser = $queryUser->fetch(PDO::FETCH_OBJ);
    // var_dump($resultsUser -> avatar); die();
    $err = "";
    $ok = "";
    $message = "";
    // Cập nhật thông tin
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])){
        $id = $_POST['user_id'];
        $user_username = $_POST['user_username'];
        $user_phone = $_POST['user_phone'];
        $user_fullname = $_POST['user_fullname'];
        $user_email = $_POST['user_email'];
        $user_zalo = $_POST['user_zalo'];
        $user_facebook = $_POST['user_facebook'];
        $user_address = $_POST['user_address'];
        if(isset($_FILES["upload-img"])){
            $imagePNG = $_FILES["upload-img"]["name"];
            if(empty($imagePNG)){
                $target_file = $resultsUser -> avatar;
            }else{
                $imageName = vn2en($imagePNG);  
                $target_dir = "./image/";
                $target_file = $target_dir.$imageName;
                move_uploaded_file($_FILES["upload-img"]["tmp_name"],'../image/'.$imageName); 
            }
        }
        $query= $conn -> prepare("UPDATE tbl_user SET phone = :phone, fullname = :fullname, email = :email, zalo = :zalo, facebook = :facebook, address = :address, avatar = :avatar WHERE id = :id ");
        $query->bindParam(':phone',$user_phone,PDO::PARAM_STR);
        $query->bindParam(':fullname',$user_fullname,PDO::PARAM_STR);
        $query->bindParam(':email',$user_email,PDO::PARAM_STR);
        $query->bindParam(':zalo',$user_zalo,PDO::PARAM_STR);
        $query->bindParam(':facebook',$user_facebook,PDO::PARAM_STR);
        $query->bindParam(':address',$user_address,PDO::PARAM_STR);
        $query->bindParam(':avatar',$target_file,PDO::PARAM_STR);
        $query->bindParam(':id',$id_user,PDO::PARAM_STR);
        $query->execute();
        if($query){
            $ok = 1;
            $message = "Cập nhật thành công";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }
    }
    // Thay đổi mật khẩu
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['old-password'])){
        $old_password = $_POST['old-password'];
        $new_password = $_POST['new-password'];
        $re_password = $_POST['re-password'];

        // Kiểm tra mật khẩu cũ đã đúng chưa
        $checkPass = password_verify($old_password, $resultsUser->password);
        if($checkPass=='true'){
            $passHash = password_hash($new_password,PASSWORD_DEFAULT);
            $queryUser = $conn->prepare("UPDATE tbl_user SET password = :password WHERE id = :id");
            $queryUser-> bindParam(':password', $passHash, PDO::PARAM_STR);
            $queryUser-> bindParam(':id', $id_user, PDO::PARAM_STR);
            $queryUser->execute();
            if($queryUser){
                $ok = 1;
                $message = "Thay đổi mật khẩu thành công!";
            }else{
                $err = 1;
                $message = "Có lỗi xảy ra, vui lòng thử lại";
            }
        }else{
            $err = 1;
            $message = "Mật khẩu cũ không chính xác, vui lòng thử lại";
        }
    }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Thông tin cá nhân</h1>
                </div>
            </section>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group row search-item mt-5">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Mã thành viên:</span>
                    <div class="col-md-6">
                        <input type="text" readonly class="form-control disable" id="user_id" value="#<?php echo $resultsUser -> id ?>" name = "user_id">
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Tên đăng nhập:</span>
                    <div class="col-md-6">
                        <input type="text" readonly class="form-control disable" id="user_username" value="<?php echo $resultsUser -> username?>" name = "user_username">
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Số điện thoại:</span>
                    <div class="col-md-6">
                        <input type="phone" class="form-control" id="user_phone" value="<?php echo $resultsUser -> phone?>" name = "user_phone" >
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Tên hiển thị:</span>
                    <div class="col-md-6">
                        <input type="text" class="form-control valid" id="user_fullname" name="user_fullname" value="<?php echo $resultsUser -> fullname?>" placeholder="VD: Nguyễn Văn A" aria-invalid="false">
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Email:</span>
                    <div class="col-md-6">
                        <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $resultsUser -> email?>" placeholder="VD: timphongnhanh@gmail.com">
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Zalo:</span>
                    <div class="col-md-6">
                        <input type="phone" class="form-control" id="user_zalo" name="user_zalo" value="<?php echo $resultsUser -> zalo?>" placeholder="">
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Facebook:</span>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="user_facebook" name="user_facebook" value="<?php echo $resultsUser -> facebook?>" placeholder="https://www.facebook.com/timphongnhanh">
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Địa chỉ:</span>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo $resultsUser -> address?>" placeholder="">
                    </div>
                </div>
                <div class="form-group row search-item">
                    <span class="col-md-2 offset-md-2 col-form-label item-name">Mật khẩu:</span>
                    <div class="col-md-6">
                        <div class="form-text text-muted">
                            <a href="#" class = "btn-add" style="display: inline-block; margin-top: 5px;">Đổi mật khẩu</a>
                        </div>
                    </div>
                </div>
                <div class="form-group row search-item mt-5 input-file">
                    <label class="col-md-2 offset-md-2 col-form-label item-name" style="padding-top: 0;">Ảnh đại diện</label>
                    <div class="col-md-6">
                        <div class="account-avt user-avatar-preview" style=" float: none; background: url(<?php if($resultsUser -> avatar != ""){echo ".".$resultsUser -> avatar;} else{echo 'https://phongtro123.com/images/default-user.png';}?>) center no-repeat; background-size: cover; margin: 0 25px 10px;" id="display-img">
                        </div>
                        <div id = "remove" style = "margin-left: 55px;">
                            <!-- <a onclick="removeImg()" class = "btn">Xóa ảnh</a> -->
                        </div>
                        <div class="user-avatar-upload clearfix">  
                            <div class="input-img" style = "padding: 10px; width: 200px;">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                Tải hình ảnh đại diện
                                <input type="file" class="upload-img" name="upload-img" id="upload-img" onchange = "ImageFileAsUrl()">
                            </div>
                        </div>
                    </div>
                    <div class="submit-form" style = "margin-top: 25px;">
                        <input type="submit" name="submit-form" class="btn btn-submit"  value="Lưu và cập nhật" style = "width: 100%;height: 45px;font-size: 18px;">
                    </div>
                </div>
            </form>
        </div>
        <!-- /main-right -->
        <div class="form-act">
            <div class="form-act-edit">
                <div class="form-close">
                    <i class="fa-solid fa-x"></i>
                </div>
                <form action="" method="post" id = "frm-re-password">
                    <h2>Thay đổi mật khẩu</h2>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Mật khẩu cũ</lable>
                        <input type="password" name="old-password" id="old-password">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Mật khẩu mới</lable>
                        <input type="password" name="new-password" id="new-password">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">NHập lại mật khẩu</lable>
                        <input type="password" name="re-password" id="re-password">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="add-form" value="Thay đổi" class="btn add-form" id = "add-form">
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            <a href="./personal-page.php" class="btn">OK</a>
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
            <a href="./personal-page.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
    <!-- script -->
    <script src="../js/validator-form.js"></script>
    <?php include('include/script.php');?>
    <!-- /script -->
    <script>
        Validator({
            form: '#frm-re-password',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [

                Validator.isRequired('#old-password'),
                Validator.isPassword('#old-password',6, 30),

                Validator.isRequired('#new-password'),
                Validator.isPassword('#new-password',6, 30),

                Validator.isRequired('#re-password'),
                Validator.isConfirmed('#re-password', function (){
                    return document.querySelector('#frm-re-password #new-password').value;
                }, 'Mật khẩu không trùng khớp'),
            ],
        });
    </script>
</body>
</html>