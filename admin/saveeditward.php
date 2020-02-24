<?php
session_start(); 
include('../connect.php');
    $a=$_POST['name'];
    $b=$_POST['sex'];
    $c=$a."-".$b;
    $d=$_POST['id'];
    $e=$_POST['charges'];
    
       
$sql = "UPDATE wards
        SET  name=?,
             charges=?             
		WHERE name=?";
$q = $db->prepare($sql);
$q->execute(array($c,$e,$d)); 
$sql = "UPDATE beds
        SET  ward=?
             
        WHERE ward=?";
$q = $db->prepare($sql);
$q->execute(array($c,$d));
header("location: index.php?response=6");

 ?>
 