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
        <br><br>
      </div>
      <div class='page-header'>
        <h1>
          Login
          <small>
            Yes, we've missed you :)
          </small>
        </h1>
      </div>
      <div class='row-fluid'>
        <div class='span2'>
        </div>
        <div class="span8">
          <form class="login-form" action='blog-edit.php' method='post' onsubmit='return processLoginForm()'>
            <table class="input-table">
              <tr>
                <td>Username:</td><td><input name='login_username' id='username' type="text"/></td>
              </tr>
              <tr>
                <td>Password:</td><td><input name='login_password' id='password' type="password"/></td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <input type='submit'  value='Log in' class='btn btn-primary' />
                </td>
              </tr>
            </table>
          </form>
          <hr>
        </div>
      </div>
    </div>
    <!-- /container -->
    <?php
      require ("../assets/html/scripts.html");
    ?>
  </body>
</html>