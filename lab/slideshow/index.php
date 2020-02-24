<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1">
<!-- Main CSS -->
<link rel="stylesheet" href="css/main.css">

<title>PHP Image Slideshow</title>
</head>
<style>
body {
    max-width: 960px;
    margin: 0 auto;
    font-family: arial;
}

.gallery {
    padding: 40px 0px;
}

.galleryItem {
    width: 300px;
    display: inline-block;
    padding-right: 15px;
}

.galleryItem img {
    width: 100%;
}
</style>
<body>
    <div class="container py-4">
        
        </body>
        <div>
            <!-- gallery class need for using gallery -->
            <div class="gallery">
                <?php
                if (isset($_POST['submit'])) {
                    if (count($_FILES['file-input']['name']) > 0) {
                        for ($i = 0; $i < count($_FILES['file-input']['name']); $i ++) {
                            $File_dir = $_FILES['file-input']['tmp_name'][$i];
                            $save = "images/" . $_FILES['file-input']['name'][$i];
                            move_uploaded_file($File_dir, $save);
                        }
                        $dir = "images/";
                        $photo = glob($dir . "*");
                        foreach ($photo as $photos) {
                            ?>
                    <div class="galleryItem">
                    <img src="<?php print_r($photos) ?>">
                </div>
                  <?php
                        }
                        ?> 
                <div class="button-row1">
                    <input type='submit' id='slideimage' name='slideshow'
                        value='Start Slideshow'>
                </div>
      <?php }}?>
                
          
        </div>
        </div>
        <div class="galleryShadow"></div>
        <div class="galleryModal">
            <i class="galleryIcon gIquit close"></i> <i
                class="galleryIcon gIleft nav-left"></i> <i
                class="galleryIcon gIright nav-right"></i>
            <div class="galleryContainer">
                <img src="">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    function validate() {
    	    if($("#file-input").val() == "") {
            $("#validation_error").html("Please select image files");
            return false;
        }
        return true;
    }
    </script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
</body>
</html>
