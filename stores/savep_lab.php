<?php
session_start(); 
include('../connect.php');
$a = $_POST['amount'];
$b = $_POST['invoice'];
$c = $_POST['invoice_no'];

$sql = "INSERT INTO lab_purchases_total (amount,inv,invoice_number) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));

header("location: print_lab.php?req=$b&invoice=$c");
?>