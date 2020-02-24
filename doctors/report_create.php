<!DOCTYPE html>
<html>
<head>
	<title> write patient report</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="ckeditor/ckeditor.js"></script>
 <style type="text/css">
 	textarea {
  width: 300px;
  height: 390px;
}
 </style>

</head>
<body>
<div class="container">
 

	
<?php
require_once('../auth.php'); 
include('../connect.php');
include('../main/nav.php');
?>
  <h4>patient report</h4>
<?php 
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
  <?php $result = $db->prepare("SELECT* FROM templates");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $contents = $row['contents'];
  } ?>
  <form action="savereport.php" method="POST">
		<textarea id="articleContent" name="report" contenteditable="true">
			<?php echo $contents;  ?>
		</textarea>
		<script type="text/javascript">
      CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( 'articleContent' );       
         </script>
         <input type="hidden" name="radiologist" value="<?php echo $_SESSION['SESS_FIRST_NAME']; ?>">
         <input type="hidden" name="req" value="<?php echo $_GET['req']; ?>">
         <p><b>Radiologist: <?php echo $_SESSION['SESS_FIRST_NAME']; ?></b></p>
      <button class="btn btn-success" style="width: 100%;">post report</button>		
	</form>
	</div>
  <p>&nbsp;</p>

</body>
</html>