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
    
    <!-- bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <!-- slick slider -->
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <link rel="stylesheet" href="./libs/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
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
        <div id="search">
          <div class="search">
            <form action="" method="post">
              <div class="search-item">
                <i class="fa-solid fa-house"></i>
                <select class="autobox" id="categories">
                  <option value="0">Chọn loại phòng</option>
                </select>
              </div>
              <div class="search-item">
                <i class="fa-solid fa-location-dot"></i>
                <select  class="autobox autobox-city " id="city">
                  <option value="0">Chọn tỉnh</option>
                </select>
              </div>
              <div class="search-item">
                <i class="fa-solid fa-thumbtack"></i>
                <select  class="autobox autobox-district" id="district">
                  <option value="0">Chọn huyện</option>
                </select>
              </div>
              <div class="search-item">
                <i class="fa-solid fa-location-arrow"></i>
                <select  class="autobox" id="ward">
                  <option value="0">Chọn xã</option>
                </select>
              </div>
              <div class="search-item ">
                <input type="submit" value="Tìm kiếm">
              </div>
            </form>
          </div>
        </div>
        <div id="post">
          <div class="row">
            <div class="col-8">
              <section class="section">
                <div class="section-header">
                  <h1 class="post_title">Danh sách tin đăng</h1>
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
                        <a href="tel:0932379943" class="btn-quick-call" target="_blank" target="_blank"><i class="fa-solid fa-phone"></i>0932379943</a>
                        <a href="http://zalo.me/0927441096" class="btn-quick-zalo" target="_blank" target="_blank">Nhắn zalo</a>
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
                  <h1 class="post_title" style = "font-size:20px">Danh mục cho thuê</h1>
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
                  <h1 class="post_title" style = "font-size:20px">Bài đăng gần nhất</h1>
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
