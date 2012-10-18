<?php
    $connection = mysql_connect("localhost", "precipa7_blogeng", "Keepitsimple@890");
    if (!$connection) {
        die ("Could not connect");
    }
    mysql_select_db("precipa7_blogging-eng", $connection);
?>