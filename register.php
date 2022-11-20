<?php
  include './include/connect.php';
  include './include/data.php';
  if(isset($_POST['submit'])&&($_POST['submit'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $rPass = $_POST['rpassword'];
    $fullName = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

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
                        <h2 class="section-title">Đăng nhập</h2>
                    </div>
                    <div class="errors">
                        <p>
                            <i class="fa-solid fa-triangle-exclamation" style=" margin-right: 5px;"></i>
                            Mật khẩu hoặc tài khoản không đúng, vui lòng thử lại
                        </p>
                    </div>

                <div class="section-content">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="form-contact">
                            <p class="contact-title">Tên đăng nhập</p>
                            <input type="text" name="username" required pattern="[0-9a-z]{1,15}"  id="username">
                        </div>
                        <div class="form-contact">
                            <p class="contact-title">Mật khẩu</p>
                            <input type="password" name="password" id="password" required minlength="6">
                        </div>
                        <div class="form-contact">
                            <p class="contact-title">Nhập lại mật khẩu</p>
                            <input type="password" name="rpassword" id="rpassword" required>
                        </div>
                        <div class="form-contact">
                            <p class="contact-title">Tên đầy đủ</p>
                            <input type="text" name="fullname" id="fullname" required pattern="[A-Za-z]+">
                        </div>
                        <div class="form-contact">
                            <p class="contact-title">Số điện thoại</p>
                            <input type="text" name="phone" id="phone" required>
                        </div>
                        <div class="form-contact">
                            <p class="contact-title">Email</p>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-contact">
                            <input type="submit" name = "submit" value="Đăng nhập" class="btn btn-login">
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
        var input = document.getElementById('username');
        input.oninvalid = function(event) {
            event.target.setCustomValidity('Tên tài khoản chấp nhận chữ thường, số liền nhau. Ví dụ timphong12 - timphongnhanh123 - tencuaban ');
        }
    </script>
  </body>
</html>