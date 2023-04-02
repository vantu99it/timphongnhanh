<?php
    if(!isset($_SESSION)){ 
        session_start();
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=timphongnhanh1", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Kết nối thành công";
    } catch(PDOException $e) {
        // echo "Kết nối thất bại: " . $e->getMessage();
    }

?>