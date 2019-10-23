<?php 
    /*
    *  Update metadata in *.mp3 
    *  1. Initializing Object (class MP3)
    *  2. Update metadata 
    *  3. Create view and put data into widgets, then return the view to user 
    */
    require_once __DIR__.'/../class/MP3.php';
    $mp3 = new MP3();
    $mp3->updateMP3($_POST);
?>