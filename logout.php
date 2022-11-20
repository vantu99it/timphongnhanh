<?php
    include 'include/connect.php';
    unset($_SESSION['login']['username']);
    header('location: index.php');
?>