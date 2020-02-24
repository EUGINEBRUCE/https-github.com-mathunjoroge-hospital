<?php
session_start();
include('../connect.php');
$a= date("Y-m-d", strtotime($_POST['date']));
$b = $_POST['clinic'];
$c = $_POST['pn'];
$sql = "INSERT INTO bookings (date,clinic_id,patient) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));
	header("location: book.php?search= &response=1");

?>
