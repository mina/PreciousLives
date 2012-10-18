<?php
$blog_id=2;
?>
<?php
require "../../assets/php/blogConnect.php";

$query = "select * from `blogs` where id=".$blog_id;
$result = mysql_query($query);
$blog = mysql_fetch_array($result);
$blog_name = $blog['blogname'];
include "../blog-template.php";// or include "../../blog-template.php" or include "./blog-template.php";
?>