<?php
  include '../include/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_comment = $_POST["id_comment"];
    $comment_content = $_POST["comment_content"];

    $stmt = $conn->prepare("UPDATE tbl_comments SET comment_content = :comment_content, updated_at = NOW() WHERE id_comment = :id_comment");
    $stmt->bindParam(":comment_content", $comment_content);
    $stmt->bindParam(":id_comment", $id_comment);

    if ($stmt->execute()) {
        // return success message as JSON object
        $success = array("message" => "Comment updated successfully");
        echo json_encode($success);
    } else {
        // return error message as JSON object
        $error = array("message" => "Error updating comment");
        echo json_encode($error);
    }
}