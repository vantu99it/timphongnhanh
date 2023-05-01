<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $err = "";
    $ok = "";
    $message = "";

    $id_admin = isset( $_SESSION['loginAdmin']['id'])? $_SESSION['loginAdmin']['id']:"";

    $id = isset($_GET['id']) ? $_GET['id'] : "";

    $queryNews = $conn->prepare("SELECT * FROM tbl_news WHERE id = :id");
    $queryNews->bindParam(':id',$id,PDO::PARAM_STR);
    $queryNews->execute();
    $resultsNews = $queryNews->fetch(PDO::FETCH_OBJ);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $slug = vn2en($title);
        $post_content = $_POST['post_content']; 
        $status = $_POST['status'];
        if(isset($_FILES["upload-img"])){
            $imagePNG = $_FILES["upload-img"]["name"];
            if(empty($imagePNG)){
                $target_file = $resultsNews -> image_logo;
            }else{
            $imagePNG = $_FILES["upload-img"]["name"];
            $imageName = vn2en($imagePNG);  
            $target_dir = "./image/news/";
            $target_file = $target_dir.$imageName;
            move_uploaded_file($_FILES["upload-img"]["tmp_name"],'../image/news/'.$imageName); 
            }      
        }

        $stmt = $conn->prepare("UPDATE tbl_news SET title = :title,slug = :slug,image_logo = :image_logo,content = :content,id_admin = :id_admin, status = :status WHERE id = :id");
        $stmt->bindParam(':title',$title,PDO::PARAM_STR);
        $stmt->bindParam(':slug',$slug,PDO::PARAM_STR);
        $stmt->bindParam(':image_logo',$target_file,PDO::PARAM_STR);
        $stmt->bindParam(':content',$post_content,PDO::PARAM_STR);
        $stmt->bindParam(':id_admin',$id_admin,PDO::PARAM_STR);
        $stmt->bindParam(':status',$status,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt){
            $ok = 1;
            $message = "Cập nhật thành công!";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Đăng tin mới</title>
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
                    <li class="breadcrumb-item"><a href="#">Trang quản trị</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý tin tức</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm tin mới</li>
                </ol>
            </nav>
            <form action="" method="post" enctype="multipart/form-data" id = "frm-post">
                <div class="form-title">
                    <h1>Tạo tin tức mới</h1>
                </div>
                <div class="form-note">
                    <h4>Lưu ý khi tạo bài viết</h4>
                    <ul>
                        <li>Nội dung phải viết bằng tiếng Việt có dấu</li>
                        <li>Tiêu đề tin không dài quá 100 kí tự</li>
                        <li>Trong bài viết phải yêu cầu có ít nhất 01 ảnh</li>
                    </ul>
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Tiêu đề bài viết</p>
                    <input type="text" name="title" class="form-focus boder-ra-5" style="width: 100%" id="post_title" value="<?php echo $resultsNews -> title ?>" maxlength="120">
                    <p class="form-message"></p>
                </div>
                <div class="input-file form-validator block">
                    <p class="item-name">Hình ảnh đại diện</p>
                    <div class="form-image-his">
                        <p class="contact-title">Ảnh hiện tại: </p>
                        <div class="display-img-news">
                        <img src=".<?php echo $resultsNews -> image_logo ?>" alt="">
                        </div>
                    </div>
                    <div style = "height: 50px;">
                        <div class="input-img">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            Tải hình thay thế
                            <input type="file" class="upload-img" name="upload-img" id="upload-img-news" onchange = "ImageFileAsUrlNews()">
                        </div>
                    </div>
                    <p class="form-message"></p>
                    <div id="display-img-news" class = "display-img-news"></div>
                    <div id = "remove" style = "margin-left: 55px;">
                    </div>
                </div>
                <div class="form-input form-validator">
                    <p class="item-name">Nội dung mô tả</p>
                    <textarea type="text" name="post_content" id="post_content" class="input-content form-focus boder-ra-5" rows="80" ><?php echo $resultsNews -> content ?></textarea>
                    <p class="form-message"></p>
                </div>
                <div class="status form-input" style = "margin-top: 10px;">
                    <p class="item-name">Trạng thái hiển thị</p>
                    <label style = "margin-right: 15px;">
                        <input type="radio" name="status" id="" value ="1" <?php if($resultsNews->status == 1) echo  "checked = 'Checked'" ?>> Hiện

                    </label>
                    <label>
                        <input type="radio" name="status" value ="0" <?php if($resultsNews->status == 0) echo  "checked = 'Checked'" ?> id="" > Ẩn
                    </label>
                </div>
                <div class="submit-form">
                    <input type="submit" name="submit-form" class="btn btn-submit"  value="cập nhật" style = "width: 100%;height: 45px;font-size: 18px;">
                </div>
            </form>
        </div>
        <!-- /main-right -->
    </div>
    <!-- footer + js -->
    <?php include('include/footer.php');?>
    <!-- /footer + js -->

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
                    <?php echo $message; ?>
                </p>
            </div>
            <a href="./posted-news.php" class="btn">OK</a>
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
                    <?php echo $message; ?>
                </p>
            </div>
            <a href="./edit-make-news.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>

    <!-- script -->
    <script>
        CKEDITOR.replace('post_content');
    </script>

    <script>
        Validator({
            form: '#frm-post',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#post_title', 'Vui lòng nhập tiêu đề bài viết'),
                Validator.minMaxLength('#post_title',30,120, 'Tiêu đề tối thiểu 30 và tối đa 120 ký tự'),
            ],
        });
    </script>
</body>
</html>