<?php
  include '../include/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_comment = $_POST["postId"];

        $stmt = $conn->prepare("UPDATE tbl_comments SET status = 1 WHERE id_comment = :id_comment");
        $stmt->bindParam(":id_comment", $id_comment);
        $stmt->execute();
    }
?>