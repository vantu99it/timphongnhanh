<?php 
    include './include/connect.php';
    include '../include/func-slug.php';

    $queryNews = $conn->prepare("SELECT * FROM tbl_news ORDER BY id DESC");
    $queryNews->execute();
    $resultsNews = $queryNews->fetchAll(PDO::FETCH_OBJ);

    // Xóa
    if(isset($_REQUEST['del'])&&($_REQUEST['del'])){
        $delId = intval($_GET['del']);
        $queryDel= $conn -> prepare("DELETE FROM tbl_news WHERE id = :id");
        $queryDel->bindParam(':id',$delId,PDO::PARAM_STR);
        $queryDel->execute();
        if($queryDel){
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
    <title>Admin | Tin đã đăng</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Tin đã đăng</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý tin tức</h1>
                </div>
                <div class="account-btn">
                    <a href="./make-news.php" class="btn btn-post btn-add">Tạo tin tức</a>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >ID</th>
                            <th style="width: 25%;" >Hình ảnh</th>
                            <th style="width: 23%;" >Tiêu đề</th>
                            <th style="width: 32%;" >Nội dung</th>
                            <th style="width: 8%;" >Trạng thái</th>
                            <th style="width: 8%;" >Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsNews as $key => $value) { ?>
                            <tr>
                                <td>#<?php echo $value -> id ?></td>
                                <td>
                                    <img src=".<?php echo $value -> image_logo ?>" alt="">
                                </td>
                                <td>
                                    <p><?php echo $value -> title ?></p>
                                </td>
                                <td class = "hide-content">
                                    <p><?php echo strip_tags($value -> content) ?></p>
                                </td>
                                <td>
                                    <?php if( $value -> status == 1){ ?>
                                        <p>Hiện</p>
                                    <?php }else{ ?>
                                         <p style = "color: red;">Ẩn</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="./edit-make-news.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="./posted-news.php?del=<?php echo $value -> id ?>" class="btn-setting" style = "color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa?');" ><i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /main-right -->
    </div>
    <!-- footer + js -->
    <?php include('include/footer.php');?>
    <!-- /footer + js -->
</body>
</html>