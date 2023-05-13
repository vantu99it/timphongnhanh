<?php
    include './include/connect.php';
    include './include/data.php';
    date_default_timezone_set("Asia/Ho_Chi_Minh");

    $slug = isset($_GET['ca'])?$_GET['ca']:'';

    // Gọi ra thông tin category
    $queryCategory = $conn->prepare("SELECT * FROM tbl_categories WHERE slug = :slug");
    $queryCategory-> bindParam(':slug', $slug, PDO::PARAM_STR);
    $queryCategory->execute();
    $resultsCategory = $queryCategory->fetch(PDO::FETCH_OBJ);
    

    // Gọi ra các bài viết theo từng loại tin 
    $queryRoom = $conn->prepare("SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
    FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
    JOIN tbl_city ci ON ci.id = r.city_id
    JOIN tbl_district dis ON dis.id = r.district_id
    JOIN tbl_ward wa ON wa.id = r.ward_id
    JOIN tbl_new_type typ ON typ.id = r.news_type_id
    JOIN tbl_categories ca ON ca.id = r.category_id
    WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND ca.slug = :slug
    ORDER BY r.price ASC ");
    $queryRoom-> bindParam(':slug', $slug, PDO::PARAM_STR);
    $queryRoom->execute();
    $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
    //  var_dump($resultsRoom); die();

    // Gọi ra các bài viết mới nhất
    $queryRoomNew = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
    FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
    JOIN tbl_city ci ON ci.id = r.city_id
    JOIN tbl_district dis ON dis.id = r.district_id
    JOIN tbl_ward wa ON wa.id = r.ward_id
    JOIN tbl_new_type typ ON typ.id = r.news_type_id
    JOIN tbl_categories ca ON ca.id = r.category_id
    WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 1 AND ca.slug = :slug
    ORDER BY r.created_ad DESC LIMIT 2)
    UNION ALL
    (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
    FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
    JOIN tbl_city ci ON ci.id = r.city_id
    JOIN tbl_district dis ON dis.id = r.district_id
    JOIN tbl_ward wa ON wa.id = r.ward_id
    JOIN tbl_new_type typ ON typ.id = r.news_type_id
    JOIN tbl_categories ca ON ca.id = r.category_id
    WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id != 1 AND ca.slug = :slug
    ORDER BY r.created_ad DESC LIMIT 8)");
    $queryRoomNew-> bindParam(':slug', $slug, PDO::PARAM_STR);
    $queryRoomNew->execute();
    $resultsRoomNew = $queryRoomNew->fetchAll(PDO::FETCH_OBJ);
    // var_dump($resultsRoomNew); die();

    // Gọi ra các bài viết nổi bật Vip nổi bật và VIP 1
    $queryRoomHot = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
    FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
    JOIN tbl_city ci ON ci.id = r.city_id
    JOIN tbl_district dis ON dis.id = r.district_id
    JOIN tbl_ward wa ON wa.id = r.ward_id
    JOIN tbl_new_type typ ON typ.id = r.news_type_id
    JOIN tbl_categories ca ON ca.id = r.category_id
    WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 1 AND ca.slug = :slug
    ORDER BY r.created_ad DESC LIMIT 3)
    UNION ALL
    (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
    FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
    JOIN tbl_city ci ON ci.id = r.city_id
    JOIN tbl_district dis ON dis.id = r.district_id
    JOIN tbl_ward wa ON wa.id = r.ward_id
    JOIN tbl_new_type typ ON typ.id = r.news_type_id
    JOIN tbl_categories ca ON ca.id = r.category_id
    WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 2 AND ca.slug = :slug
    ORDER BY r.created_ad DESC LIMIT 2)");
    $queryRoomHot-> bindParam(':slug', $slug, PDO::PARAM_STR);
    $queryRoomHot->execute();
    $resultsRoomHot = $queryRoomHot->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $resultsCategory -> name ?></title>
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
                    <h1 class="page-title"><?php echo $resultsCategory -> title ?></h1>
                    <p class="page-description"><?php echo $resultsCategory -> description ?></p>
                </div>
                <section class="section location-city">
                    <a href="" class="location-item city-1">
                        <div class="location-bg">
                            <img src="./image/anh1.jpg" alt="">
                        </div>
                        <span class="location-cat">
                            <?php echo $resultsCategory -> type ?>
                            <span class="location-name">Hà Nội</span>
                        </span>
                    </a>
                    <a href="" class="location-item city-2">
                        <div class="location-bg">
                            <img src="./image/anh2.jpg" alt="">
                        </div>
                        <span class="location-cat">
                            <?php echo $resultsCategory -> type ?>
                            <span class="location-name">Nghệ An</span>
                        </span>
                    </a>
                    <a href="" class="location-item city-3">
                        <div class="location-bg">
                            <img src="./image/anh5.jpg" alt="">
                        </div>
                        <span class="location-cat">
                            <?php echo $resultsCategory -> type ?>
                            <span class="location-name">Hồ Chí Minh</span>
                        </span>
                    </a>
                </section>
                <div class="row">
                    <div class="col-8">
                        <!-- Tin đăng chính -->
                        <section class="section">
                            <div class="section-header">
                                <h2 class="post_title">Danh sách tin đăng</h2>
                            </div>
                            <ul class="post-listing-cheap">
                                <?php foreach ($resultsRoom as $key => $value) {?>
                                    <div class="slick-item">
                                        <div class="item-detail">
                                            <div class="item-detail-bg">
                                                <a href="./article-details.php?id=<?php echo $value -> id ?>">
                                                    <img src="<?php echo $value -> image_logo ?>" alt="">
                                                    <span 
                                                        <?php if($value->news_type_id == 1){?>
                                                        class="star post-star star-5"
                                                        <?php } if($value->news_type_id == 2){?>
                                                        class="star post-star star-4"
                                                        <?php } if($value->news_type_id == 3){?>
                                                        class="star post-star star-3"
                                                        <?php } if($value->news_type_id == 4){?>
                                                        class="star post-star star-2"
                                                        <?php } ?>>
                                                    </span>
                                                    <div class="detail">
                                                        <span class="post-location">
                                                        <p><i class="fa-solid fa-location-dot"></i> <?php echo $value -> ward.', '.$value -> district.', '.$value -> city ?></p>
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="item-detail-content">
                                                <h3 class="title"><a href="./article-details.php?id=<?php echo $value -> id ?>"><?php echo $value -> name ?></a></h3>
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
                                                <span class="area"><i class="fa-solid fa-expand"></i> <?php echo $value -> area ?>m&#178;</span>
                                                </div>
                                                <p class="content">
                                                    <?php echo strip_tags($value -> contents) ?>
                                                </p>
                                                <div class="detail detail-name">
                                                    <span class="author-name">
                                                        <?php echo $value -> name_user ?>
                                                        <?php if($value->news_type_id == 1 || $value->news_type_id == 2){?>
                                                        <i class="fa-regular fa-circle-check check"></i>
                                                        <?php }?>
                                                    </span>
                                                    <span span class="post-time">
                                                        <?php 
                                                        $time = time() - strtotime($value->created_ad);
                                                        if(floor($time/60/60/24)==0){
                                                            if(floor($time/60/60)==0){
                                                            echo(ceil($time/60)." phút");
                                                            }else{
                                                            echo(floor($time/60/60)." tiếng");
                                                            }
                                                        }else{
                                                            echo(floor($time/60/60/24)." ngày");
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </ul>
                        </section> 
                    </div>
                    <div class="col-4">
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
                                        </span><?php echo $value -> name?> 
                                    </a>
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
                        <!-- Các danh mục cho thuê -->
                            <?php include('./include/list-of-lease.php');?>
                        <!-- Bài viết mới -->
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
