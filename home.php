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

    <!-- slider -->
    <?php include('./include/slider.php');?>
    <!-- /slider -->

    <div id="main">
      <div class="container">
        <!-- search -->
        <?php include('./include/search.php');?>
        <!-- /search -->
        <!--main-content -->
        <div id="post">
          <div class="post-header">
              <h1 class="page-title">Cho thông tin phòng trọ, nhà ở, căn hộ, homestay số 1 Việt Nam</h1>
              <p class="page-description">Kênh thông tin Phòng Trọ số 1 Việt Nam - Website đăng tin cho thuê phòng trọ, nhà nguyên căn, căn hộ, ở ghép nhanh, hiệu quả với 100.000+ tin đăng và 2.500.000 lượt xem mỗi tháng.</p>
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
                  <h2 class="post_title" style = "font-size:20px">Danh mục cho thuê</h2>
                </div>
                <ul  class = "category" id = "category">
                  <?php 
                    if(isset($dataCate)&&(count($dataCate)>1)){
                      foreach($dataCate as $list){
                        echo '<li>
                                <h2>
                                  <i class="fa-solid fa-check"></i>
                                  <a href="#">'.$list['name'].'</a>
                                </h2>
                                <span class="count">(1200)</span>
                              </li>';
                      }
                    }
                    ?>
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
                <ul class = "category" >
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
        <!-- main-content -->
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
