<?php
session_start();

include('../connect.php');
$a=$_GET['id'];
$b=$_GET['pn'];
$c=$_GET['admitted'];
$d=$_GET['did'];
$e=$_GET['qty'];
$token=$_GET['token'];
$sql = "DELETE FROM `dispensed_drugs` WHERE `dispensed_drugs`.`dispense_id` = $a";
$q = $db->prepare($sql);
$q->execute();
// edit qty if the patient is admitted
if ($c==1) {
	$sql = "UPDATE drugs
        SET  pharm_qty=pharm_qty+?
		WHERE drug_id=?";
$q = $db->prepare($sql);
$q->execute(array($e,$d));
} 
	header("location: index.php?search=$b&response=0&token=$token");

?>