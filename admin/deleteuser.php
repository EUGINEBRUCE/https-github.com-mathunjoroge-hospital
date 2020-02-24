<?php
session_start();

include('../connect.php');
$a=$_POST['user'];
$sql = "DELETE FROM `user` WHERE `user`.`id` = $a";
$q = $db->prepare($sql);
$q->execute();
	header("location: index.php?response=3");

?>