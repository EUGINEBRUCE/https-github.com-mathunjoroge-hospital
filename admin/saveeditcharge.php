<?php
session_start(); 
include('../connect.php');
    $a=$_POST['id'];
    $b=$_POST['name'];
    $c=$_POST['amount'];
    $d=$_POST['payable'];    
       
$sql = "UPDATE fees
        SET  fees_name=?,
             amount=? ,
             payable_before=?            
		WHERE fees_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$c,$d,$a));
header("location: fees.php?response=2");

 ?>
 