<section class="section section-why">
    <div class="section-content why-content">
        <h4 class="section-title">Tại sao lại chọn Tìm phòng nhanh?</h4>
        <p>Chúng tôi biết bạn có rất nhiều lựa chọn, nhưng <b>Tìm phòng nhanh</b> tự hào là trang web đứng top google về các từ khóa: <b>cho thuê phòng trọ, nhà trọ, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép, cho thuê mặt bằng</b>...Vì vậy tin của bạn đăng trên website sẽ tiếp cận được với nhiều khách hàng hơn, do đó giao dịch nhanh hơn, tiết kiệm chi phí hơn</p>
        <div class="why-count">
            <div class="why-count-item">
            <span class="why-count-item-number">200.250+</span>
            <span class="why-count-item-text">Thành viên</span>
            </div>
            <div class="why-count-item">
            <span class="why-count-item-number">100.000++</span>
            <span class="why-count-item-text">Bài đăng</span>
            </div>
            <div class="why-count-item">
            <span class="why-count-item-number">250.000+</span>
            <span class="why-count-item-text">Lượt truy cập/tháng</span>
            </div>
            <div class="why-count-item">
            <span class="why-count-item-number">2.000.000+</span>
            <span class="why-count-item-text">Lượt xem/tháng</span>
            </div>
        </div>
        <h4 class="section-title">Bạn đang có phòng trọ / căn hộ cho thuê?</h4>
        <p>Không phải lo tìm người cho thuê, phòng trống kéo dài</p>
        <?php if(isset($_SESSION['login']['id'])){?>
            <a href="./user/create-post.php" class="btn">Đăng tin ngay</a>
        <?php }else{?>
            <a href="./login.php" class="btn">Đăng tin ngay</a>
        <?php }?>

    </div>
</section>
<section class="section section-support">
    <div class="section-content">
    <div class="support-bg"></div>
    <p>Bạn đang gặp vấn đề về việc tìm nhà cần được hỗ trợ?</p>
    <p>Bạn đang khó khăn trong việc đăng bài cần hỗ trợ?</p>
    <p>Bạn đang gặp khó khăn trong thanh toán cần giúp đỡ?</p>
    <a href="/timphongnhanh/contact.php" class="btn">Gửi liên hệ</a>
    </div>
</section>