<?php include_once("google-analytics.php"); ?>
<?php
require ("./assets/php/blogConnect.php");

$blog_id = 1;

$posts = mysql_query("SELECT * FROM posts where `blog_id`={$blog_id} ORDER BY time_stamp DESC", $connection);
while ($post= mysql_fetch_array($posts)) {
  
  print "<div class='hero-unit'>";
  print "<h1>{$post['title']}</h1>";
  if ($post['subtitle']) {
    print "<small>{$post['subtitle']}</small>";
  }
  print "<p>{$post['body']}</p>"; print "</div>";
  
  $comments = mysql_query("select * from `comments` where `blog_id`=1 and `post_id`={$post['id']} order by id asc");
  print "<div class='comment-section' post_id='{$post['id']}'>";
  print "<div class='row-fluid'>";
  print "<button class=\"comment-btn pull-right btn\">Comments</button>";
  print "</div>";
  print "<div class='comment-block row-fluid'>";
  print "<div class='comments'>";
  while ($comment = mysql_fetch_array($comments)) {
    print "<div class='row-fluid'>";
    print "<blockquote class='comment pull-right'><p>{$comment['body']}</p><small>{$comment['name']}</small></blockquote>";
    print "</div>";
  }
  print "</div>";
  print "<div class='row-fluid comment-form'>";
  print "<div class='well'>";
  print "<div class='hidden-field'>";
  print "<button id='comment-close' class='btn close-btn'>x</button>";
  print "<label class='control-label'>(Optional) Name:</label> <input name='comment-name' type='text' />";
  print "<label class='control-labe'>(Optional) Email:</label> <input name='comment-email' type='text' />";
  print "</div>";
  print "<form action='#' class='form-horiontal comment-submit' blog_id={$blog_id} post_id='{$post['id']}'>";
  print "<label class='control-label'>Comment: </label><input class='comment-add input-xlarge' id='textarea' rows='3' type='textarea' name='comment-body' placeholder='Add comment...' />";
  print "</form>";
  print "</div>";
  print "</div>";
  print "</div>";
  print "</div>";
}
?>