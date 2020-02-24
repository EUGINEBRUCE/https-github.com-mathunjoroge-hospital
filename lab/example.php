<?php 
require_once('../main/auth.php');
 include('../connect.php');
 ?>
<html>
<head>
<title>Your slider in a simple web page</title>

<style>
body { background-color: #fff; color: #000; padding: 0; margin: 0; }
.container { width: 900px; margin: auto; padding-top: 1em; }
.container .ism-slider { margin-left: auto; margin-right: auto; }
</style>

<link rel="stylesheet" href="ism/css/my-slider.css"/>
<script src="ism/js/ism-2.2.min.js"></script>

</head>
</head><body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>
   
  </header>
      <p><button class="btn btn-primary" id="back">back</button></p>
      <div class='container'>

      <?php
$myfiles =$_REQUEST["id"];
     $files = glob("$myfiles/*.*");
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
         );

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         if (in_array($ext, $supported_file)) {
            echo '<div class="ism-slider" id="my-slider">"'.'<div class="'.'"ism-slider'.'" id="'.'my-slider">'.'<li>'.'<img'." ".'src="'.$image .'"/>' .'</div>'.'
    </li>'.'<ol>'.'</div></div>';
     
                        
             
          }
       ?>
       
     
     <?php } ?>
       <script type="text/javascript">
        
       </script>
         

</body>
</html>

