<?php 
include('../connect.php');
$a=$_POST['jb'];
$b=$_POST['amount'];
$sql = "INSERT INTO `job_groups` (`jg_name`,`basic_salary`) VALUES ('$a','$b')";
$q = $db->prepare($sql);
$q->execute();
	# code...
header("location: payroll.php?");
?>