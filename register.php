<?php
  include './include/connect.php';
  include './include/data.php';
  $err = "";
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $rPass = $_POST['rpassword'];
    $fullName = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO tbl_user(username, password, fullname, email,phone) VALUE (:username, :password, :fullname, :email, :phone)";
    $query= $conn -> prepare($sql);
    $query->bindParam(':username',$user,PDO::PARAM_STR);
    $query->bindParam(':password',$pass,PDO::PARAM_STR);
    $query->bindParam(':fullname',$fullName,PDO::PARAM_STR);
    $query->bindParam(':phone',$phone,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $conn->lastInsertId();
    if($lastInsertId){
        header('location: home.php');
    }
    else 
    {
        $err = 1;
        $error = "Đã có lỗi xảy ra vui lòng kiểm tra lại!";
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
    <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <div id="main" class="mg-t90">
      <div class="container">
        <!--main-content -->
        <div id="post">
            <div class="post-header">
                <h1 class="page-title">Hãy đăng ký tài khoản ngay để đăng bài nhé</h1>
            </div>

            <section class="section section-login">
                <div class="login">
                    <div class="section-header">
                        <h2 class="section-title">Đăng ký tài khoản</h2>
                    </div>
                    <?php if($err == 1){ ?>
                    <div class="errors">
                        <p>
                            <i class="fa-solid fa-triangle-exclamation" style=" margin-right: 5px;"></i>
                            <?php echo $error?>
                        </p>
                    </div>
                    <?php } ?>
                    <div class="section-content">
                        
                        <form action="" method="post" id = "frm-register">
                            <div class="form-contact form-group">
                                <lable class="contact-title">Tên đăng nhập</lable>
                                <input type="text" name="username" rules = "required"   id="username">
                                <span class="form-message"></span>
                            </div>
                            <!-- pattern="[0-9a-z]{1,15}" -->
                            <div class="form-contact form-group">
                                <lable class="contact-title">Mật khẩu</lable>
                                <input type="password" name="password" id="password" rules = "required|min:6" >
                                <span class="form-message"></span>
                            </div>
                            <!-- minlength="6" -->
                            <div class="form-contact form-group">
                                <lable class="contact-title">Nhập lại mật khẩu</lable>
                                <input type="password" name="rpassword" id="rpassword" rules = "required">
                                <span id = "pass-err" class="form-message"></span>
                            </div> 
                            <div class="form-contact form-group">
                                <lable class="contact-title">Tên đầy đủ</lable>
                                <input type="text" name="fullname" id="fullname" rules = "required" >
                                <span class="form-message"></span>
                            </div>
                            <!-- pattern="[A-Za-z]+" -->
                            <div class="form-contact form-group">
                                <lable class="contact-title">Số điện thoại</lable>
                                <input type="text" name="phone" id="phone" rules = "required">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-contact form-group">
                                <lable class="contact-title">Email</lable>
                                <input type="email" name="email" id="email" rules = "required|email">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-contact">
                                <input type="submit" name = "submit-login" value="Đăng ký" class="btn btn-login">
                            </div>
                        </form>
                        <div class="form-footer">
                            <a style="float: right;" href="./login.php">Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- main-content -->
        <!-- why-support -->
        <?php include('./include/why-support.php');?>
        <!-- /why-support -->
      </div>
    </div>

    <!-- footer + js-->
    <?php include('./include/footer.php');?>
    <!-- /footer + js -->
    <script>
        Validator('#frm-register');





        // var input = document.getElementById('username');
        // input.oninvalid = function(event) {
        //     event.target.setCustomValidity('Tên tài khoản chấp nhận chữ thường, số liền nhau. Ví dụ timphong12 - timphongnhanh123 - tencuaban ');
        // }

    </script>
  </body>
</html>