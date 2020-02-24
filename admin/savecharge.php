<?php
session_start(); 
include('../connect.php');
$a = $_POST['amount'];
$b = $_POST['name'];
$c = $_POST['payable'];
$sql = "INSERT INTO fees (amount,fees_name,payable_before) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location: fees.php?response=1");
?>