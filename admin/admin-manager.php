<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $queryAdmin = $conn->prepare("SELECT * FROM tbl_admin");
    $queryAdmin->execute();
    $resultsAdmin = $queryAdmin->fetchAll(PDO::FETCH_OBJ);

    $err = "";
    $ok = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-form']) ){
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $rPass = $_POST['password-confirmation'];
        $fullName = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
    // Check xem đã tồn tại chưa
        $sqlCheck ="SELECT * FROM tbl_admin WHERE username=:username OR phone=:phone OR email=:email";
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
            $sql = "INSERT INTO tbl_admin(username, password, fullname, email,phone) VALUE (:username, :password, :fullname, :email, :phone)";
            $query= $conn -> prepare($sql);
            $query->bindParam(':username',$user,PDO::PARAM_STR);
            $query->bindParam(':password',$passHash,PDO::PARAM_STR);
            $query->bindParam(':fullname',$fullName,PDO::PARAM_STR);
            $query->bindParam(':phone',$phone,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $conn->lastInsertId();
            if($lastInsertId){
                $ok = 1;
                $successful = "Tạo tài khoản thành công!";
                 header("Location: ./admin-manager.php");
            }
            else 
            {
                $err = 1;
                $error = "Đã có lỗi xảy ra vui lòng kiểm tra lại!";
            }
        }
    }
    // Cập nhật
    $updateId = isset($_GET['id'])?$_GET['id']:'';
    if($updateId){
        $queryUpdate = $conn->prepare("SELECT * FROM tbl_admin WHERE ID = $updateId");
        $queryUpdate->execute();
        $resultsUpdate = $queryUpdate->fetch(PDO::FETCH_OBJ);
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-form'])){
        $passOld = $_POST['old-password'];
        $passNew = $_POST['new-password'];
        $rPass = $_POST['password-confirmation'];
        $fullName = $_POST['fullname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        
        if (empty($passOld) || empty($passNew)|| empty($rPass)){
            $sql = "UPDATE tbl_admin SET fullname = :fullname, email = :email, phone = :phone, status = :status WHERE id = $updateId ";
            $query= $conn -> prepare($sql);
            $query->bindParam(':fullname',$fullName,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->bindParam(':phone',$phone,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->execute();
            if($query){
                header('location: ./admin-manager.php');
            }else{
                $err = 'Đã xảy ra lỗi, vui lòng thử lại';
            }
        }else{
            if($checkPass = password_verify($passOld, $resultsUpdate->password)){
                $sql = "UPDATE tbl_admin SET password = :password, fullname = :fullname, email = :email, phone = :phone, status = :status WHERE id = $updateId ";
                $query= $conn -> prepare($sql);
                $query->bindParam(':password',$passNew,PDO::PARAM_STR);
                $query->bindParam(':fullname',$fullName,PDO::PARAM_STR);
                $query->bindParam(':email',$email,PDO::PARAM_STR);
                $query->bindParam(':phone',$phone,PDO::PARAM_STR);
                $query->bindParam(':status',$status,PDO::PARAM_STR);
                $query->execute();
                if($query){
                    header('location: ./admin-manager.php');
                }else{
                    $err = 'Đã xảy ra lỗi, vui lòng thử lại';
                }
            }else{
                $err = 'Đã xảy ra lỗi, vui lòng thử lại';
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
    <title>Admin | Quản lý tài khoản Admin</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Quản lý tài khoản Admin</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý tài khoản Admin</h1>
                </div>
                <div class="account-btn">
                <button class="btn btn-post btn-add">Tạo tài khoản admin</button>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >ID</th>
                            <th style="width: 15%;" >Tên đẩy đủ</th>
                            <th style="width: 15%;" >Tên đăng nhập</th>
                            <th style="width: 20%;" >Email</th>
                            <th style="width: 10%;" >Số điện thoại</th>
                            <th style="width: 10%;" >Ngày tạo</th>
                            <th style="width: 15%;" >Trạng thái</th>
                            <th style="width: 10%;" >Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsAdmin as $key => $value) { ?>
                            <tr>
                                <td>#<?php echo $value -> id ?></td>
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
                                    <a href="./admin-manager.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /main-right -->
        <div class="form-act">
            <div class="form-act-edit">
                <div class="form-close">
                    <i class="fa-solid fa-x"></i>
                </div>
                <form action="" method="post" id="frm-createAdmin">
                    <h2>Tạo tài khoản Admin</h2>
                    <div class="form-half">
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Tên đăng nhập</lable>
                            <input type="text" name="username"  id="username"placeholder="VD: timphong123">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Tên đầy đủ</lable>
                            <input type="text" name="fullname" id="fullname"  placeholder="VD: Nguyễn Văn A">
                            <span class="form-message"></span>
                        </div>
                    </div>
                    <div class="form-half">
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Mật khẩu</lable>
                            <input type="password" name="password" id="password" placeholder="VD: Timphong123@">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator ">
                            <lable class="contact-title">Nhập lại mật khẩu</lable>
                            <input type="password" name="password-confirmation"  id="password-confirmation" placeholder="VD: Timphong123@">
                            <span id = "pass-err" class="form-message"></span>
                        </div> 
                    </div>
                    <div class="form-half">
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
                    </div>
                    <input type="hidden" name="add-form" value = "1">
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="add-forms" value="Tạo mới" class="btn add-form" id = "add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if(isset($_GET['id'])){?>
        <div class="form-act form-animation" style ="display: block;">
            <div class="form-act-edit">
                <div class="form-close">
                    <a href="./admin-manager.php"><i class="fa-solid fa-x"></i></a>
                </div>
                <form action="" method="post" id ="frmAdminUpdate">
                    <h2>Chỉnh sửa người dùng</h2>
                    <p style = "color: #d59300;">Nếu không thay đổi mật khẩu hãy bỏ qua các ô nhập mật khẩu</p>
                    <?php if($err == 1){ ?>
                        <div class="errors">
                            <p>
                                <i class="fa-solid fa-triangle-exclamation" style=" margin-right: 5px;"></i>
                                <?php echo $error ?>
                            </p>
                        </div>
                    <?php } ?>
                    <div class="form-contact form-validator">
                        <lable class="contact-title">Tên đăng nhập</lable>
                        <input type="text" name="username"  id="username-Update" value = "<?php echo $resultsUpdate -> username ?>" disabled>
                        <span class="form-messages"></span>
                    </div>
                    <div class="form-half">
                        <div class="form-contact form-validator">
                            <lable class="contact-title">Tên đầy đủ</lable>
                            <input type="text" name="fullname" id="fullname-Update" value = "<?php echo $resultsUpdate -> fullname ?>" >
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <lable class="contact-title">Mật khẩu cũ</lable>
                            <input type="password" name="old-password" id="old-password-Update" >
                            <span class="form-message"></span>
                        </div>
                    </div>
                    <div class="form-half">
                        <div class="form-contact form-validator">
                            <lable class="contact-title">Mật khẩu mới</lable>
                            <input type="password" name="new-password" id="new-password-Update" >
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <lable class="contact-title">Nhập lại mật khẩu</lable>
                            <input type="password" name="password-confirmation"  id="password-confirmation-Update">
                            <span class="form-message"></span>
                        </div> 
                    </div>
                    <div class="form-half">
                        <div class="form-contact form-validator">
                            <lable class="contact-title">Số điện thoại</lable>
                            <input type="text" name="phone" id="phone-Update" value = "<?php echo $resultsUpdate -> phone ?>">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <lable class="contact-title">Email</lable>
                            <input type="email" name="email" id="email-Update" value = "<?php echo $resultsUpdate -> email ?>">
                            <span class="form-message"></span>
                        </div>
                    </div>
                    <div class="status" style = "margin-top: 10px;">
                        <label style = "margin-right: 15px;">
                            <input type="radio" name="status" id="" value ="1" <?php if($resultsUpdate->status == 1) echo  "checked = 'Checked'" ?>> Hoạt động

                        </label>
                        <label>
                            <input type="radio" name="status" value ="0" <?php if($resultsUpdate->status == 0) echo  "checked = 'Checked'" ?> id="" > Ngừng hoạt động
                        </label>
                    </div>
                    <input type="hidden" name="update-form" value = "1">
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="update-form" value="Cập nhật" class="btn update-form ">
                    </div>
                </form>
            </div>
        </div>
        <?php }?>
    </div>
    <!-- footer + js -->
    <?php include('include/footer.php');?>
    <!-- /footer + js -->

    <script>
        Validator({
            form: '#frm-createAdmin',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#username'), 
                Validator.minLength('#username',4,'Tên đăng nhập phải chứa ít nhất 4 ký tự'), 
                Validator.maxLength('#username',20,'Tên đăng nhập chứa tối đa 20 ký tự'),  

                Validator.isRequired('#password'),
                Validator.isPassword('#password',6, 30),
                Validator.isRequired('#password-confirmation'),
                Validator.isConfirmed('#password-confirmation', function (){
                    return document.querySelector('#frm-createAdmin #password').value;
                }, 'Mật khẩu không trùng khớp'),

                Validator.isRequired('#fullname'),

                Validator.isRequired('#phone'),
                Validator.isPhone('#phone', 'Số điện thoại gồm 10 số và bắt đầu từ số 0'),

                Validator.isRequired('#email'),
                Validator.isEmail('#email'),
            ],
        });
        
    </script>
    <script>
        Validator({
            form: '#frmAdminUpdate',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isConfirmed('#password-confirmation-Update', function (){
                    return document.querySelector('#frmAdminUpdate #new-password-Update').value;
                }, 'Mật khẩu không trùng khớp'),
            ],
        });
        
    </script>
</body>
</html>