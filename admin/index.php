<?php 
require_once('../main/auth.php');
include('../connect.php');
$result = $db->prepare("SELECT * FROM user WHERE logged_in=1");
$result->execute();
$rowcount = $result->rowcount();
//get total users
$result = $db->prepare("SELECT * FROM user");
$result->execute();
$users = $result->rowcount();
//get users offline
$result = $db->prepare("SELECT * FROM user WHERE logged_in=0");
$result->execute();
$offline = $result->rowcount();
//get the total number of beds
$result = $db->prepare("SELECT * FROM beds");
$result->execute();
$beds_total = $result->rowcount();
//get the total beds ocupied
$result = $db->prepare("SELECT * FROM beds WHERE ocuppied=1");
$result->execute();
$occupied = $result->rowcount();
//get the total wards
$result = $db->prepare("SELECT * FROM wards");
$result->execute();
$wards = $result->rowcount();

?>
<!doctype html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>admin dashboard</title>
<?php 
require_once('../main/auth.php');
include('../connect.php');

$result = $db->prepare("SELECT * FROM user WHERE logged_in=1");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           
         }
        
        ?>
 <!doctype html>
 <html class="no-js" lang=""> <!--<![endif]-->
<head>
  <?php 
require_once('../main/auth.php');
include ('../connect.php');
$shownav=0; ?>
<!DOCTYPE html>
<html>
<title>users</title>
<?php
include "../header.php";
?>

</head>
<body >

<header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>   
</header><?php include('sidee.php'); ?>
<div class="content-wrapper"> <div class="jumbotron" style="height:100%;background: white;text-align:center;background-image: url(../main/bgg.jpeg);background-repeat:no-repeat;background-size: cover;">

<div class="row">
<div class="col-sm-4">
<div class="card alert alert alert-warning" role="alert" style="width: 37rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="loggedin.php?response=0" >
<h5 class="card-title" >users logged in</h5>    
<p class="card-text " ><?php  echo $rowcount; ?></p></a>
</div>
</div>
</div>

<div class="col-sm-4">
<div class="card  alert alert-success" role="alert" style="width: 37rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="total.php?response=0"><h5 class="card-title" >total users</h5>
<p class="card-text" ><?php echo $users; ?></p>
</a>
</div>
</div>
</div>

<div class="col-sm-4">
<div class="card alert alert-danger" style="width: 37rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="offline.php?response=0"><h5 class="card-title">users offline</h5>
<p class="card-text"><?php echo $offline; ?></p>
</a>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-4">
<div class="card alert alert-danger" style="width: 37rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="wards_total.php?response=0">
<h5 class="card-title">total number of wards</h5>
<p class="card-text"><?php echo $wards; ?></p>
</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="card alert alert-info" style="width: 37rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="beds.php?response=0"><h5 class="card-title">total number of beds</h5>
<p class="card-text"><?php echo $beds_total; ?></p>
</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="card alert alert-warning" style="width: 37rem;">
<img class="card-img-top" >
<div class="card-body">
<h5 class="card-title">beds occupied</h5>
<p class="card-text"><?php echo $occupied; ?></p>
</a>
</div>
</div>
</div>
</div>
</div>

</body>
</html>