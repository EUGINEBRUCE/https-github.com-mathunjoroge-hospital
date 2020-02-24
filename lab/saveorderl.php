<?php
session_start(); 
include('../connect.php');
$a = $_POST['pn'];
$b = $_POST['med'];
$c = $_POST['qty'];
$d = $_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO lab_orders (patient,drug_id,quantity,posted_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));

    header("location: orders.php?req=$a&response=0"); 
?>

    