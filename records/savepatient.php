<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$b = $_POST['contact'];
$c= date("Y-m-d", strtotime($_POST['age']));
$d = $_POST['nok'];
$e= $_POST['sex']; 
$f = $_POST['nokc']; 
$g= $_POST['address'];   
$h = $_POST['number'];
$dept = $_POST['dept'];
$sql = "INSERT INTO patients (name,contact,age,next_of_kin,sex,nokcontact,address,opno) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h)); 
//record to visits table
$sql = "INSERT INTO visits (patient) VALUES (:h)";
$q = $db->prepare($sql);
$q->execute(array(':h'=>$h)); 
?>
<?php
$fees = $_POST['fees'];
$j = $_POST['number'];
$doctor =$_SESSION['SESS_FIRST_NAME'];
$date=date('Y-m-d');
foreach ($fees as $fee) {

	$sql = "INSERT INTO collection (fees_id,date,paid_by) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$fee,':b'=>$date,':c'=>$j)); 
	 
      ?>
<?php
if ($dept==2) {
	header("location: admit.php?search==$h&response=0");
}

else{
	header("location: receipt.php?name=$a&number=$h");
?>
<?php } } ?>