<?php
include 'connect.php';
$id = (isset($_SESSION['loginAdmin']['id']))? $_SESSION['loginAdmin']['id']:[];
    if(isset($id)){
        $sql = "SELECT * FROM tbl_admin WHERE id = :id";
        $query= $conn -> prepare($sql);
		$query-> bindParam(':id', $id, PDO::PARAM_STR);
        $query-> execute();
		$results = $query->fetch(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
		{
            $idAd = $results->id;
            $username= $results->username;
            $password= $results->password;
            $fullname= $results->fullname;
            $email= $results->email;
            $phone= $results->phone;
            $avata = $results->avatar;
            
        }
    }
?>
<div id="header">
    <div class="header">
        <div class="header-title">
            <p>Tìm phòng nhanh - Quản trị hệ thống</p>
        </div>
        <div class="account account-right">
            <div class="account-avt">
                <img src="./image/author.png" alt="avata" />
                <!-- <i class="fa-solid fa-user"></i> -->
            </div>
            <div class="account-name">
                <p class="account-fullname">Xin chào: <?php echo $fullname ?></p>
                <iconify-icon class="down" icon="bx:chevron-down" width="18" height="18"></iconify-icon>
                <div class="account-menu">
                    <ul>
                        <li><a href="personal-page.php">Hồ sơ của tôi</a></li>
                        <li><a href="logout.php">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>