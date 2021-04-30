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
<?php 
$result = $db->prepare("SELECT * FROM settings");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				    $hospname =$row['name'];
				    
				
				if (isset($hospname)) { 
?>
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
<?php }
}
if (!isset($hospname)) {
									
								
 ?>
 <div class="container" align="center">
     <label>please enter hospital details to complete the setup</label>
     <form action="save_hospital_details.php" method="POST"> 
     <div class="form-group">
          <label for="hospital">hospital name</label>
    <input type="text" name="name" class="form-control"  placeholder="hospital name" style="width:50%;" required>
    <label for="hospital">address</label>
    <input type="text" name="address"  class="form-control"  placeholder="address" style="width:50%;" required>
    <label for="phone">phone</label>
    <input type="text" class="form-control" name="phone"   placeholder="phone number" style="width:50%;" required>
    <label for="slogan">slogan</label>
    <input type="text" name="slogan" class="form-control"  placeholder="slogan" style="width:50%;" required>
    <label for="email">email</label>
    <input type="email" class="form-control" name="email"   placeholder="email" style="width:50%;" required>
    <label for="hospital">prescribe from</label>
    <select class="form-control" name="p_from" style="width:50%;" required><option value="1">FDA DrugsList</option>
<option value="0">my drugs list</option></select>
</div>
  <div class="form-group">
      <button class="btn btn-success" style="width:50%;">save</button>
      </div>
     </form>
 </div>
 <?php
}
?>

</div>

</body>
</html>