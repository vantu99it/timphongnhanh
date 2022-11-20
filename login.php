<?php
  include './include/connect.php';
  include './include/data.php';
  $err = "";
  if(isset($_POST['submit'])&&($_POST['submit'])){
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $sql ="SELECT * FROM tbl_user WHERE UserName=:username and Password=:password";
		$query= $conn -> prepare($sql);
		$query-> bindParam(':username', $user, PDO::PARAM_STR);
		$query-> bindParam(':password', $pass, PDO::PARAM_STR);
		$query-> execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
            foreach($results as $row){
            $_SESSION['login']['username']= $row->username;
            $_SESSION['login']['password']= $row->password;
            $_SESSION['login']['fullname']= $row->fullname;
            $_SESSION['login']['email']= $row->email;
            $_SESSION['login']['phone']= $row->phone;
            $_SESSION['login']['address']= $row->address;
            }
			header('location: index.php');
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
    <title>Document</title>
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="form-contact">
                            <p class="contact-title">Tên đăng nhập</p>
                            <input type="text" name="username" id="">
                        </div>
                        <div class="form-contact">
                            <p class="contact-title">Mật khẩu</p>
                            <input type="password" name="password" id="">
                        </div>
                        <div class="form-contact">
                            <input type="submit" name = "submit" value="Đăng nhập" class="btn btn-login">
                        </div>
                    </form>
                    <div class="form-footer">
                        <a style="float: left;" href="./">Bạn quên mật khẩu?</a>
                        <a style="float: right;" href="http://">Tạo tài khoản</a>
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
    
  </body>
</html>