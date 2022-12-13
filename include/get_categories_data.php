<?php
include 'connect.php';
$stmt=$conn->prepare("SELECT *  FROM  where status = 1");    
$stmt->execute();    
$data  = $stmt->fetchAll(PDO::FETCH_ASSOC);
 echo json_encode($data);
?>