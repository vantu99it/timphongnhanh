<?php
    include 'include/connect.php';
    // session_destroy();
    unset($_SESSION['login']['username']);
    header('location: index.php');
?>