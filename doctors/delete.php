<?php
session_start();
include('../connect.php');
$id=$_GET['id'];
$code=$_GET['code'];
$search=$_GET['search'];
$sql = "DELETE FROM `prescribed_meds` WHERE `id`= $id";
$q = $db->prepare($sql);
$q->execute();
//redirect
if (isset($_GET['anticancer'];)) {
header("location:oncology.php?search=$search&response=0&code=$code");

exit();
}
header("location:prescribe_inp.php?search=$search&response=0&code=$code");
?>