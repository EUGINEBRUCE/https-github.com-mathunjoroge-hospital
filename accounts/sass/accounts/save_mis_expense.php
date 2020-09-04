<?php
include('../connect.php');
session_start(); 
$a = $_POST['name'];
$b = $_POST['amount'];
$c =$_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO miscellaneous (description,amount) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b));
header("location:expenses.php?response=1");
?>