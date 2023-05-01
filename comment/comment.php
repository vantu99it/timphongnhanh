<?php 
  include '../include/connect.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

  if(isset($_SESSION['login'])){
    $id_user = $_SESSION['login']['id'];
    $queryUser = $conn->prepare("SELECT * FROM tbl_user WHERE id = $id_user");
    $queryUser->execute();
    $resultsUser = $queryUser->fetch(PDO::FETCH_OBJ);
    $userAvatar = $resultsUser -> avatar;
  }

  if(isset($_POST['id_rooms'])){
    $id_rooms = $_POST['id_rooms'];

    $stmt = $conn->prepare("SELECT comments.*, user.fullname, user.avatar FROM tbl_comments AS comments JOIN tbl_user AS user ON comments.id_user = user.id WHERE id_rooms=:id_rooms ORDER BY created_at DESC");
    $stmt->bindParam(':id_rooms', $id_rooms);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($comments as $key => $comment) {
      ?>
      <div class="comment-test">
        <div class="comment" data-id="<?php echo $comment -> id_comment?>">
          <div class="comment-list">
            <div class="avatar">
              <div class="avata-img">
                <?php if(strlen($comment -> avatar) != 0){ ?>
                  <img src="<?php echo $comment -> avatar?>" alt="">
                <?php }else{ ?> 
                  <img src="./image/default-user.png" alt="">
                  <?php }?> 
              </div>
            </div>
            <div class="comment-content">
              <p class="full-name"><?php echo $comment -> fullname?></p>
              <p class="content"><?php echo $comment -> comment_content?></p>
            </div>
          </div>
          <div class="comment-act">
            <?php if(isset($_SESSION['login'])) { ?>
              <button class="reply-button">Phản hồi</button>
              <?php if($comment -> id_user == $_SESSION['login']['id']){ ?>
                <button class="delete-button">Xóa</button>
            <?php }} ?>
            <span class="post-time">
              <?php 
                $time = time() - strtotime($comment->created_at);
                if(floor($time/60/60/24)==0){
                  if(floor($time/60/60)==0){
                    echo(ceil($time/60)." phút trước");
                  }else{
                    echo(floor($time/60/60)." tiếng trước");
                  }
                }else{
                  echo(floor($time/60/60/24)." ngày trước");
                }
              ?>
            </span>
          </div>
          <?php if(isset($_SESSION['login'])) { ?>
            <div class="replies" id="replies">
              <form method="post" class="reply-form" >
                <input type="hidden" name="id_comment" value="<?php echo $comment -> id_comment?>">
                <input type="hidden" name="username" value="<?php echo $_SESSION['login']['id']?>">
                <div class="form-contact comment-input">
                  <div class="avatar">
                    <div class="avata-img">
                      <?php if(strlen($userAvatar) != 0){ ?>
                        <img src="<?php echo $userAvatar ?>" alt="">
                      <?php }else{ ?> 
                        <img src="./image/default-user.png" alt="">
                      <?php }?> 
                    </div>
                  </div>
                  <input type="text" name="reply_content" id="reply_content" placeholder="Phản hồi dưới tên <?php echo $_SESSION['login']['fullname']?>">
                  <button type="submit" id="reply-form" class="btn btn-contact submit-comment"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
              </form>
              <div id="reply-form-message"></div>
            </div>
          <?php } ?>
        </div>
        <?php

        // Hiển thị danh sách các phản hồi của bình luận này
        $stmt = $conn->prepare("SELECT replies.*, user.fullname, user.avatar FROM tbl_replies AS replies JOIN tbl_user AS user ON replies.id_user = user.id WHERE id_comment=:id_comment ORDER BY created_at DESC");
        $stmt->bindParam(':id_comment', $comment -> id_comment);
        $stmt->execute();
        $replies = $stmt->fetchAll(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();
        
        if($count >0){
        ?>
        <div class="total-reply">
          <i class="fa-solid fa-turn-up"></i>
          <button class ="show-more" >Hiện thị tất cả <?php echo $count ?> phản hồi.</button>
        </div>
        <?php }
        foreach ( $replies as $key1 => $reply) {
          ?>
          <div class="reply" style= "margin-left: 60px" data-id="<?php echo $reply -> id_reply?>">
            <div class="comment-list">
              <div class="avatar">
                <div class="avata-img">
                  <?php if(strlen($reply -> avatar) != 0){ ?>
                    <img src="<?php echo $reply -> avatar?>" alt="">
                  <?php }else{ ?> 
                    <img src="./image/default-user.png" alt="">
                    <?php }?> 
                </div>
              </div>
              <div class="comment-content">
                <p class="full-name"><?php echo $reply -> fullname?></p>
                <p class="content"><?php echo $reply -> reply_content?></p>
              </div>
            </div>
            <div class="comment-act">
              <?php if(isset($_SESSION['login'])) { ?>
                <?php if($reply -> id_user == $_SESSION['login']['id']){ ?>
                  <button class="delete-button-reply">Xóa</button>
              <?php }} ?>
              <span class="post-time">
                <?php 
                  $time = time() - strtotime($reply->created_at);
                  if(floor($time/60/60/24)==0){
                    if(floor($time/60/60)==0){
                      echo(ceil($time/60)." phút trước");
                    }else{
                      echo(floor($time/60/60)." tiếng trước");
                    }
                  }else{
                    echo(floor($time/60/60/24)." ngày trước");
                  }
                ?>
              </span>
            </div>
          </div>
          <?php 
        }?>
      </div>
      <?php
    } 
  }
?>