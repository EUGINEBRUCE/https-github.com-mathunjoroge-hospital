	<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;"><div align="center"><caption align="ceter"><h4><h4></caption><h4><?php echo $_GET["test_done"]?></h4><h4><?php echo $_GET["name"]?>,&nbsp; <?php echo $_GET["sex"]?> age: <?php $age=number_format($_GET["age"], 2, '.', ''); if ($age>=1) { echo $age." Years"; } if ($age<1) { echo $age*12; echo "&nbsp;"." Months"; } ?></h4></div>');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>	 
	 <div class="container" id="print" style="width: 100%;">
	 	<img src="../lab/logos/jaramogi.jpg" class="img-thumbnail">
	 	<?php
	include('../connect.php');
	$test_id=$_GET["lab_id"];
	$result = $db->prepare("SELECT  lab_tests.id AS id,lab_template FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE lab_tests.id='$test_id'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $data= $row['lab_template'];

	 ?>	
		<div><?php echo $data; ?>
		</div>
		</div>
		
<?php } ?>

<a href="javascript:Clickheretoprint()"> 
<button style="width: 90%;" class="btn btn-success btn-mini">Print report</button></a>
