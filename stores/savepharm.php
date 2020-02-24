<?php
session_start(); 
include('../connect.php');
	$pn=$_GET['pn'];
    $reset=6;
$sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$pn)); 
 header("location: index.php?search= &response=1"); 
 ?>