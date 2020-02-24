<?php
session_start(); 
include('../connect.php');
    $a=$_POST['qty'];
    $id=$_POST['id'];
    $b=$_POST['pn'];
    $c=$_POST['did'];
    $d=$_POST['orr'];
    $e=$_POST['admitted'];
    $token=$_POST['token'];
    $diff=$d-$a;
$sql = "UPDATE dispensed_drugs
        SET  quantity=?
		WHERE dispense_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$id));
// if patient is admitted update qty 
if ($e==1) {
	$sql = "UPDATE drugs
        SET  pharm_qty=pharm_qty+?
		WHERE drug_id=?";
$q = $db->prepare($sql);
$q->execute(array($diff,$c));
} 
header("location: index.php?search=$b&response=0&token=$token") ?>