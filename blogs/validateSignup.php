<?php

require("../assets/php/blogConnect.php");
require("../assets/php/blogDBAccess.php");

$personname = mysql_real_escape_string($_POST['personname']);
$blogname = mysql_real_escape_string($_POST['blogname']);
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
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

$result = addBlogger($blogname, $username, $password, $blogurl, $personname);
if (!$result) {
    $response['message'] = "There was an error adding you to the database :( Please try again later.";
    print json_encode($response);
    exit;
}

$blog_id = $result;

$result = mkdir("./".$blogurl);
if (!$result) {
    $response['message'] = "Error creating the your blog's URL.";
    print json_encode($response);
    exit;
}

$data = "<?php\n\$blog_id=".$blog_id.";\n?>";

$result = file_put_contents("./".$blogurl."/index.php", $data);
if (!$result) {
    $response['message'] = "Error creating file.";
    print json_encode($response);
    exit;
}

$templateFile = file_get_contents("./signup-template.php");
if (!$templateFile) {
    $response['message'] = "Error getting the template file contents.";
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