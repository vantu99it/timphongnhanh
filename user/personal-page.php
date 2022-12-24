<?php
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <form action="" method="post">
                <div class="form-group row mt-5">
                    <span class="col-md-2 offset-md-2 col-form-label">Mã thành viên:</span>
                    <div class="col-md-6">
                        <input type="text" readonly="" class="form-control disable" id="user_id" value="#124674">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-md-2 offset-md-2 col-form-label">Số điện thoại:</span>
                    <div class="col-md-6">
                        <input type="phone" readonly="" class="form-control disable" id="user_phone" value="0927441096">
                        <div class="form-text text-muted">
                            <a style="display: inline-block; margin-top: 5px;" href="https://phongtro123.com/quan-ly/doi-so-dien-thoai.html">Đổi số điện thoại</a>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-md-2 offset-md-2 col-form-label">Tên hiển thị:</span>
                    <div class="col-md-6">
                        <input type="text" class="form-control valid" id="user_name" name="name" value="Nguyễn Văn Tú" placeholder="VD: Nguyễn Văn A" aria-invalid="false">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-md-2 offset-md-2 col-form-label">Email:</span>
                    <div class="col-md-6">
                        <input type="email" class="form-control" id="user_email" name="email" value="" placeholder="VD: timphongnhanh@gmail.com">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-md-2 offset-md-2 col-form-label">Zalo:</span>
                    <div class="col-md-6">
                        <input type="phone" class="form-control" id="phone_email" name="phone" value="" placeholder="">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-md-2 offset-md-2 col-form-label">Mật khẩu:</span>
                    <div class="col-md-6">
                        <div class="form-text text-muted">
                            <a style="display: inline-block; margin-top: 5px;" href="https://phongtro123.com/quan-ly/doi-so-dien-thoai.html">Đổi mật khẩu</a>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-5 input-file">
                    <label for="user_avatar" class="col-md-2 offset-md-2 col-form-label" style="padding-top: 0;">Ảnh đại diện</label>
                    <div class="col-md-6">
                        <div class="account-avt user-avatar-preview" style=" float: none; background: url(https://phongtro123.com/images/default-user.png) center no-repeat; background-size: cover; margin: 0 25px 10px;" id="display-img">
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
                        </div> <!-- end one_featured_image_wrapper -->
                    </div>
                </div>
            </form>
            
        </div>
        <!-- /main-right -->
    </div>
    <!-- script -->
    <?php include('include/script.php');?>
    <!-- /script -->
    
</body>
</html>