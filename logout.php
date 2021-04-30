<?php
session_start(); 
include('connect.php');
include('../signup/connect.php');
$a=0;
$last=date('Y-m-d H:i:s');
$id=$_SESSION['SESS_MEMBER_ID'];
//setting logout time
$sql = "UPDATE user
SET  logged_in=?,
     last_seen=?
WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$last,$id));
//setting that the registered user has logged out
$email=$_SESSION['email'];
$sql = "UPDATE users
SET  logged_in=?
WHERE email=?";
$q = $conn->prepare($sql);
$q->execute(array($a,$email));
header("location: ../signup/");
?>