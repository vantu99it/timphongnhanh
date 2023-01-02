<?php
  include '../include/connect.php';
  include '../include/data.php';
  include '../include/func-slug.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];
    // Gọi ra loại tin 
    $queryType = $conn->prepare("SELECT * FROM tbl_new_type WHERE status = 1");
    $queryType->execute();
    $resultsType = $queryType->fetchAll(PDO::FETCH_OBJ);

    // Lấy thông tin bài đăng theo id
    $idRoom = $_GET['id'];

    $queryRoom = $conn->prepare("SELECT r.*, ca.name as category, pay.pay_status, ci.name as city, dis.name as district, wa.name as ward,ty.name_type, ty.price as price_type FROM tbl_rooms r join tbl_categories ca on ca.id = r.category_id join tbl_payment_history pay on pay.id_rooms = r.id join tbl_city ci on ci.id = r.city_id join tbl_district dis on dis.id = r.district_id join tbl_ward wa on wa.id = r.ward_id join tbl_new_type ty on ty.id = r.news_type_id WHERE r.id = :id");
    $queryRoom-> bindParam(':id', $idRoom, PDO::PARAM_STR);
    $queryRoom->execute();
    $resultsRoom = $queryRoom->fetch(PDO::FETCH_OBJ);

    // Gọi ra ảnh chi tiết của bài đăng
    $queryImage = $conn->prepare("SELECT * FROM tbl_rooms_image WHERE id_rooms = :id");
    $queryImage-> bindParam(':id', $idRoom, PDO::PARAM_STR);
    $queryImage->execute();
    $resultsImage = $queryImage->fetchAll(PDO::FETCH_OBJ);

    $err = "";
    $ok = "";
    $message = "";
    $header="";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $street = $_POST['street'];
        $apartment = $_POST['apartment'];
        $category = $_POST['category'];
        $title = $_POST['title'];
        $slug = vn2en($title);
        $post_content = $_POST['post_content'];
        $price = (int) $_POST['price'];
        $area = $_POST['area'];
        $subject = $_POST['subject'];
        if(isset($_GET['giahan'])){
            $new_type = $_POST['new-type'];
            $time_start= $_POST['time-start'];
            $time_stop = $_POST['time-end'];
            $date = (strtotime($time_stop) - strtotime($time_start))/60/60/24;
            $getdate = date('H:i:s');
            $start = date_format(date_create($getdate.$time_start),"Y-m-d H:i:s");
            $stop = date_format(date_create($getdate.$time_stop),"Y-m-d H:i:s");
        }
        if(isset($_GET['edit'])){
            $new_type = $resultsRoom -> news_type_id;
            $start =  $resultsRoom -> time_start;
            $stop = $resultsRoom -> time_stop;
        }
        if(isset($_FILES["upload-img"])){
            $imagePNG = $_FILES["upload-img"]["name"];
            if(empty($imagePNG)){
                $target_file = $resultsRoom->image_logo;
            }else{
            $imageName = vn2en($imagePNG);  
            $target_dir = "./image/upload/";
            $target_file = $target_dir.$imageName;
            move_uploaded_file($_FILES["upload-img"]["tmp_name"],'../image/upload/'.$imageName); 
            }      
        } 
        if(isset($_FILES["upload-imgs"])){
            $imagePNGs = $_FILES["upload-imgs"]["name"];
            if(!empty($imagePNGs[0])){
                $queryDelImg= $conn -> prepare("DELETE FROM tbl_rooms_image WHERE id_rooms = :id");
                $queryDelImg->bindParam(':id',$idRoom,PDO::PARAM_STR);
                $queryDelImg->execute();

                $imageNames = vn2en($imagePNGs);
                foreach ($imageNames as $key => $value) {
                    move_uploaded_file($_FILES["upload-imgs"]["tmp_name"][$key],'../image/upload/'.$value);       
                }
                foreach ($imageNames as $key => $value) {
                    $target_dirs = "./image/upload/";
                    $target_files = $target_dirs.$value;
                    $sqlImg = "INSERT INTO tbl_rooms_image (id_rooms,image) VALUE (:id_rooms,:image)";
                    $queryImg= $conn -> prepare($sqlImg);
                    $queryImg->bindParam(':id_rooms',$idRoom,PDO::PARAM_STR);
                    $queryImg->bindParam(':image',$target_files,PDO::PARAM_STR);
                    $queryImg->execute();
                }
            }
            
        }
        $sql = "UPDATE tbl_rooms SET name = :name, slug = :slug , street = :street , apartment_number = :apartment_number, price = :price, area = :area, contents = :contents, image_logo = :image_logo, subject = :subject, user_id = :user_id, category_id = :category_id, news_type_id = :news_type_id,  time_start = :time_start, time_stop = :time_stop, status = 1, created_ad = now(), updated_ad = now() WHERE id = :id";
        $query= $conn -> prepare($sql);
        $query->bindParam(':name',$title,PDO::PARAM_STR);
        $query->bindParam(':slug',$slug,PDO::PARAM_STR);
        $query->bindParam(':street',$street,PDO::PARAM_STR);
        $query->bindParam(':apartment_number',$apartment,PDO::PARAM_STR);
        $query->bindParam(':price',$price,PDO::PARAM_STR);
        $query->bindParam(':area',$area,PDO::PARAM_STR);
        $query->bindParam(':contents',$post_content,PDO::PARAM_STR);
        $query->bindParam(':image_logo',$target_file,PDO::PARAM_STR);
        $query->bindParam(':subject',$subject,PDO::PARAM_STR);
        $query->bindParam(':user_id',$id_user ,PDO::PARAM_STR);
        $query->bindParam(':category_id',$category,PDO::PARAM_STR);
        $query->bindParam(':news_type_id',$new_type,PDO::PARAM_STR);
        $query->bindParam(':time_start',$start,PDO::PARAM_STR);
        $query->bindParam(':time_stop',$stop,PDO::PARAM_STR);
        $query->bindParam(':id',$idRoom,PDO::PARAM_STR);
        $query->execute();

        if($query && isset($_GET['giahan'])){
            // insert id vào bảng thanh toán
            $sqlPayment = "INSERT INTO tbl_payment_history(id_rooms,user_id,news_type_id ) VALUE (:id_rooms,:user_id,:news_type_id)";
            $queryPayment= $conn -> prepare($sqlPayment);
            $queryPayment->bindParam(':id_rooms',$idRoom,PDO::PARAM_STR);
            $queryPayment->bindParam(':user_id',$id_user,PDO::PARAM_STR);
            $queryPayment->bindParam(':news_type_id',$new_type,PDO::PARAM_STR);
            $queryPayment->execute();
            $lastInsertIdPay = $conn->lastInsertId();

            $_SESSION['payment_history']['id'] = $lastInsertIdPay;
            $_SESSION['time-day']['date'] = $date;
            $_SESSION['time-day']['type'] = $new_type;

            $ok = 1;
            $message = "Gia hạn thành công! Thanh toán bài viết ngay!";
            $header = './post-payment.php?id='.$idRoom;
        }
        elseif ($query){
            $ok = 1;
            $message = "Đã chỉnh sửa thành công!";
            $header = "./post-unpaid.php";
        } else {
            $err = 1;
            $message = "Đã có lỗi xảy ra, vui lòng thử lại";
            $header = "./edit-post.php";
        }
    }
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
                    <h1>Chỉnh sửa tin đăng</h1>
                </div>
                <div class="form-note">
                    <h4>Lưu ý khi đăng tin</h4>
                    <ul>
                    <li>Nội dung phải viết bằng tiếng Việt có dấu</li>
                        <li>Tiêu đề tin không dài quá 100 kí tự</li>
                        <li>Các bạn nên điền đầy đủ thông tin vào các mục để tin đăng có hiệu quả hơn.</li>
                        <li>Tin đăng có hình ảnh rõ ràng sẽ được xem và gọi gấp nhiều lần so với tin rao không có ảnh. Hãy đăng ảnh để được giao dịch nhanh chóng!</li>
                        <li>Hãy chọn loại tin hiển thị, ngày bắt đầu và ngày kết thúc hiển thị bài viết trước khi gửi và thanh toán nhé!</li>
                    </ul>
                </div>
                <div class="form-content">
                    <h3>Địa chỉ cho thuê</h3>
                </div>
                <div class="form-address form-validator" >
                    <div class="search-item form-validator">
                        <p class="item-name">Tỉnh/Thành phố</p>
                        <select class="autobox form-focus boder-ra-5 input-disabled "  name="city" disabled>
                            <option value="<?php echo $resultsRoom->city_id ?>"><?php echo $resultsRoom->city?></option>
                        </select>
                        <span class="form-message"></span>

                    </div>
                    <div class="search-item form-validator">
                        <p class="item-name">Quận/Huyện</p>
                        <select  class="autobox form-focus autobox-district boder-ra-5 input-disabled" name = "district" disabled>
                            <option value="0"><?php echo $resultsRoom->district?></option>
                        </select>
                        <span class="form-message"></span><span class="form-message"></span>

                    </div>
                    <div class="search-item form-validator">
                        <p class="item-name">Phường/Xã</p>
                        <select  class="autobox form-focus boder-ra-5 input-disabled" name ="ward" disabled>
                            <option value="0"><?php echo $resultsRoom->ward?></option>
                        </select>
                        <span class="form-message"></span>
                    </div>
                    <div class="street-number form-validator">
                        <p class="item-name">Tên đường</p>
                        <input type="text" name="street" class="form-focus boder-ra-5" id="street-names" value="<?php echo $resultsRoom->street?>" style="width: 230px "> 
                        <p class="form-message"></p>
                    </div>
                    <div class="street-number form-validator">
                        <p class="item-name">Số nhà</p>
                        <input type="text" name="apartment" class=" form-focus boder-ra-5" id="apartment" value="<?php echo $resultsRoom->apartment_number?>"  style="width: 140px ">
                        <p class="form-message"></p>
                    </div>
                </div>
                <div class="form-content">
                    <h3>Thông tin mô tả</h3>
                </div>
                <div class="search-item form-validator">
                    <p class="item-name">Chuyên mục bài đăng</p>
                    <select  class="autobox form-focus boder-ra-5" name = "category" id="category" style="width: 25% ">
                        <option value="<?php echo $resultsRoom->category_id ?>"><?php echo $resultsRoom->category?></option>
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
                    <input type="text" name="title" class="form-focus boder-ra-5" style="width: 100%" id="post_title" value="<?php echo $resultsRoom->name?>" maxlength="120">
                    <span class="form-message"></span>
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Nội dung mô tả</p>
                    <textarea type="text" name="post_content" id="post_content" class="input-content form-focus boder-ra-5" rows="20" ><?php echo $resultsRoom->contents?></textarea>
                    <span class="form-message"></span>
                </div>
                <div class="form-input " >
                    <p class="item-name">Thông tin liên hệ</p>
                    <input type="text" name="full-name" class=" boder-ra-5 input-disabled " id="" value = "<?php echo $fullname ?>" style="width: 340px;" disabled>
                </div>
                <div class="form-input ">
                    <p class="item-name">Điện thoại</p>
                    <input type="text" name="phone" class=" boder-ra-5 input-disabled" id="" value = "<?php echo $phone ?>" style="width: 340px;" disabled>
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Giá cho thuê</p>
                    <div class="input-detail boder-ra-5">
                        <input type="number" name="price" class="input-content boder-ra-5 mask" id="price" style="margin: 0;" value="<?php echo $resultsRoom->price?>" >
                        <span class="input-disabled">Đồng</span>
                    </div>  
                    <p style="margin-top: 8px; color: #ff9900;" >Vui lòng nhập đủ số tiền. Ví dụ 2 triệu: 2000000</p>   
                    <span class="form-message"></span>              
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Diện tích</p>
                    <div class="input-detail boder-ra-5">
                        <input type="number" name="area" class="input-content boder-ra-5" id="area" style="margin: 0;" value = "<?php echo $resultsRoom->area?>" >
                        <span class="input-disabled">m&sup2;</span>
                    </div>         
                    <span class="form-message"></span>          
                </div>
                <div class="search-item form-validator">
                    <p class="item-name">Đối tượng cho thuê</p>
                    <select  class="autobox form-focus boder-ra-5" name = "subject" id="subject" style="width: 25% ">
                        <option value="1" <?php echo ($resultsRoom->subject == 1)?"selected":""?>>Tất cả</option>
                        <option value="2" <?php echo ($resultsRoom->subject == 2)?"selected":""?>>Nam</option>
                        <option value="3" <?php echo ($resultsRoom->subject == 3)?"selected":""?>>Nữ</option>
                    </select>
                    <span class="form-message"></span>
                </div>
                <div class="input-file form-validator">
                    <p class="item-name">Ảnh đại diện</p>
                    <div class="img-avatar">
                        <img src=".<?php echo ($resultsRoom->image_logo)?>" alt="">
                    </div>
                    <div style = "height: 70px;">
                        <div class="input-img">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            Thay ảnh đại diện mới
                            <input type="file" class="upload-img" name="upload-img" id="upload-img" onchange = "ImageFileAsUrl()">
                        </div>
                    </div>
                    <div id="display-img">
                    </div>
                    <div id = "remove" style = "margin-left: 55px;">
                        <!-- <a onclick="removeImg()" class = "btn">Xóa ảnh</a> -->
                    </div>
                    <span class="form-message"></span>
                </div>
                <div class="input-file form-validator">
                    <p class="item-name">Hình ảnh chi tiết</p>
                    <div class="img-avatar">
                        <?php foreach ($resultsImage as $key => $value) {?>
                            <img src=".<?php echo $value -> image ?>" alt="">
                        <?php }?>
                    </div>
                    <div style = "height: 70px;">
                        <div class="input-img">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            Thay ảnh chi tiết
                            <input type="file" class="upload-img" name="upload-imgs[]" id="upload-imgs" onchange = "ImageFileAsUrls()" multiple = "multiple">
                        </div>
                    </div>
                    <div id="display-imgs">
                    </div>
                    <div id = "removes" style = "margin-left: 55px;">
                        <!-- <a onclick="removeImg()" class = "btn">Xóa ảnh</a> -->
                    </div>
                    
                    <span class="form-message"></span>
                </div>
                <?php if(isset($_GET['giahan'])){ ?>
                    <div class="form-times form-validator" >
                        <div class=" form-input search-item form-validator" style = "margin-left: 0;">
                            <p class="item-name">Chọn loại tin đăng</p>
                            <select class="autobox form-focus autobox-city boder-ra-5 "  name="new-type" id="new-type" style = "width: 300px;">
                                <option value="0">Chọn loại tin</option>
                                <?php foreach ($resultsType as $key => $value) {?>
                                    <option value="<?php echo $value->id ?>" <?php echo ($resultsRoom->news_type_id == $value->id)?"selected":""?>><?php echo $value->name_type ?> (<?php
                                        $bien = number_format((int) $value -> price,0,",",".");
                                        echo $bien." đồng/ngày";
                                        ?>) </option>
                                <?php }?>
                            </select>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-input search-item form-validator">
                            <p class="item-name">Chọn thời gian bắt đầu</p>
                            <input type="date" name="time-start" id="timeStart" class=" form-focus boder-ra-5" value ="<?php echo date_format(date_create($resultsRoom->time_start),"Y-m-d") ?>">
                            <span class="form-message"></span><span class="form-message"></span>
                        </div>
                        <div class="form-input search-item form-validator">
                            <p class="item-name">Chọn thời gian kết thúc</p>
                            <input type="date" name="time-end" id="timeEnd" class=" form-focus boder-ra-5" value ="<?php echo date_format(date_create($resultsRoom->time_stop),"Y-m-d") ?>">
                            <span class="form-message"></span><span class="form-message"></span>
                        </div>
                </div>
                <?php } ?>
                <div class="submit-form">
                    <input type="submit" name="submit-form" class="btn btn-submit"  value="Tiếp tục" style = "width: 50%;height: 45px;font-size: 18px;">
                </div>
            </form>
        </div>
        <!-- /main-right -->
        
    </div>
     <!-- Thông báo thành công -->
     <?php if($ok == 1){ ?>
    <div class="noti">
        <div class="success-checkmark">
            <div class="check-icon">
                <span class="icon-line line-tip"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
            <div class="notification">
                <p>
                    <?php echo $message ?>
                </p>
            </div>
            <a href="<?php echo $header?>" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
    <!-- Thông báo thất bại -->
    <?php if($err == 1){ ?>
    <div class="noti">
        <div class="error-banmark">
            <div class="ban-icon">
                <span class="icon-line line-long-invert"></span>
                <span class="icon-line line-long"></span>
                <div class="icon-circle"></div>
                <div class="icon-fix"></div>
            </div>
            <div class="notification">
                <p>
                    <?php echo $message ?>
                </p>
            </div>
            <a href="<?php echo $header ?>" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
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

                Validator.isRequired('#price', 'Vui lòng nhập giá cho thuê'),
                Validator.isRequired('#area', 'Vui lòng nhập diện tích'),
                Validator.numberMin('#area', 10, 'Diện tích phải >= 10'),
                // Validator.isRequired('#upload-img', 'Vui lòng tải lên 1 hình ảnh'),
                // Validator.isRequired('#upload-imgs', 'Vui lòng tải lên ít nhất 1 hình ảnh'),
                
            ],
        });
    </script>
    <script>
        CKEDITOR.replace('post_content');
    </script>
    <script>
        $(document).ready(function () {
            timeStart.min = new Date().toISOString().split("T")[0];

            const today = new Date();
            today.setDate(today.getDate() +5);
            timeEnd.min= today.toLocaleDateString('en-ca');
        });
    </script>
</body>
</html>