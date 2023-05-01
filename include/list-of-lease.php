<?php 
// Gọi ra số lượng bài viết trong chuyên mục
  $queryCate = $conn->prepare("SELECT ca.name, ca.slug, COUNT(r.category_id) as number FROM tbl_categories ca JOIN tbl_rooms r on r.category_id = ca.id where ca.status = 1 GROUP BY ca.name;");
  $queryCate->execute();
  $resultsCates  = $queryCate->fetchAll(PDO::FETCH_OBJ);
?>
<section class="section">
    <div class="section-header">
        <h2 class="post_title" style = "font-size:20px">Danh mục cho thuê</h2>
    </div>
    <ul class = "category" id = "category">
        <?php foreach ($resultsCates as $key => $value) { ?>
        <li>
            <h2>
            <i class="fa-solid fa-check"></i>
            <a href="./rooms.php?ca=<?php echo $value->slug?>"><?php echo $value -> name ?></a>
            </h2>
            <span class="count">(<?php echo $value -> number ?>)</span>
        </li>
        <?php } ?>
    </ul>
</section>