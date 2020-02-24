<?php 
include('../connect.php');
$a=$_POST['employee_name'];
$b=$_POST['id_number'];
$c = $_POST['jg']; 
$d=$_POST['nhif'];
$e = $_POST['nssf'];   
$f=$_POST['bank'];
$g= $_POST['acc']; 
$sql = "INSERT INTO `employees` (`employee_name`,`id_no`,`jg_id`,`nssf`,`nhif`,`bank`,`account_number`) VALUES ('$a','$b','$c','$e','$d','$f','$g')";
$q = $db->prepare($sql);
$q->execute();
	# code...
header("location: payroll.php?");
?>