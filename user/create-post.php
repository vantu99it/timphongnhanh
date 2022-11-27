<?php
  include '../include/connect.php';
  include '../include/data.php';

//   if(isset($_POST['submit'])&&($_POST['submit'])){
//     $city = $_POST['city'];
//     $district = $_POST['district'];
//     $ward = $_POST['ward'];
//     $street = $_POST['street'];
//     $number = $_POST['number'];
//     $title = $_POST['title'];
//     $content = $_POST['content'];
//     $district = $_POST['district'];
//     $district = $_POST['district'];
//     $district = $_POST['district'];
//   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin cá nhân</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Đăng tin mới</li>
                </ol>
            </nav>
            <form action="" method="post" enctype="multipart/form-data" id = "frm-post">
                <div class="form-title">
                    <h1>Tạo tin đăng mới</h1>
                </div>
                <div class="form-note">
                    <h4>Lưu ý khi đăng tin</h4>
                    <ul>
                        <li style="list-style-type: square; margin-left: 15px;">Nội dung phải viết bằng tiếng Việt có dấu</li>
                        <li style="list-style-type: square; margin-left: 15px;">Tiêu đề tin không dài quá 100 kí tự</li>
                        <li style="list-style-type: square; margin-left: 15px;">Các bạn nên điền đầy đủ thông tin vào các mục để tin đăng có hiệu quả hơn.</li>
                        <li style="list-style-type: square; margin-left: 15px;">Tin đăng có hình ảnh rõ ràng sẽ được xem và gọi gấp nhiều lần so với tin rao không có ảnh. Hãy đăng ảnh để được giao dịch nhanh chóng!</li>
                    </ul>
                </div>
                <div class="form-content">
                    <h3>Địa chỉ cho thuê</h3>
                </div>
                <div class="form-address form-validator" >
                    <div class="search-item form-validator">
                        <p class="item-name">Tỉnh/Thành phố</p>
                        <select class="autobox form-focus autobox-city boder-ra-5 "  name="city" id="city">
                            <!-- <option value="0">Chọn tỉnh</option> -->
                        </select>
                        <span class="form-message"></span>

                    </div>
                    <div class="search-item form-validator">
                        <p class="item-name">Quận/Huyện</p>
                        <select  class="autobox form-focus autobox-district boder-ra-5" name = "district" id="district">
                            <option value="0">Chọn huyện</option>
                        </select>
                        <span class="form-message"></span><span class="form-message"></span>

                    </div>
                    <div class="search-item form-validator">
                        <p class="item-name">Phường/Xã</p>
                        <select  class="autobox form-focus boder-ra-5" name ="ward" id="ward">
                            <option value="0">Chọn xã</option>
                        </select>
                        <span class="form-message"></span>
                    </div>
                    <div class="street-number form-validator">
                        <p class="item-name">Tên đường</p>
                        <input type="text" name="street" class="form-focus boder-ra-5" id="street-names" placeholder="VD: Lê Hồng Phong" style="width: 230px "> 
                        <p class="form-message"></p>
                    </div>
                    <div class="street-number form-validator">
                        <p class="item-name">Số nhà</p>
                        <input type="text" name="apartment" class=" form-focus boder-ra-5" id="apartment" placeholder="VD: Ngõ 5/80"  style="width: 140px ">
                        <p class="form-message"></p>
                    </div>
                </div>
                <!-- <div class="full-address form-input">
                    <p class="item-name">Địa chỉ đầy đủ</p>
                    <input type="text" name="fullAdress" class=" boder-ra-5 input-disabled" id="fullAdress" style="width: 100% " required data-msg-required="Chưa chọn khu vực đăng tin" >
                </div> -->
                <div class="form-content">
                    <h3>Thông tin mô tả</h3>
                </div>
                <div class="search-item form-validator">
                    <p class="item-name">Chuyên mục bài đăng</p>
                    <select  class="autobox form-focus boder-ra-5" name = "category" id="category" style="width: 25% ">
                        <option value="">-- Chọn loại chuyên mục --</option>
                        <?php 
                            if(isset($dataCate)&&(count($dataCate)>1)){
                            foreach($dataCate as $list){
                                echo '<option value="'.$list['id'].'">'.$list['name'].'</option>';
                            }
                            }
                        ?>
                    </select>
                    <p class="form-message"></p>
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Tiêu đề bài viết</p>
                    <input type="text" name="title" class="form-focus boder-ra-5" style="width: 100%" id="post_title" value="" maxlength="120">
                    <span class="form-message"></span>
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Nội dung mô tả</p>
                    <textarea type="text" name="post_content" id="post_content" class="input-content form-focus boder-ra-5" rows="20" ></textarea>
                    <span class="form-message"></span>
                </div>
                <div class="form-input " >
                    <p class="item-name">Thông tin liên hệ</p>
                    <input type="text" name="full-name" class=" boder-ra-5 input-disabled " id="" style="width: 340px;" disabled>
                </div>
                <div class="form-input ">
                    <p class="item-name">Điện thoại</p>
                    <input type="text" name="phone" class=" boder-ra-5 input-disabled" id="" style="width: 340px;" disabled>
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Giá cho thuê</p>
                    <div class="input-detail boder-ra-5">
                        <input type="number" name="price" class="input-content boder-ra-5 mask" id="price" style="margin: 0;" >
                        <span class="input-disabled">Đồng</span>
                    </div>  
                    <p style="margin-top: 8px; color: #ff9900;" >Vui lòng nhập đủ số tiền. Ví dụ 2 triệu: 2000000</p>   
                    <span class="form-message"></span>              
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Diện tích</p>
                    <div class="input-detail boder-ra-5">
                        <input type="number" name="area" class="input-content boder-ra-5" id="area" style="margin: 0;" >
                        <span class="input-disabled">m&sup2;</span>
                    </div>         
                    <span class="form-message"></span>          
                </div>
                <div class="search-item form-validator">
                    <p class="item-name">Đối tượng cho thuê</p>
                    <select  class="autobox form-focus boder-ra-5" name = "subject" id="subject" style="width: 25% ">
                        <option value="1">Tất cả</option>
                        <option value="2">Nam</option>
                        <option value="3">Nữ</option>
                    </select>
                    <span class="form-message"></span>
                </div>
                <div class="input-file form-validator">
                    <p class="item-name">Tải hình ảnh</p>
                    <div class="input-img">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        Tải hình ảnh lên
                        <input type="file" class="upload-img" name="upload" id="upload-img" onchange = "ImageFileAsUrl()" multiple>
                    </div>
                    <div id="display-img">
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="submit-form">
                    <input type="submit" name="submit-form" class="btn btn-submit"  value="Tiếp tục" style = "width: 50%;height: 45px;font-size: 18px;">
                </div>
            </form>
        </div>
        <!-- /main-right -->
    </div>
    
    <!-- script -->
    <?php include('include/script.php');?>
    <!-- /script -->
    
    <script>
        Validator({
            form: '#frm-post',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#street-names', 'Vui lòng nhập tên đường'), 
                Validator.isRequired('#apartment', 'Vui lòng nhập số nhà'),
                Validator.isRequired('#category', 'Vui lòng lựa chọn chuyên mục'),

                Validator.isRequired('#post_title', 'Vui lòng nhập tiêu đề bài viết'),
                Validator.minMaxLength('#post_title',30,120, 'Tiêu đề tối thiểu 30 và tối đa 120 ký tự'),

                Validator.isRequired('#post_content', 'Vui lòng nhập mô tả chi tiết vài viết'),
                Validator.minLength('#post_content',120, 'Mô tả phải nhập ít nhất 120 ký tự'),

                Validator.isRequired('#price', 'Vui lòng nhập giá cho thuê'),
                Validator.isRequired('#area', 'Vui lòng nhập diện tích'),
                Validator.numberMin('#area', 10, 'Diện tích phải >= 10'),
                Validator.isRequired('#upload-img', 'Vui lòng tải lên ít nhất 1 hình ảnh'),
                
            ],
        });
        

    </script>
    <script>
        CKEDITOR.replace('post_content');
    </script>
</body>
</html>