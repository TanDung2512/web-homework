<?php 
    /*
    *  Process file *.mp3 when first submit to server 
    *  1. Move *.mp3 file from cache to storage to can be able to process on it
    *  2. Initializing Object (class MP3)
    *  3. Use library to extract metadata from the song in the idv3 standard 
    *  4. Create view and put data into widgets, then return the view to user 
    */
    require_once __DIR__.'/../class/MP3.php';
    $file = $_FILES['song']['tmp_name'];
    $path = __DIR__."/../songs/".$_FILES['song']['name'];
    move_uploaded_file($file, $path);

    $mp3 = new MP3();
    $mp3->createView($path);
?>