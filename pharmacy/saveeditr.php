<?php
session_start(); 
include('../connect.php');
    $a=$_POST['qty'];
    $b=$_POST['orr'];
    $diff=$b-$a;
    $id=$_POST['id'];
    $pn=$_POST['pn'];
    $did=$_POST['drug'];
$sql = "UPDATE returned_drugs
        SET  quantity=?
		WHERE dispense_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$id));
// update pharmacy qty
$sql = "UPDATE drugs
        SET  pharm_qty=pharm_qty-?
		WHERE drug_id=?";
$q = $db->prepare($sql);
$q->execute(array($diff,$did)); 
header("location: return.php?search=$pn&response=0") ?>