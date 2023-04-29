<?php
  include '../include/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_user = $_SESSION['login']['id']; 
    $id_comment = $_POST["id_comment"];
    $reply_content = $_POST["reply_content"];

    $check = $conn->prepare("SELECT id_user FROM tbl_comments WHERE id_comment = :id_comment");
    $check->bindParam(":id_comment", $id_comment);
    $check->execute();
		$resultsCheckUser = $check->fetch(PDO::FETCH_OBJ);
    if($resultsCheckUser->id_user == $id_user){
      $status = 1;
    }else {
      $status = 0;
    }

    $stmt = $conn->prepare("INSERT INTO tbl_replies (id_user, id_comment, reply_content, status, created_at, updated_at) VALUES (:id_user, :id_comment, :reply_content, :status, NOW(), NOW())");
    $stmt->bindParam(":id_user", $id_user);
    $stmt->bindParam(":id_comment", $id_comment);
    $stmt->bindParam(":reply_content", $reply_content);
    $stmt->bindParam(":status", $status);
    $stmt->execute();
    }
?>