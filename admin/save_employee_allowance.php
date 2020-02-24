<?php
session_start(); 
include('../connect.php');
$a = $_POST['employee'];
$b = implode(',', $_POST['allowances']);

$sql = "INSERT INTO employee_allowances (employee_id,allowance_ids) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b));
header("location: add_allowances.php?employee_id=$a"); 
?>