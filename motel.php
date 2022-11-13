<?php
  include './include/connect.php';
  include './include/data.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
    <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <div id="main">
      <div class="container">
        <!-- search -->
        <?php include('./include/search.php');?>
        <!-- /search -->
        <div id="post">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="first link"><a href="#">Trang chủ</a></li>
                    <li class="link link"><a href="#">Cho thuê phòng trọ</a></li>
                </ol>
            </nav>
            <div class="post-header">
                <h1 class="page-title">Cho Thuê Phòng Trọ, Giá Rẻ, Tiện Nghi, Mới Nhất 2022</h1>
                <p class="page-description">Cho thuê phòng trọ - Kênh thông tin số 1 về phòng trọ giá rẻ, phòng trọ sinh viên, phòng trọ cao cấp mới nhất năm 2022. Tất cả nhà trọ cho thuê giá tốt nhất tại Việt Nam.</p>
            </div>
            <section class="section location-city">
                <a href="" class="location-item city-1">
                    <div class="location-bg">
                        <img src="./image/anh1.jpg" alt="">
                    </div>
                    <span class="location-cat">
                        Phòng trọ
                        <span class="location-name">Hà Nội</span>
                    </span>
                </a>
                <a href="" class="location-item city-2">
                    <div class="location-bg">
                        <img src="./image/anh2.jpg" alt="">
                    </div>
                    <span class="location-cat">
                        Phòng trọ
                        <span class="location-name">Nghệ An</span>
                    </span>
                </a>
                <a href="" class="location-item city-3">
                    <div class="location-bg">
                        <img src="./image/anh5.jpg" alt="">
                    </div>
                    <span class="location-cat">
                        Phòng trọ
                        <span class="location-name">Hồ Chí Minh</span>
                    </span>
                </a>
            </section>
            <div class="row">
                <div class="col-8">
                    <section class="section">
                        <div class="section-header">
                        <h2 class="post_title">Danh sách tin đăng</h2>
                        </div>
                        <ul class="post-listing">
                        <li class = "post-item post-vip vip-hot">
                            <figure class="post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                                <span class="bookmark"></span>
                            </a>
                            </figure>
                            <div class="post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-5"></span> Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thanhf phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>2.5 triệu/tháng</span>
                                <span class="area"><i class="fa-solid fa-expand"></i>14m&#178;</span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            <div class="content"> 
                                <p class="post-summary">
                                Phòng trọ đẹp nằm ngay trung tâm quận Phú Nhuận (xem hình thật). View trước là đối diện Khách Sạn 3* Tân Sơn Nhất, View sau là đường Nguyễn Văn…</p>
                                </div>
                            <div class="contact">
                                <div class="avatar">
                                <div class="avata-img">
                                    <img src="./image/author.png" alt="">
                                    <!-- <i class="fa-solid fa-user"></i> -->
                                </div>
                                <span class="author-name">hieuthanh2006</span>
                                <i class="fa-regular fa-circle-check check"></i>
                                </div>
                                <a href="tel:0932379943" class="btn-quick-call" target="_blank" ><i class="fa-solid fa-phone"></i>0932379943</a>
                                <a href="http://zalo.me/0927441096" class="btn-quick-zalo"  target="_blank">Nhắn zalo</a>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item post-vip vip-1">
                            <figure class="post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-4"></span> Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thanhf phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>2.5 triệu/tháng</span>
                                <span class="area"><i class="fa-solid fa-expand"></i>14m&#178;</span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            <div class="content"> 
                                <p class="post-summary">
                                Phòng trọ đẹp nằm ngay trung tâm quận Phú Nhuận (xem hình thật). View trước là đối diện Khách Sạn 3* Tân Sơn Nhất, View sau là đường Nguyễn Văn…</p>
                                </div>
                            <div class="contact">
                                <div class="avatar">
                                <div class="avata-img">
                                    <img src="./image/author.png" alt="">
                                    <!-- <i class="fa-solid fa-user"></i> -->
                                </div>
                                <span class="author-name">hieuthanh2006</span>
                                <i class="fa-regular fa-circle-check check"></i>
                                </div>
                                <a href="tel:0932379943" class="btn-quick-call" target="_blank" target="_blank"><i class="fa-solid fa-phone"></i>0932379943</a>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item post-vip vip-2">
                            <figure class="post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-3"></span> Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thanhf phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>2.5 triệu/tháng</span>
                                <span class="area"><i class="fa-solid fa-expand"></i>14m&#178;</span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            <div class="content"> 
                                <p class="post-summary">
                                Phòng trọ đẹp nằm ngay trung tâm quận Phú Nhuận (xem hình thật). View trước là đối diện Khách Sạn 3* Tân Sơn Nhất, View sau là đường Nguyễn Văn…</p>
                                </div>
                            <div class="contact">
                                <div class="avatar">
                                <div class="avata-img">
                                    <img src="./image/author.png" alt="">
                                    <!-- <i class="fa-solid fa-user"></i> -->
                                </div>
                                
                                <span class="author-name">hieuthanh2006</span>
                                </div>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item post-vip vip-3">
                            <figure class="post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-2"></span> Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thanhf phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>2.5 triệu/tháng</span>
                                <span class="area"><i class="fa-solid fa-expand"></i>14m&#178;</span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            <div class="content"> 
                                <p class="post-summary">
                                Phòng trọ đẹp nằm ngay trung tâm quận Phú Nhuận (xem hình thật). View trước là đối diện Khách Sạn 3* Tân Sơn Nhất, View sau là đường Nguyễn Văn…</p>
                                </div>
                            <div class="contact">
                                <div class="avatar">
                                <div class="avata-img">
                                    <img src="./image/author.png" alt="">
                                    <!-- <i class="fa-solid fa-user"></i> -->
                                </div>
                                <span class="author-name">hieuthanh2006</span>
                                </div>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item post-normal">
                            <figure class="post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta">
                            <h3 class="title">
                                <a href="#">Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thanhf phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>2.5 triệu/tháng</span>
                                <span class="area"><i class="fa-solid fa-expand"></i>14m&#178;</span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            <div class="content"> 
                                <p class="post-summary">
                                Phòng trọ đẹp nằm ngay trung tâm quận Phú Nhuận (xem hình thật). View trước là đối diện Khách Sạn 3* Tân Sơn Nhất, View sau là đường Nguyễn Văn…</p>
                                </div>
                            <div class="contact">
                                <div class="avatar">
                                <div class="avata-img">
                                    <img src="./image/author.png" alt="">
                                    <!-- <i class="fa-solid fa-user"></i> -->
                                </div>
                                
                                <span class="author-name">hieuthanh2006</span>
                                </div>
                            </div>
                            </div>
                        </li>
                        </ul>
                    </section> 
                </div>
                <div class="col-4">
                <section class="section">
                    <div class="section-header">
                        <h2 class="post_title" style = "font-size:20px">Danh sách nối bật</h2>
                    </div>
                    <ul class="post-listing new-post-listing">
                        <li class = "post-item new-post-item post-vip vip-hot">
                            <figure class="post-thumb new-post-thumb">
                                <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                                </a>
                            </figure>
                            <div class="post-meta new-post-meta">
                                <h3 class="title">
                                    <a href="#"><span class="star star-5"></span>Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thành phố vinh nghệ an</a>
                                </h3>
                                <div class="detail">
                                    <span class="price">
                                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                        2.5 triệu/tháng
                                    </span>
                                    <span class="area">
                                        <i class="fa-solid fa-expand"></i>
                                        14m&#178;
                                    </span>
                                    <span class="post-location">
                                        <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                    </span>
                                    <span class="post-time">Hôm nay</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </section>
                <section class="section new-post">
                    <div class="section-header new-post-header ">
                        <h2 class="post_title" style = "font-size:20px">Bài đăng gần nhất</h2>
                    </div>
                    <ul class="post-listing new-post-listing">
                        <li class = "post-item new-post-item post-vip vip-hot">
                            <figure class="post-thumb new-post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta new-post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-5"></span>Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thành phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                2.5 triệu/tháng
                                </span>
                                <span class="area">
                                <i class="fa-solid fa-expand"></i>
                                14m&#178;
                                </span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item new-post-item post-vip vip-1">
                            <figure class="post-thumb new-post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta new-post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-4"></span>Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thành phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                2.5 triệu/tháng
                                </span>
                                <span class="area">
                                <i class="fa-solid fa-expand"></i>
                                14m&#178;
                                </span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item new-post-item post-vip vip-2">
                            <figure class="post-thumb new-post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta new-post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-3"></span>Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thành phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                2.5 triệu/tháng
                                </span>
                                <span class="area">
                                <i class="fa-solid fa-expand"></i>
                                14m&#178;
                                </span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item new-post-item post-vip vip-3">
                            <figure class="post-thumb new-post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta new-post-meta">
                            <h3 class="title">
                                <a href="#"><span class="star star-2"></span>Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thành phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                2.5 triệu/tháng
                                </span>
                                <span class="area">
                                <i class="fa-solid fa-expand"></i>
                                14m&#178;
                                </span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            </div>
                        </li>
                        <li class = "post-item new-post-item">
                            <figure class="post-thumb new-post-thumb">
                            <a href="#" class="clearfix">
                                <img src="./image/anh1.jpg" alt="">
                            </a>
                            </figure>
                            <div class="post-meta new-post-meta">
                            <h3 class="title">
                                <a href="#"></span>Cho thuê phòng trọ - 27 bạch liêu gần đại học Vinh - thành phố vinh nghệ an</a>
                            </h3>
                            <div class="detail">
                                <span class="price">
                                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                2.5 triệu/tháng
                                </span>
                                <span class="area">
                                <i class="fa-solid fa-expand"></i>
                                14m&#178;
                                </span>
                                <span class="post-location">
                                <a href="#"><i class="fa-solid fa-location-dot"></i>Thành phố Vinh, Nghệ An</a>
                                </span>
                                <span class="post-time">Hôm nay</span>
                            </div>
                            </div>
                        </li>
                    </ul>
                </section>
                <section class="section">
                    <div class="section-header">
                        <h2 class="post_title" style = "font-size:20px">Bài viết mới</h2>
                    </div>
                    <ul class = "category" id = "category">
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Các công ty chuyển nhà trọ uy tín nhất hiện nay</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Các công ty chuyển nhà trọ uy tín nhất hiện nay</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Các công ty chuyển nhà trọ uy tín nhất hiện nay</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Các công ty chuyển nhà trọ uy tín nhất hiện nay</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Các công ty chuyển nhà trọ uy tín nhất hiện nay</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Các công ty chuyển nhà trọ uy tín nhất hiện nay</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Các công ty chuyển nhà trọ uy tín nhất hiện nay</a>
                            </h2>
                        </li>
                    </ul>
                </section>
                <section class="section">
                    <div class="section-header">
                        <h2 class="post_title" style = "font-size:20px">Có thể bạn quan tâm</h2>
                    </div>
                    <ul class = "category" id = "category">
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Mẫu hợp đồng cho thuê phòng trọ mới nhất</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Kinh nghiệm thuê phòng trọ Sinh Viên</a>
                            </h2>
                        </li>
                        <li>
                            <h2>
                                <i class="fa-solid fa-angle-right"></i>
                                <a href="">Cẩn thận các kiểu lừa đảo khi thuê phòng trọ</a>
                            </h2>
                        </li>
                    </ul>
                </section>
                </div>
            </div>
        </div>
        <!-- why-support -->
        <?php include('./include/why-support.php');?>
        <!-- /why-support -->
      </div>
    </div>

    <!-- footer + js-->
    <?php include('./include/footer.php');?>
    <!-- /footer + js -->
    
  </body>
</html>