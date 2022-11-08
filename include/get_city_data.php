<?php
include 'connect.php';
$stmt=$conn->prepare("SELECT id, classify, name, fullname  FROM tbl_city");    
$stmt->execute();    
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
?>