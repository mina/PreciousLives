<?php
  if (!isset($_COOKIE['blog_id'])) {
    header("Location: /blogs/");
    exit;
  }
  
  if (!$_POST['post_id']) {
    header ("Location: /blogs/error.php");
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

    <title><?=htmlspecialchars($blog['blogname'])?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <style type="text/css">
body {
        padding: 40px;
      }
    </style>
    <link href="/assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript">
</script>
</head>

<body>
    <div class="container">
        <?php
            include "/home3/precipa7/public_html/assets/html/top-navbar.php";
        ?>

        <div class="row-fluid">
            <br>
            <br>

            <div class="page-header">
                <h1>Manage comments on your blog <small>Delete the ones you don't like.</small></h1>
            </div>
        </div>

        <div class="row-fluid">
            <!--this is actual content-->

            <div class="span2"></div>

            <div class='row-fluid'>
                <div class='span8'>
                    <button id='go-to-blog-edit' class='btn'>Go back</button><br>
                    <br>
                    <?php
    	                $query = "select * from `comments` where `post_id`=".$_POST['post_id'];
	                    $result = mysql_query($query);
                    ?>

                    <table class='table-bordered table table-stripped'>
                        <tr>
                            <th>Name</th>

                            <th>Email</th>

                            <th>Comment</th>

                            <th>Delete</th>
                        </tr>
                        
                        <?php while ($comment= mysql_fetch_array($result)) { ?>

                        <tr>
                            <td><?=htmlspecialchars($comment['name'])?>
                            </td>

                            <td><?=htmlspecialchars($comment['email'])?>
                            </td>

                            <td><?=htmlspecialchars($comment['body'])?>
                            </td>

                            <td>
                            	<a class='delete-comment' href='#' comment_id=<?=$comment['id']?>>
	                            	<i class="icon-trash"></i>
                            	</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div><?php     
      include ("/home3/precipa7/public_html/assets/html/scripts.html");
    ?>
</body>
</html>
