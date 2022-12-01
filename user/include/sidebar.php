<?php
$name = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

if(isset($_SESSION['login']['id'])){
    $sql = "SELECT * FROM tbl_user WHERE id = :id";
    $query= $conn -> prepare($sql);
    $query-> bindParam(':id', $_SESSION['login']['id'], PDO::PARAM_STR);
    $query-> execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
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
?>

<div id="sidebar">
        <div class="account">
            <div class="account-avt">
                <img src="./image/author.png" alt="avata" />
                <!-- <i class="fa-solid fa-user"></i> -->
            </div>
            <div class="account-name">
                <div class="name">
                    <p class="account-fullname"><?php echo  $fullname ?></p>
                    <p class="account-phone"><?php echo  $phone ?></p>
                </div>
            </div>
            <ul>
                <li>
                    <span>Mã thành viên:</span>
                    <span  style = "font-weight: 700">#<?php echo  $id ?></span>
                </li>
                <li>
                    <span>Số dư TK:</span>
                    <span style = "font-weight: 700"><?php echo  number_format($balance,0,",",".")  ?> VNĐ</span>
                </li>
            </ul>
            <div class="account-btn">
                <a href="http://" class="btn btn-recharge">Nạp tiền</a>
                <a href="http://" class="btn btn-post">Đăng tin</a>
            </div>
            
        </div>
        <ul class="sidebar-menu">
            <li class="menu-item active">
                <a href="">
                    <iconify-icon class="icon" icon="fa:dashboard" width="24" height="24"></iconify-icon>
                    Thông tin cá nhân
                </a>
                
            </li>
            <li class="menu-item">
                <a href="javascrip:void(0)">
                    <iconify-icon class="icon" icon="ic:twotone-post-add" width="24" height="24"></iconify-icon>
                    Quản lý tin đăng
                    <iconify-icon class="down" icon="bx:chevron-down" width="18" height="18"></iconify-icon>
                </a>
                <ul class="sidebar-menu-mini">
                    <li class="menu-item-mini"><a href="./create-post.php">Thêm mới</a></li>
                    <li class="menu-item-mini"><a href="./post-manage.php">Tin đã đăng</a></li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascrip:void(0)">
                    <iconify-icon class="icon" icon="fluent:money-hand-20-filled" width="24" height="24"></iconify-icon> 
                    Nạp tiền vào tài khoản         
                </a>
            </li>
            <li class="menu-item">
                <a href="javascrip:void(0)">
                    <iconify-icon class="icon" icon="fluent:receipt-money-24-filled" width="24" height="24"></iconify-icon>
                    Lịch sử nạp tiền         
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <iconify-icon class="icon" icon="la:money-check-alt" width="24" height="24"></iconify-icon>
                    Lịch sử thanh toán
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                <iconify-icon class="icon" icon="ri:price-tag-2-fill" width="24" height="24"></iconify-icon>
                    Bảng giá dịch vụ
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <iconify-icon class="icon" icon="ic:round-contact-mail" width="24" height="24"></iconify-icon>
                    Liên hệ
                </a>
            </li>
            <li class="menu-item">
                <a href="">
                    <iconify-icon class="icon" icon="octicon:sign-out-16" width="24" height="24"></iconify-icon>
                    Thoát
                </a>
            </li>
        </ul>
    </div>