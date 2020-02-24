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

</head><body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>
   
  </header>
  <div class="content-wrapper"> 
    <div class="container">
        <script type="text/javascript">
          document.getElementById('back')onclick()
          {history.back();}
        </script>
      <p><button class="btn btn-primary" id="back">back</button></p>
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
            echo '<div class="'.'container'.">'.'<div class=".'ism-slider'." id=".'my-slider">'.'<li>
      '"<img". 'id='."zoomimg".  'style="width:98%;height:98%;"'.' "src="'.$image .'"/>"' .'"</div>"';'
    </li>'.'<ol>';
                        
             
          }
       ?>
       <?php echo"</div>"; } ?>
       <script type="text/javascript">
        
       </script>
      </div></div></div>

</body>
</html>

