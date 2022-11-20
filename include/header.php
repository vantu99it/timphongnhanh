<?php
include 'connect.php';
$name = (isset($_SESSION['login']['username']))? $_SESSION['login']['username']:[];
    if(isset($_SESSION['login']['username'])){
        $sql = "SELECT * FROM tbl_user";
        $query= $conn -> prepare($sql);
        $query-> execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
		{
            foreach($results as $row){
                $id = $row->id;
                $username= $row->username;
                $password= $row->password;
                $fullname= $row->fullname;
                $email= $row->email;
                $phone= $row->phone;
                $address= $row->address;
                $avata = $row->avatar;
                $balance = $row->balance;
            }
        }
    }
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
                    <img src="./image/author.png" alt="avata" />
                    <!-- <i class="fa-solid fa-user"></i> -->
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
                        <li ><a href="" class="manage-menu-item payment"><i></i> Nạp tiền</a></li>
                        <li ><a href="" class="manage-menu-item payment-history"><i></i>Lịch sử nạp tiền</a></li>
                        <li ><a href="" class="manage-menu-item manage-user"><i></i> Thông tin cá nhân</a></li>
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
                <li class="navbar-item"><a href="./motel-rooms.php" class="navlist">Cho thuê phòng trọ</a></li>
                <li class="navbar-item"><a href="./house.php" class="navlist" >Nhà cho thuê</a></li>
                <li class="navbar-item"><a href="./apartment.php" class="navlist" >Cho thuê căn hộ</a></li>
                <li class="navbar-item"><a href="./homestay.php" class="navlist" >Cho thuê homestay</a></li>
                <li class="navbar-item"><a href="./news.php" class="navlist" >Tin tức</a></li>
                <li class="navbar-item"><a href="./guide.php" class="navlist" >Hướng dẫn</a></li>
                <li class="navbar-item"><a href="./price-list.php" class="navlist" >Bảng giá</a></li>
                <li class="navbar-item"><a href="./loading-money.php" class="navlist" >Nạp tiền</a></li>
            </ul>
        </div>
    </nav>
</div>