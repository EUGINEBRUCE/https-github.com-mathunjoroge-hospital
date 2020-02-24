<?php
session_start();
include('../connect.php');
$a = $_POST['name'];  
$h = $_POST['number'];
$dept = $_POST['dept'];
$sql = "INSERT INTO patients (name,opno) VALUES (:a,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':h'=>$h));

header("location: receipt.php?name=$a&number=$h");
?>