<?php
session_start();
include('../connect.php');
$id=$_REQUEST['id'];
$code=$_REQUEST['code'];
$search=$_REQUEST['search'];
$sql = "DELETE FROM `prescribed_meds` WHERE `id`= $id";
$q = $db->prepare($sql);
$q->execute();
header("location:newprescription.php?search=$search&response=0&code=$code");

?>