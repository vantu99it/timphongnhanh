<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $queryType = $conn->prepare("SELECT * FROM tbl_new_type");
    $queryType->execute();
    $resultsType = $queryType->fetchAll(PDO::FETCH_OBJ);
    // tạo mới
    $err = "";
    $ok = "";
    $message = "";
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add-form']) ){
        $name = $_POST['name'];
        $price = $_POST['price'];
        // var_dump($name); die();
        $sql = "INSERT INTO tbl_new_type(name_type,price) value(:name,:price)";
        $query= $conn -> prepare($sql);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':price',$price,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $conn->lastInsertId();
        if($lastInsertId){
            $ok = 1;
            $message = "Tạo loại tin thành công";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }
    };
    // cập nhật
    $updateId = isset($_GET['id'])?$_GET['id']:'';
    if($updateId){
        $queryUpdate = $conn->prepare("SELECT * FROM tbl_new_type WHERE ID = $updateId");
        $queryUpdate->execute();
        $resultsUpdate = $queryUpdate->fetch(PDO::FETCH_OBJ);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-form'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        
        $sql = "UPDATE tbl_new_type SET name_type = :name,price = :price,status = :status WHERE id = $updateId ";
        $query= $conn -> prepare($sql);
        $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':price',$price,PDO::PARAM_STR);
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
        $sql = "DELETE FROM tbl_new_type WHERE id = :id";
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
                    <h1>Quản lý loại tin</h1>
                </div>
                <div class="account-btn">
                    <button class="btn btn-post btn-add">Tạo loại tin</button>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >STT</th>
                            <th style="width: 50%;" >Loại tin</th>
                            <th style="width: 25%;" >Giá</th>
                            <th style="width: 10%;" >Trạng thái</th>
                            <th style="width: 10%;" >Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsType as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <p><?php echo $value -> name_type ?></p>
                                </td>
                                <td>
                                    <p>
                                        <?php
                                        $bien = number_format((int) $value -> price,0,",",".");
                                        echo $bien." đồng/ngày";
                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <?php if( $value -> status == 1){ ?>
                                        <p>Hiện</p>
                                    <?php }else{ ?>
                                        <p>Ẩn</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="./new-type.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="./new-type.php?del=<?php echo $value -> id ?>" class="btn-setting" style = "color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa?');" ><i class="fa-solid fa-trash"></i>
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
                    <h2>Thêm loại tin mới</h2>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tên loại tin</lable>
                        <input type="text" name="name"  id="name">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Giá tin</lable>
                        <input type="number" name="price"  id="price">
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
                    <a href="./new-type.php"><i class="fa-solid fa-x"></i></a>
                </div>
                <form action="" method="post">
                    <h2>Chỉnh sửa chuyên mục</h2>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tên loại tin</lable>
                        <input type="text" name="name"  id="name" value ="<?php echo $resultsUpdate->name_type ?>">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Giá tin</lable>
                        <input type="number" name="price"  id="price" value ="<?php echo $resultsUpdate->price ?>">
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
                    <?php echo $message ?>
                </p>
            </div>
            <a href="./new-type.php" class="btn">OK</a>
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
            <a href="./new-type.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>
</body>
</html>