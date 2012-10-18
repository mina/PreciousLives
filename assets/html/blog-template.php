<?php
require ("blogConnect.php");

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
      <?=$blog['blogname']?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding: 40px;
      }
    </style>
    <link href="bootstrap-responsive.css" rel="stylesheet">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   </head>

  <body>
   <?php include_once("../google-analytics.php"); ?>
    <div class="container">
      <?php
      include "../../assets/html/top-navbar.php";
      ?>
      <div class="row-fluid"><br><br></div>
      <div class="row-fluid">
        <div class='span2'>
          
        </div>
        <div class="span8">
            <!--this is actual content-->
            <div class="mycontent">
              <?php
                require("blog.php");
              ?>
            </div>
        </div>
      </div>
    </div> <!-- /container -->
    <?php
      include "scripts.html";
    ?>
  </body>
</html>
