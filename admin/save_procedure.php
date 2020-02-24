<?php
session_start(); 
include('../connect.php');
$a = $_POST['amount'];
$b = $_POST['name'];
$c = $_POST['payable'];
$d = 2;
$sql = "INSERT INTO fees (amount,fees_name,payable_before,is_nursing) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));
header("location: fees.php?response=1");
?>