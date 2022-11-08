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
                        <select  class="autobox autobox-city " name = "city" id="city">
                            <option value="0">Chọn tỉnh</option>
                        </select>
                    </div>
                    <div class="search-item">
                        <div class="item-name">Quận/Huyện</div>
                        <select  class="autobox autobox-district" name = "district" id="district">
                            <option value="0">Chọn huyện</option>
                        </select>
                    </div>
                    <div class="search-item">
                        <div class="item-name">Phường/Xã</div>
                        <select  class="autobox" name ="ward" id="ward">
                            <option value="0">Chọn xã</option>
                        </select>
                    </div>
                    <div class="street-number">
                        <div class="item-name">Tên đường</div>
                        <input type="text" name="street" id="" placeholder="Tên đường" style="width: 230px ">
                    </div>
                    <div class="street-number">
                        <div class="item-name">Số nhà</div>
                        <input type="text" name="number" id="" placeholder="Số nhà" style="width: 100px ">
                    </div>
                </div>
                <div class="full-address form-input">
                    <div class="item-name">Địa chỉ đầy đủ</div>
                    <input type="text" name="fullAdress" id="" style="width: 100% " disabled>
                </div>
                <div class="form-content">
                    <h3>Thông tin mô tả</h3>
                </div>
                <div class="search-item">
                    <div class="item-name">Chuyên mục bài đăng</div>
                    <select  class="autobox" name = "category" id="ward" style="width: 25% ">
                        <option value="0">-- Chọn loại chuyên mục --</option>
                    </select>
                </div>
                <div class="form-input">
                    <div class="item-name">Địa chỉ đầy đủ</div>
                    <input type="text" name="title" id="" style="width: 100%" id="post_title" value="" minlength="30" maxlength="120" required="" data-msg-required="Tiêu đề không được để trống" data-msg-minlength="Tiêu đề quá ngắn" data-msg-maxlength="Tiêu đề quá dài">
                </div>
                <div class="form-input">
                    <div class="item-name">Nội dung mô tả</div>
                    <textarea type="text" name="content" id="post_content" style="width: 100%;" rows="10"  required="" minlength="100" data-msg-required="Bạn chưa nhập nội dung" data-msg-minlength="Nội dung tối thiểu 100 kí tự"></textarea>
                    <label id="post_content-error" class="error" for="post_content"  style="color:red;">Nội dung tối thiểu 100 kí tự</label>
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