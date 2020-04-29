<?php
session_start(); 
include('../connect.php');
$result = $db->prepare("SELECT * FROM icd_second_level_codes");
$result->execute();
$count = $result->rowcount()-10081;
$title =$_POST['disease'];
$code ="MOH-".($count);

$sql = "INSERT INTO icd_second_level_codes (code,title) VALUES (:a,:b)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$code,':b'=>$title));
header("location:index.php?search=%20&response=0");
?>