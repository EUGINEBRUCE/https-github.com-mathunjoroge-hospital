<?php
session_start(); 
include('../connect.php');
$a=$_GET['code'];
$b=1;
$token=rand();
$sql = "UPDATE prescribed_meds
        SET  dispensed=?
		WHERE patient=?";
$q = $db->prepare($sql);
$q->execute(array($b,$a));
//set payment to a later date if patient admtted

 header("location: index.php?token=$token&search= &response=0"); 
 ?>