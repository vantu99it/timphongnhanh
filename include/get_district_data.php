<?php
include 'connect.php';
$city_id=0;
if (isset($_GET['city_id'])) $city_id = $_GET['city_id'];
settype($city_id, "int");

$stmt=$conn->prepare("SELECT id, classify, name, fullname  FROM tbl_district WHERE city_id=?");    
$stmt->execute([$city_id]);    
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
?>