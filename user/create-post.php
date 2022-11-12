<?php
  include '../include/connect.php';
  include '../include/data.php';

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
            <form action="" method="post" enctype="multipart/form-data">
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
                <div class="form-address">
                    <div class="search-item">
                        <div class="item-name">Tỉnh/Thành phố</div>
                        <select class="autobox form-focus autobox-city boder-ra-5 "  name="city" id="city">
                            <!-- <option value="0">Chọn tỉnh</option> -->
                        </select>

                    </div>
                    <div class="search-item">
                        <div class="item-name">Quận/Huyện</div>
                        <select  class="autobox form-focus autobox-district boder-ra-5" name = "district" id="district">
                            <option value="0">Chọn huyện</option>
                        </select>

                    </div>
                    <div class="search-item">
                        <div class="item-name">Phường/Xã</div>
                        <select  class="autobox form-focus boder-ra-5" name ="ward" id="ward">
                            <option value="0">Chọn xã</option>
                        </select>

                    </div>
                    <div class="street-number">
                        <div class="item-name">Tên đường</div>
                        <input type="text" name="street" class="form-focus boder-ra-5" id="number" placeholder="VD: Lê Hồng Phong" minlength="5" required style="width: 230px "> 
                    </div>
                    <div class="street-number">
                        <div class="item-name">Số nhà</div>
                        <input type="text" name="number" class=" form-focus boder-ra-5" id="" placeholder="VD: Ngõ 5/80"  minlength="1" required style="width: 140px ">
                    </div>
                </div>
                <!-- <div class="full-address form-input">
                    <div class="item-name">Địa chỉ đầy đủ</div>
                    <input type="text" name="fullAdress" class=" boder-ra-5 input-disabled" id="fullAdress" style="width: 100% " required data-msg-required="Chưa chọn khu vực đăng tin" >
                </div> -->
                <div class="form-content">
                    <h3>Thông tin mô tả</h3>
                </div>
                <div class="search-item">
                    <div class="item-name">Chuyên mục bài đăng</div>
                    <select  class="autobox form-focus boder-ra-5" name = "category" id="ward" style="width: 25% ">
                        <option value="0">-- Chọn loại chuyên mục --</option>
                        <?php 
                            if(isset($dataCate)&&(count($dataCate)>1)){
                            foreach($dataCate as $list){
                                echo '<option value="'.$list['id'].'">'.$list['name'].'</option>';
                            }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-input">
                    <div class="item-name">Tiêu đề bài viết</div>
                    <input type="text" name="title" class="form-focus boder-ra-5" id="" style="width: 100%" id="post_title" value="" minlength="30" maxlength="120">
                </div>
                <div class="form-input">
                    <div class="item-name">Nội dung mô tả</div>
                    <textarea type="text" name="content" id="post_content" class="input-content form-focus boder-ra-5" rows="10"  required minlength="100" data-msg-required="Bạn chưa nhập nội dung" data-msg-minlength="Nội dung tối thiểu 100 kí tự"></textarea>
                    <label id="post_content-error" class="error" for="post_content"  style="color:red;">Nội dung tối thiểu 100 kí tự</label>
                </div>
                <div class="full-address form-input">
                    <div class="item-name">Thông tin liên hệ</div>
                    <input type="text" name="fullAdress" class=" boder-ra-5 input-disabled " id="" style="width: 340px;" disabled>
                </div>
                <div class="full-address form-input">
                    <div class="item-name">Điện thoại</div>
                    <input type="text" name="fullAdress" class=" boder-ra-5 input-disabled" id="" style="width: 340px;" disabled>
                </div>
                <div class="full-address form-input">
                    <div class="item-name">Giá cho thuê</div>
                    <div class="input-detail boder-ra-5">
                        <input type="number" name="fullAdress" class="input-content boder-ra-5" id=""  pattern="[0-9.]+" r data-msg-required="Bạn chưa nhập giá phòng" data-msg-min="Giá phòng chưa đúng" required>
                        <span class="input-disabled">Đồng</span>
                    </div>  
                    <p style="margin-top: 8px; color: #ff9900;">Vui lòng nhập đủ số tiền. Ví dụ 2 triệu: 2000000</p>                 
                </div>
                <div class="full-address form-input">
                    <div class="item-name">Diện tích</div>
                    <div class="input-detail boder-ra-5">
                        <input type="number" name="fullAdress" class="input-content boder-ra-5" id="" attern="[0-9.]+" name="dien_tich" max="1000" required="" data-msg-required="Bạn chưa nhập diện tích"  >
                        <span class="input-disabled">m&sup2;</span>
                    </div>                   
                </div>
                <div class="search-item">
                    <div class="item-name">Đối tượng cho thuê</div>
                    <select  class="autobox form-focus boder-ra-5" name = "subject" id="ward" style="width: 25% ">
                        <option value="0">Tất cả</option>
                        <option value="1">Nam</option>
                        <option value="2">Nữ</option>
                    </select>
                </div>
                <div class="input-file">
                    <div class="item-name">Tải hình ảnh</div>
                    <div class="input-img">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    Tải hình ảnh lên
                        <input type="file" class="upload-img" name="upload" id="upload-img" onchange = "ImageFileAsUrl()" multiple>
                    </div>
                    <div id="display-img">
                            
                    </div>
                </div>
                <div class="submit-form">
                    <input type="submit" class="btn btn-submit"  value="Tiếp tục" style = "width: 50%;height: 45px;font-size: 18px;">
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