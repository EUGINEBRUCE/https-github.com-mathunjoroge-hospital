<?php
session_start();
include('../connect.php');
$a = $_POST['patient'];
$cs =($_POST['fees']);
$d = $_POST['name'];
$date = date("Y-m-d H:i;s");
foreach ($cs as $c) {
$sql = "INSERT INTO collection (fees_id, date, paid_by) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$c,':b'=>$date,':c'=>$a)); 
} 
//save data into visits table
$sql = "INSERT INTO visits (patient) VALUES (:a)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a)); 
	header("location: receipt.php?name=$d&number=$a");
?>