<?php
  include '../include/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_reply = $_POST["postId"];

        $stmt = $conn->prepare("UPDATE tbl_replies SET status = 1 WHERE id_reply = :id_reply");
        $stmt->bindParam(":id_reply", $id_reply);
        $stmt->execute();
    }
?>