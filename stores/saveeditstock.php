<?php
session_start(); 
include('../connect.php');
    $a=$_POST['qty'];
    $id=$_POST['id'];
    $pn=$_POST['pn'];
$sql = "UPDATE drugs
        SET  quantity=?
		WHERE drug_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$id)); 
header("location: stocks.php") ?>