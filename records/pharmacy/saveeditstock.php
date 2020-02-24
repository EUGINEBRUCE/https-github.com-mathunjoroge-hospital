<?php
session_start(); 
include('../connect.php');
//posting variables here
    $a=$_POST['a'];
    $b=$_POST['b'];
    $c=$_POST['c'];
    $d=$_POST['d'];
    $e=$_POST['e'];
    $f=$_POST['f'];
    $gg=$_POST['g'];
    $g=($gg+100)/100;
    $h=$_POST['h'];
    $j=$_POST['j'];
    $id=$_POST['k'];
$sql = "UPDATE drugs
        SET  generic_name=?,brand_name=?,category=?,quantity=?,pharm_qty=?,price=?,mark_up=?,reorder_ph=?,reorder_st=?
		WHERE drug_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d,$e,$f,$g,$h,$j,$id)); 
header("location: stocks.php") ?>