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
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>admin dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="apple-touch-icon" href="apple-icon.png">
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="assets/css/normalize.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/flag-icon.min.css">
<link rel="stylesheet" href="assets/css/cs-skin-elastic.css">    
<!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
<link rel="stylesheet" href="assets/scss/style.css">
<link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
</head>
<body>
<?php include("side.php"); ?>

<div id="right-panel" class="right-panel">
<header id="header" class="header">

<div class="header-menu">

<div class="col-sm-5">
<a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
<!-- notifications will go here -->
<div  style="float: right;margin-right: -130%;">
<form action="../redirect.php" method="POST">
<label>view as</label>
<script type="text/javascript">
function getval(sel)
{
document.getElementById("submitbtn").click();
}
</script>
<select name="position" title="please select user" onchange="getval(this);" required/>
<option></option>
<option value="registration">records</option>
<option value="cashier">cashier</option>
<option value="nurse">nurse</option>
<option value="doctor">doctor</option>
<option value="pharmacist">pharmacist</option>
<option value="stores">store</option>
<option value="lab">lab</option>                        
</select>
<button id="submitbtn" style="display: none;">submit</button>
</form>

<p>
<?php echo $_SESSION['SESS_FIRST_NAME']; ?>

<a  href="../logout.php"> <i class="fa fa-power-off" style="color: red;"></i>&nbsp;Logout</a></p>                        
</div>   

</header><!-- /header -->
<!-- Header-->


<div class="breadcrumbs">
<div class="col-sm-4">
<div class="page-header float-left">

</div>
</div>
<div class="col-sm-8">
<div class="page-header float-right">
<div class="page-title">

</div>
</div>
</div>
</div>
<?php
if ($_GET['response']==0) {


?>
<?php } ?>
<?php
if ($_GET['response']==1) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-success alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-success">Success</span> user registered
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==2) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-success alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-success">Success</span> user details updated!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==3) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-danger alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-danger">deleted</span> user deleted!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==4) {
?>

<div class="content mt-3">
<div class="col-sm-12">
<div class="alert  alert-success alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-success">created</span> user ward has been creted successifully!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==5) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-danger alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-danger">exists</span> that ward already exists. use a different name!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>

<?php
if ($_GET['response']==6) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-success alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-primary">edited</span>ward edited success!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==8) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-warning alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-warning">exists</span>a fee with that name exists. use a different name!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==9) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-sucess alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-success">created</span>fee creation success!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==10) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-warning alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-warning">exists</span>a clinic with that name exists. use a different name!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==11) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-sucess alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-success">created</span>clinic creation success!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==12) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-warning alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-warning">exists</span>a imaging method with that name exists. use a different name!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==13) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-sucess alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-success">created</span>imaging method creation success!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==14) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-warning alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-warning">exists</span>a test with that name exists. use a different name!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<?php
if ($_GET['response']==15) {


?>

<div class="content mt-3">

<div class="col-sm-12">
<div class="alert  alert-sucess alert-dismissible fade show" role="alert">

<span class="badge badge-pill badge-success">created</span>test creation success!
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
</div>
<?php } ?>
<a href="loggedin.php?response=0"> <div class="col-sm-6 col-lg-4">
<div class="card text-white bg-flat-color-5">
<div class="card-body pb-success">


<p class="text-light">users logged in</p>
<h4>
<span class="count"><?php echo $rowcount; ?></span>
</h4>

<div class="chart-wrapper px-0" style="height:1.875em;" height="30">
</div>

</div>

</div>
</div></a>
<!--/.col-->

<a href="total.php?response=0"><div class="col-sm-6 col-lg-4">
<div class="card text-white bg-flat-color-1">
<div class="card-body pb-primary">
<div class="dropdown float-right">

<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="dropdown-menu-content">

</div>
</div>
</div>
<h4 class="mb-0">
<p class="text-light">total users</p>
<span class="count"><?php echo $users; ?></span>
</h4>


<div class="chart-wrapper px-0" style="height:1.875em;" height="30">
<canvas id="widgetChart2"></canvas>
</div>

</div>
</div>
</div></a>
<!--/.col-->
<a href="offline.php?response=0">
<div class="col-sm-6 col-lg-4">
<div class="card text-white bg-flat-color-4">
<div class="card-body pb-success">
<div class="dropdown float-right">
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="dropdown-menu-content">
</div>
</div>
</div>
<h4 class="mb-0">
<span class="count"><?php echo $offline; ?></span>
</h4>
<p class="text-light">
users offline</p>
</div>
<div class="chart-wrapper px-0" style="height:1.875em;" height="30">
<canvas id="widgetChart3"></canvas>
</div>
</div>
</div></a>
<!--/.col-->
<a href="wards_total.php?response=0">
<div class="col-sm-6 col-lg-4">
<div class="card text-white bg-flat-color-5">
<div class="card-body pb-success">
<p class="text-light">total number of wards</p>
<h4>
<span class="count"><?php echo $wards; ?></span>
</h4>
<div class="chart-wrapper px-0" style="height:1.875em;" height="30">
</div>
</div>
</div>
</div>
</a>
<!--/.col-->
<a href="beds.php?response=0">
<div class="col-sm-6 col-lg-4">
<div class="card text-white bg-flat-color-2">
<div class="card-body pb-primary">
<div class="dropdown float-right">
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="dropdown-menu-content">
</div>
</div>
</div>
<h4 class="mb-0">
<p class="text-light">total beds</p>
<span class="count"><?php echo $beds_total; ?></span>
</h4>
<div class="chart-wrapper px-0" style="height:1.875em;" height="30">
<canvas id="widgetChart2"></canvas>
</div>

</div>
</div>
</div></a>
<!--/.col-->
<a href="#">

<div class="col-sm-6 col-lg-4">
<div class="card text-white bg-flat-color-5">
<div class="card-body pb-success">
<div class="dropdown float-right">
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<div class="dropdown-menu-content">
</div>
</div>
</div>
<h4 class="mb-0">
<span class="count"><?php echo $occupied; ?></span>
</h4>
<p class="text-light">
beds occupied</p>

</div>

<div class="chart-wrapper px-0" style="height:1.875em;" height="30">
<canvas id="widgetChart3"></canvas>
</div>
</div>
</div>
</a>
<!--/.col-->
<!-- Right Panel -->

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>


<script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/widgets.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
<script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
<script>
( function ( $ ) {
"use strict";

jQuery( '#vmap' ).vectorMap( {
map: 'world_en',
backgroundColor: null,
color: '#ffffff',
hoverOpacity: 0.7,
selectedColor: '#1de9b6',
enableZoom: true,
showTooltip: true,
values: sample_data,
scaleColors: [ '#1de9b6', '#03a9f5' ],
normalizeFunction: 'polynomial'
} );
} )( jQuery );
</script>

</body>
</html>
