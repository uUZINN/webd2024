<?php
    $host = "localhost";
    $user = "uzin4916";
    $pw = "why49148751!!";
    $db = "uzin4916";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf-8");

    // if(mysqli_connect_errno()){
    //     echo "DATABASE Connect False";
    // } else {
    //     echo "DATABASE Connect True";
    // }
?>