<?php
session_start(); 
include('../connect.php');
	$pn=$_GET['pn'];
	$admitted=$_GET['admitted'];
    $reset=0;
    $disp=1;
	$dis_by="pharm-return";
	$date=date('Y-m-d H:i:s');
	$sql = "UPDATE returned_drugs
        SET  dispensed=?,
            cashed_by=?,
            updated_at=?
		WHERE patient=?";
$q = $db->prepare($sql);
$q->execute(array($disp,$dis_by,$date,$pn));
 header("location: index.php?search= &response=1"); 
 ?>