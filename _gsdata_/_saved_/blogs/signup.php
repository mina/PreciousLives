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
     <?php include_once("../google-analytics.php"); ?>
    <div class="container">
      <?php
      include "../assets/html/top-navbar.php";
      ?>
      <div class="row-fluid">
      <div class='page-header'>
        <br>
        <br>
        <h1>
          Signup!
          <small>Welcome to the blogosphere</small>
        </h1>
      </div>
      </div>
      <div class="row-fluid">
        <div class='span2'>
        </div>
        <div class="span10">
          <form class='signup-form' method='post' action='blog-edit.php'>
            <table class="input-table">
              <tr>
                <td>Your Name:</td><td><input id='signup_name' type='text'</td><td>We'll say hi when you log in :)</td>
              </tr>
              <tr>
                <td>Blog's Name:</td><td><input id='signup_blogname' name="signup_blogname" type="text" /></td><td>This will be visible on your blog.</td>
              </tr>
              <tr>
                <td>Username:</td><td><input id='signup_username' name="signup_username" type="text"/></td><td>You will use this to log in.</td>
              </tr>
              <tr>
                <td>Password:</td><td><input id='password_one' type="password" name="signup_password" /></td><td>You will use this too to log in.</td>
              </tr>
              <tr>
                <td>Repeat Password:</td><td><input id='password_two' type="password" name="signup_password2" /></td>
              </tr>
              <tr>
                <td>www.preciouslives.net/blogs/</td><td><input id="blog_url" type="text" name="blog_url" /></td><td>Your blog will be hosted at this URL.</td>
              </tr>
              <tr>
                <td><input class='btn btn-primary' type="submit" value='Signup!'/></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
    <!-- /container -->
    <?php
      require ("../assets/html/scripts.html");
    ?>
  </body>
  
</html>