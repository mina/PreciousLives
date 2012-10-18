<?php

session_start();

require("myphpfiles/blogConnect.php");
require("myphpfiles/blogDBAccess.php");

$blog_id = $_COOKIE['blog_id'];
$post_id = $_POST['post_id'];

$post = getPostByID($post_id);
$response['result'] = false;

if (!$blog_id == $post_id['blog_id']) {
    $response['message'] = "We have encountered an error. It seems that your are trying to delete a post that is not yours. Please trying logging out and back in.";
    print json_encode($response);
} else {
    if (!deletePost($post_id)) {
        $response['message'] = "We have encountered an error deleting this post. The post was not deleted. Sorry :(";
        print json_encode($response);
    } else {
        $response['result'] = true;
        $response['message'] = "Your have deleted this post.";
        print json_encode($response);
    }
}


?>