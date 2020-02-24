<?php 
include('../connect.php');
$a=$_POST['allowance_name'];
$b=$_POST['amount'];
$sql = "INSERT INTO `alowances` (`name`,`amount`) VALUES ('$a','$b')";
$q = $db->prepare($sql);
$q->execute();
	# code...
header("location: payroll.php?");
?>