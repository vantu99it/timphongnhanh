<?php

// Lấy id bài viết từ url
$id_rooms = $_GET['id'];

// Lấy thông tin của bài viết
$stmt = $conn->prepare("SELECT * FROM tbl_rooms WHERE id=:id_rooms");
$stmt->bindParam(':id_rooms', $id_rooms);
$stmt->execute();
$room = $stmt->fetch(PDO::FETCH_ASSOC);

// Lấy danh sách bình luận của bài viết
$stmt = $conn->prepare("SELECT comments.*, user.fullname FROM tbl_comments AS comments JOIN tbl_user AS user ON comments.id_user = user.id WHERE id_rooms=:id_rooms ORDER BY created_at DESC");
$stmt->bindParam(':id_rooms', $id_rooms);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form id = 'comment-form'>
    <input type='hidden' name='id_rooms' value='<?php echo $id_rooms?>'>
    <textarea name='comment_content'></textarea><br/>
    <input type='submit' name='submit_comment' value='Gửi bình luận'>
</form>
<?php
foreach ($comments as $comment) {
    echo "<div>";
    echo "<p><strong>".$comment['fullname']."</strong> ".$comment['comment_content']."</p>";
    
    // Hiển thị form phản hồi bình luận
    echo "<button onclick='showForm(".$comment['id_comment'].")'>Phản hồi</button>";
    echo "<div id='form-reply-".$comment['id_comment']."' style='display:none;'>";
    echo "<form action='./include/comment-handle.php' method='post'> id = 'reply-form'>";
    echo "<input type='hidden' name='id_comment' value='".$comment['id_comment']."'>";
    echo "<textarea name='reply_content'></textarea><br/>";
    echo "<input type='submit' name='submit_reply' value='Gửi phản hồi'>";
    echo "</form>";
    echo "</div>";
    
    // Hiển thị danh sách các phản hồi của bình luận này
    $stmt = $conn->prepare("SELECT replies.*, user.fullname FROM tbl_replies AS replies JOIN tbl_user AS user ON replies.id_user = user.id WHERE id_comment=:id_comment ORDER BY created_at ASC");
    $stmt->bindParam(':id_comment', $comment['id_comment']);
    $stmt->execute();
    $replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($replies as $reply) {
        echo "<div style='margin-left: 20px;'>";
        echo "<p><strong>".$reply['fullname']."</strong> ".$reply['reply_content']."</p>";
        
        // Hiển thị nút chỉnh sửa bình luận
        echo "<button onclick='showEditForm(".$reply['id_reply'].")'>Chỉnh sửa</button>";
        echo "<div id='form-edit-".$reply['id_reply']."' style='display:none;'>";
        echo "<form action='./include/comment-handle.php' method='post' name='edit-reply-form' id = 'edit-reply-form'>";
        echo "<input type='hidden' name='id_reply' value='".$reply['id_reply']."'>";
        echo "<textarea name='reply_content'>".$reply['reply_content']."</textarea><br/>";
        echo "<input type='submit' name='submit_edit_reply' value='Lưu'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    
    echo "</div>";
}
?>
<script>
    // Hiển thị form phản hồi bình luận khi click vào nút "Phản hồi"
function showForm(commentId) {
    // Ẩn tất cả các form trả lời khác
    var forms = document.querySelectorAll('[id^="form-reply-"]');
    for (var i = 0; i < forms.length; i++) {
        forms[i].style.display = 'none';
    }
    
    // Hiển thị form trả lời tương ứng
    var form = document.getElementById('form-reply-' + commentId);
    form.style.display = 'block';
}

// Hiển thị form chỉnh sửa bình luận khi click vào nút "Chỉnh sửa"
function showEditForm(replyId) {
    // Ẩn tất cả các form chỉnh sửa khác
    var forms = document.querySelectorAll('[id^="form-edit-"]');
    for (var i = 0; i < forms.length; i++) {
        forms[i].style.display = 'none';
    }
    
    // Hiển thị form chỉnh sửa tương ứng
    var form = document.getElementById('form-edit-' + replyId);
    form.style.display = 'block';
}
</script>
<!-- Thêm thư viện jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
$(document).ready(function() {
    // Gửi bình luận mới và hiển thị trực tiếp lên trang web
    $('#comment-form').on('submit', function(event) {
        event.preventDefault();
        
        var form = $(this);
        var formData = form.serialize();
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Tạo HTML của bình luận/ phản hồi mới
                var html = "<div>";
                html += "<p><strong>" + response.user_name + "</strong> " + response.comment_content + "</p>";
                
                if (form.find('[name="id_comment"]').length > 0) {
                    // Nếu là phản hồi bình luận, thêm vào danh sách phản hồi tương ứng
                    html += "<button onclick='showEditForm(" + response.id_reply + ")'>Chỉnh sửa</button>";
                    html += "<div id='form-edit-" + response.id_reply + "' style='display:none;'>";
                    html += "<form action='comment.php' method='post'>";
                    html += "<input type='hidden' name='id_reply' value='" + response.id_reply + "'>";
                    html += "<textarea name='reply_content'>" + response.reply_content + "</textarea><br/>";
                    html += "<input type='submit' name='submit_edit_reply' value='Lưu'>";
                    html += "</form>";
                    html += "</div>";
                    
                    $('#form-reply-' + response.id_comment).before(html);
                } else {
                    // Nếu là bình luận mới, thêm vào danh sách bình luận
                    html += "<button onclick='showForm(" + response.id_comment + ")'>Phản hồi</button>";
                    html += "<div id='form-reply-" + response.id_comment + "' style='display:none;'>";
                    html += "<form action='comment.php' method='post'>";
                    html += "<input type='hidden' name='id_comment' value='" + response.id_comment + "'>";
                    html += "<textarea name='reply_content'></textarea><br/>";
                    html += "<input type='submit' name='submit_reply' value='Gửi phản hồi'>";
                    html += "</form>";
                    html += "</div>";
                    
                    $('#comments').prepend(html);
                }
                
                // Reset form
                form.trigger('reset');
            }
        });
    });
    // // Chỉnh sửa phản hồi và hiển thị trực tiếp lên trang web
    // $('#edit-reply-form').on('submit', function(event) {
    //     event.preventDefault();
        
    //     var form = $(this);
    //     var formData = form.serialize();
        
    //     $.ajax({
    //         url: form.attr('action'),
    //         method: 'POST',
    //         data: formData,
    //         dataType: 'json',
    //         success: function(response) {
    //             // Cập nhật nội dung phản hồi đã chỉnh sửa trên trang web
    //             var replyContent = form.find('[name="reply_content"]');
    //             var editedReply = replyContent.val().trim();
    //             var p = replyContent.parent().prev();
    //             if (editedReply.length > 0) {
    //                 p.text(editedReply);
    //             }
                
    //             // Ẩn form chỉnh sửa
    //             form.hide();
    //         },
    //         error: function(xhr, status, error) {
    //             console.log(error);
    //             alert('Có lỗi xảy ra, vui lòng thử lại sau!');
    //         }
    //     });
    // });
});
</script>