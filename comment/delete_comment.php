<?php
  include '../include/connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_comment = $_POST["id_comment"];

        $stmt = $conn->prepare("DELETE FROM tbl_replies WHERE id_comment = :id_comment");
        $stmt->bindParam(":id_comment", $id_comment);
        $stmt->execute();

        $stmt1 = $conn->prepare("DELETE FROM tbl_comments WHERE id_comment = :id_comment");
        $stmt1->bindParam(":id_comment", $id_comment);
        $stmt1->execute();
    }
?>