<?php
  include './include/connect.php';
  include './include/data.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

  $item_per_page = 4;
  $current_page = !empty($_GET['page'])?$_GET['page']:1 ;
  $offset = ($current_page -1) * $item_per_page;
  // Gọi ra các bài viết
  $queryNews = $conn->prepare("SELECT news.*, ad.fullname FROM tbl_news news JOIN tbl_admin ad ON ad.id = news.id_admin WHERE news.status = 1 GROUP BY news.created_at DESC LIMIT $item_per_page OFFSET $offset");
  $queryNews->execute();
  $resultsNews  = $queryNews->fetchAll(PDO::FETCH_OBJ);

  $queryTotalNews = $conn->prepare("SELECT * FROM tbl_news WHERE status = 1");
  $queryTotalNews->execute();
  $totalPages = $queryTotalNews ->rowCount();
  $totalPages = ceil($totalPages/$item_per_page);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tin tức</title>
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
        <!--main-content -->
        <div id="post" style = "margin: 25px 0">
          <div class="post-header">
              <h1 class="page-title">Cho thông tin phòng trọ, nhà ở, căn hộ, homestay số 1 Việt Nam</h1>
              <p class="page-description">Kênh thông tin tìm phòng số 1 Việt Nam - Website đăng tin cho thuê phòng trọ, nhà nguyên căn, căn hộ, ở ghép nhanh, hiệu quả với 100.000+ tin đăng và 2.500.000 lượt xem mỗi tháng.</p>
          </div>
          <div class="row">
            <div class="col-8">
              <!-- Hiển thị danh sách tin tức -->
              <section class="section">
                <div class="section-header">
                  <h2 class="post_title">Danh sách tin tức</h2>
                </div>
                <ul class="post-listing">
                  <?php foreach ($resultsNews as $key => $value) { ?>
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
              <!-- phân trang -->
              <?php include './include/page-division.php'; ?>
              <!-- /Phân trang -->
            </div>
            <div class="col-4">
              <!-- Các danh mục cho thuê -->
                <?php include('./include/list-of-lease.php');?>
              <!-- Hiển thị bài đăng mới nhất -->
              <!-- Các bài viết mới nhất -->
                <?php include('./include/list-news.php');?>              
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