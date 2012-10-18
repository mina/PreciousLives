<?php

require("myphpfiles/blogConnect.php");
$query = "insert into `comments` (`blog_id`, `post_id`, `name`, `email`, `body`) values ('{$_POST['blog_id']}', '{$_POST['post_id']}', '{$_POST['comment_name']}', '{$_POST['comment_email']}', '{$_POST['comment_body']}')";
$result = mysql_query($query);
$return['result'] = $result;
if (!$return['result']) {
    $return['message'] = "Sorry, could not add your comment at this time.";
}

print json_encode($return);
?>