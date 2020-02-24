<?php 
require_once('auth.php');
 ?>
 <?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='cashier') { 
	header("location:../accounts/index.php?search= &response=0"); 
?>
<?php } ?>
 <?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='doctor') { 
	header("location:../doctors/index.php?search= &response=0"); 
?>
<?php } ?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='pharmacist') { 
	$token=rand();
	header("location:../pharmacy/index.php?search= &response=0&token=$token"); 
?>
<?php } ?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='nurse') { 
	header("location:../nursing/index.php?search= &response=0"); 
?>
<?php } ?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='lab') { 
	header("location:../lab/index.php?search= &response=0"); 
?>
<?php } ?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='registration') { 
	header("location:../records/index.php?attempt=0"); 
?>
<?php } ?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='stores') { 
	header("location:../stores/index.php"); 
?>
<?php } ?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='admin') { 
	header("location:../admin/index.php?response=0"); 
?>
<?php } ?>