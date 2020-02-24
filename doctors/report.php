
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("report").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<div class="container" id="report">
  <div class="container" align="center"><img src="../lab/logos/jaramogi.jpg"></div>
 	<h4>patient report</h4>
<?php
require_once('../main/auth.php');
 include('../connect.php');
$patient=$_REQUEST['search'];
  $result = $db->prepare("SELECT* FROM patients WHERE opno=:a");
  $result->bindParam(':a',$patient); 
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $a = $row['name'];
      $b = $row['age'];
      $c = $row['sex'];
 ?>
 <?php } ?>
 <caption align="left">Patient name: <?php echo $a; ?>, &nbsp; age: <?php 
  $now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"." Months"; }
    # code...
  ?> &nbsp; sex: <?php echo $c; ?> </caption>

  <?php
  $patient=$_REQUEST['path'];
   $result = $db->prepare("SELECT* FROM images WHERE image_path=:a");
   $result->bindParam(':a',$patient); 
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    
      $contents = $row['report'];
      $reported_by = $row['reported_by'];
  
  } ?>
		<div id="articleContent" name="report">
			<?php echo $contents;  ?>
		
		
         
         <p><b>Radiologist: <?php echo $reported_by; ?></b></p>
      
	</div>
  </div>
  <a href="javascript:Clickheretoprint()" style="font-size:20px; width: 100%;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print report</button></a>
