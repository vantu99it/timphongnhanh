<?php
  include './include/connect.php';
  include './include/data.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

  $id = isset($_GET['id'])?$_GET['id']:'';
  $queryRoom = $conn->prepare("SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug,ca.classify AS category_classify,typ.name_type, CURDATE() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.id = $id");
  $queryRoom->execute();
  $resultsRoom = $queryRoom->fetch(PDO::FETCH_OBJ);

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
                    <li class="first link"><a href="#">Cho thuê phòng trọ</a></li>
                    <li class="link link"><a href="#">Nghệ An</a></li>
                    <li class="link link"><a href="#">Thành phố Vinh</a></li>
                    <li class="link last"><a href="#">Bến Thủy</a></li>
                </ol>
            </nav>
          <div class="row">
            <div class="col-8">
                <div id="article-detail" class=" section article-detail">
                    <div class="image-slider slider-detail">
                        <div class="image-item image-item-detail">
                            <div class="image image-detail">
                                <img src="./image/slider-2.jpg" alt="slider1" />
                            </div>
                        </div>
                        <div class="image-item image-item-detail">
                            <div class="image image-detail">
                                <img src="./image/slider-1.jpg" alt="slider1" />
                            </div>
                        </div>
                        <div class="image-item image-item-detail">
                            <div class="image image-detail">
                                <img src="./image/slider-3.jpg" alt="slider1" />
                            </div>
                        </div>
                        <div class="image-item image-item-detail">
                            <div class="image image-detail">
                                <img src="./image/slider-4.jpg" alt="slider1" />
                            </div>
                        </div>
                    </div>
                    <div 
                    <?php if($resultsRoom->news_type_id == 1){?>
                      class="post-detail post-vip vip-hot"
                    <?php } if($resultsRoom->news_type_id == 2){?>
                      class="post-detail post-vip vip-1"
                    <?php } if($resultsRoom->news_type_id == 3){?>
                      class="post-detail post-vip vip-2"
                    <?php } if($resultsRoom->news_type_id == 4){?>
                      class="post-detail post-vip vip-3"
                    <?php } ?>
                    >
                        <div class="detail-info">
                            <div class="post-meta">
                                <h2 class="title">
                                    <a href="#">
                                    <?php if($resultsRoom->news_type_id == 1){?>
                                      <span class="star star-detail star-5"></span>
                                    <?php } if($resultsRoom->news_type_id == 2){?>
                                      <span class="star star-detail star-4"></span>
                                    <?php } if($resultsRoom->news_type_id == 3){?>
                                      <span class="star star-detail star-3"></span>
                                    <?php } if($resultsRoom->news_type_id == 4){?>
                                      <span class="star star-detail star-2"></span>
                                    <?php } ?> 
                                    <?php echo $resultsRoom->name ?></a>
                                </h2>
                                <p>Chuyên mục: <a href="http://"><strong>Cho thuê phòng trọ <?php echo $resultsRoom->ward ?></strong></a></p>
                                <p class="post-location">
                                    <i class="fa-solid fa-location-dot" style = "color: #1266dd;"></i>
                                    <?php echo $resultsRoom -> apartment_number.', '.$resultsRoom -> street.', '.$resultsRoom -> ward.', '.$resultsRoom -> district.', '.$resultsRoom -> city ?>
                                </p>
                                <div class="detail">
                                    <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>
                                    <?php
                                      $tien = (int) $resultsRoom->price;
                                      $bien =0;
                                      if(strlen($tien)>=7){
                                        $bien =  $tien/1000000;
                                        echo $bien.(($resultsRoom -> category_slug == "Cho-thue-Homestay")?" triệu/ngày":" triệu/tháng");
                                      }else {
                                        $bien = number_format($tien,0,",",".");
                                        echo $bien.(($resultsRoom -> category_slug == "Cho-thue-Homestay")?" đ/ngày":" đ/tháng");
                                      }
                                    ?>
                                    </span>
                                    <span class="area mg-25 "><i class="fa-solid fa-expand"></i><?php echo $resultsRoom -> area ?>m&#178;</span>
                                    <span class="detail-time mg-25 "><i class="fa-regular fa-clock"></i>
                                    <?php 
                                      $time = time() - strtotime($resultsRoom->created_ad);
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
                                    <span class="detail-id mg-25 "><i class="fa-solid fa-hashtag"></i><?php echo $resultsRoom -> id ?></span>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <section class="post-content mg-0-15">
                        <div class="section-header pd-10-0  ">
                            <h2 class="section-title">Mô tả chi tiết</h2>
                        </div>
                        <div class="section-content">
                          <?php echo $resultsRoom -> contents?>
                        </div>
                    </section>
                    <section class="section-overview mg-0-15">
                      <div class="section-header pd-10-0  ">
                        <h2 class="section-title">Thông tin bài đăng</h2>
                      </div>
                      <div class="section-content">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td class="name">Mã tin:</td>
                              <td>#<?php echo $resultsRoom -> id ?></td>
                            </tr>
                            <tr>
                              <td class="name">Khu vực:</td>
                              <td>Cho thuê phòng trọ <?php echo $resultsRoom -> city ?></td>
                            </tr>
                            <tr>
                              <td class="name">Loại tin:</td>
                              <td><?php echo $resultsRoom -> category_classify ?></td>
                            </tr>
                            <tr>
                              <td class="name">Đối tượng thuê:</td>
                              <td>
                                <?php if($resultsRoom -> subject == 1) {
                                  echo 'Tất cả';
                                }elseif ($resultsRoom -> subject == 2) {
                                  echo 'Chỉ cho Nam thuê';
                                }else {
                                  echo 'Chỉ cho Nữ thuê';
                                };
                               ?>
                               </td>
                            </tr>
                            <tr>
                              <td class="name">Gói tin</td>
                              <td><?php echo $resultsRoom -> name_type ?></td>
                            </tr>
                            <tr>
                              <td class="name">Ngày đăng</td>
                              <td>Thứ 5, 14:09 10/11/2022</td>
                            </tr>
                            <tr>
                              <td class="name">Ngày hết hạn</td>
                              <td>Thứ 7, 14:09 15/11/2022</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </section>
                    <section class="section-contact mg-0-15">
                      <div class="section-header pd-10-0  ">
                        <h2 class="section-title">Thông tin liên hệ</h2>
                      </div>
                      <div class="section-content">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td class="name">Liên hệ:</td>
                              <td>Nguyễn Văn Tú</td>
                            </tr>
                            <tr>
                              <td class="name">Điện thoại:</td>
                              <td>093237943</td>
                            </tr>
                            <tr>
                              <td class="name">Mã tin:</td>
                              <td>0932379943</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </section>
                    <section class="section-note mg-0-15" style = "margin-bottom: 20px;">
                      <p>Bạn đang xem nội dung tin đăng: <i>"Phòng mới 100% full nội thất 25m2 ban công View Landmark 81 - Mã tin: 609987"</i> . Mọi thông tin liên quan đến tin đăng này chỉ mang tính chất tham khảo. Nếu bạn có phản hồi với tin đăng này (báo xấu, tin đã cho thuê, không liên lạc được,...), vui lòng thông báo để cho chúng tôi để có thể xử lý.</p>
                      <a href="" class="btn btn-feedback">Gửi phản hồi</a>
                    </section>
                </div>
                <section class="section">
                  <div class="section-header">
                    <h2 class="post_title">Tin có liên quan</h2>
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
              <section class="section contact-info">
                <div class="section-author">
                  <div class="author-avata">
                    <img src="./image/author-1.png" alt="Avata">
                  </div>
                  <div class="author-fullname">
                    <p>Nguyễn Văn Tú</p>
                  </div>
                  <a href="tel:+" class="btn author-phone" target="_blank">
                    <i class="fa-solid fa-phone"></i>
                    0932379943
                  </a>
                  <a href="http://zalo.me/0927441096" class="btn author-zalo" target="_blank">
                    Liên hệ qua zalo
                  </a>
                </div>
              </section>
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
                  <h2 class="post_title" style = "font-size:20px">Khu vực Nghệ An</h2>
                </div>
                <ul  class = "category" id = "category">
                  <?php 
                    if(isset($dataCity)&&(count($dataCity)>1)){
                      foreach($dataCity as $list){
                        echo '<li>
                                <h2>
                                  <i class="fa-solid fa-check"></i>
                                  <a href="#">'.$list['fullname'].'</a>
                                </h2>
                                <span class="count">(1200)</span>
                              </li>';
                      }
                    }
                   ?>
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