<?php
  include '../include/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_reply = $_POST["id_reply"];

        $stmt = $conn->prepare("DELETE FROM tbl_replies WHERE id_reply = :id_reply");
        $stmt->bindParam(":id_reply", $id_reply);
        $stmt->execute();
    }
?>