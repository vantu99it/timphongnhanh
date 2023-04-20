<?php 
  include './connect.php';
// Nếu là gửi bình luận mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $id_rooms = $_POST['id_rooms'];
    $id_user = $_SESSION['login']['id']; 
    $comment_content = $_POST['comment_content'];
    // Thực hiện insert vào bảng tbl_comments
    $stmt = $conn->prepare("INSERT INTO tbl_comments (id_user, id_rooms, comment_content) VALUES (:id_user, :id_rooms, :comment_content)");
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_rooms', $id_rooms);
    $stmt->bindParam(':comment_content', $comment_content);
    $stmt->execute();
    
    // Lấy thông tin của bình luận vừa thêm vào để hiển thị trực tiếp
    $id_comment = $conn->lastInsertId();
    $stmt = $conn->prepare("SELECT comments.*, user.fullname FROM tbl_comments AS comments JOIN tbl_user AS user ON comments.id_user = user.id WHERE id_comment=:id_comment");
    $stmt->bindParam(':id_comment', $id_comment);
    $stmt->execute();
    $comment = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Hiển thị bình luận vừa thêm vào cho người dùng xem (dạng json)
    header('Content-Type: application/json');
    echo json_encode($comment);
}
// Nếu là gửi phản hồi bình luận
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_reply'])) {
    $id_comment = $_POST['id_comment'];
    $id_user = $_SESSION['login']['id']; 
    $reply_content = $_POST['reply_content'];
    
    // Thực hiện insert vào bảng tbl_replies
    $stmt = $conn->prepare("INSERT INTO tbl_replies (id_user, id_comment, reply_content) VALUES (:id_user, :id_comment, :reply_content)");
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_comment', $id_comment);
    $stmt->bindParam(':reply_content', $reply_content);
    $stmt->execute();
    
    // Lấy thông tin của phản hồi vừa thêm vào để hiển thị trực tiếp
    $id_reply = $conn->lastInsertId();
    $stmt = $conn->prepare("SELECT replies.*, user.fullname FROM tbl_replies AS replies JOIN tbl_user AS user ON replies.id_user = user.id WHERE id_reply=:id_reply");
    $stmt->bindParam(':id_reply', $id_reply);
    $stmt->execute();
    $reply = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Hiển thị phản hồi vừa thêm vào cho người dùng xem (dạng json)
    header('Content-Type: application/json');
    echo json_encode($reply);
}
// Nếu là chỉnh sửa phản hồi bình luận
else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_edit_reply'])) {
    $id_reply = $_POST['id_reply'];
    $reply_content = $_POST['reply_content'];
    
    // Thực hiện update bản ghi trong bảng tbl_replies
    $stmt = $conn->prepare("UPDATE tbl_replies SET reply_content=:reply_content, updated_ad=NOW() WHERE id_reply=:id_reply");
    $stmt->bindParam(':reply_content', $reply_content);
    $stmt->bindParam(':id_reply', $id_reply);
    $stmt->execute();
    
    // Hiển thị thông tin phản hồi đã chỉnh sửa cho người dùng xem (dạng json)
    $stmt = $conn->prepare("SELECT replies.*, user.fullname FROM tbl_replies AS replies JOIN tbl_user AS user ON replies.id_user = user.id WHERE id_reply=:id_reply");
    $stmt->bindParam(':id_reply', $id_reply);
    $stmt->execute();
    $reply = $stmt->fetch(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($reply);
}
?>


