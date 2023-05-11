<?php 
    include './include/connect.php';
    include '../include/func-slug.php';
date_default_timezone_set("Asia/Ho_Chi_Minh");
    // Đếm số bài chưa thanh toán
    $queryUnpaid = $conn->prepare("SELECT r.* FROM tbl_rooms r JOIN tbl_payment_history pay on pay.id_rooms = r.id WHERE pay.pay_status = 0 and  r.status = 1 and pay.expired = 0");
    $queryUnpaid->execute();
    $countUnpaid = $queryUnpaid->rowCount();

    // Đếm số bài chưa duyệt
    $queryPending = $conn->prepare("SELECT r.* FROM tbl_rooms r JOIN tbl_payment_history pay on pay.id_rooms = r.id WHERE pay.pay_status = 1 and  r.status = 1 and pay.expired = 0");
    $queryPending->execute();
    $countPending = $queryPending->rowCount();

    // Đếm số bài đã duyệt
    $queryApproved = $conn->prepare("SELECT r.* FROM tbl_rooms r JOIN tbl_payment_history pay on pay.id_rooms = r.id WHERE pay.pay_status = 1 and  r.status = 2  or r.status = 3");
    $queryApproved->execute();
    $countApproved = $queryApproved->rowCount();

    // Đếm số liên hệ chưa giải quyết
    $queryContact = $conn->prepare("SELECT * FROM tbl_contact WHERE status = 0");
    $queryContact->execute();
    $countContact = $queryContact->rowCount();

    // Thực thi câu truy vấn
    $sql = "SELECT  DATE_FORMAT(DATE_ADD('2023-01-01', INTERVAL n MONTH), '%Y-%m') AS month, SUM(COALESCE(pay_price, 0)) AS total_amount FROM tbl_payment_history RIGHT JOIN (SELECT 0 n UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11) months ON MONTH(created_at) = months.n + 1 WHERE created_at BETWEEN '2023-01-01 00:00:00' AND '2023-12-31 23:59:59' GROUP BY  month;";
    $stmt = $conn->query($sql);

    // Tạo mảng dữ liệu
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $item = array(
        "month" => $row["month"],
        "total_amount" => $row["total_amount"],
    );
    array_push($data, $item);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Bảng điều khiển</title>
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
            <section class="main-right-title">
                <div class="form-title">
                    <h1>Trang quản lý</h1>
                </div>
            </section>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <p>Tin chưa thanh toán</p>
                            <p class="count-number">
                                <?php echo $countUnpaid ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./post-unpaid.php">Xem ngay</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <p>Tin đang chờ duyệt</p>
                            <p class="count-number">
                                <?php echo $countPending ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./post-pending.php">Duyệt tin</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <p>Tin đã duyệt</p>
                            <p class="count-number">
                                <?php echo $countApproved ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./post-approved.php">Xem ngay</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">
                            <p>Phản hồi mới</p>
                            <p class="count-number">
                                <?php echo $countContact ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="./contact-manager-new.php">Giải quyết</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Biểu đồ doanh thu  -->
            <section class="main-right-title">
                <div class="form-title">
                    <h2>Biểu đồ thống kê doanh thu</h2>
                </div>
            </section>

            <!-- Biểu đồ doanh thu theo ngày của từng tháng trong năm -->
            <div class="form-contact form-validator ">
                <select name="month" id="month" class="autobox form-focus boder-ra-5" style = "width: 20%;"> 
                    <option value="1">Tháng 1</option>
                    <option value="2">Tháng 2</option>
                    <option value="3">Tháng 3</option>
                    <option value="4">Tháng 4</option>
                    <option value="5">Tháng 5</option>
                    <option value="6">Tháng 6</option>
                    <option value="7">Tháng 7</option>
                    <option value="8">Tháng 8</option>
                    <option value="9">Tháng 9</option>
                    <option value="10">Tháng 10</option>
                    <option value="11">Tháng 11</option>
                    <option value="12">Tháng 12</option>
                </select>
                <select name="year" id="year" class="autobox form-focus boder-ra-5" style = "width: 20%;">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>

            <div id="chart-days" style="width: 95%; height: 400px;"></div>


            <!-- Biểu đồ doanh thu theo loại thanh toán -->
            <div id="chart-payment" style="width: 95%; height: 400px;" ></div>

            <!-- Biểu đồ doanh thu theo loại thanh toán -->
            <div id="chart-month" style="width: 95%; height: 400px;"></div>
        </div>
        <!-- /main-right -->
    </div>
    <!-- footer + js -->
    <?php include('include/footer.php');?>
    <!-- /footer + js -->

    <!-- JS biểu đồ doanh thu theo từng ngày trong tháng -->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(getDataDays);

        function getDataDays() {
            var year = $('#year').val();
            var month = $('#month').val();
            $.ajax({
            url: './include/get-payment-days.php',
            dataType: 'json',
            data: { year: year, month: month },
            success: function(data) {
                var chartDataDays = [['Tháng', 'Tổng tiền']];
                for (var key in data) {
                if (key !== 'month' && key !== 'year') {
                    chartDataDays.push([key, data[key]]);
                }
                }
                drawChartDays(chartDataDays);
            }
            });
        }

        function drawChartDays(chartDataDays) {
            var data = google.visualization.arrayToDataTable(chartDataDays);
            var options = {
            legend: { position: 'none' },
            chart: {
                title: 'Biểu đồ thống kê doanh số theo từng ngày trong tháng',
                subtitle: '' },
            axes: {
                x: {
                0: { side: 'bottom', label: ''} 
                }
            },
            vAxis: {
                format: 'decimal',
            },
            bar: { groupWidth: "60%" },
            colors: ['#0d6efd'],

            };

            var chart = new google.charts.Bar(document.getElementById('chart-days'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        $(document).ready(function() {
            // gán giá trị mặc định cho tháng và năm hiện tại
            var currentMonth = new Date().getMonth() + 1;
            var currentYear = new Date().getFullYear();
            $('#month option[value="' + currentMonth + '"]').prop('selected', true);
            $('#year option[value="' + currentYear + '"]').prop('selected', true);

            // bắt sự kiện thay đổi tháng/năm
            $('#year, #month').change(function() {
            var year = $('#year').val();
            var month = $('#month').val();
            $.ajax({
                url: './include/get-payment-days.php',
                dataType: 'json',
                method: 'POST',
                data: { year: year, month: month },
                success: function(data) {
                var chartDataDays = [['Month', 'Total Amount']];
                for (var key in data) {
                    if (key !== 'month' && key !== 'year') {
                    chartDataDays.push([key, data[key]]);
                    }
                }
                drawChartDays(chartDataDays);
                }
            });
            });
        });
    </script>

    <!-- JS biểu đồ doanh thu theo tháng từng loại hình thức thanh toán -->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(fetchData);

        function fetchData() {
        var year = $('#year').val();
        $.ajax({
            url: './include/get-payment-amount.php',
            method: 'post',
            data: {year: year},
            dataType: 'json',
            success: function(data) {
                drawChartPay(data);
            },
            error: function() {
                alert('Đã xảy ra lỗi khi lấy dữ liệu.');
            }
        });
        }

        function drawChartPay(data) {
            // Tạo bảng dữ liệu.
            var chartDataPay = google.visualization.arrayToDataTable(data);

            // Thiết lập các tùy chọn cho biểu đồ.
            var options = {
            chart: {
                title: 'Biểu đồ thống kê doanh số',
                subtitle: 'Thống kê doanh số dựa trên các hình thức thanh toán theo các tháng',
            },
            bars: 'vertical',
            vAxis: {
                format: 'decimal'
            },
            hAxis: {
                title: ''
            },
            colors: ['#0d6efd', '#ffc107'],
            legend: { position: 'top' }
            };

            $(document).ready(function() {
            // bắt sự kiện thay đổi tháng/năm
            $('#year').change(function() {
            var year = $('#year').val();
            $.ajax({
                url: './include/get-payment-amount.php',
                method: 'post',
                data: {year: year},
                dataType: 'json',
                success: function(data) {
                    drawChartPay(data);
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi lấy dữ liệu.');
                }
            });
            });
        });

            // Vẽ biểu đồ, sử dụng các tùy chọn đã thiết lập.
            var chart = new google.charts.Bar(document.getElementById('chart-payment'));
            chart.draw(chartDataPay, google.charts.Bar.convertOptions(options));
        }
    </script>

    <!-- JS biểu đồ doanh thu theo tháng -->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(getData);

        function getData() {
        var year = $('#year').val();
        $.ajax({
            url: './include/get-payment-month.php',
            method: 'POST', // Sử dụng phương thức POST
            data: { year: year },
            dataType: 'json',
            success: function(data) {
            // Tạo một mảng dữ liệu mới chứa thông tin về các tháng và tổng tiền tương ứng
            var chartDataMonth = [['Tháng', 'Tổng tiền']];
            for (var i = 0; i < data.length; i++) {
                chartDataMonth.push([data[i].month, data[i].total_amount]);
            }
            drawChartMonth(chartDataMonth);
            }
        });
        }
        function drawChartMonth(chartDataMonth) {
        var dataMonth = google.visualization.arrayToDataTable(chartDataMonth);

        var options = {
            legend: { position: 'none' },
            chart: {
            title: 'Biểu đồ doanh thu theo tháng',
            subtitle: 'Thống kê doanh số theo các tháng' },
            axes: {
            x: {
                0: { side: 'bottom', label: ''}
            }
            },
            vAxis: {
            format: 'decimal',
            },
            bar: { groupWidth: "30%" },
            colors: ['#0d6efd'],
        };

        $(document).ready(function() {
            // bắt sự kiện thay đổi tháng/năm
            $('#year').change(function() {
            var year = $('#year').val();
            $.ajax({
                url: './include/get-payment-month.php',
                method: 'POST', // Sử dụng phương thức POST
                data: { year: year },
                dataType: 'json',
                success: function(data) {
                // Tạo một mảng dữ liệu mới chứa thông tin về các tháng và tổng tiền tương ứng
                var chartDataMonth = [['Tháng', 'Tổng tiền']];
                for (var i = 0; i < data.length; i++) {
                    chartDataMonth.push([data[i].month, data[i].total_amount]);
                }
                drawChartMonth(chartDataMonth);
                }
            });
            });
        });

        var chartMonth = new google.charts.Bar(document.getElementById('chart-month'));
        chartMonth.draw(dataMonth, google.charts.Bar.convertOptions(options));
        }
     </script>
</body>
</html>