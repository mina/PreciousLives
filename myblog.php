<?php
  require "./assets/php/blogConnect.php";
  
  $query = "select * from `blogs` where `id`=1";
  $blog = mysql_fetch_array(mysql_query($query));
  require("/home3/precipa7/public_html/assets/html/blog.php");
?>