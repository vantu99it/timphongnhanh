<div id="footer">
    <div class="container">
    <div class="row">
        <div class="col-3 footer-cubes">
        <a
            class="bottom-logo logo"
            href=""
            title="cho thuê phòng trọ, cho thuê nhà trọ, tìm phòng trọ"
            >
        </a>
        <p><b>Tìm phòng nhanh</b> tự hào có lượng dữ liệu bài đăng lớn nhất trong lĩnh vực cho thuê phòng trọ và được nhiều người lựa chọn là website uy tín để lựa chọn phòng trọ, thuê nhà, căn hộ, homestay,..</p>
        </div>
        <div class="col-3 footer-cubes">
        <div class="footer-title">Danh mục cho thuê</div>
        <ul class="footer-category category">
            <?php 
            if(isset($dataCate)&&(count($dataCate)>1)){
                foreach($dataCate as $list){
                echo '<li>
                        <h4>
                            <a href="#">'.$list['name'].'</a>
                        </h4>
                        </li>';
                }
            }
            ?>
        </ul>
        </div>
        <div class="col-3 footer-cubes">
        <div class="footer-title">Hỗ trợ khách hàng</div>
        <ul class="footer-support category">
            <li><a href="#">Câu hỏi thường gặp</a></li>
            <li><a href="#">Hướng dẫn đăng tin</a></li>
            <li><a href="#">Bảng giá dịch vụ</a></li>
            <li><a href="#">Quy định đăng tin</a></li>
            <li><a href="#">Giải quyết khiếu nại</a></li>
        </ul>
        </div>
        <div class="col-3 footer-cubes">
        <div class="footer-title">Liên hệ với chúng tôi</div>
        <div class="social-link">
            <a href="http://" target="_blank" rel="nofollow" class="facebook"><i></i></a>
            <a href="http://" target="_blank" rel="nofollow" class="instagram"><i></i></a>
            <a href="http://" target="_blank" rel="nofollow" class="zalo"><i></i></a>
            <a href="tel:" target="_blank" rel="nofollow" class="phone"><i></i></a>
        </div>
        <div class="footer-title">Phương thức thanh toán</div>
        <span class="payment-icon-1"></span>
        <span class="payment-icon-2"></span>
        <span class="payment-icon-3"></span>
        </div>
    </div>
    
    </div>
    <div class="copyright">
        <p>Copyright © Đồ án chuyên ngành - Nguyễn Văn Tú</p>
    </div>
    <div title="Về đầu trang" id="top-up">
    <i class="fa-solid fa-plane-up"></i>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
    type="text/javascript"
    src="https://code.jquery.com/jquery-1.11.0.min.js"
></script>
<script
    type="text/javascript"
    src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
></script>
<script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
></script>
<script src="./js/getdata.js"></script>
<script src="./js/validator-form.js"></script>
<script src="./js/script.js"></script>
