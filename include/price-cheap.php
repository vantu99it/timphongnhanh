<?php
    $slugCate = isset($_GET['ca'])?$_GET['ca']:"Cho-thue-phong-tro";
    if($slugCate == "Nha-cho-thue" || $slugCate == "Cho-thue-can-ho" || $slugCate == "Cho-thue-mat-bang"){
        $numMin = 5000000;
    }
    elseif($slugCate == "Cho-thue-Homestay"){
        $numMin = 3000000;
    }
    else{
        $numMin = 1000000;
    }


  // Gọi ra các bài viết theo từng loại tin 
  $queryRoomCheap = $conn->prepare("SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.price <= $numMin AND ca.slug = '$slugCate'
  ORDER BY r.price ASC LIMIT 20");
 $queryRoomCheap->execute();
 $resultsRoomCheap = $queryRoomCheap->fetchAll(PDO::FETCH_OBJ);

?>
<section class="section">
    <div class="section-header">
        <h2 class="post_title">giá rẻ bất ngờ</h2>
        </div>
        <div class="section-list-menu">
        <div class="section-list">
            <p>Hiển thị: </p>
            <ul class="list-menu">
                <?php 
                    $queryCateSlug = $conn->prepare("SELECT ca.type, ca.slug FROM tbl_categories ca where ca.status = 1");
                    $queryCateSlug->execute();
                    $resultsCateSlug  = $queryCateSlug->fetchAll(PDO::FETCH_OBJ);
                    $activeFound = false;
                    foreach ($resultsCateSlug as $key => $value) {
                        $class = isset($_GET['ca']) && $_GET['ca'] == $value->slug ? 'active' : '';
                        if ($class === 'active') {
                            $activeFound = true;
                        }
                        ?>
                        <li class="list-menu-item <?php echo $class ?>"><a href="./home.php?ca=<?php echo $value->slug ?>"><?php echo $value -> type ?></a></li>
                        <?php
                    }
                    if (!$activeFound && !empty($resultsCateSlug)) {
                        echo "<script>document.querySelector('.list-menu-item').classList.add('active');</script>";
                    }
                ?>
            </ul>
        </div>
        <p><a href="./rooms-price-cheap.php?ca=<?php echo $slugCate ?>">Xem thêm >></a></p>
        </div>
        <div class="section-slick">
            <?php foreach ($resultsRoomCheap as $key => $value) {?>
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
        </div>
    </section>