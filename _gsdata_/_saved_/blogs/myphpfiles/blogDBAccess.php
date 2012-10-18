<?php
    function addBlogger ($blogname, $username, $password, $blogurl) {
        $sql = "INSERT INTO  `blog`.`blogs` (`blogname` ,`username` ,`password`, `blogurl`)
                VALUES ('".$blogname."',  '".$username."',  '".$password."', '".$blogurl."');";
        if (!mysql_query($sql)) {
            return false;
        }
        $sql = "SELECT * FROM `blog`.`blogs` WHERE username='".$username."';";
        $record = mysql_query($sql);
        if (!$record) {
            return false;
        }
        $array = mysql_fetch_array($record);
        if (!$array) {
            return false;
        }
        return $array['id'];
    }
    
    function getBlogByUsername($username) {
        $sql = "SELECT * FROM `blogs` WHERE `username`='".$username."'";
        $result = mysql_query($sql);
        if (!$result) {
            return NULL;
        }
        $row = mysql_fetch_array($result);
        return $row;
    }
    
    function getBlogByID($blog_id) {
        $sql = "SELECT * FROM `blogs` WHERE `id`='".$blog_id."'";
        $result = mysql_query($sql);
        if (!$result) {
            return NULL;
        }
        $record = mysql_fetch_array($result);
        return $record;
    }
    
    function updateBlogTitle($blog_id, $newtitle) {
        $sql = "UPDATE  `blog`.`blogs` SET  `blogname` =  '".$newtitle."' WHERE  `blogs`.`id` =".$blog_id.";";
        if (mysql_query($sql)) {
            return true;
        }
        
        return false;
        
    }
    
    function updatePostInDB($post_id, $title, $subtitle, $body) {
        $sql = "UPDATE  `posts` SET  `title` =  '".$title."', `subtitle`='".$subtitle."', `body`='".$body."' WHERE `id` =".$post_id.";";
        return mysql_query($sql);
    }
    
    
    function addNewPostToDB($blog_id, $title, $subtitle, $body) {
        $sql = "INSERT INTO  `posts` (title, subtitle, body, time_stamp, blog_id) VALUES ('".$title."', '".$subtitle."', '".$body."', CURRENT_TIMESTAMP ,  '".$blog_id."')";
        //print ($sql);
        if (mysql_query($sql)) {
            return true;
        } else {
            return false;
        }
        
    }
    
    function getPostByID($post_id) {
        $sql = "SELECT * FROM `posts` WHERE `id`='".$post_id."'";
        $result = mysql_query($sql);
        $post = mysql_fetch_array($result);
        return $post;
        
    }
    
    function deletePost($post_id) {
        $sql = "DELETE FROM `posts` WHERE `id`='".$post_id."'";
        return mysql_query($sql);
    }
    
    
    function checkPostBelongsToBlog($blog_id, $post_id) {
        $post = getPostByID($post_id);
        return $post['blog_id'] == $blog_id;
    }
?>
