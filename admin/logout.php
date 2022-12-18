<?php
    include 'include/connect.php';
    unset($_SESSION['loginAdmin']['username']);
    header('location: login.php');
?>