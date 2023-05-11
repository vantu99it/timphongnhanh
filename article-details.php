<?php
  include './include/connect.php';
  include './include/data.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

  $id = isset($_GET['id'])?$_GET['id']:'';
  $id_rooms = $id;
  //gọi ra thông tin đăng nhập
  if(isset($_SESSION['login'])){
    $id_user = $_SESSION['login']['id'];
    $queryUser = $conn->prepare("SELECT * FROM tbl_user WHERE id = $id_user");
    $queryUser->execute();
    $resultsUser = $queryUser->fetch(PDO::FETCH_OBJ);
    $userAvatar = $resultsUser -> avatar;
  }
  // Gọi ra thông tin bài viết
  $queryRoom = $conn->prepare("SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,us.facebook,ca.slug AS category_slug, ca.classify AS category_classify,ca.name AS category_name, typ.name_type, ca.name as category_name, CURDATE() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.id = $id");
  $queryRoom->execute();
  $resultsRoom = $queryRoom->fetch(PDO::FETCH_OBJ);
  $cityName = $resultsRoom -> city;
  $category_id = $resultsRoom ->category_id;

  // Gọi ra ảnh bài viết
  $queryRoomImg = $conn->prepare("SELECT * FROM tbl_rooms_image WHERE id_rooms = $id");
  $queryRoomImg->execute();
  $resultsRoomImg = $queryRoomImg->fetchAll(PDO::FETCH_OBJ);

  // Gọi ra danh sách huyện của tỉnh
  $idCity = $resultsRoom -> city_id;
  $queryCity= $conn -> prepare("SELECT c.name as city, d.fullname as district, COUNT(r.district_id) as number FROM tbl_city c JOIN tbl_district d ON c.id = d.city_id JOIN tbl_rooms r ON r.district_id = d.id WHERE c.id = :id GROUP BY d.fullname");
  $queryCity-> bindParam(':id', $idCity, PDO::PARAM_STR);
  $queryCity-> execute();
  $resultsCity = $queryCity->fetchAll(PDO::FETCH_OBJ);

  // Gọi ra các bài viết liên quan
  $queryRoomSame = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 1 AND ci.name = :cityName AND r.id != :id AND r.category_id = :category_id
  ORDER BY r.created_ad DESC LIMIT 2)
  UNION ALL
  (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id != 1 AND ci.name = :cityName AND r.id != :id AND r.category_id = :category_id
  ORDER BY r.news_type_id ASC, r.created_ad DESC LIMIT 4)");
  $queryRoomSame-> bindParam(':cityName', $cityName, PDO::PARAM_STR);
  $queryRoomSame-> bindParam(':id', $id, PDO::PARAM_STR);
  $queryRoomSame-> bindParam(':category_id', $category_id, PDO::PARAM_STR);
  $queryRoomSame->execute();
  $resultsRoomSame = $queryRoomSame->fetchAll(PDO::FETCH_OBJ);

  // Gọi ra các bài viết mới đăng theo chuyên mục
  $queryRoomNew = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 1 AND r.id != :id AND r.category_id = :category_id
  ORDER BY r.created_ad DESC LIMIT 3)
  UNION ALL
  (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id != 1 AND r.id != :id AND r.category_id = :category_id
  ORDER BY r.created_ad DESC LIMIT 7)");
  $queryRoomNew-> bindParam(':id', $id, PDO::PARAM_STR);
  $queryRoomNew-> bindParam(':category_id', $category_id, PDO::PARAM_STR);
  $queryRoomNew->execute();
  $resultsRoomNew = $queryRoomNew->fetchAll(PDO::FETCH_OBJ);

  // Gọi ra các bài viết nổi bật Vip nổi bật và VIP 1
   $queryRoomHot = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
   FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
   JOIN tbl_city ci ON ci.id = r.city_id
   JOIN tbl_district dis ON dis.id = r.district_id
   JOIN tbl_ward wa ON wa.id = r.ward_id
   JOIN tbl_new_type typ ON typ.id = r.news_type_id
   JOIN tbl_categories ca ON ca.id = r.category_id
   WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 1 AND r.id != :id AND r.category_id = :category_id
   ORDER BY r.created_ad DESC LIMIT 3)
   UNION ALL
   (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
   FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
   JOIN tbl_city ci ON ci.id = r.city_id
   JOIN tbl_district dis ON dis.id = r.district_id
   JOIN tbl_ward wa ON wa.id = r.ward_id
   JOIN tbl_new_type typ ON typ.id = r.news_type_id
   JOIN tbl_categories ca ON ca.id = r.category_id
   WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 2 AND r.id != :id AND r.category_id = :category_id
   ORDER BY r.created_ad DESC LIMIT 2)");
   $queryRoomHot-> bindParam(':id', $id, PDO::PARAM_STR);
   $queryRoomHot-> bindParam(':category_id', $category_id, PDO::PARAM_STR);
   $queryRoomHot->execute();
   $resultsRoomHot = $queryRoomHot->fetchAll(PDO::FETCH_OBJ);
  //  var_dump($resultsRoomHot); die();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi tiết bài đăng</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
    <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <div id="main" class = "mg-t90">
      <div class="container">
        <div id="post">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="first link"><a href="#"><?php echo $resultsRoom->category_name?></a></li>
                    <li class="link link"><a href="#"><?php echo $resultsRoom -> city?></a></li>
                    <li class="link link"><a href="#"><?php echo $resultsRoom -> district?></a></li>
                    <li class="link last"><a href="#"><?php echo $resultsRoom -> ward?></a></li>
                </ol>
            </nav>
          <div class="row">
            <div class="col-8">
              <!-- Chi tiết bài viết -->
              <div id="article-detail" class=" section article-detail">
                <div class="image-slider slider-detail">
                  <div class="image-item image-item-detail">
                      <div class="image image-detail">
                          <img src="<?php echo $resultsRoom -> image_logo?>" alt="slider1"/>
                      </div>
                  </div>
                  <?php foreach ($resultsRoomImg as $key => $value) { ?>
                    <div class="image-item image-item-detail">
                        <div class="image image-detail">
                            <img src="<?php echo $value -> image?>" alt="slider1" />
                        </div>
                    </div>
                  <?php } ?>
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
                            <p>Chuyên mục: <a href="http://"><strong><?php echo $resultsRoom->category_name." ".$resultsRoom->ward ?></strong></a></p>
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
                <!-- tabs -->
                <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
                  <input type="radio" name="pcss3t" checked  id="tab1"class="tab-content-first">
                  <label for="tab1"><i class="fa-solid fa-house-signal"></i><span> Chi tiết</span></label>
                  
                  <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
                  <label for="tab2"><i class="fa-solid fa-phone-volume"></i><span>Liên hệ</span></label>
                  
                  <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
                  <label for="tab3"><i class="fa-solid fa-house-lock"></i><span>Thông tin bài đăng</span></label>
                  
                  <input type="radio" name="pcss3t" id="tab5" class="tab-content-last">
                  <label for="tab5"><i class="fa-solid fa-note-sticky"></i><span>Lưu ý</span></label>
                  
                  <ul>
                    <li class="tab-content tab-content-first typography">
                      <div class="section-header pd-10-0  ">
                        <h2 class="section-title">Mô tả chi tiết</h2>
                      </div>
                      <div class="section-content" style ="margin: 0; padding: 0 0 0 10px;">
                        <?php echo $resultsRoom -> contents?>
                      </div>
                    </li>
                    
                    <li class="tab-content tab-content-2 typography">
                      <div class="section-header pd-10-0  ">
                        <h2 class="section-title">Thông tin liên hệ</h2>
                      </div>
                      <div class="section-content" style ="margin: 0; padding: 0 0 0 10px;">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td class="name">Liên hệ:</td>
                              <td><b><?php echo $resultsRoom-> name_user?></b></td>
                            </tr>
                            <tr>
                              <td class="name">Điện thoại:</td>
                              <td><a href="tel:+<?php echo $resultsRoom-> phone_user?>" target="_blank"><?php echo $resultsRoom-> phone_user?></a></td>
                            </tr>
                            <tr>
                              <td class="name">Zalo:</td>
                              <td><a href="http://zalo.me/<?php echo $resultsRoom-> phone_user?>" target="_blank"><?php echo $resultsRoom-> phone_user?></a></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </li>
                    
                    <li class="tab-content tab-content-3 typography">
                      <div class="section-header pd-10-0  ">
                        <h2 class="section-title">Thông tin bài đăng</h2>
                      </div>
                      <div class="section-content" style ="margin: 0; padding: 0 0 0 10px;">
                        <table class="table">
                          <tbody>
                            <tr>
                              <td class="name">Mã tin:</td>
                              <td>#<?php echo $resultsRoom -> id ?></td>
                            </tr>
                            <tr>
                              <td class="name">Khu vực:</td>
                              <td><?php echo $resultsRoom->district." - ".$resultsRoom -> city ?></td>
                            </tr>
                            <tr>
                              <td class="name">Loại tin:</td>
                              <td><?php echo $resultsRoom -> category_name ?></td>
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
                              <td>
                                <?php $date = date_format(date_create( $resultsRoom -> time_start),"N");
                                if($date == 1){echo "Thứ 2, ";}
                                elseif($date == 2){echo "Thứ 3, ";}
                                elseif($date == 3){echo "Thứ 4, ";}
                                elseif($date == 4){echo "Thứ 5, ";}
                                elseif($date == 5){echo "Thứ 6, ";}
                                elseif($date == 6){echo "Thứ 7, ";}
                                else{echo "Chủ nhật, ";}
                                echo date_format(date_create( $resultsRoom -> time_start),"H:i:s d-m-Y")
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td class="name">Ngày hết hạn</td>
                              <td>
                                <?php $date = date_format(date_create( $resultsRoom ->  time_stop),"N");
                                  if($date == 1){echo "Thứ 2, ";}
                                  elseif($date == 2){echo "Thứ 3, ";}
                                  elseif($date == 3){echo "Thứ 4, ";}
                                  elseif($date == 4){echo "Thứ 5, ";}
                                  elseif($date == 5){echo "Thứ 6, ";}
                                  elseif($date == 6){echo "Thứ 7, ";}
                                  else{echo "Chủ nhật, ";}
                                  echo date_format(date_create( $resultsRoom -> time_stop),"H:i:s d-m-Y") ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>				
                    </li>
                    
                    <li class="tab-content tab-content-last typography">
                      <p>Bạn đang xem nội dung tin đăng: <i style= "color: red;">"<?php echo $resultsRoom -> name ?> - Mã tin: #<?php echo $resultsRoom -> id ?>"</i> . Mọi thông tin liên quan đến tin đăng này chỉ mang tính chất tham khảo. Nếu bạn có phản hồi với tin đăng này (báo xấu, tin đã cho thuê, không liên lạc được,...), vui lòng thông báo để cho chúng tôi để có thể xử lý.</p>
                      <div class = "btn-handling">
                        <a href="./contact.php" class="btn btn-feedback">Gửi phản hồi</a>
                        <?php $id_user = isset($_SESSION['login']['id'])?$_SESSION['login']['id']:"";
                          if($resultsRoom-> user_id == $id_user){?>
                          <a href="./user/edit-post.php?id=<?php echo $resultsRoom -> id?>&edit=1" class="btn btn-feedback">Sửa bài viết</a>
                        <?php } ?>
                      </div>
                    </li>
                  </ul>
                </div>
                <!--/ tabs -->
                <!-- comment -->
                <section class = "section-comment">
                  <?php if(isset($_SESSION['login'])) {?>
                    <form method="post" id="comment-form">
                      <input type="hidden" name="id_rooms" value="<?php echo $id_rooms; ?>">
                      <div class="form-contact comment-input">
                        <div class="avatar">
                          <div class="avata-img">
                            <?php if(strlen($userAvatar) != 0){ ?>
                              <img src="<?php echo $userAvatar ?>" alt="">
                            <?php }else{ ?> 
                              <img src="./image/default-user.png" alt="">
                            <?php }?> 
                          </div>
                        </div>
                        <input type="text" name="comment_content" id="comment_content" placeholder="Bình luận dưới tên <?php echo $_SESSION['login']['fullname']?>">
                        <button type="submit" id="submit-comment" class="btn btn-contact submit-comment"><i class="fa-solid fa-paper-plane"></i></button>
                      </div>
                    </form>
                  <?php } else { ?>
                    <h4>Bạn vui lòng <a href="./login.php">đăng nhập</a> để sử sử dụng chức năng bình luận.</h4>
                  <?php }?>
                  <div id="comment-message"></div>
                  <hr>
                  <div id="comments"></div>
                  <div id="reply-comments"></div>
                </section>
                <!-- /comment -->
              </div>
              <!-- Tin có liên quan theo tỉnh -->
              <section class="section">
                <div class="section-header">
                  <h2 class="post_title">Tin có liên quan</h2>
                </div>
                <ul class="post-listing">
                  <?php foreach ($resultsRoomSame as $key => $value) { ?>
                  <!-- Tin VIP nổi bật -->
                    <li 
                      <?php if($value->news_type_id == 1){?>
                        class = "post-item post-vip vip-hot"
                      <?php } if($value->news_type_id == 2){?>
                        class = "post-item post-vip vip-1"
                      <?php } if($value->news_type_id == 3){?>
                        class = "post-item post-vip vip-2"
                      <?php } if($value->news_type_id == 4){?>
                        class = "post-item post-vip vip-3"
                      <?php } if($value->news_type_id == 5){?>
                        class = "post-item post-normal"
                      <?php } ?>
                    >
                      <figure class="post-thumb">
                        <a href="./article-details.php?id=<?php echo $value -> id ?>" class="clearfix">
                          <img src="<?php echo $value -> image_logo ?>" alt="">
                          <?php if($value->news_type_id == 1){?>
                            <span class="bookmark"></span>
                          <?php }?>
                        </a>
                      </figure>
                      <div class="post-meta">
                        <h3 class="title">
                          <a href="./article-details.php?id=<?php echo $value -> id ?>">
                          <span 
                            <?php if($value->news_type_id == 1){?>
                              class="star star-5"
                            <?php } if($value->news_type_id == 2){?>
                              class="star star-4"
                            <?php } if($value->news_type_id == 3){?>
                            class="star star-3"
                            <?php } if($value->news_type_id == 4){?>
                              class="star star-2"
                            <?php } ?>>
                          </span>
                          <?php echo $value -> name ?></a>
                        </h3>
                        <div class="detail">
                          <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>
                            <?php
                              $tien = (int) $value->price;
                              $bien =0;
                              if(strlen($tien)>=7){
                                $bien =  $tien/1000000;
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" triệu/ngày":" triệu/tháng");
                              }else {
                                $bien = number_format($tien,0,",",".");
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" đ/ngày":" đ/tháng");
                              }
                            ?>
                          </span>
                          <span class="area"><i class="fa-solid fa-expand"></i><?php echo $value -> area ?>m&#178;</span>
                          <span class="post-time">
                            <?php 
                              $time = time() - strtotime($value->created_ad);
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
                        <div class="detail">
                          <span class="post-location">
                            <p><i class="fa-solid fa-location-dot"></i><?php echo $value -> ward.', '.$value -> district.', '.$value -> city ?></p>
                          </span>
                          
                        </div>
                        <div class="content"> 
                          <p class="post-summary">
                            <?php echo strip_tags($value -> contents) ?>
                          </p>
                          </div>
                        <div class="contact">
                          <div class="avatar">
                            <div class="avata-img">
                              <?php if(strlen($value -> avatar) != 0){ ?>
                                <img src="<?php echo $value -> avatar ?>" alt="">
                              <?php }else{ ?>
                                <img src="./image/default-user.png" alt="">
                              <?php }?>
                            </div>
                            <span class="author-name"><?php echo $value -> name_user ?></span>
                            <?php if($value->news_type_id == 1 || $value->news_type_id == 2){?>
                              <i class="fa-regular fa-circle-check check"></i>
                            <?php }?>
                          </div>
                          <?php if($value->news_type_id == 1 || $value->news_type_id == 2 ){?>
                          <a href="tel:<?php echo $value -> phone_user ?>" class="btn-quick-call" target="_blank" ><i class="fa-solid fa-phone"></i><?php echo $value -> phone_user ?></a>
                          <?php }?>
                          <?php if($value->news_type_id == 1 ){?>
                          <a href="http://zalo.me/<?php echo $value -> phone_user ?>" class="btn-quick-zalo"  target="_blank">Nhắn zalo</a>
                          <?php }?>
                        </div>
                      </div>
                    </li>
                  <?php }?>
                </ul>
              </section>
            </div>
            <div class="col-4">
              <!-- Thông tin người cho thuê -->
              <section class="section contact-info">
                <div class="section-author">
                  <div class="author-avata">
                    <?php if(strlen($resultsRoom -> avatar) != 0){?>
                      <img src="<?php echo $resultsRoom -> avatar?>" alt="Avata">
                    <?php } else { ?>
                      <img src="./image/default-user.png" alt="Avata">
                    <?php } ?>
                  </div>
                  <div class="author-fullname">
                    <p><?php echo $resultsRoom -> name_user?></p>
                  </div>
                  <a href="tel:+<?php echo $resultsRoom -> phone_user?>" class="btn author-phone" target="_blank">
                    <i class="fa-solid fa-phone"></i>
                    <?php echo $resultsRoom -> phone_user?>
                  </a>
                  <a href="http://zalo.me/<?php echo $resultsRoom -> phone_user?>" class="btn author-zalo" target="_blank">
                    Liên hệ qua zalo
                  </a>
                  <a href="<?php echo $resultsRoom -> facebook?>" class="btn author-zalo" target="_blank">
                    Liên hệ qua facebook
                  </a>
                </div>
              </section>
              <!-- Bài đăng nổi bật -->
              <section class="section">
                <div class="section-header">
                  <h2 class="post_title" style = "font-size:20px">Danh sách nối bật</h2>
                </div>
                <ul class="post-listing new-post-listing">
                  <?php foreach ($resultsRoomHot as $key => $value) { ?>
                    <li 
                      <?php if($value->news_type_id == 1){?>
                        class="post-item new-post-item post-vip vip-hot"
                      <?php } if($value->news_type_id == 2){?>
                        class="post-item new-post-item post-vip vip-1"
                      <?php } ?>
                    >
                      <figure class="post-thumb new-post-thumb">
                        <a href="./article-details.php?id=<?php echo $value -> id ?>" class="clearfix">
                          <img src="<?php echo $value -> image_logo?>" alt="">
                        </a>
                      </figure>
                      <div class="post-meta new-post-meta">
                        <h3 class="title">
                          <a href="./article-details.php?id=<?php echo $value -> id ?>">
                          <span 
                            <?php if($value->news_type_id == 1){?>
                              class="star star-5"
                            <?php } if($value->news_type_id == 2){?>
                              class="star star-4"
                            <?php } ?>
                          >
                          </span><?php echo $value -> name?> </a>
                        </h3>
                        <div class="detail">
                          <span class="price">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            <?php
                              $tien = (int) $value->price;
                              $bien =0;
                              if(strlen($tien)>=7){
                                $bien =  $tien/1000000;
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" triệu/ngày":" triệu/tháng");
                              }else {
                                $bien = number_format($tien,0,",",".");
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" đ/ngày":" đ/tháng");
                              }
                            ?>
                          </span>
                          <span class="area">
                            <i class="fa-solid fa-expand"></i>
                            <?php echo $value -> area?>m&#178;
                          </span>
                          <span class="post-location">
                            <a href="#"><i class="fa-solid fa-location-dot"></i><?php echo $value -> district.', '.$value -> city ?></a>
                          </span>
                          <span class="post-time">
                            <?php 
                              $time = time() - strtotime($value->created_ad);
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
                      </div>
                    </li>
                  <?php } ?>
                </ul>
              </section>
              <!-- Bài đăng mới nhất -->
              <section class="section new-post">
                <div class="section-header new-post-header ">
                  <h2 class="post_title" style = "font-size:20px">Bài đăng gần nhất</h2>
                </div>
                <ul class="post-listing new-post-listing">
                  <?php foreach ($resultsRoomNew as $key => $value) { ?>
                    <li 
                      <?php if($value->news_type_id == 1){?>
                        class="post-item new-post-item post-vip vip-hot"
                      <?php } if($value->news_type_id == 2){?>
                        class="post-item new-post-item post-vip vip-1"
                      <?php } if($value->news_type_id == 3){?>
                        class="post-item new-post-item post-vip vip-2"
                      <?php } if($value->news_type_id == 4){?>
                        class="post-item new-post-item post-vip vip-2"
                      <?php } if($value->news_type_id == 5){?>
                      class="post-item new-post-item"
                      <?php } ?>
                    >
                      <figure class="post-thumb new-post-thumb">
                        <a href="./article-details.php?id=<?php echo $value -> id ?>" class="clearfix">
                          <img src="<?php echo $value -> image_logo?>" alt="">
                        </a>
                      </figure>
                      <div class="post-meta new-post-meta">
                        <h3 class="title">
                          <a href="./article-details.php?id=<?php echo $value -> id ?>">
                          <span 
                            <?php if($value->news_type_id == 1){?>
                              class="star star-5"
                            <?php } if($value->news_type_id == 2){?>
                              class="star star-4"
                            <?php } if($value->news_type_id == 3){?>
                             class="star star-3"
                            <?php } if($value->news_type_id == 4){?>
                              class="star star-2"
                            <?php } ?>
                          >
                          </span><?php echo $value -> name?> </a>
                        </h3>
                        <div class="detail">
                          <span class="price">
                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                            <?php
                              $tien = (int) $value->price;
                              $bien =0;
                              if(strlen($tien)>=7){
                                $bien =  $tien/1000000;
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" triệu/ngày":" triệu/tháng");
                              }else {
                                $bien = number_format($tien,0,",",".");
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" đ/ngày":" đ/tháng");
                              }
                            ?>
                          </span>
                          <span class="area">
                            <i class="fa-solid fa-expand"></i>
                            <?php echo $value -> area?>m&#178;
                          </span>
                          <span class="post-location">
                            <a href="#"><i class="fa-solid fa-location-dot"></i><?php echo $value -> district.', '.$value -> city ?></a>
                          </span>
                          <span class="post-time">
                            <?php 
                              $time = time() - strtotime($value->created_ad);
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
                      </div>
                    </li>
                  <?php } ?>
                </ul>
              </section>
              <!-- Khu vực tương tự -->
              <section class="section">
                <div class="section-header">
                  <h2 class="post_title" style = "font-size:20px">Khu vực <?php echo $cityName?></h2>
                </div>
                <ul  class = "category" id = "category">
                  <?php foreach ($resultsCity as $key => $value) {?>
                    <li>
                      <h2>
                        <i class="fa-solid fa-check"></i>
                        <a href="#"><?php echo $value -> district ?></a>
                      </h2>
                      <span class="count">(<?php echo $value -> number ?>)</span>
                    </li>
                  <?php } ?>
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
    <script>
      //load lại trang và lấy dư liệu
        var fetchCommentsEnabled = true;
        var commentsLoaded = false; 
        function fetchComments(){
            if (!commentsLoaded && fetchCommentsEnabled) { 
                commentsLoaded = true; 
                var id_rooms = <?php echo $id_rooms; ?>; 
                $.ajax({
                    url: "./comment/comment.php",
                    method: "POST",
                    data: {id_rooms: id_rooms},
                    success: function(result){
                        $("#comments").html(result);
                    },
                    complete: function() {
                        setTimeout(fetchComments, 10000); 
                    }
                });
            } else {
                setTimeout(fetchComments, 10000);
            }
        }
        fetchComments();

        //gửi bình luận
        $("#comment-form").submit(function(event) {
            event.preventDefault();
            var commentContent = $("#comment_content").val().trim();
            if (commentContent.length === 0) {
                $("#comment-message").text("Vui lòng không bỏ trống"); 
                return;
            }
            $.ajax({
                url: "./comment/process_comment.php",
                type: "POST",
                data: $(this).serialize(), 
                success: function(response) {
                    $("#comment_content").val(''); 
                    $("#comment-message").text("");
                    commentsLoaded = false;
                    fetchComments();
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            });
        });

        //nhấn nút phản hồi
        $(document).on("click", ".reply-button", function() {
          var commentDiv = $(this).closest(".comment");
          commentDiv.find("#replies").addClass("add-display"); 
        });

        //gửi bình luận
        $(document).on("submit", ".reply-form", function(event) {
            event.preventDefault();
            var form = $(this);
            var replyContent = form.find("input[name=reply_content]").val().trim(); 
            if (replyContent.length === 0) { 
                $("#reply-form-message").html("<p>Vui lòng không bỏ trống.</p>"); 
                return; 
            }
            $.ajax({
                url: "./comment/process_reply.php",
                type: "POST",
                data: form.serialize(), 
                success: function(response) {
                    form.remove(); 
                    $("#reply-form-message").html("");
                    commentsLoaded = false;
                    fetchComments();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            });
        });

        //xóa bình luận
        $(document).on("click", ".delete-button", function() {
            var commentDiv = $(this).closest(".comment");
            var commentId = commentDiv.data("id");
            if (confirm("Bạn có chắc muốn xóa bình luận này?")) {
              $.ajax({
                  url: "./comment/delete_comment.php",
                  type: "POST",
                  data: { id_comment: commentId },
                  success: function(response) {
                      commentsLoaded = false;
                      fetchComments();
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                  }
              });
            }
        });

        //xóa phản hồi
        $(document).on("click", ".delete-button-reply", function() {
            var replyDiv = $(this).closest(".reply");
            var replyId = replyDiv.data("id");
            if (confirm("Bạn có chắc muốn xóa phản hồi này?")) {
              $.ajax({
                  url: "./comment/delete_reply.php",
                  type: "POST",
                  data: { id_reply: replyId },
                  success: function(response) {
                      commentsLoaded = false;
                      fetchComments();
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                  }
              });
            }
        });

      //hiện tất cả phản hồi
      $(document).on("click", ".show-more", function(event) {
        event.preventDefault();
        const showMoreBtn = $(this);
        const commentEl = showMoreBtn.closest('.comment-test');
        const replyEls = commentEl.find('.reply');
        const totalEls = commentEl.find('.total-reply');

        totalEls.addClass('hidden');
        replyEls.addClass('show');
      });

    </script>
  </body>
</html>