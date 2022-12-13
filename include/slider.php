<?php 
    $querySlider = $conn->prepare("SELECT * FROM tbl_slider WHERE status = 1");
    $querySlider->execute();
    $resultsSlider = $querySlider->fetchAll(PDO::FETCH_OBJ);
?>
<div id="slider">
    <div class="image-slider">
        <?php foreach ($resultsSlider as $key => $value) {?>
            <div class="image-item">
                <div class="image">
                    <img src="<?php echo $value -> image ?>" alt="slider" />
                </div>
                <div class="slider-title">
                <h3 class="title-image">
                    <?php echo $value -> title ?>
                </h3>
                <p class="content-image"><?php echo $value -> description ?></p>
                </div>
            </div>
        <?php } ?>
        <!-- <div class="image-item">
            <div class="image">
            <img src="./image/slider-1.jpg" alt="slider1" />
            </div>
            <div class="slider-title">
            <h3 class="title-image">
                Bạn đang có nhà ở cho thuê / đang muốn tìm nhà để thuê
            </h3>
            <p class="content-image">
                Đăng ngay nhà cho thuê / tìm nhà cho thuê ngay
            </p>
            </div>
        </div>
        <div class="image-item">
            <div class="image">
            <img src="./image/slider-3.jpg" alt="slider1" />
            </div>
            <div class="slider-title">
            <h3 class="title-image">
                Bạn đang có căn hộ cho thuê / đang muốn thuê một căn hộ
            </h3>
            <p class="content-image">
                Đăng ngay căn hộ cho thuê / tìm căn hộ cho thuê ngay
            </p>
            </div>
        </div>
        <div class="image-item">
            <div class="image">
            <img src="./image/slider-4.jpg" alt="slider1" />
            </div>
            <div class="slider-title">
            <h3 class="title-image">
                Bạn đang có homestay cho thuê / đang muốn tìm một homestay nghỉ
                dưỡng
            </h3>
            <p class="content-image">
                Đăng ngay homestay lên đây / tìm homestay ngay để tận hưởng chuyến
                đi
            </p>
            </div>
        </div> -->
    </div>
</div>