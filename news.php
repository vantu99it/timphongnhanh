<?php
  include './include/connect.php';
  include './include/data.php';
  include './include/breadcrumb.php';
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

    <!-- slider -->
    <?php include('./include/slider.php');?>
    <!-- /slider -->

    <div id="main">
      <div class="container">
        <!-- search -->
        <?php include('./include/search.php');?>
        <!-- /search -->
        <!--main-content -->
        
        <p><?= breadcrumbs(' > ') ?></p>
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