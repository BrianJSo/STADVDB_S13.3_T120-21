<?php

    function connection(){
        $host = "sql211.epizy.com";
        $username = "epiz_27563948";
        $password = "23O3HbzNQy";
        $database = "epiz_27563948_imdb_ijs";

        $con = new mysqli($host, $username, $password, $database);

        if($con->connect_error){
            echo $con->connect_error;
        } else {
            return $con;
        }
    }
