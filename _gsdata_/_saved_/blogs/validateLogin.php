<?php
require("myphpfiles/blogDBAccess.php");
require("myphpfiles/blogConnect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$record = getBlogByUsername($username);

if (!$record) {
    $result['result'] = false;
    $result['message'] = "The username was not found in the database";
    print json_encode($result);
} else {
    if ($password == $record['password']) {
        $result['result'] = true;
        $result['blog_id'] = $record['id'];
        print json_encode($result);
    } else {
        $result['result'] = false;
        $result['message'] = "You have entered the wrong password";
        print json_encode($result);
    }
}