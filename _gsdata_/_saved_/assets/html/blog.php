<?php
  require ("./assets/php/blogConnect.php");
  $posts = mysql_query("SELECT * FROM posts where `blog_id`={$blog['id']} ORDER BY time_stamp DESC", $connection);
  while ($post= mysql_fetch_array($posts)) {
?>
    <div class='hero-unit'>
      <h1><?=$post['title']?></h1>
      <small><?=$post['subtitle']?></small>
      <p><?=$post['body']?></p>
    </div>
  
    <?php
      $comments = mysql_query("select * from `comments` where `blog_id`={$blog['id']} and `post_id`={$post['id']} order by id asc");
      $num_comments = mysql_numrows($comments);
    ?>
   
    <div class='comment-section' post_id="<?=$post['id']?>">
      <div class='row-fluid'>
        <button class="comment-btn pull-right btn">Comments</button>
      </div>
      <div class='comment-block row-fluid'>
        <div class='comments'>
          <?php while ($comment = mysql_fetch_array($comments)) { ?>
            <div class='row-fluid'>
              <blockquote class='comment pull-right'>
                <p><?=$comment['body']?></p>
                <small><?=$comment['name']?></small>
              </blockquote>
            </div>
          <?php } ?>
        </div>
        <div class='row-fluid comment-form'>
          <div class='well'>
          <form action='#' class='form-horiontal comment-submit' blog_id="<?=$blog['id']?>" post_id="<?=$post['id']?>">
              <button id='comment-close' class='btn close-btn'>x</button>
              <label class='control-label'>(Optional) Name:</label>
              <input name='comment-name' type='text' />
              <label class='control-labe'>(Optional) Email:</label>
              <input name='comment-email' type='text' />
            <label class='control-label'>Comment: </label>
            <input class='comment-add input-xlarge' id='textarea' rows='3' type='textarea' name='comment-body' placeholder='Add comment...' />
            <input type="submit">
          </form>
          </div>
        </div>
      </div>
    </div>
<?php } ?>