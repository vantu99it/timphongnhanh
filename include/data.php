<?php
    include 'connect.php';

    // categories
    $categories = $conn->prepare("SELECT * FROM tbl_categories");
    $categories->execute();
    $result = $categories->setFetchMode(PDO::FETCH_ASSOC);
    $dataCate  = $categories->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($dataCate);
?>