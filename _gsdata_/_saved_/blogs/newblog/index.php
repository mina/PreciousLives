<?php
$blog_id=3;
?><?php
require ("myphpfiles/blogConnect.php");

$query = "select * from `blogs` where id=".$blog_id;
$result = mysql_query($query);
$blog = mysql_fetch_array($result);
$blog_name = $blog['blogname'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
      <?php
      print $blog['blogname'];
      ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="/projects/mina/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding: 40px;
      }
    </style>
    <link href="/projects/mina/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   </head>

  <body>
    <div class="container">
      <?php
      include "../assets/html/top-navbar.php";
      ?>
      <div class="row-fluid"><br><br></div>
      <div class="row-fluid">
        <div class="span10">
            <!--this is actual content-->
            <div class="mycontent">
              <?php
              
              require ("myphpfiles/blogConnect.php");
              
              if (!$_GET['page']) {
                $sql = "SELECT * FROM `posts` WHERE `blog_id`=".$blog_id;
              }
              
              $posts = mysql_query($sql);
              
              if (!$posts) {
                print "There is an error fetching this blog posts.";
              }
              
              while ($post= mysql_fetch_array($posts)) {
                print "<div class='hero-unit span10'>";
                print"<h1>".$post['title']."</h1>"; 
                if ($post['subtitle']) {
                  print "<small>".$post['subtitle']."</small>";
                }
                print "<p>".$post['body']."</p>"; print "</div>";
              }
              ?>
            </div>
        </div>
      </div>
    </div> <!-- /container -->

  </body>
</html>
