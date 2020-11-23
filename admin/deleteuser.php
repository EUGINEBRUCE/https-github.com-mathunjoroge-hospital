<?php
session_start();

include('../connect.php');
$a=$_GET['id'];
$sql = "DELETE FROM `user` WHERE `user`.`id` = $a";
$q = $db->prepare($sql);
$q->execute();
	header("location: total.php?response=3");

?>