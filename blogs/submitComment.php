<?php

require("../assets/php/blogConnect.php");

$comment_name = mysql_real_escape_string($_POST['comment_name']);
$comment_email = mysql_real_escape_string($_POST['comment_email']);
$comment_body = mysql_real_escape_string($_POST['comment_body']);

$query = "insert into `comments` (`blog_id`, `post_id`, `name`, `email`, `body`) values ('{$_POST['blog_id']}', '{$_POST['post_id']}', '{$comment_name}', '{$comment_email}', '{$comment_body}')";

$result = mysql_query($query);
$return['result'] = $result;
if (!$return['result']) {
    $return['message'] = "Sorry, could not add your comment at this time.";
}

print json_encode($return);
?>