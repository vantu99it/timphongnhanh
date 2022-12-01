<?php
  include './include/connect.php';
  include './include/data.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
    <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <div id="main">
      <div class="container">
        <!-- search -->
        <?php include('./include/search.php');?>
        <!-- /search --> 
        <div id="post">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin: 0;">
                    <li class="first link"><a href="#">Trang chủ</a></li>
                    <li class="link link"><a href="#">Cho thuê phòng trọ</a></li>
                </ol>
            </nav>
            <div class="post-header">
                <h1 class="page-title">Liên hệ với chúng tôi</h1>
                <p class="page-description">Bạn đang có thắc mắc, bạn đang không biết làm sao để đăng bài, bạn muốn khiếu nại thì hãy liên hệ với chúng tôi để được giúp đỡ nhé!</p>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <section class="section">
                    <div class="section-form">
                        <div class="section-header">
                            <p>Điền thông tin vào biểu mẫu này!</p>
                        </div>
                    <form action="" method="post" id = "frm-contact">
                        <div class="form-contact form-validator">
                            <p class="contact-title">Họ tên</p>
                            <input type="text" name="name" id="name">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <p class="contact-title">Số điện thoại</p>
                            <input type="number" name="phone" id="phone">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <p class="contact-title">Email</p>
                            <input type="email" name="email" id="email">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact form-validator">
                            <p class="contact-title">Loại vấn đề cần giải quyết</p>
                            <select name="problem" id="problem">
                                <option value="">-- Vấn đề cần giải quyết --</option>
                                <option value="1">Giải đáp thắc mắc</option>
                                <option value="2">Hỗ trợ đăng bài</option>
                                <option value="3">Hỗ trợ thanh toán</option>
                                <option value="4">Giải quyết khiếu nại</option>
                            </select>
                            <p style="margin-top: 8px;" class="form-message"></p>
                        </div>
                        <div class="form-contact form-validator">
                            <p class="contact-title">Nội dung</p>
                            <textarea name="content" id="content" cols="30" rows="10"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-contact">
                            <input type="submit" value="Gửi thông tin" class="btn btn-contact">
                        </div>
                        <div class="form-contact">
                            <p class="complete"></p>
                        </div>
                    </form>
                    </div>
                </section>
            </div>
            <div class="col-6">
                <section class="section section-note-right">
                    <div class="contact-note">
                        <p class="section-header">Lưu ý</p>
                        <ul>
                            <li class="note-item">Chúng tôi tin rằng bạn có rất nhiều lựa chọn và nhiều kênh thông tin để tìm kiếm, cám ơn bạn đã tin tưởng chúng tôi.</li>
                            <li class="note-item">Nếu bạn đang cần giúp đỡ: </li>
                            <li class="note-item">+ Giải đáp thắc mắc</li>
                            <li class="note-item">+ Hỗ trợ đăng bài</li>
                            <li class="note-item">+ Hỗ trợ thanh toán</li>
                            <li class="note-item">+ Giải quyết khiếu nại</li>
                            <li class="note-item">Hãy điền đầy đủ những thông tin cần thiết vào form bên và gửi cho chúng tôi.</li>
                            <li class="note-item">Chúng tôi sẽ tiếp nhận thông tin, bộ phận chăm sóc khách hàng của chúng tôi sẽ liên hệ và hỗ trợ giúp bạn.</li>
                            <li class="note-item">Mọi thông tin vui lòng liên hệ:</li>
                            <li class="note-item"><strong>Hotline: </strong>0932379943</li>
                            <li class="note-item"><strong>Email: </strong>sckh.timphongnhanh@gmail.com</li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
        <!-- why-support -->
        <?php include('./include/why-support.php');?>
        <!-- /why-support -->
      </div>
    </div>

    <!-- footer + js-->
    <?php include('./include/footer.php');?>
    <!-- /footer + js -->
    <script>
        Validator({
            form: '#frm-contact',
            formGroupSelector: '.form-validator',
            errorSelector: ".form-message",
            rules: [
                Validator.isRequired('#name', 'Vui lòng nhập tên của bạn'), 
                Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại'),
                Validator.isPhone('#phone', 'Số điện thoại gồm 10 số và bắt đầu từ số 0'),


                Validator.isRequired('#email', 'Vui lòng nhập email'),
                Validator.isEmail('#email', 'Email không hợp lệ'),

                Validator.isRequired('#problem', 'Vui lòng lựa chọn vấn đề bạn muốn hỗ trợ'),

                Validator.isRequired('#content', 'Vui lòng nhập mô tả chi tiết vài viết'),
                Validator.minLength('#post_content',80, 'Mô tả phải nhập ít nhất 80 ký tự'),
                
            ],
        });
        

    </script>
    </script>
  </body>
</html>