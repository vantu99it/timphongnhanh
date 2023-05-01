<?php
  include './include/connect.php';
  include './include/data.php';
  $queryPrice = $conn->prepare("SELECT * FROM tbl_new_type");
  $queryPrice->execute();
  $resultsPrice  = $queryPrice->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bảng giá</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
    <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <div id="main" class="mg-t90">
      <div class="container">
        <!--main-content -->
        <div id="post">
          <div class="post-header">
            <h1 class="page-title">Giới thiệu về TÌM PHÒNG NHANH</h1>
          </div>
          <section class="section">
            <div class= "section-introduce">
              <p>ĐỪNG ĐỂ PHÒNG TRỐNG THÊM BẤT CỨ NGÀY NÀO!, đăng tin ngay tại TÌM PHÒNG NHANH và tất cả các vấn đề sẽ được giải quyết một cách nhanh nhất</p>
              <p>ƯU ĐIỂM TÌM PHÒNG NHANH:</p>
              <ul>
                <li class="section-item"><img src="./image/icon/icon-tick-green.svg" alt=""><p>Top đầu google về từ khóa: cho thuê phòng trọ, thuê phòng trọ, phòng trọ hồ chí minh, phòng trọ hà nội, thuê nhà nguyên căn, cho thuê căn hộ, tìm người ở ghép…với lưu lượng truy cập (traffic) cao nhất trong lĩnh vực.</p></li>
                <li class="section-item"><img src="./image/icon/icon-tick-green.svg" alt=""><p>Tìm phòng nhanh tự hào có lượng dữ liệu bài đăng lớn nhất trong lĩnh vực cho thuê phòng trọ với hơn <strong>105.000</strong> tin trên hệ thống và tiếp tục tăng.</p></li>
                <li class="section-item"><img src="./image/icon/icon-tick-green.svg" alt=""><p>Tìm phòng nhanh tự hào có số lượng người dùng lớn nhất trong lĩnh vực cho thuê phòng trọ với hơn <strong>300.000</strong> khách truy cập thường xuyên và hơn <strong>2.500.000</strong> lượt pageview mỗi tháng.</p></li>
                <li class="section-item"><img src="./image/icon/icon-tick-green.svg" alt=""><p>Tìm phòng nhanh tự hào được sự tin tưởng sử dụng của hơn <strong>116.998</strong> khách hàng là chủ nhà, đại lý, môi giới đăng tin thường xuyên tại website.</p></li>
                <li class="section-item"><img src="./image/icon/icon-tick-green.svg" alt=""><p>Tìm phòng nhanh tự hào ghi nhận <strong>80.000</strong> giao dịch thành công khi sử dụng dịch vụ tại web, mức độ <strong>hiệu quả đạt xấp xỉ 85% tổng tin đăng.</strong></p></li>
              </ul>
            </div>
          </section>
          <section class="section">
            <div class="section-header">
              <h2 class="post_title">Bảng giá dịch vụ</h2>
            </div>
            <div class="section-content" style = "border: 1px solid #ccc;">   
              <div class="section-preface">
                <p>
                  Nếu bạn muốn tiếp cận với những người thuê trọ, nhà, căn hộ, homstay,... một cách nhanh chóng và hiệu quả nhất thông qua website tìm phòng nhanh của chúng tôi. Bạn có thể chọn loại gói tin đăng mà bạn muốn bài viết của mình hiển thị và tiếp cận tới nhiều người.
                </p>
                <p>Dưới đây là bảng giá chi tiết các gói tin mà bạn có thể lựa chọn</p>
              </div>
              <table class="table table-pricing">
                <thead>
                  <tr>
                    <th class="package package_vip0">
                    </th>
                    <th class="package package_vip1">
                      Tin VIP nổi bật
                      <p class="star star-5"></p>
                    </th>
                    <th class="package package_vip2">
                      Tin VIP 1
                      <p class="star star-4"></p>
                    </th>
                    <th class="package package_vip3">
                    Tin VIP 2
                      <p class="star star-3"></p>
                    </th>
                    <th class="package package_vip4">
                    Tin VIP 3
                      <p class="star star-2"></p>
                    </th>
                    <th class="package package_vip5">
                      Tin thông thường
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="content-item"><strong>Ưu điểm</strong></td>
                    <td class="content-item">
                      <p>- Lượt xem nhiều <strong>gấp 30 lần</strong> so với tin thường</p>
                      <p>- Ưu việt, tiếp cận <strong> tối đa</strong> khách hàng.</p>
                      <p>- Xuất hiện vị trí <strong> đầu tiên</strong> ở trang chủ</p>
                      <p>- Đứng <strong>trên tất cả</strong> các loại tin VIP khác</p>
                      <p>- Xuất hiện <strong> đầu tiên</strong> ở mục tin nổi bật xuyên suốt khu vực chuyên mục đó.</p>
                    </td>
                    <td class="content-item">
                      <p>- Lượt xem nhiều  so với tin thường</p>
                      <p>- Tiếp cận <strong>rất nhiều</strong> khách hàng.</p>
                      <p>- Xuất hiện sau <strong>VIP NỔI BẬT</strong> và <strong>trước Vip 2, Vip 3, tin thường</strong>.</p>
                      <p>- Xuất hiện thêm ở mục tin nổi bật xuyên suốt khu vực chuyên mục đó.</p>
                    </td>
                    <td class="content-item">
                      <p>- Lượt xem nhiều <strong>gấp 10 lần</strong> so với tin thường</p>
                      <p>- Tiếp cận khách hàng <strong>rất tốt</strong>.</p>
                      <p>- Xuất hiện <strong>sau VIP 1</strong> và <strong>trước VIP 3, tin thường</strong>.</p>
                      <p>- Xuất hiện thêm ở mục tin nổi bật xuyên suốt khu vực chuyên mục đó. </p>
                    </td>
                    <td class="content-item">
                      <p>- Lượt xem nhiều <strong>gấp 5 lần</strong> so với tin thường</p>
                      <p>- Tiếp cận khách hàng <strong>tốt</strong>.</p>
                      <p>- Xuất hiện <strong>sau VIP 2</strong> và <strong>sau VIP 2</strong>.</p>
                    </td>
                    <td class="content-item">
                      <p>- Tiếp cận khách hàng <strong>khá tốt</strong>.</p>
                      <p></p>
                    </td>
                  </tr>
                  <tr>
                    <td class="content-item"><strong>Phù hợp</strong></td>
                    <td class="content-item">
                      <p>Phù hợp khách hàng là công ty/cá nhân sở hữu <strong>hệ thống lớn</strong> có từ 15-20 căn phòng/nhà trở lên hoặc phòng trống quá lâu, thường xuyên đang cần <strong>cho thuê gấp</strong>.</p>
                    </td>
                    <td class="content-item">
                      <p>Phù hợp khách hàng cá nhân/môi giới có 10-15 căn phòng/nhà đang trống thường xuyên, cần cho thuê <strong>nhanh nhất</strong>.</p>
                      
                    </td>
                    <td class="content-item">
                      <p>Phù hợp khách hàng cá nhân/môi giới có lượng căn trống thường xuyên, cần cho thuê<strong> nhanh hơn</strong>.</p>
                    <td class="content-item">
                      <p>Phù hợp loại hình phòng trọ chung chủ, KTX ở ghép hay khách hàng có 1-5 căn phòng/nhà cần cho thuê nhanh, <strong>tiếp cận khách hàng tốt hơn</strong>.</p>
                    </td>
                    <td class="content-item">
                      <p>Phù hợp tất cả các loại hình tuy nhiên lượng tiếp cận khách hàng <strong>  thấp hơn</strong> và cho thuê <strong>chậm hơn</strong> so với tin VIP.</p>
                      <p></p>
                    </td>
                  </tr>
                  <tr>
                    <td class="content-item"><strong>Giá ngày</strong></td>
                    <?php foreach ($resultsPrice as $key => $value) {?>
                      <?php if($value -> slug == "VIP-noi-bat"){?>
                        <td class="content-item">
                          <p class="price">
                          <?php
                              $bien = number_format((int) $value->price,0,",",".");
                              echo $bien." đ/ngày";
                            ?>
                          </p>
                          <p class="minimum">(Tối thiểu 5 ngày)</p>
                        </td>
                      <?php } ?>
                      <?php if($value -> slug == "VIP-1"){?>
                        <td class="content-item">
                          <p class="price">
                          <?php
                              $bien = number_format((int) $value->price,0,",",".");
                              echo $bien." đ/ngày";
                            ?>
                          </p>
                          <p class="minimum">(Tối thiểu 5 ngày)</p>
                        </td>
                      <?php } ?>
                      <?php if($value -> slug == "VIP-2"){?>
                        <td class="content-item">
                          <p class="price">
                          <?php
                              $bien = number_format((int) $value->price,0,",",".");
                              echo $bien." đ/ngày";
                            ?>
                          </p>
                          <p class="minimum">(Tối thiểu 5 ngày)</p>
                        </td>
                      <?php } ?>
                      <?php if($value -> slug == "VIP-3"){?>
                        <td class="content-item">
                          <p class="price">
                          <?php
                              $bien = number_format((int) $value->price,0,",",".");
                              echo $bien." đ/ngày";
                            ?>
                          </p>
                          <p class="minimum">(Tối thiểu 5 ngày)</p>
                        </td>
                      <?php } ?>
                      <?php if($value -> slug == "thong-thuong"){?>
                        <td class="content-item">
                          <p class="price">
                          <?php
                              $bien = number_format((int) $value->price,0,",",".");
                              echo $bien." đ/ngày";
                            ?>
                          </p>
                          <p class="minimum">(Tối thiểu 10 ngày)</p>
                        </td>
                      <?php } ?>
                      <?php } ?>
                    </tr>
                </tbody>
              </table>
            </div>
          </section>
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