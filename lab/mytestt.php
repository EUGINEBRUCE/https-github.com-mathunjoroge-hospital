<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<style type="text/css">#parent div {
    display:none;
    position: absolute;
    top: 0;
    left: 0;
}
#parent div:first-child {
    display:block;
}
div{background:}

#parent > div{
    width:90%;
    height:90%;
}</style>
<script type="text/javascript">    function Divs() {
        var divs= $('#parent div'),
            now = divs.filter(':visible'),
            next = now.next().length ? now.next() : divs.first(),
            speed = 1000;
    
        now.fadeOut(speed);
        next.fadeIn(speed);
    }
    
    $(function () {
        setInterval(Divs, 1400);
    });

</script><div id="parent"><?php
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
            '<div class="col-md-3">';
            '<a href="zoom.php?img='.$myfiles.'/'.basename($image).'">'.'<h4>'.basename($image).'</h4>'.'</a>'; // show only image name if you want to show full path then use this code // echo $image."<br />";
             $rows='<img id="zoomimg"  style="width:98%;height:98%;" src="'.$image .'" alt="Random image" />'."<br /><br />".'</div>';
             	
             	 
             
          }
       ?>
       
       <?php 
       echo '<div'.' '.'id="'.$image.'"'.' '.'class="'.'box"'.'> '.'<img'.' '.'"src="'.$image.'"/>'.'</div>'; ?>
        <?php } ?>
    </div>