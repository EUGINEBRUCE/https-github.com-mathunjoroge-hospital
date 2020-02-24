<?php
session_start(); 
include('../connect.php');
    $a=$_POST['id'];
    $b=$_POST['username'];
    $x=md5($_POST['password']);
    $c=md5($x);
    $d=$_POST['name'];
    $e=$_POST['usertype'];    
$sql = "UPDATE user
        SET  username=?,
             password=?,
             name=?,
             position=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$c,$d,$e,$a)); 
header("location: index.php?response=2");

 ?>
 