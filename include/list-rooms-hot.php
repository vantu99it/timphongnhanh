<?php
    $slugCate = isset($_GET['ca'])?$_GET['ca']:"Cho-thue-phong-tro";
  // Gọi ra các bài viết theo từng loại tin 
  $queryRoomHot = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.news_type_id = 1 AND ca.slug = '$slugCate'
  ORDER BY r.time_start DESC LIMIT 10)
  UNION ALL
  (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
  FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
  JOIN tbl_city ci ON ci.id = r.city_id
  JOIN tbl_district dis ON dis.id = r.district_id
  JOIN tbl_ward wa ON wa.id = r.ward_id
  JOIN tbl_new_type typ ON typ.id = r.news_type_id
  JOIN tbl_categories ca ON ca.id = r.category_id
  WHERE r.status = 2 AND r.time_start <= NOW()  AND r.time_stop >= NOW() AND r.news_type_id = 2 AND ca.slug = '$slugCate'
  ORDER BY r.time_start DESC LIMIT 10)");
 $queryRoomHot->execute();
 $resultsRoomHot = $queryRoomHot->fetchAll(PDO::FETCH_OBJ);

?>
<section class="section">
    <div class="section-header">
        <h2 class="post_title">bài đăng nổi bật</h2>
    </div>
    <div class="section-slick-hot">
        <?php for($i=0; $i<count($resultsRoomHot); $i++){ ?>
            <div class="slick-item slick-item-hot"<?php if($i>=3) echo ' style="display: none;"'; ?>>
                <div class="item-detail">
                    <div class="item-detail-bg">
                        <a href="./article-details.php?id=<?php echo $resultsRoomHot[$i] -> id ?>">
                            <img src="<?php echo $resultsRoomHot[$i] -> image_logo ?>" alt="">
                            <span 
                                <?php if($resultsRoomHot[$i]->news_type_id == 1){?>
                                class="star post-star star-5"
                                <?php } if($resultsRoomHot[$i]->news_type_id == 2){?>
                                class="star post-star star-4"
                                <?php } if($resultsRoomHot[$i]->news_type_id == 3){?>
                                class="star post-star star-3"
                                <?php } if($resultsRoomHot[$i]->news_type_id == 4){?>
                                class="star post-star star-2"
                                <?php } ?>>
                            </span>
                            <div class="detail">
                                <span class="post-location">
                                <p><i class="fa-solid fa-location-dot"></i> <?php echo $resultsRoomHot[$i] -> ward.', '.$resultsRoomHot[$i] -> district.', '.$resultsRoomHot[$i] -> city ?></p>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="item-detail-content">
                        <h3 class="title"><a href="./article-details.php?id=<?php echo $resultsRoomHot[$i] -> id ?>"><?php echo $resultsRoomHot[$i] -> name ?></a></h3>
                        <div class="detail">
                        <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i> 
                            <?php
                            $tien = (int) $resultsRoomHot[$i]->price;
                            $bien =0;
                            if(strlen($tien)>=7){
                                $bien =  $tien/1000000;
                                echo $bien.(($resultsRoomHot[$i] -> category_slug == "Cho-thue-Homestay")?" triệu/ngày":" triệu/tháng");
                            }else {
                                $bien = number_format($tien,0,",",".");
                                echo $bien.(($resultsRoomHot[$i] -> category_slug == "Cho-thue-Homestay")?" đ/ngày":" đ/tháng");
                            }
                            ?>
                        </span>
                        <span class="area"><i class="fa-solid fa-expand"></i> <?php echo $resultsRoomHot[$i] -> area ?>m&#178;</span>
                        </div>
                        <p class="content">
                            <?php echo strip_tags($resultsRoomHot[$i] -> contents) ?>
                        </p>
                        <div class="detail detail-name">
                            <span class="author-name">
                                <?php echo $resultsRoomHot[$i] -> name_user ?>
                                <?php if($resultsRoomHot[$i]->news_type_id == 1 || $resultsRoomHot[$i]->news_type_id == 2){?>
                                <i class="fa-regular fa-circle-check check"></i>
                                <?php }?>
                            </span>
                            <span span class="post-time">
                                <?php 
                                $time = time() - strtotime($resultsRoomHot[$i]->created_ad);
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
    <?php if(count($resultsRoomHot) > 3){ ?>
        <button class="btn btn-read-more" id="btn-read-more" data-total-posts="<?php echo count($resultsRoomHot) ?>">Xem thêm</button>
        <a href="./rooms.php?ca=<?php echo $slugCate ?>" class="btn btn-view-all" id = "btn-view-all">Xem nhiều hơn</a>
    <?php } ?>
</section>
<script>
    var totalPosts = document.getElementById("btn-read-more").getAttribute("data-total-posts");
    var btnReadMore = document.getElementById("btn-read-more");
    var btnViewAll = document.getElementById("btn-view-all");
    var count = 3;

    function showNextPosts() {
        var hiding = document.querySelectorAll('.slick-item-hot[style*="display: none"]');
        
        for(var i=0; i<hiding.length && i<1; i++){
            hiding[i].style.display = "block";
        }
        count += 1;
        if(document.querySelectorAll('.slick-item-hot[style*="display: none"]').length === 0){
            btnReadMore.style.display = "none";
            btnViewAll.style.display = "block";
        }
    }

    btnReadMore.addEventListener("click", showNextPosts);
</script>