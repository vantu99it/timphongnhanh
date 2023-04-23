<?php 

$id_rooms = isset($_GET['id'])?$_GET['id']:'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" id="comment-form">
        <input type="hidden" name="id_rooms" value="<?php echo $id_rooms; ?>">
        <div class="form-contact">
        <input type="text" name="comment_content" id="comment_content" placeholder="Nhập bình luận...">
        </div>
        <button type="submit" id="submit-comment">Submit</button>
    </form>
    <div id="comment-message"></div>
    <div id="comments"></div>
    <div id="reply-comments"></div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var fetchCommentsEnabled = true;
        var commentsLoaded = false; // Thêm cờ biến commentsLoaded
        function fetchComments(){
            if (!commentsLoaded && fetchCommentsEnabled) { // Kiểm tra commentsLoaded 
                commentsLoaded = true; // Đặt cờ biến commentsLoaded là true
                var id_rooms = <?php echo $id_rooms; ?>; 
                $.ajax({
                    url: "comment.php",
                    method: "POST",
                    data: {id_rooms: id_rooms},
                    success: function(result){
                        $("#comments").html(result);
                    },
                    complete: function() {
                        // Gọi lại hàm fetchComments sau 10 giây
                        setTimeout(fetchComments, 10000); 
                    }
                });
            } else {
                // Nếu đã load rồi thì chỉ đợi để hàm được gọi lại
                setTimeout(fetchComments, 10000);
            }
        }
        fetchComments();

        $("#comment-form").submit(function(event) {
            event.preventDefault();
            var commentContent = $("#comment_content").val().trim();
            if (commentContent.length === 0) {
                $("#comment-message").text("Vui lòng không bỏ trống"); 
                return;
            }
            $.ajax({
                url: "process_comment.php",
                type: "POST",
                data: $(this).serialize(), 
                success: function(response) {
                    $("#comment_content").val(''); 
                    $("#comment-message").text("");
                    commentsLoaded = false;
                    fetchComments();
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            });
        });

        $(document).on("click", ".reply-button", function() {
            // fetchCommentsEnabled = false;
            var commentDiv = $(this).closest(".comment");
            var commentId = commentDiv.data("id");
            var username = commentDiv.find("strong").text();

            var html = '<form method="post" class="reply-form" >';
            html += '<input type="hidden" name="id_comment" value="' + commentId + '">';
            html += '<input type="hidden" name="username" value="' + username + '">';
            html += '<input type="text" name="reply_content" placeholder="Write a reply...">';
            html += '<button type="submit" id="reply-form">Submit</button>';
            html += '</form>';
            html += '<div id="reply-form-message"></div>';
            commentDiv.find(".replies").append(html); 
        });

        $(document).on("submit", ".reply-form", function(event) {
            event.preventDefault();
            var form = $(this);
            var replyContent = form.find("input[name=reply_content]").val().trim(); 
            if (replyContent.length === 0) { 
                $("#reply-form-message").html("<p>Vui lòng không bỏ trống.</p>"); 
                return; 
            }
            $.ajax({
                url: "process_reply.php",
                type: "POST",
                data: form.serialize(), 
                success: function(response) {
                    form.remove(); 
                    $("#reply-form-message").html("");
                    commentsLoaded = false;
                    fetchComments();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            });
        });

        $(document).on("click", ".delete-button", function() {
            var commentDiv = $(this).closest(".comment");
            var commentId = commentDiv.data("id");

            $.ajax({
                url: "delete_comment.php",
                type: "POST",
                data: { id_comment: commentId },
                success: function(response) {
                    commentsLoaded = false;
                    fetchComments();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            });
        });

        $(document).on("click", ".delete-button-reply", function() {
            var replyDiv = $(this).closest(".reply");
            var replyId = replyDiv.data("id");

            $.ajax({
                url: "delete_reply.php",
                type: "POST",
                data: { id_reply: replyId },
                success: function(response) {
                    commentsLoaded = false;
                    fetchComments();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            });
        });
    </script>
</body>
</html>
