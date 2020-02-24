<?php 
require_once('../auth.php'); 
include('../connect.php');
$a=$_POST['req'];
$b=$_POST['radiologist'];
$c=$_POST['report'];
$e=date('d/m/Y H:i:s');


//updating report
$sql = "UPDATE images
        SET  report=?,
        reported_by=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b,$a)); 
 ?>

 <p align="center">data saved success!</p>
<script type="text/javascript">
 	setTimeout(function(){
    self.close();
},3000);
 </script>


 