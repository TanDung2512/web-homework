<html>
    <?php include_once("includes/head.php");?>
    <body class = "layout">
        <main class = "main">
        <form  enctype="multipart/form-data" method = "POST" action = "./">
            <div class="form-group">
                <label for="exampleFormControlFile1">Mp3 metadata extraction</label>
                <input type="text" class="form-control-file border" style = "display:none" name = "action" value = "processMP3" />
                <input type="file" name = "song"  class="form-control-file" id="song">
                <button class = "btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
        </main>
    </body>
</html>
