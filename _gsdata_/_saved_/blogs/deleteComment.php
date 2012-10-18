<?php
require ("myphpfiles/blogConnect.php");

$comment_id = $_POST['comment_id'];
$query = "delete from `comments` where `id`={$comment_id}";
$resource = mysql_query($query);

if ($resource) {
    $response['result'] = true;
} else {
    $response['result'] = false;
    $response['message'] = "Sorry, we could not delete this comment at this time.";
}

print json_encode($response);