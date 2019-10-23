<?php

    session_start();
    $DIR = "php-template/";

    switch(true){
        case $_SERVER['REQUEST_METHOD'] === "POST":
            $path = $_POST['action'];
            include $DIR."controllers/".$path.".php";
            break;
        default:
            include $DIR.'submitmp3.php';
   }
?>
