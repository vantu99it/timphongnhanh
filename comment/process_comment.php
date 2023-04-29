<?php
  include '../include/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['login']['id']; 
    $id_rooms = $_POST["id_rooms"];
    $comment_content = $_POST["comment_content"];


    $checkUser = $conn->prepare("SELECT * FROM tbl_rooms WHERE user_id = :id_user AND id = :id_rooms");
    $checkUser->bindParam(":id_user", $id_user);
    $checkUser->bindParam(":id_rooms", $id_rooms);
    $checkUser->execute();
    if($checkUser->rowCount() > 0){
      $status = 1;
    }else {
      $status = 0;
    }

    $stmt = $conn->prepare("INSERT INTO tbl_comments (id_user, id_rooms, comment_content, status, created_at, updated_at) VALUES (:id_user, :id_rooms, :comment_content, :status, NOW(), NOW())");
    $stmt->bindParam(":id_user", $id_user);
    $stmt->bindParam(":id_rooms", $id_rooms);
    $stmt->bindParam(":comment_content", $comment_content);
    $stmt->bindParam(":status", $status);
    $stmt->execute();
}
