<?php
  if (isset($_COOKIE['blog_id'])) {
    header("Location: /blogs/blog-edit.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Precious Blogs</title>
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
   <?php include_once("google-analytics.php"); ?>
    <div class="container">
	<?php
	    include "../assets/html/top-navbar.php";
	?>
	<div class="row-fluid">
	    <br>
	    <br>
	</div>
	<div class="row-fluid">
	  <div class='page-header'>
	    <h1>Welcome to Precious Blogs</h1>
	  </div>
	  <div class='span2'>
	    
	  </div>
	    <div class="span8">
	    <!--this is actual content-->
	    <div class="mycontent row-fluid">
	      <p>
		Precious blogs is a blogging engine. You can sign up and create your
		very own blog, and we'll have it up and running in seconds. If you already have an
		account with us, you can log in via the link below too. Happy blogging!
	      </P>
	      <br>
	      <div class='row-fluid'>
		<hr>
		<div class='span2'>
		  
		</div>
		<div class='span4'>
		    <a href="login.php">
		      <h1 class='signup-login'>Login</h1>
		    </a>
		</div>
		<div class='span4'>
		  <a href='signup.php'>
		    <h1 class='signup-login'>Signup</h1>
		  </a>
		</div>
	      </div>
		  <hr>
		  <h3>Here are all the blogs currently hosted by Precious Blogs:</h3>
		  <?php
		  
		  require "../assets/php/blogConnect.php";
		  $query = "SELECT * FROM `blogs`";
		  $result = mysql_query($query);
		  
		  while ($blog = mysql_fetch_array($result)) {
		  ?>
		  <a href="http://www.preciouslives.net/blogs/<?=$blog['blogurl']?>">
		  <div class="page-header blog-list">
		    <h1>
		      <?=$blog['blogname']?>
		      <small>
			by <?=$blog['personname']?>
		      </small>
		    </h1>
		  </div>
		  </a>
		  
		  <?php } ?>
	    </div>
	    </div>
	</div>
    </div>
    <?php
        require ("../assets/html/scripts.html");
    ?>
  </body>
</html>
