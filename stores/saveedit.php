<?php
session_start(); 
include('../connect.php');
    $a=$_POST['qty'];
    $id=$_POST['id'];
    $pn=$_POST['pn'];
$sql = "UPDATE dispensed_drugs
        SET  quantity=?
		WHERE dispense_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$id)); 
header("location: index.php?search=$pn&response=0") ?>