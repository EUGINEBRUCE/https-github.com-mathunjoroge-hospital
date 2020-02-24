<?php
session_start(); 
include('../connect.php');

?>

 <?php
$c = rand();
$a = $_POST['pn'];
$b = $_POST['notes']; 
$d =$_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO discharge_summary (patient,doctor_notes,doctor) VALUES (:a,:b,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':d'=>$d));
header("location: discharge_meds.php?search=$a&response=0&code=$c");

?>