<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $queryCate = $conn->prepare("SELECT * FROM tbl_categories");
    $queryCate->execute();
    $resultsCate = $queryCate->fetchAll(PDO::FETCH_OBJ);

    $err = "";
    $ok = "";
    $message = "";
    // tạo mới
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-form']) ){
        $name = $_POST['name'];
        $slug = vn2en($name);
        $classify = $_POST['classify'];
        $title = $_POST['title'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        // var_dump($name); die();
        $sql = "INSERT INTO tbl_categories(name,classify,slug,title,description,type) value(:name,:classify,:slug,:title,:description,:type)";
        $query= $conn -> prepare($sql);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':classify',$classify,PDO::PARAM_STR);
        $query->bindParam(':slug',$slug,PDO::PARAM_STR);
        $query->bindParam(':title',$title,PDO::PARAM_STR);
        $query->bindParam(':type',$type,PDO::PARAM_STR);
        $query->bindParam(':description',$description,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $conn->lastInsertId();
        if($lastInsertId){
            $ok = 1;
            $message = "Tạo chuyên mục thành công";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }
    };
    // cập nhật
    $updateId = isset($_GET['id'])?$_GET['id']:'';
    if($updateId){
        $queryUpdate = $conn->prepare("SELECT * FROM tbl_categories WHERE ID = $updateId");
        $queryUpdate->execute();
        $resultsUpdate = $queryUpdate->fetch(PDO::FETCH_OBJ);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-form'])){
        $name = $_POST['name'];
        $slug = vn2en($name);
        $classify = $_POST['classify'];
        $title = $_POST['title'];
        $type = $_POST['type'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        
        $sql = "UPDATE tbl_categories SET name = :name,classify = :classify,slug = :slug,title = :title, type = :type,description = :description, status = :status WHERE id = $updateId ";
        $query= $conn -> prepare($sql);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':classify',$classify,PDO::PARAM_STR);
        $query->bindParam(':slug',$slug,PDO::PARAM_STR);
        $query->bindParam(':title',$title,PDO::PARAM_STR);
        $query->bindParam(':type',$type,PDO::PARAM_STR);
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
        $sql = "DELETE FROM tbl_categories WHERE id = :id";
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
    <title>Admin | Quản lý chuyên mục</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Quản lý chuyên mục</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý chuyên mục</h1>
                </div>
                <div class="account-btn">
                    <button class="btn btn-post btn-add">Tạo chuyên mục</button>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >STT</th>
                            <th style="width: 12%;" >Tên chuyên mục</th>
                            <th style="width: 12%;" >Phân loại</th>
                            <th style="width: 12%;" >Menu hiển thị</th>
                            <th style="width: 20%;" >Tiêu đề</th>
                            <th style="width: 22%;" >Mô tả</th>
                            <th style="width: 8%;" >Trạng thái</th>
                            <th style="width: 10%;" >Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsCate as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <p><?php echo $value -> name ?></p>
                                </td>
                                <td style="text-align: left; ">
                                    <p><?php echo $value -> classify ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> type ?></p>
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
                                        <p>Ẩn</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="./categories.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="./categories.php?del=<?php echo $value -> id ?>" class="btn-setting" style = "color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa?');" ><i class="fa-solid fa-trash"></i>
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
                <form action="" method="post">
                    <h2>Thêm mới chuyên mục</h2>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tên chuyên mục</lable>
                        <input type="text" name="name"  id="name">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Phân loại</lable>
                        <input type="text" name="classify"  id="classify">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tiêu đề</lable>
                        <input type="text" name="title"  id="title">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Hiển thị menu</lable>
                        <input type="text" name="type"  id="type">
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
                    <a href="./categories.php"><i class="fa-solid fa-x"></i></a>
                </div>
                <form action="" method="post">
                    <h2>Chỉnh sửa chuyên mục</h2>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tên chuyên mục</lable>
                        <input type="text" name="name"  id="name" value = "<?php echo $resultsUpdate->name ?>">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Phân loại</lable>
                        <input type="text" name="classify"  id="classify" value = "<?php echo $resultsUpdate->classify ?>">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tiêu đề</lable>
                        <input type="text" name="title"  id="title"  value = "<?php echo $resultsUpdate->title ?>">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Hiển thị menu</lable>
                        <input type="text" name="type"  id="type" value = "<?php echo $resultsUpdate->type ?>">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Mô tả</lable>
                        <textarea name="description" id="description" cols="30" rows="3" ><?php echo $resultsUpdate->description ?></textarea>
                        <span class="form-message"></span>
                    </div>
                    <div class="status" style = "margin-top: 10px;">
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
                    <?php echo $message; ?>
                </p>
            </div>
            <a href="./categories.php" class="btn">OK</a>
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
            <a href="./categories.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>