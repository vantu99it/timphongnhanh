<?php
include 'connect.php';
    $id = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];
    if(isset($_SESSION['login']['id'])){
        $id = $_SESSION['login']['id'];
        $query= $conn -> prepare("SELECT * FROM tbl_user WHERE id = :id");
		$query-> bindParam(':id',$id, PDO::PARAM_STR);
        $query-> execute();
		$results = $query->fetch(PDO::FETCH_OBJ);
        if($query->rowCount() > 0){
            $id = $results->id;
            $username= $results->username;
            $password= $results->password;
            $fullname= $results->fullname;
            $email= $results->email;
            $phone= $results->phone;
            $address= $results->address;
            $avata = $results->avatar;
            $balance = $results->balance;
            
        }
    }
    $queryCate= $conn -> prepare("SELECT * FROM tbl_categories WHERE status = 1");
    $queryCate-> execute();
    $resultsCate = $queryCate->fetchAll(PDO::FETCH_OBJ);
?>
<div id="header">
    <nav class="header-top">
        <div class="container">
            <a
            class="top-logo logo"
            href=""
            title="cho thuê phòng trọ, cho thuê nhà trọ, tìm phòng trọ"
            ></a>
            <?php if(!isset($_SESSION['login']['username'])){ ?>
            <div class="no-login">
                <a href="./login.php" class="btn">Đăng nhập</a>
                <a href="./register.php" class="btn">Đăng ký</a>
                <a href="./login.php" class="btn btn-red">
                    Đăng tin mới
                    <i></i>
                </a>
            </div>
            <?php  } else {?>
            <div class="logged account">
                <div class="account-avt">
                    <?php if(strlen($avata) != 0){?>
                        <img src="<?php echo $avata?>" alt="Avata">
                    <?php } else { ?>
                        <img src="./image/default-user.png" alt="Avata">
                    <?php } ?>
                </div>
                <div class="account-name">
                    <div class="name">
                        <p class="account-fullname">Xin chào: <b><?php echo  $fullname ?></b></p>
                        <ul>
                            <li style = "margin-right: 10px;">
                                <span>Mã thành viên:</span>
                                <span  style = "font-weight: 700">#<?php echo  $id  ?></span>
                            </li>
                            <li>
                                <span>Số dư TK:</span>
                                <span style = "font-weight: 700"><?php echo  number_format($balance,0,",",".")  ?> VNĐ</span>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="manage">
                    <button  class="btn-manage">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Quản lý tài khoản</span> 
                    </button>
                    <ul class="manage-menu">
                        <li ><a href="./user/create-post.php" class="manage-menu-item add-post"><i></i> Đăng tin mới</a></li>
                        <li ><a href="./user/post-manage.php" class="manage-menu-item manage-post"><i></i> Quản lý bài đăng</a></li>
                        <li ><a href="./user/deposit-money.php" class="manage-menu-item payment"><i></i> Nạp tiền</a></li>
                        <li ><a href="./user/deposit-money-history.php" class="manage-menu-item payment-history"><i></i>Lịch sử nạp tiền</a></li>
                        <li ><a href="./user/personal-page.php" class="manage-menu-item manage-user"><i></i> Thông tin cá nhân</a></li>
                        <li ><a href="./logout.php" class="manage-menu-item manage-logout" style = "border-bottom: none"><i></i> Thoát</a></li>
                    </ul>

                </div>
                <a href="./user/create-post.php" class="btn btn-red">
                    Đăng tin mới
                    <i></i>
                </a>
            </div>
            <?php  }?>
        </div>
    </nav>
    <nav class="header-navbar">
        <div class="container">
            <ul class="navbar-menu">
                <li class="navbar-item"><a href="./home.php" class="navlist active">Trang chủ</a></li>
                <?php foreach ($resultsCate as $key => $value) {?>
                <li class="navbar-item"><a href="./rooms.php?ca=<?php echo $value -> slug ?>" class="navlist"><?php echo $value -> type ?></a></li>
                <?php } ?>
                <li class="navbar-item"><a href="./news.php" class="navlist" >Tin tức</a></li>
                <li class="navbar-item"><a href="./price-list.php" class="navlist" >Bảng giá</a></li>
                <li class="navbar-item"><a href="./contact.php" class="navlist" >Liên hệ</a></li>
            </ul>
        </div>
    </nav>
</div>