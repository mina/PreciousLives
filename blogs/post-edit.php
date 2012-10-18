<?php
  if (!isset($_REQUEST['blog_id'])) {
    header("Location: /blogs/");
    exit;
  }
  
  if (!$_REQUEST['post_id']) {
    header ("Location: /error.php");
    exit;
  }
  
  require "../assets/php/blogConnect.php";
  require "../assets/php/blogDBAccess.php";
  require "../assets/php/printHtml.php";

  $blog = getBlogByID($_COOKIE['blog_id']);
  if (!$blog) {
    header("Location: /error.php");
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
    <style>
      body {
        padding: 40px;
      }
    </style>
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   </head>

  <body>
     <?php include_once("../google-analytics.php"); ?>
    <div class="container">
    <?php
      include "../assets/html/top-navbar.php";
    ?>
      <div class="row-fluid">
	<br><br>
	<div class='page-header'>
	  <h1>
	  <?php
	    if ($_REQUEST['post_id'] != "newpost") {
	      print "Edit your blog entry";
	      print "<small>Hopefully no one is going to notice.</small>";
	    } else {
	      print "Add a blog entry";
	      print "<small> We wanna hear what you have to say.</small>";
	    }
	  ?>
	  </h1>
	</div>
      </div>
      <div class="row-fluid">
	<!--this is actual content-->
	<div class='span2'>
	  
	</div>
	<div class='span8'>
	<?php
	  if (!$_REQUEST['post_id']) {
	    printAddPostForm($post);
	  } else {
	    $query = "select * from `posts` where `id`='{$_REQUEST['post_id']}'";
	    $resource = mysql_query($query);
	    $post = mysql_fetch_array($resource);
	    printAddPostForm($post);
	  }
	?>
	</div>
      </div>
    </div>
    <!-- /container -->
    <?php include ("../assets/html/scripts.html"); ?>
  </body>
</html>