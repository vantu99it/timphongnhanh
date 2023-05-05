<?php
  include './include/connect.php';
  include './include/data.php';
  $err = "";
  $ok = "";
  if($_SERVER["REQUEST_METHOD"] == "POST" ){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $rPass = $_POST['password-confirmation'];
    $fullName = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

   // Check xem đã tồn tại chưa
    $sqlCheck ="SELECT * FROM tbl_user WHERE UserName=:username OR phone=:phone OR email=:email";
    $queryCheck= $conn -> prepare($sqlCheck);
    $queryCheck-> bindParam(':username', $user, PDO::PARAM_STR);
    $queryCheck-> bindParam(':phone', $phone, PDO::PARAM_STR);
    $queryCheck-> bindParam(':email', $email, PDO::PARAM_STR);
    $queryCheck-> execute();
    $results = $queryCheck->fetch(PDO::FETCH_OBJ);
    if($queryCheck->rowCount() > 0){
        if($user == $results->username){
            $err = 1;
            $error = "Tên đăng nhập đã tồn tại! Xin vui lòng thử lại";
        }elseif ($phone == $results->phone) {
            $err = 1;
            $error = "SĐT đã tồn tại! Xin vui lòng thử lại";
        }elseif ( $email == $results->email ) {
            $err = 1;
            $error = "Email đã tồn tại! Xin vui lòng thử lại";
        }
        
    }else{
        $passHash = password_hash($pass,PASSWORD_DEFAULT);
        $sql = "INSERT INTO tbl_user(username, password, fullname, email,phone,zalo) VALUE (:username, :password, :fullname, :email, :phone, :zalo)";
        $query= $conn -> prepare($sql);
        $query->bindParam(':username',$user,PDO::PARAM_STR);
        $query->bindParam(':password',$passHash,PDO::PARAM_STR);
        $query->bindParam(':fullname',$fullName,PDO::PARAM_STR);
        $query->bindParam(':phone',$phone,PDO::PARAM_STR);
        $query->bindParam(':zalo',$phone,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $conn->lastInsertId();
        if($lastInsertId){
            $ok = 1;
            $successful = "Tạo tài khoản thành công! Đăng nhập ngay nhé!";
        }
        else 
        {
            $err = 1;
            $error = "Đã có lỗi xảy ra vui lòng kiểm tra lại!";
        }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký tài khoản</title>
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
                <h1 class="page-title">Hãy đăng ký tài khoản ngay để đăng bài và sử dụng các chức năng khác nhé</h1>
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
                    <?php } 
                    if ($ok == 1){  ?>
                        <div class="successful">
                            <p>
                                <i class="fa-regular fa-circle-check" style=" margin-right: 5px;"></i>
                                <?php echo $successful?>
                            </p>
                        </div>

                        <a style = "text-align: center;display: block;font-size: 18px;" href="./login.php"> >> Đăng nhập ngay</a>

                    <?php } ?>
                    <div class="section-content">
                        <form action="" method="post" id = "frm-register">
                            <div class="form-contact form-validator ">
                                <lable class="contact-title">Tên đăng nhập</lable>
                                <input type="text" name="username"  id="username"placeholder="VD: timphong123">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-contact form-validator ">
                                <lable class="contact-title">Mật khẩu</lable>
                                <input type="password" name="password" id="password-new" placeholder="VD: Timphong123@" oninput="checkInput()">
                                <div id="error1" style="display: none;"></div>
                                <div id="error2" style="display: none;"></div>
                                <div id="error3" style="display: none;"></div>
                                <div id="error4" style="display: none;"></div>
                                <div id="error5" style="display: none;"></div>
                                <!-- <span class="form-message"></span> -->
                            </div>

                            <div class="form-contact form-validator ">
                                <lable class="contact-title">Nhập lại mật khẩu</lable>
                                <input type="password" name="password-confirmation"  id="password-confirmation" placeholder="VD: Timphong123@">
                                <span id = "pass-err" class="form-message"></span>
                            </div> 
                            <div class="form-contact form-validator ">
                                <lable class="contact-title">Tên đầy đủ</lable>
                                <input type="text" name="fullname" id="fullname"  placeholder="VD: Nguyễn Văn A">
                                <span class="form-message"></span>
                            </div>

                            <div class="form-contact form-validator ">
                                <lable class="contact-title">Số điện thoại</lable>
                                <input type="text" name="phone" id="phone" placeholder="VD: 0932379943">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-contact form-validator ">
                                <lable class="contact-title">Email</lable>
                                <input type="email" name="email" id="email" placeholder="VD: timphongnhanh@gmail.com">
                                <span class="form-message"></span>
                            </div>                            
                            <div class="form-contact">
                                <input type="submit" name = "submit-form" value="Đăng ký" class="btn btn-login submit-button" >
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
        Validator({
            form: '#frm-register',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#username'), 
                Validator.minLength('#username',4,'Tên đăng nhập phải chứa ít nhất 4 ký tự'), 
                Validator.maxLength('#username',20,'Tên đăng nhập chứa tối đa 20 ký tự'), 
                Validator.isUserName('#username', 'Tên đăng nhập chỉ bao gồm chữ cái, số, không chứa khoảng trống'), 

                // Validator.isRequired('#password-new'),
                // Validator.isPassword('#password-new',6, 30),

                Validator.isRequired('#password-confirmation'),
                Validator.isConfirmed('#password-confirmation', function (){
                    return document.querySelector('#frm-register #password-new').value;
                }, 'Mật khẩu không trùng khớp'),

                Validator.isRequired('#fullname'),

                Validator.isRequired('#phone'),
                Validator.isPhone('#phone', 'Số điện thoại gồm 10 số và bắt đầu từ số 0'),

                Validator.isRequired('#email'),
                Validator.isEmail('#email'),
            ],
        });
    </script>

  </body>
</html>