<?php
  include '../include/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_user = $_SESSION['login']['id']; 
    $id_comment = $_POST["id_comment"];
    $reply_content = $_POST["reply_content"];

    $stmt = $conn->prepare("INSERT INTO tbl_replies (id_user, id_comment, reply_content, created_at, updated_at) VALUES (:id_user, :id_comment, :reply_content, NOW(), NOW())");
    $stmt->bindParam(":id_user", $id_user);
    $stmt->bindParam(":id_comment", $id_comment);
    $stmt->bindParam(":reply_content", $reply_content);
    $stmt->execute();
    }
?>