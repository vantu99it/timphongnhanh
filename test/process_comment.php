<?php
  include '../include/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = 25; 
    $id_rooms = $_POST["id_rooms"];
    $comment_content = $_POST["comment_content"];

    $stmt = $conn->prepare("INSERT INTO tbl_comments (id_user, id_rooms, comment_content, created_at, updated_at) VALUES (:id_user, :id_rooms, :comment_content, NOW(), NOW())");
    $stmt->bindParam(":id_user", $id_user);
    $stmt->bindParam(":id_rooms", $id_rooms);
    $stmt->bindParam(":comment_content", $comment_content);
    $stmt->execute();
}
