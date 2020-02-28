<?php
session_start(); 
include('../connect.php');
$a = $_POST['allowance'];
$b = $_POST['amount'];
$c = $_POST['employee_id'];
$sql = "INSERT INTO other_allowances (name,amount,employee_id) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location: payslip.php?employee_id=$c");
?>