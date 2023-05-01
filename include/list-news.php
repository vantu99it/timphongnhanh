<?php 
// Gọi ra số lượng bài viết trong chuyên mục
  $queryListNews = $conn->prepare("SELECT * FROM tbl_news WHERE status = 1 GROUP BY created_at DESC LIMIT 10");
  $queryListNews->execute();
  $resultsListNews  = $queryListNews->fetchAll(PDO::FETCH_OBJ);
?>
<section class="section">
    <div class="section-header">
        <h2 class="post_title" style = "font-size:20px">Bài viết mới</h2>
    </div>
    <ul class = "category" id = "category">
        <?php foreach ($resultsListNews as $key => $value) { ?>
            <li>
                <h2>
                    <i class="fa-solid fa-angle-right"></i>
                    <a href="./news-detail.php?id=<?php echo $value -> id ?>"><?php echo  $value -> title?></a>
                </h2>
            </li>
        <?php } ?>
    </ul>
</section>