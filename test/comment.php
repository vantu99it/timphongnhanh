<?php 
  include '../include/connect.php';
  if(isset($_POST['id_rooms'])){
    $id_rooms = $_POST['id_rooms'];

    $stmt = $conn->prepare("SELECT comments.*, user.fullname FROM tbl_comments AS comments JOIN tbl_user AS user ON comments.id_user = user.id WHERE id_rooms=:id_rooms ORDER BY created_at DESC");
    $stmt->bindParam(':id_rooms', $id_rooms);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($comments as $comment) {
        $html = '<div class="comment" data-id="' . $comment['id_comment'] . '">';
        $html .= '<strong>' . $comment['fullname'] . '</strong>';
        $html .= '<span class="time">' . $comment['created_at'] . '</span>';
        $html .= '<p>' . $comment['comment_content'] . '</p>';
        $html .= '<button class="reply-button">Reply</button>';
        $html .= '<button class="delete-button">Delete</button>';
        $html .= '<div class="replies"></div>';
        $html .= '</div>';
        echo $html;

        // Hiển thị danh sách các phản hồi của bình luận này
        $stmt = $conn->prepare("SELECT replies.*, user.fullname FROM tbl_replies AS replies JOIN tbl_user AS user ON replies.id_user = user.id WHERE id_comment=:id_comment ORDER BY created_at DESC");
        $stmt->bindParam(':id_comment', $comment['id_comment']);
        $stmt->execute();
        $replies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($replies as $reply) {
            $html1 = '<div class="reply" style= "margin-left: 40px" data-id="' . $reply['id_reply'] . '">';
            $html1 .= '<strong>' . $reply['fullname'] . '</strong>';
            $html1 .= '<span class="time">' . $reply['created_at'] . '</span>';
            $html1 .= '<p>' . $reply['reply_content'] . '</p>';
            $html1 .= '<button class="delete-button-reply">Delete</button>';
            $html1 .= '</div>';
            echo $html1;
    }
    }


}
    

?>