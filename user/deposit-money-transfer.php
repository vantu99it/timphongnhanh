<?php
    include '../include/connect.php';
    include '../include/data.php';
    include '../include/func-slug.php';
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $id_user = (isset($_SESSION['login']['id']))? $_SESSION['login']['id']:[];

    $getdate = date('dmY-His');
    $pay_code = "TPN-KH#".$_SESSION['login']['id']."-".$getdate;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nạp tiền qua chuyển khoản</title>

    <!-- link-css -->
    <?php include('include/link-css.php');?>
    <!-- /link-css -->
</head>
<body>
    <!-- header -->
    <?php include('include/header.php');?>
    <!-- /header -->
    <div id="main">
        <!-- sidebar -->
        <?php include('include/sidebar.php');?>
        <!-- /sidebar -->

        <!-- main-right -->
        <div id="main-right">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tìm trọ nhanh</a></li>
                    <li class="breadcrumb-item"><a href="#">Quản lý</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đăng tin mới</li>
                </ol>
            </nav>
            <div class="form-title">
                <h1>Nạp tiền vào tài khoản</h1>
            </div>
            <div class="form-note">
                <h4>Lưu ý</h4>
                <ul>
                    <li>Vui lòng kiểm tra lại thông tin thanh toán trước khi xác nhận thanh toán.</li>
                    <li>Chuyển khoản đúng số tiền bạn muốn nạp vào tài khoản với các số tài khoản bên dưới</li>
                    <li>Phần nội dung chuyển khoản bạn vui lòng ghi đúng: <b><?php echo $pay_code ?></b></li>
                </ul>
            </div>
            
            <div class="main-right-table">
                <table class="table table-bordered table-post-list" id = "">
                    <thead>
                        <tr>
                            <th style="width: 25%;" >Ngân hàng</th>
                            <th style="width: 13%;" >Chủ tài khoản</th>
                            <th style="width: 20%;" >Số tài khoản</th>
                            <th style="width: 12%;" >Chi nhánh</th>
                            <th style="width: 40%;" >Nội dung chuyển khoản</th>
                        </tr>
                        
                    </thead>
                    <tbody >
                        <tr>
                            <td>
                                <p><b style = "color: red;">VIETCOMBANK</b> -  NGÂN HÀNG THƯƠNG MẠI CỔ PHẦN NGOẠI THƯƠNG VIỆT NAM</p>
                            </td>
                            <td>
                                <P>NGUYỄN VĂN TÚ</P>
                            </td>
                            <td>
                                <div class="text-copy"> 
                                    <input type="text" name="" id="code-payVCB" value = "0861000092335" disabled>
                                    <button onclick="copyCodeVCB()"><i class="fa-regular fa-copy"></i></button>
                                </div>
                            </td>
                            <td>
                                VINH - NGHỆ AN
                            </td>
                            <td rowspan="3">
                                <b style = "font-size: 20px;">Nội dung chuyển khoản, bạn ghi đầy đủ: </b>
                                <div class="text-copy"> 
                                    <input type="text" name="" id="code-payND" value = "<?php echo $pay_code ?>" disabled style = "font-size: 16px;">
                                    <button onclick="copyCodeND()"><i class="fa-regular fa-copy"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b style = "color: red;">MBBANK</b> -  NGÂN HÀNG THƯƠNG MẠI CỔ PHẦN QUÂN ĐỘI</p>
                            </td>
                            <td>
                                <P>NGUYỄN VĂN TÚ</P>
                            </td>
                            <td>
                                <div class="text-copy"> 
                                    <input type="text" name="" id="code-payMB" value = "1999199636999" disabled>
                                    <button onclick="copyCodeMB()"><i class="fa-regular fa-copy"></i></button>
                                </div>
                            </td>
                            <td>
                                VINH - NGHỆ AN
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><b style = "color: red;">VIETTINBANK</b> -  NGÂN HÀNG THƯƠNG MẠI CỔ PHẦN CÔNG THƯƠNG</p>
                            </td>
                            <td>
                                <P>NGUYỄN VĂN TÚ</P>
                            </td>
                            <td>
                                <div class="text-copy"> 
                                    <input type="text" name="" id="code-payVTin" value = "106877160982" disabled>
                                    <button onclick="copyCodeVTin()"><i class="fa-regular fa-copy"></i></button>
                                </div>
                            </td>
                            <td>
                                VINH - NGHỆ AN
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /main-right -->
    </div>
     <!-- script -->
     <?php include('include/script.php');?>
    <!-- /script -->
</body>
</html>