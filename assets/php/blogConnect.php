<?php
    @$connection = mysql_connect("localhost", "precipa7_blogeng", "Keepitsimple@890");
    if (!$connection) {
        @$connection = mysql_connect("localhost", "root", "minmas27");
        if (!$connection) {
            die ("Could not connect to MySQL server on local");
        } else {
            if (!mysql_select_db("blog", $connection)) {
                die ("Could not select DB on local");
            }
        }
    } else {
        if (!mysql_select_db("precipa7_blogging-engine", $connection)) {
            die ("Could not select live DB");
        }
    }
?>