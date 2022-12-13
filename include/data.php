<?php
    include 'connect.php';

    // categories
    $categories = $conn->prepare("SELECT * FROM tbl_categories where status = 1");
    $categories->execute();
    $result = $categories->setFetchMode(PDO::FETCH_ASSOC);
    $dataCate  = $categories->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($dataCate);

    // city
    $city = $conn->prepare("SELECT d.* from tbl_city c JOIN tbl_district d ON c.id = d.city_id WHERE c.fullname = 'Tỉnh Nghệ An'");
    $city->execute();
    $resultCity = $city->setFetchMode(PDO::FETCH_ASSOC);
    $dataCity  = $city->fetchAll(PDO::FETCH_ASSOC);
?>