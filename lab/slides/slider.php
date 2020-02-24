<!DOCTYPE html>
<html>
<head>
	<title>images slider</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Made with WOW Slider - Create beautiful, responsive image sliders in a few clicks. Awesome skins and animations. Jquery slider" />
	<link rel="stylesheet" type="text/css" href="engine1/style.css" />
	<script type="text/javascript" src="engine1/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->

</head>
<body style="background-color:#d7d7d7;margin:0">
	
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul><?php
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
            '<div class="col-md-4">';
            '<a href="zoom.php?img='.$myfiles.'/'.basename($image).'">'.'<h4>'.basename($image).'</h4>'.'</a>'; // show only image name if you want to show full path then use this code // echo $image."<br />";
           echo  $rows='<img id="zoomimg"  style="width:98%;height:98%;" src="'.$image .'" alt="Random image" />'."<br /><br />";
            
             	 
             
          
       ?>
       
       <div class="ws_images"><ul>
        <li><img src="<?php echo $rows; ?>" title="VALERIAN ADOYO_12930_0001_99431" id="wows1_0"/></li>
    </ul></div>
    <div class="ws_bullets"><div>
        <a href="#" title="VALERIAN ADOYO_12930_0001_99431"><span><img src="<?php echo $rows; ?>" alt=""/></span></a>
    </div></div>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.net">jquery slider</a> by WOWSlider.com v8.8</div>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>
	<!-- End WOWSlider.com BODY section -->

</body>
<?php } ?><?php } ?>
</html>