<?php
  include './include/connect.php';
  include './include/data.php';
  $err = "";
  if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $sql ="SELECT * FROM tbl_user WHERE username=:username and status = 1";
		$query= $conn -> prepare($sql);
		$query-> bindParam(':username', $user, PDO::PARAM_STR);
		$query-> execute();
		$results = $query->fetch(PDO::FETCH_OBJ);
        // var_dump($query->rowCount());
        // die();
		if($query->rowCount() > 0)
		{
            $checkPass = password_verify($pass, $results->password);
            // var_dump($checkPass);
            // die();
            if($checkPass){
                $_SESSION['login']['id']= $results->id;
                $_SESSION['login']['username']= $results->username;
                $_SESSION['login']['password']= $results->password;
                $_SESSION['login']['fullname']= $results->fullname;
                $_SESSION['login']['email']= $results->email;
                $_SESSION['login']['phone']= $results->phone;
                $_SESSION['login']['avatar']= $results->avatar;
                $_SESSION['login']['status']= $results->status;
                header('location: index.php');
            }else {
                $err = "1";
            }
            
		} else{
			$err = "1";
		}
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
    <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <div id="main"  class="mg-t90">
    <div class="container">
        <!--main-content -->
        <div id="post">
            <div class="post-header">
                <h1 class="page-title">Vui lòng đăng nhập để sử dụng các chức năng khác</h1>
            </div>
            <section class="section section-login">
                <div class="login">
                    <div class="section-header">
                        <h2 class="section-title">Đăng nhập</h2>
                    </div>
                    <?php if($err == 1){ ?>
                        <div class="errors">
                            <p>
                                <i class="fa-solid fa-triangle-exclamation" style=" margin-right: 5px;"></i>
                                Mật khẩu hoặc tài khoản không đúng, vui lòng thử lại
                            </p>
                        </div>
                    <?php } ?>
                <div class="section-content">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id = "frm-user-login">
                        <div class="form-contact form-validator">
                            <lable  class="contact-title form-validator">Tên đăng nhập</lable>
                            <input type="text" name="username" id="username">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <lable class="contact-title form-validator">Mật khẩu</lable>
                            <input type="password" name="password" id="password">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <input type="submit" name = "submit-form" value="Đăng nhập" class="btn btn-login">
                        </div>
                    </form>
                    <div class="form-footer">
                        <a style="float: left;" href="./">Bạn quên mật khẩu?</a>
                        <a style="float: right;" href="./register.php">Tạo tài khoản</a>
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
        Validator({
            form: '#frm-user-login',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#username'), 
                Validator.isRequired('#password'),    
            ],
        });
    </script>
</body>
</html>