<?php 
require_once('../main/auth.php');
include ('../connect.php');
$shownav=0; ?>
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
<!DOCTYPE html>
<html>
<title>fees</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
<link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
<link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
<link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
<link href="../pharmacy/demo.css" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../pharmacy/dist/js/bootstrap-select.js"></script>
<link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('a[rel*=facebox]').facebox({
loadingImage : '../src/loading.gif',
closeImage   : '../src/closelabel.png'
})
})
</script>

<style type="text/css">
table.resultstable {
border: 1px solid #1C6EA4;
background-color: #EEEEEE;
width: 100%;
text-align: left;
border-collapse: collapse;
}
table.resultstable td, table.resultstable th {
border: 1px solid #AAAAAA;
padding: 3px 2px;
}
table.resultstable tbody td {
font-size: 13px;
}
table.resultstable tr:nth-child(even) {
background: #D0E4F5;
}
table.resultstable thead {
background: #1C6EA4;
background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
border-bottom: 2px solid #444444;
}
table.resultstable thead th {
font-size: 15px;
font-weight: bold;
color: #FFFFFF;
border-left: 2px solid #D0E4F5;
}
table.resultstable thead th:first-child {
border-left: none;
}

table.resultstable tfoot td {
font-size: 14px;
}
table.resultstable tfoot .links {
text-align: right;
}
table.resultstable tfoot .links a{
display: inline-block;
background: #1C6EA4;
color: #FFFFFF;
padding: 2px 8px;
border-radius: 5px;
}
</style>
</head>
<body><header class="header clearfix">

<?php include('../main/nav.php'); ?>   
</header><?php include('side.php'); ?>
<div class="content-wrapper"> 
<div class="jumbotron" >
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
<div class="container">
<div class="row">
<div class="col-sm-4">
<div class="card alert alert-success" style="width: 20rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="loggedin.php?response=0" >
<h5 class="card-title">users logged in</h5>    
<p class="card-text "><?php  echo $rowcount; ?></a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="card alert alert alert-primary" style="width: 20rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="total.php?response=0"><h5 class="card-title">total users</h5>
<p class="card-text"><?php echo $users; ?></p>
</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="card alert alert-danger" style="width: 20rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="offline.php?response=0"><h5 class="card-title">users offline</h5>
<p class="card-text"><?php echo $offline; ?></p>
</a>
</div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-sm-4">
<div class="card alert alert-info" style="width: 20rem;">
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
<div class="card alert alert-dark" style="width: 20rem;">
<img class="card-img-top" >
<div class="card-body">
<a href="beds.php?response=0"><h5 class="card-title">total number of beds</h5>
<p class="card-text"><?php echo $beds_total; ?></p>
</a>
</div>
</div>
</div>
<div class="col-sm-4">
<div class="card alert alert-warning" style="width: 20rem;">
<img class="card-img-top" >
<div class="card-body">
<h5 class="card-title">beds occupied</h5>
<p class="card-text"><?php echo $occupied; ?></p>
</a>
</div>
</div>
</div>


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
</div>
</div>
</div>
</div>
</div>

</body>
</html>