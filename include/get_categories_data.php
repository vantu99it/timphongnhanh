<?php
include 'connect.php';
$stmt=$conn->prepare("SELECT *  FROM tbl_categories");    
$stmt->execute();    
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
 echo json_encode($data);
?>