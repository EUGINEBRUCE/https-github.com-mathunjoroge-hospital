<?php $myfiles ="http://127.0.0.1/hospital/scans/10_201920190507123620/";
     
$myfiles =$_REQUEST["id"];
     $files = glob("$myfiles/*.*");
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png',
                'dcm'
         );

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
         if (in_array($ext, $supported_file)) {
            echo $image;
             	 
             
          }
       ?>
       <?php } ?>