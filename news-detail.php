<?php
  include './include/connect.php';
  include './include/data.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

  $id = isset($_GET['id']) ? $_GET['id'] : "";
  // bài viết chi tiết
  $queryNews = $conn->prepare("SELECT news.*, ad.fullname FROM tbl_news news JOIN tbl_admin ad ON ad.id = news.id_admin WHERE news.id = :id");
  $queryNews-> bindParam(':id', $id, PDO::PARAM_STR);
  $queryNews->execute();
  $resultsNews  = $queryNews->fetch(PDO::FETCH_OBJ);

  //bài viết liên quan
  $queryNewsRelate = $conn->prepare("SELECT news.*, ad.fullname FROM tbl_news news JOIN tbl_admin ad ON ad.id = news.id_admin WHERE news.status = 1 and news.id != :id GROUP BY news.created_at DESC LIMIT 5");
  $queryNewsRelate-> bindParam(':id', $id, PDO::PARAM_STR);
  $queryNewsRelate->execute();
  $resultsNewsRelate  = $queryNewsRelate->fetchAll(PDO::FETCH_OBJ);

  // Gọi ra các bài viết mới nhất
  $queryRoomNew = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 1
  ORDER BY r.created_ad DESC LIMIT 5)
  UNION ALL
  (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id != 1
  ORDER BY r.created_ad DESC LIMIT 10)");
  $queryRoomNew->execute();
  $resultsRoomNew = $queryRoomNew->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tin tức chi tiết</title>
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
        <!--main-content -->
        <div id="post" style = "margin: 25px 0">
          <div class="post-header">
              <h1 class="page-title">Cho thông tin phòng trọ, nhà ở, căn hộ, homestay số 1 Việt Nam</h1>
              <p class="page-description">Kênh thông tin tìm phòng số 1 Việt Nam - Website đăng tin cho thuê phòng trọ, nhà nguyên căn, căn hộ, ở ghép nhanh, hiệu quả với 100.000+ tin đăng và 2.500.000 lượt xem mỗi tháng.</p>
          </div>
          <div class="row">
            <div class="col-8">
              <!-- Hiển thị chi tiết tin tức -->
              <section class="section">
                <div class="section-header" style = "border-bottom: 1px solid #dbdbdb;">
                  <h2 class="post_title">Nội dung chi tiết bài đăng</a></h2>
                </div>
                <ul class="post-listing">
                      <div class="post-meta" style = "margin: 15px;">
                        <div class="detail-info">
                            <h2 style = "font-weight: 700;">
                                <?php echo $resultsNews -> title ?></a>
                            </h2>
                            <div class="contact">
                            <div class="avatar">
                                <span class="author-name"><?php echo $resultsNews -> fullname ?></span>
                                <i class="fa-regular fa-circle-check check"></i>
                            </div>
                            <span class="detail">
                                <?php 
                                    $time = time() - strtotime($resultsNews->created_at);
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
                        <div class = "content-news"> 
                            <?php echo $resultsNews -> content ?>
                        </div>
                      </div>
                    </li>
                </ul>
              </section> 

              <!-- Hiển thị tin tức liên quan -->
              <section class="section">
                <div class="section-header">
                  <h2 class="post_title">Các tin tức liên quan</h2>
                </div>
                <ul class="post-listing">
                  <?php foreach ($resultsNewsRelate as $key => $value) { ?>
                    <li class = "post-item post-normal">
                      <figure class="post-thumb" style = "height: 150px;">
                        <a href="./news-detail.php?id=<?php echo $value -> id ?>" class="clearfix">
                          <img src="<?php echo $value -> image_logo ?>" alt="">
                        </a>
                      </figure>
                      <div class="post-meta">
                        <h3 class="title">
                          <a href="./news-detail.php?id=<?php echo $value -> id ?>">
                          <?php echo $value -> title ?></a>
                        </h3>
                        
                        <div class="content" style = "height: auto; -webkit-line-clamp: 3;"> 
                          <p class="post-summary">
                            <?php echo strip_tags($value -> content) ?>
                          </p>
                          </div>
                        <div class="contact">
                          <div class="avatar">
                            <span class="author-name"><?php echo $value -> fullname ?></span>
                            <i class="fa-regular fa-circle-check check"></i>
                          </div>
                          <span class="detail">
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
                      </div>
                    </li>
                    <?php }?>
                </ul>
              </section> 
            </div>
            <div class="col-4">
              <!-- Các danh mục cho thuê -->
                <?php include('./include/list-of-lease.php');?>
              <!-- Hiển thị bài đăng mới nhất -->
              <!-- Các bài viết mới nhất -->
                <?php include('./include/list-news.php');?>   
                <!-- Hiển thị bài đăng mới nhất -->
              <section class="section new-post">
                <div class="section-header new-post-header ">
                  <h2 class="post_title" style = "font-size:20px">Bài đăng mới nhất</h2>
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
                        class="post-item new-post-item post-vip vip-3"
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
                  <?php } ?>
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