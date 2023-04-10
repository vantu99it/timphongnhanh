<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
</head>
<body>
        <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <!-- slider -->
    <?php include('./include/slider.php');?>
    <!-- /slider -->
    <div id="main">
        <div class="container">
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Tab 1</a></li>
                    <li><a href="#tabs-2">Tab 2</a></li>
                    <li><a href="#tabs-3">Tab 3</a></li>
                </ul>
                <div id="tabs-1">
                    <p>Content for Tab 1 goes here.</p>
                </div>
                <div id="tabs-2">
                    <p>Content for Tab 2 goes here.</p>
                </div>
                <div id="tabs-3">
                    <p>Content for Tab 3 goes here.</p>
                </div>
            </div>
        </div>
    </div>
        <!-- footer + js-->
    <?php include('./include/footer.php');?>
    <!-- /footer + js -->

    <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>
</body>
</html>