<?php
    include 'include/connect.php';
    // session_destroy();
    unset($_SESSION['login']);
    header('location: index.php');
?>