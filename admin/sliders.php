<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $querySlider = $conn->prepare("SELECT * FROM tbl_slider");
    $querySlider->execute();
    $resultsSlider = $querySlider->fetchAll(PDO::FETCH_OBJ);

    $err = "";
    $ok = "";
    $message = "";
    // tạo mới
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-form']) ){
        $title = $_POST['title'];
        $description = $_POST['description'];
        if(isset($_FILES["upload-img"])){
            $imagePNG = $_FILES["upload-img"]["name"];
            $imageName = vn2en($imagePNG);  
            $target_dir = "./image/slider/";
            $target_file = $target_dir.$imageName;
            move_uploaded_file($_FILES["upload-img"]["tmp_name"],'../image/slider/'.$imageName);       
        }
        $sql = "INSERT INTO tbl_slider(image,title,description) value(:image,:title,:description)";
        $query= $conn -> prepare($sql);
        $query->bindParam(':image',$target_file,PDO::PARAM_STR);
        $query->bindParam(':title',$title,PDO::PARAM_STR);
        $query->bindParam(':description',$description,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $conn->lastInsertId();
        if($lastInsertId){
            $ok = 1;
            $message = "Thêm slide thành công";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }
    };
    // cập nhật
    $updateId = isset($_GET['id'])?$_GET['id']:'';
    if($updateId){
        $queryUpdate = $conn->prepare("SELECT * FROM tbl_slider WHERE ID = $updateId");
        $queryUpdate->execute();
        $resultsUpdate = $queryUpdate->fetch(PDO::FETCH_OBJ);
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-form'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        if(isset($_FILES["upload-img"])){
            $imagePNG = $_FILES["upload-img"]["name"];
            if(empty($imagePNG)){
                $target_file = $resultsUpdate -> image;
            }else{
                $imageName = vn2en($imagePNG);  
                $target_dir = "./image/slider/";
                $target_file = $target_dir.$imageName;
                move_uploaded_file($_FILES["upload-img"]["tmp_name"],'../image/slider/'.$imageName); 
            }
        }
        
        $sql = "UPDATE tbl_slider SET image = :image, title = :title,description = :description, status = :status WHERE id = $updateId ";
        $query= $conn -> prepare($sql);
        $query->bindParam(':image',$target_file,PDO::PARAM_STR);
        $query->bindParam(':title',$title,PDO::PARAM_STR);
        $query->bindParam(':description',$description,PDO::PARAM_STR);
        $query->bindParam(':status',$status,PDO::PARAM_STR);
        $query->execute();
        if($query){
            $ok = 1;
            $message = "Cập nhật thành công";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }
    }
    // Xóa
    if(isset($_REQUEST['del'])&&($_REQUEST['del'])){
        $delId = intval($_GET['del']);
        $sql = "DELETE FROM tbl_slider WHERE id = :id";
        $query= $conn -> prepare($sql);
        $query->bindParam(':id',$delId,PDO::PARAM_STR);
        $query->execute();

        if($query){
            $ok = 1;
            $message = "Đã xóa thành công";
        }
        else{
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
    <title>Admin | Quản lý slider</title>
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
                    <li class="breadcrumb-item"><a href="#">Quản lý hệ thống</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý slider</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý slider</h1>
                </div>
                <div class="account-btn">
                    <button class="btn btn-post btn-add">Tạo slider</button>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >STT</th>
                            <th style="width: 30%;" >Hình ảnh</th>
                            <th style="width: 23%;" >Tiêu đề</th>
                            <th style="width: 25%;" >Mô tả</th>
                            <th style="width: 8%;" >Trạng thái</th>
                            <th style="width: 10%;" >Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsSlider as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <img src=".<?php echo $value -> image ?>" alt="">
                                </td>
                                <td>
                                    <p><?php echo $value -> title ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> description ?></p>
                                </td>
                                <td>
                                    <?php if( $value -> status == 1){ ?>
                                        <p>Hiện</p>
                                    <?php }else{ ?>
                                        <p style = "color: red;">Ẩn</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="./sliders.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="./sliders.php?del=<?php echo $value -> id ?>" class="btn-setting" style = "color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa?');" ><i class="fa-solid fa-trash"></i>
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
                <form action="" method="post" enctype="multipart/form-data">
                    <h2>Thêm mới slider</h2>
                    <div class="input-file form-validator">
                        <div class="input-img">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            Tải hình ảnh
                            <input type="file" class="upload-img" name="upload-img" id="upload-img" onchange = "ImageFileAsUrl()">
                        </div>
                        <div id="display-img">
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tiêu đề</lable>
                        <input type="text" name="title"  id="title">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Mô tả</lable>
                        <textarea name="description" id="description" cols="30" rows="3"></textarea>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="add-form" value="Tạo mới" class="btn add-form" id = "add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if(isset($_GET['id'])){?>
        <div class="form-act form-animation" style ="display: block;">
            <div class="form-act-edit">
                <div class="form-close">
                    <a href="./sliders.php"><i class="fa-solid fa-x"></i></a>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <h2>Chỉnh sửa slider</h2>
                    <div class="form-image-his">
                        <lable class="contact-title">ẢNH BAN ĐẦU</lable>
                        <img src=".<?php echo $resultsUpdate->image?>" alt="">
                    </div>
                    <div class="input-file form-validator">
                        <div class="input-img">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                            Tải hình ảnh
                            <input type="file" class="upload-img" name="upload-img" id="upload-img-Update" onchange = "ImageFileAsUrlUpdate()">
                        </div>
                        <div id="display-img-Update">
                        </div>
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tiêu đề</lable>
                        <input type="text" name="title"  id="title"  value = "<?php echo $resultsUpdate->title ?>">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Mô tả</lable>
                        <textarea name="description" id="description" cols="30" rows="3" ><?php echo $resultsUpdate->description ?></textarea>
                        <span class="form-message"></span>
                    </div>
                    <div class="status" style = "margin-top: 10px;">
                        <p class="item-name">Trạng thái hiển thị</p>
                        <label style = "margin-right: 15px;">
                            <input type="radio" name="status" id="" value ="1" <?php if($resultsUpdate->status == 1) echo  "checked = 'Checked'" ?>> Hiện

                        </label>
                        <label>
                            <input type="radio" name="status" value ="0" <?php if($resultsUpdate->status == 0) echo  "checked = 'Checked'" ?> id="" > Ẩn
                        </label>
                    </div>
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="update-form" value="Cập nhật" class="btn update-form " id = "update-form">
                    </div>
                </form>
            </div>
        </div>
        <?php }?>
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
                    <?php echo $message ?>
                </p>
            </div>
            <a href="./sliders.php" class="btn">OK</a>
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
            <a href="./sliders.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>