
<?php
include 'connect.php';
    // $id = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];
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
        //truy vấn cmt
        $queryCmt= $conn -> prepare("SELECT cmt.*, us.fullname, r.name as room_name, us.avatar FROM tbl_comments cmt 
        JOIN tbl_user us ON us.id = cmt.id_user
        JOIN tbl_rooms r ON r.id = cmt.id_rooms 
        WHERE r.user_id = :id ORDER BY cmt.created_at DESC");
        $queryCmt-> bindParam(':id',$id, PDO::PARAM_STR);
        $queryCmt-> execute();
        $resultsCmt = $queryCmt->fetchAll(PDO::FETCH_OBJ);

        // truy vấn phản hồi
        $queryRep= $conn -> prepare("SELECT rep.*, us.fullname, r.name as room_name, us.avatar, cmt.id_rooms FROM tbl_replies rep 
        JOIN tbl_comments cmt ON cmt.id_comment = rep.id_comment
        JOIN tbl_user us ON us.id = rep.id_user
        JOIN tbl_rooms r ON r.id = cmt.id_rooms
        WHERE cmt.id_user = :id ORDER BY rep.created_at DESC");
        $queryRep-> bindParam(':id',$id, PDO::PARAM_STR);
        $queryRep-> execute();
        $resultsRep = $queryRep->fetchAll(PDO::FETCH_OBJ);

        // tính tổng bình luận chưa phản hồi 
        $totalCmt = $conn ->prepare("SELECT COUNT(cmt.id_comment) as cmtNum FROM tbl_comments cmt 
        JOIN tbl_user us ON us.id = cmt.id_user
        JOIN tbl_rooms r ON r.id = cmt.id_rooms 
        WHERE r.user_id = :id AND cmt.status = 0");
        $totalCmt-> bindParam(':id',$id, PDO::PARAM_STR);
        $totalCmt-> execute();
        $resultsCmtTotal = $totalCmt->fetch(PDO::FETCH_OBJ);
        $cmtNum = $resultsCmtTotal-> cmtNum;

        // tính tổng phản hồi chưa đọc
        $totalReply = $conn ->prepare("SELECT count(rep.id_reply) as replyNum FROM tbl_replies rep JOIN tbl_comments cmt ON cmt.id_comment = rep.id_comment WHERE cmt.id_user = :id AND rep.status = 0 ");
        $totalReply-> bindParam(':id',$id, PDO::PARAM_STR);
        $totalReply-> execute();
        $resultsRepTotal = $totalReply->fetch(PDO::FETCH_OBJ);
        $replyNum = $resultsRepTotal-> replyNum;

        $totalNum = $cmtNum + $replyNum;
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
                    <button class="btn-manage">
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
                <div class="header-notification">
                    <button class="btn-noti">
                        <i class="fa-solid fa-bell"></i>
                    </button>
                    <?php echo $totalNum > 0 ? '<span class="noti-number">'.$totalNum.'</span>' : "" ?>
                    <div class="noti-menu">
                        <div class="tabs">
                            <button class="tablinks active" onclick="openTab(event, 'tab-comment')">Bình luận <?php echo $cmtNum > 0 ? "(".$cmtNum.")" : "" ?></button>
                            <button class="tablinks" onclick="openTab(event, 'tab-replies')">Phản hồi <?php echo $replyNum > 0 ? "(".$replyNum.")" : "" ?></button>

                            <div id="tab-comment" class="tabcontent">
                                <ul class="noti-menu-comment tab-comment">
                                    <?php foreach ($resultsCmt as $key => $value) { ?>
                                    <li style = "background:<?php echo ($value->status == 0) ? "#d4f1ff" : "#fff"?>">
                                        <a href="./article-details.php?id=<?php echo $value->id_rooms ?>" class="noti-menu-item" data-post-id = "<?php echo $value-> id_comment ?>">
                                            <div class="avatar">
                                                <div class="avata-img">
                                                    <?php if(strlen($value -> avatar) != 0){ ?>
                                                        <img src="<?php echo $value -> avatar?>" alt="">
                                                    <?php }else{ ?> 
                                                        <img src="./image/default-user.png" alt="">
                                                        <?php }?>
                                                </div>
                                            </div>
                                            <div class="noti-content">
                                                <p><b><?php echo $value->fullname ?></b> đã bình luận về bài viết <b><?php echo $value->room_name?></b></p>
                                                <span class="post-time">
                                                    <?php 
                                                        $time = time() - strtotime($value->created_at);
                                                        if(floor($time/60/60/24)==0){
                                                            if(floor($time/60/60)==0){
                                                            echo(ceil($time/60)." phút trước");
                                                            }else{
                                                            echo(floor($time/60/60)." tiếng trước");
                                                            }
                                                        }else{
                                                            echo(floor($time/60/60/24)." ngày trước");
                                                        }
                                                    ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div id="tab-replies" class="tabcontent">
                                <ul class="noti-menu-comment tab-replies">
                                    <?php foreach ($resultsRep as $key => $value) { ?>
                                    <li style = "background:<?php echo ($value->status == 0) ? "#d4f1ff" : "#fff"?>">
                                        <a href="./article-details.php?id=<?php echo $value->id_rooms ?>" class="noti-menu-item" data-post-id = "<?php echo $value-> id_reply ?>">
                                            <div class="avatar">
                                                <div class="avata-img">
                                                    <?php if(strlen($value -> avatar) != 0){ ?>
                                                        <img src="<?php echo $value -> avatar?>" alt="">
                                                    <?php }else{ ?> 
                                                        <img src="./image/default-user.png" alt="">
                                                        <?php }?>
                                                </div>
                                            </div>
                                            <div class="noti-content">
                                                <p><b><?php echo $value->fullname ?></b> đã phản hồi bình luận của bạn trong bài viết <b><?php echo $value->room_name?></b></p>
                                                <span class="post-time">
                                                    <?php 
                                                        $time = time() - strtotime($value->created_at);
                                                        if(floor($time/60/60/24)==0){
                                                            if(floor($time/60/60)==0){
                                                            echo(ceil($time/60)." phút trước");
                                                            }else{
                                                            echo(floor($time/60/60)." tiếng trước");
                                                            }
                                                        }else{
                                                            echo(floor($time/60/60/24)." ngày trước");
                                                        }
                                                    ?>
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <script>
                                const tabs = document.querySelectorAll('.tabcontent');
                                tabs.forEach(function(tab) {
                                    const links = tab.querySelectorAll('a');
                                    links.forEach(function(link) {
                                        link.addEventListener('click', handleClick);
                                        function handleClick(event) {
                                            event.preventDefault();
                                            const targetTab = event.target.closest('.tabcontent');
                                            const url = (targetTab.id === 'tab-comment') ? './comment/update-status-comment.php' : './comment/update-status-replies.php';
                                            console.log(url);
                                            const xhr = new XMLHttpRequest();
                                            xhr.open('POST', url);
                                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState === 4 && xhr.status === 200) {
                                                    console.log(xhr.responseText);
                                                    window.location.href = link.getAttribute('href');
                                                    link.removeEventListener('click', handleClick);
                                                }
                                            };
                                            const postId = link.getAttribute('data-post-id');
                                            console.log(postId);
                                            xhr.send('postId=' + postId);
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <a href="./user/create-post.php" class="btn btn-red" style = "margin-left: 15px;">
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