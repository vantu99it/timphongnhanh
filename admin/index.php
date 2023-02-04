<?php 
    include './include/connect.php';
    if(isset($_SESSION['loginAdmin']['id'])){
        include './dashboard.php';
    }
    else{
        include './login.php';
    }
?>