<?php
session_start();
include('../connect.php');
$a = $_POST['username'];
$x = md5($_POST['password']);
$b=md5($x);
$c= $_POST['other'];
$d = $_POST['usertype'];

$sql = "INSERT INTO user (username,password,name,position) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));
header("location: index.php?response=1"); 
?>

