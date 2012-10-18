<?php

require("../assets/php/blogConnect.php");
require("../assets/php/blogDBAccess.php");

$templateFile = file_get_contents("./blog-template.php");
$blogname = $_POST['blogname'];
$username = $_POST['username'];
$password = $_POST['password'];
$blogurl = $_POST['blogurl'];

$query = "select * from `blogs` where `username`='".$username."'";
$result = mysql_query($query);

$blog = mysql_fetch_array($result);

$response['result'] = false;

if ($blog) {
    $response['message'] = "That username is already taken. Please select a different username.";
    print json_encode($response);
    exit;
}

$query = "select * from `blogs` where `blogurl`='".$blogurl."'";
$result = mysql_query($query);
$blog = mysql_fetch_array($result);
if ($blog) {
    $response['message'] = "That Blog URL is already taken. Please select a different URL.";
    print json_encode($response);
    exit;
}

$result = addBlogger($blogname, $username, $password, $blogurl);
if (!$result) {
    $response['message'] = "There was an error adding you to the database :( Please try again later.";
    print json_encode($response);
    exit;
}

$blog_id = $result;

$result = mkdir("./".$blogurl);
if (!$result) {
    $response['message'] = "error creating the directory<br>";
    print json_encode($response);
    exit;
}

$data = "<?php\n\$blog_id=".$blog_id.";\n?>";

$result = file_put_contents("./".$blogurl."/index.php", $data);
if (!$result) {
    $response['message'] = "error creating file<br>";
    print json_encode($response);
    exit;
}

$templateFile = file_get_contents("./blog-template.php");
if (!$templateFile) {
    $response['message'] = "error getting the template file contents<br>";
    print json_encode($response);
    exit;
}

$result = file_put_contents ("./".$blogurl."/index.php", $templateFile, FILE_APPEND );
if (!$result) {
    $response['message'] = "error appending other conents<br>";
    print json_encode($response);
    exit;
} else {
    $response['result'] = true;
    $response['blog_id'] = $blog_id;
    print json_encode($response);
    exit;
}