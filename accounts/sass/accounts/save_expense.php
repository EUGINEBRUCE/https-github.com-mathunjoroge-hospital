<?php
include('../connect.php');
session_start(); 
$a = $_POST['expense'];
$b = $_POST['amount'];
$c =$_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO overheads (expense_id,amount,paid_by) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
header("location:expenses.php?response=1");
?>