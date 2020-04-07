<?php
session_start();
include('../connect.php');
$a = $_POST['name'];  
$h = $_POST['number'];
$dept = $_POST['dept'];
$age = $_POST['age'];
$sql = "INSERT INTO patients (name,opno,age) VALUES (:a,:h,:j)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':h'=>$h ,':j'=>$age));

//save data into visits table
$sql = "INSERT INTO visits (patient) VALUES (:h)";
$q = $db->prepare($sql);
$q->execute(array(':h'=>$h));

header("location: receipt.php?name=$a&number=$h");
?>