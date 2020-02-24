<?php
include('../connect.php');
session_start(); 
$a=$_POST['ip_no'];
$b = $_POST['operation'];
$c = $_POST['type'];
$d = $_POST['speciality'];
$e  =$_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO surgeries (patient,operation,type,speciality,prep_by) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e));
header("location:theatre.php?response=1");
?>