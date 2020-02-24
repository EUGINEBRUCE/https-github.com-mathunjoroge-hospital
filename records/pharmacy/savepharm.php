<?php
session_start(); 
include('../connect.php');
	$pn=$_GET['pn'];
	$admitted=$_GET['admitted'];
    $reset=0;
$sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$pn));
//set payment to a later date if patient admtted
if ($admitted==1) {
	$disp=1;
	$dis_by="pharm-ward";
	$date=date('Y-m-d H:i:s');
	$sql = "UPDATE dispensed_drugs
        SET  dispensed=?,
            cashed_by=?,
            updated_at=?
		WHERE patient=?";
$q = $db->prepare($sql);
$q->execute(array($disp,$dis_by,$date,$pn));
 	
 } 
 header("location: index.php?search= &response=1"); 
 ?>