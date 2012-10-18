<?php
  require "./assets/php/blogConnect.php";
  
  $query = "select * from `blogs` where `id`=1";
  $blog = mysql_fetch_array(mysql_query($query));
  
?>
  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Precious Lives | Mina Almasry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding: 60px;
      }
    </style>
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   </head>

  <body>
    <div class="container-fluid">
      <?php
        include "./assets/html/top-navbar.php";
      ?>
      <div class="row-fluid hidden-desktop">
        <ul class="nav nav-pills my-navbar">
          <li class="active"><a href="/index.php" class="blog-link">Blog</a></li>
          <li><a href="/projects.html" class="projects-link">Projects</a></li>
          <li><a href="/resume.html" class="resume-link">Resume</a></li>
          <li><a href="/contact.html" class="contact-link">Contact</a></li>
          <li><a href="/about.html" class="about-link">About</a></li>
        </ul>
      </div>
      <div class="row-fluid">
        <div class="span2"></div>
        <div class="page-header">
          <h1>
            Blog
            <small>Precious Lives</small>
          </h1>
        </div>
      </div>
      <div class="row-fluid">
        <div class="span2 visible-desktop">
          <ul class="nav well nav-pills nav-stacked my-navbar side-navbar">
            <li class="active"><a href="#" class="blog-link">Blog</a></li>
            <li ><a href="#" class="projects-link">Projects</a></li>
            <li ><a href="#" class="resume-link">Resume</a></li>
            <li ><a href="#" class="contact-link">Contact</a></li>
            <li ><a href="#" class="about-link">About</a></li>
          </ul>
        </div>
        <div class="span7" id="content">
          <!--this is actual content-->
        </div>
        <div class="well span3 hidden-phone welcome-message">
          <h2 >Welcome!</h2>
          <hr>
            <p>
              My name is Mina Almasry and this is my personal webpage.
              You're now looking at my blog. If it's your first time here
              have a look around :)
            </p>
        </div>
      </div>
    </div> <!-- /container -->
    <?php
    include "./assets/html/scripts.html";
    ?>
  </body>
</html>
