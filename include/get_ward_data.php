<?php
include 'connect.php';
$district_id=0;
if (isset($_GET['district_id'])) $district_id = $_GET['district_id'];
settype($district_id, "int");

$stmt=$conn->prepare("SELECT id, classify, name, fullname FROM tbl_ward WHERE district_id=?");    
$stmt->execute([$district_id]);    
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
?>