<?php 
    include './include/connect.php';
    include '../include/func-slug.php';
     date_default_timezone_set("Asia/Ho_Chi_Minh");

    // Gọi ra thông tin giao dịch
    $queryDep = $conn->prepare("SELECT dep.*, us.username FROM tbl_deposit_money dep JOIN tbl_user us ON us.id = dep.user_id ORDER BY dep.status ASC, dep.created_at DESC");
    $queryDep->execute();
    $resultsDep = $queryDep->fetchAll(PDO::FETCH_OBJ);

    // gọi thông tin user
    $queryUser = $conn->prepare("SELECT * FROM tbl_user");
    $queryUser->execute();
    $resultsUser = $queryUser->fetchAll(PDO::FETCH_OBJ);

    $err = "";
    $ok = "";
    $message = "";
    // tạo mới
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idUser']) ){
        $user_id = $_POST['idUser'];
        $getdate = $_POST['timeCode'];
        $pay_code = "TPN-KH#".$user_id."-".$getdate;

        $payments = $_POST['payments'];
        $pay_price = $_POST['price'];
        $sql = "INSERT INTO tbl_deposit_money(pay_code,pay_price,payments,user_id) value(:pay_code,:pay_price,:payments,:user_id)";
        $query= $conn -> prepare($sql);
        $query->bindParam(':pay_code',$pay_code,PDO::PARAM_STR);
        $query->bindParam(':pay_price',$pay_price,PDO::PARAM_STR);
        $query->bindParam(':payments',$payments,PDO::PARAM_STR);
        $query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $conn->lastInsertId();
        if($lastInsertId){
            $ok = 1;
            $message = "Khởi tạo thành công!";
        }else{
            $err = 1;
            $message = "Có lỗi xảy ra, vui lòng thử lại";
        }
    };
    // cập nhật
    $updateId = isset($_GET['id'])?$_GET['id']:'';
    if($updateId){
        $queryUpdate = $conn->prepare("SELECT dep.*, us.username FROM tbl_deposit_money dep JOIN tbl_user us ON us.id = dep.user_id WHERE dep.id = $updateId");
        $queryUpdate->execute();
        $resultsUpdate = $queryUpdate->fetch(PDO::FETCH_OBJ);
        $id_user = $resultsUpdate -> user_id;

        $queryUser = $conn->prepare("SELECT * FROM tbl_user WHERE id = :id");
        $queryUser-> bindParam(':id', $id_user, PDO::PARAM_STR);
        $queryUser->execute();
        $resultsUser = $queryUser->fetch(PDO::FETCH_OBJ);
        $balance = (int) $resultsUser->balance;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pay_code'])){
        $pay_code = $_POST['pay_code'];
        $payments = $_POST['payments'];
        $pay_price = $_POST['price'];
        $status = $_POST['status'];
        
        $balanceHis = $balance + $pay_price;

        if($status == 1){
            $sql = "UPDATE tbl_deposit_money SET pay_code = :pay_code,payments = :payments,pay_price = :pay_price, status = :status WHERE id = $updateId ";
            $query= $conn -> prepare($sql);
            $query->bindParam(':pay_code',$pay_code,PDO::PARAM_STR);
            $query->bindParam(':payments',$payments,PDO::PARAM_STR);
            $query->bindParam(':pay_price',$pay_price,PDO::PARAM_STR);
            $query->bindParam(':status',$status,PDO::PARAM_STR);
            $query->execute();

            // Cập nhật lại tiền
            $sqlUser = "UPDATE tbl_user SET balance = :balance WHERE id = :id";
            $queryUser= $conn -> prepare($sqlUser);
            $queryUser->bindParam(':balance',$balanceHis,PDO::PARAM_STR);
            $queryUser->bindParam(':id',$id_user,PDO::PARAM_STR);
            $queryUser->execute();

            if($query && $queryUser){
                $ok = 1;
                $message = "Cập nhật thành công";
            }else{
                $err = 1;
                $message = "Có lỗi xảy ra, vui lòng thử lại";
            }
        }
    }
    // Xóa
    if(isset($_REQUEST['del'])&&($_REQUEST['del'])){
        $delId = intval($_GET['del']);
        $sql = "DELETE FROM tbl_deposit_money WHERE id = :id";
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
    <title>Admin | Quản lý nạp tiền</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Quản lý nạp tiền</li>
                </ol>
            </nav>
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Quản lý nạp tiền</h1>
                </div>
                <div class="account-btn">
                    <button class="btn btn-post btn-add">Tạo giao dịch</button>
                </div>
            </section>
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "table-manage">
                    <thead>
                        <tr>
                            <th style="width: 5%;" >STT</th>
                            <th style="width: 20%;" >Mã giao dịch</th>
                            <th style="width: 10%;" >Hình thức</th>
                            <th style="width: 15%;" >Khách hàng</th>
                            <th style="width: 15%;" >Số tiền</th>
                            <th style="width: 15%;" >Ngày thực hiện</th>
                            <th style="width: 10%;" >Trạng thái</th>
                            <th style="width: 10%;" >Hành động</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <?php foreach ($resultsDep as $key => $value) { ?>
                            <tr>
                                <td><?php echo $key+1 ?></td>
                                <td>
                                    <p><?php echo $value -> pay_code ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value ->payments ?></p>
                                </td>
                                <td>
                                    <p><?php echo $value -> username ?></p>
                                </td>
                                <td>
                                <div class="post_price">
                                        <?php
                                            $tien = (int) $value->pay_price;
                                            $bien = number_format($tien,0,",",".");
                                            echo $bien." đồng";
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <p><?php echo $value -> created_at ?></p>
                                </td>
                                <td>
                                    <?php if( $value -> status == 1){ ?>
                                        <p style = "color: #37a344;" >Đã hoàn thành</p>
                                    <?php }else{ ?>
                                        <p style = "color: red;">Khởi tạo</p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if( $value -> status == 0){ ?>
                                        <a href="./deposit-money-manager.php?id=<?php echo $value -> id ?>" class="btn-setting btn-edit" style = "color: #1266dd;"><i class="fa-regular fa-pen-to-square"></i></a>
                                        </a>
                                        <a href="./deposit-money-manager.php?del=<?php echo $value -> id ?>" class="btn-setting" style = "color: red;" onclick="return confirm('Bạn chắc chắn muốn xóa?');" ><i class="fa-solid fa-trash"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if( $value -> status == 1){ ?>
                                        <p class="btn-setting btn-edit" style = "color: #37a344;"><i class="fa-solid fa-check"></i></p>
                                    <?php } ?>
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
                <form action="" method="post" id = "frm-post">
                    <h2>Khởi tạo giao dịch mới</h2>
                    <div class="form-contact form-validator ">
                        <p class="contact-title">ID khách hàng</p>
                        <select class="autobox form-focus boder-ra-5" name = "idUser" id="idUser" style="width: 50% ">
                            <option value="">Chọn ID khách hàng</option>
                            <?php foreach ($resultsUser as $key => $value) { ?>
                                <option value="<?php echo $value -> id ?>"><?php echo $value -> id ?></option>
                            <?php }?>
                        </select>
                        <p class="form-message"></p>
                    </div>
                    <div class="form-contact form-validator ">
                        <p class="contact-title">Time-code</p>
                        <input type="text" name="timeCode" value = "<?php echo date('dmY-His')?>"  id="timeCode" style="width: 50% ">
                        <p class="form-message"></p>
                    </div>
                    <div class="form-contact form-validator ">
                        <p class="contact-title">Loại hình thanh toán</p>
                        <select  class="autobox form-focus boder-ra-5" name = "payments" id="payments" style="width: 50% ">
                            <option value="">Chọn loại thanh toán</option>
                            <option value="BANK">Chuyển khoản qua ngân hàng</option>
                            <option value="MOMO">Chuyển khoản qua momo</option>
                            <option value="CASH">Nạp tiền mặt</option>
                        </select>
                        <p class="form-message"></p>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Số tiền</lable>
                        <input type="number" name="price"  id="price">
                        <p class="form-message"></p>
                    </div>
                    <div class="form-contact form-validator" id = "btn-submit">
                        <input type="submit" name ="add-form" value="Khởi tạo giao dịch" class="btn add-form" id = "add-form">
                    </div>
                </form>
            </div>
        </div>
        <?php if(isset($_GET['id'])){?>
        <div class="form-act form-animation" style ="display: block;">
            <div class="form-act-edit">
                <div class="form-close">
                    <a href="./deposit-money-manager.php"><i class="fa-solid fa-x"></i></a>
                </div>
                <form action="" method="post">
                    <h2>Chỉnh sửa giao dịch</h2>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Mã giao dịch</lable>
                        <input type="text" name="pay_code"  id="pay_code" value = "<?php echo $resultsUpdate->pay_code ?>">
                    </div>
                    <div class="form-contact form-validator ">
                        <p class="contact-title">Hình thức nạp tiền</p>
                        <select  class="autobox form-focus boder-ra-5" name = "payments" id="payments" style="width: 50% ">
                            <option value="">Chọn loại thanh toán</option>
                            <option value="BANK" <?php if($resultsUpdate->payments == "BANK") echo 'selected' ?>>Chuyển khoản qua ngân hàng</option>
                            <option value="MOMO" <?php if($resultsUpdate->payments == "MOMO") echo 'selected' ?>>Chuyển khoản qua momo</option>
                            <option value="CASH" <?php if($resultsUpdate->payments == "CASH") echo 'selected' ?>>Nạp tiền mặt</option>
                        </select>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Tên khách hàng</lable>
                        <input type="text" name="username"  id="username"  value = "<?php echo $resultsUpdate->username ?>" disabled>
                    </div>
                    <div class="form-contact form-validator ">
                        <lable class="contact-title">Số tiền nạp</lable>
                        <input type="number" name="price"  id=""  value = "<?php echo $resultsUpdate->pay_price ?>">
                    </div>
                    <div class="status" style = "margin-top: 10px;">
                        <label style = "margin-right: 15px;">
                            <input type="radio" name="status" id="" value ="1" <?php if($resultsUpdate->status == 1) echo  "checked = 'Checked'" ?>> Duyệt
                        </label>
                        <label>
                            <input type="radio" name="status" value ="0" <?php if($resultsUpdate->status == 0) echo  "checked = 'Checked'" ?> id="" > Khởi tạo
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
            <a href="./deposit-money-manager.php" class="btn">OK</a>
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
            <a href="./deposit-money-manager.php" class="btn">OK</a>
        </div>
    </div>
    <?php }?>

    <script>
        Validator({
            form: '#frm-post',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#idUser', 'Vui lòng chọn ID người nạp tiền'), 
                Validator.isRequired('#timeCode', 'Vui lòng nhập time code theo mã giao dịch'), 
                Validator.isRequired('#payments', 'Vui lòng chọn hình thức nạp tiền'), 
                Validator.isRequired('#price', 'Vui lòng nhập số tiền nạp vào'),
                Validator.numberMin('#price', 19999, 'Số tiền nạp vào tối thiểu là 20.000 vnđ'),
                
            ],
        });
    </script>
</body>
</html>