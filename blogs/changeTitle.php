<?php

require("../assets/php/blogConnect.php");
require("../assets/php/blogDBAccess.php");

$blog_id = $_COOKIE['blog_id'];
$new_title = $_POST['new_blog_title'];
$new_title = mysql_real_escape_string($new_title);

$response['result'] = false;

if (updateBlogTitle($blog_id, $new_title)) {
    $response['result'] = true;
    $response['message'] = "You have successfully updated your blog's title";
    print json_encode($response);
} else {
    $response['message'] = "We have encountered an error updatign the blog title. Sorry :(";
    print json_encode($response);
}