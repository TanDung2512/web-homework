<?php 
    require_once(__DIR__.'/getid3/getid3.php');
    require_once(__DIR__.'/getid3/getid3.lib.php');
    require_once(__DIR__.'/getid3/write.php');

    class MP3{
        private $_song ;
        private $_textEncoding = 'UTF-8';
        private $_metadata;
        
        /*
        *   function to update MP3 file 
        *   @param file_data - $_POST request from the form 
        *   @return view 
        *   
        */
        public function updateMP3($file_data){
            $getID3 = new getID3;
            $getID3->setOption(array('encoding'=>$this->_textEncoding));
            $tagwriter = new getid3_writetags;
            $tagwriter->filename = $file_data["path"];
            $tagwriter->tagformats = array('id3v2.3');


            $tagwriter->overwrite_tags    = true; 
            $tagwriter->remove_other_tags = false;
            $tagwriter->tag_encoding      = $this->_textEncoding;
            $tagwriter->remove_other_tags = true;
            $format_data = array();

            foreach($file_data as $key => $value){
                if($key == "action" or $key == "path"){
                    continue;
                }
                $format_data[$key] =  array($value);
            }
            $tagwriter->tag_data = $format_data;

            if ($tagwriter->WriteTags()) {
                if (!empty($tagwriter->warnings)) {
                    echo 'There were some warnings:<br>'.implode('<br><br>', $tagwriter->warnings);
                }
            } else {
                echo 'Failed to write tags!<br>'.implode('<br><br>', $tagwriter->errors);
            }
            $this->createView($file_data["path"]);
        }
        
                
        public function createView($filePath){
            $getID3 = new getID3;
            $getID3->setOption(array('encoding'=>$this->_textEncoding));
            $metadata = $getID3->analyze($filePath);
            getid3_lib::CopyTagsToComments($metadata);
            if(!isset($metadata["tags"])){
                echo "no tags";
                return;
            }
            // var_dump($metadata["tags"]);
            $metadata = $metadata["tags"]["id3v2"];

?>  
            <html>
                <?php include_once(__DIR__."/../includes/head.php");?>
                <body class = "layout">
                    <main class = "main">
                    <form class="needs-validation" novalidate method = "POST" action = "./">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <input type="text" name = "action" value = "updateMP3" />

                            <?php
                                foreach($metadata as $key => $value){
                            ?>
                                <label for="validationCustom01">
                                    <?php echo $key;?>
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="validationCustom01" 
                                    placeholder="First name" 
                                    <?php 
                                        echo "name=\"".$key."\"";
                                        if(is_array($value)){
                                            foreach($value as $key_1 => $value_1){
                                                echo "value=\"".$value_1."\"";
                                            }
                                        }
                                        else{
                                            echo "value=\"".$value."\"";
                                        }
                            }
                                    ?>
                                    required>
                            </div>
                        </div>
                        <label for="validationCustom01">
                                    Path
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="validationCustom01" 
                                    name = "path"
                                    <?php 
                                        echo "value=\"".$filePath."\"";
                                    ?>
                                    required>
                        <input class = "btn " type = "submit" value = "Submit">
                    </form>
                    </main>
                </body>
            </html>
<?php
        }
    }
?>