<?php
session_start();

include('../connect.php');
$a=$_GET['id'];
$b=$_GET['pn'];
$sql = "DELETE FROM `dispensed_reagents` WHERE `dispensed_reagents`.`dispense_id` = $a";
$q = $db->prepare($sql);
$q->execute();
// edit qty if the patient is admitted

	header("location: record.php?search=$b&response=0");

?>