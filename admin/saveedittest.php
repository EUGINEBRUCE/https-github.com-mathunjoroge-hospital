<?php
session_start(); 
include('../connect.php');
    $a=$_POST['id'];
    $b=$_POST['name'];
    $c=$_POST['amount'];
    $d=$_POST['payable'];     
       
$sql = "UPDATE lab_tests
        SET  name=?,
             cost=?,
             payable_before=?              
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$c,$d,$a));
header("location: fees.php?response=2");

 ?>
 