<?php
if (!isset($_COOKIE['blog_id'])) {
  header("Location: /blogs");
  exit;
}

require "../assets/php/blogConnect.php";
require "../assets/php/blogDBAccess.php";
require "../assets/php/printHtml.php";

$blog = getBlogByID($_COOKIE['blog_id']);
if (!$blog) {
  header("Location: /blogs/error.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$blog['blogname']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  </head>
  <body>
     <?php include_once("google-analytics.php"); ?>
    <div class="container">
      <div class="page-header">
      <?php
        include "../assets/html/top-navbar.php";
      ?>
      <h1> Your blog </h1>
    </div>
    <div class='row-fluid'>
      <div class="span2">
        
      </div>
      <div class="span8">
      <div class='row-fuild update-title-form'>
        <form>
          <div>
            <h6>Blog Name</h6>
          </div>
          <input type='text' value='<?=$blog['blogname']?>' id='edited_blogname' name='edited_blogname'/>
          <div class='row-fluid'>
            <input type='submit' value="Update Your Blog's title" class='btn' />
          </div>
        </form>
        <hr>
        <br>
        <div class='row-fluid'>
          <div class='span6'>
            <h6>Posts</h6>
            <br>
          </div>
          <div class='span6'>
            <a href='post-edit.php?post_id=newpost'>
              <button class='btn btn-primary pull-right'>Add post</button>
            </a>
            <a href=<?=$blog['blogurl']?>>
              <button class='btn pull-right'">Go to your blog</button>
            </a>
          </div>
        </div>
        <table class='table-bordered table table-stripped'>
          <tr>
            <th>Title</th><th>Subtitle</th><th>Body</th><th>Date posted</th><th>Edit</th><th>Delete</th><th>Comments</th>
          </tr>
          <?php
            $sql = "SELECT * FROM posts WHERE `blog_id`=".$_COOKIE['blog_id'];
            $posts = mysql_query($sql);
          
            if (!$posts) {
              print "<br>found no posts<br>";
            }
          ?>
          <?php while ($post= mysql_fetch_array($posts)) : ?>
            <tr post_id=<?=$post['id']?>>
              <td><?=$post['title'] ?></td>
              <td><?=$post['subtitle']?></td>
              <td><?=$post['body']?></td>
              <td><?=$post['time_stamp']?></td>
              <td>
                <a class='edit-post' href='post-edit.php'>
                  <i class='icon-edit'></i>
                </a>
              </td>
              <td>
                <a class='delete-post' post_id=<?=$post['id']?> href='#' >
                  <i class='icon-remove'></i>
                </a>
              </td>
              <?php
                $query = "select * from `comments` where `post_id`='{$post['id']}'";
                $num_comments = mysql_numrows(mysql_query($query));
              ?>
              <td>
                <a href='#' class='edit-comments'>
                  <span class='badge badge-info' post_id=<?=$post['id']?>><?=$num_comments?></span>
                </a>
              </td>
            </tr>
          <? endwhile; ?>
        </table>
      </div>
      </div>
    </div>
    </div>
    <!-- /container -->
    <?php include "../assets/html/scripts.html" ?>
  </body>
</html>
