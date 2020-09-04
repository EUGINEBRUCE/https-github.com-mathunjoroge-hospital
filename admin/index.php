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
<link rel="shortcut icon" href="../favicon.ico">
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
<div style="z-index: 1;position:relative;">
<?php 
include('../main/admin_nav.php'); ?>   

</div>
</div>

<?php include('side.php'); ?>
<div class="container">
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
</div></div>
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
</div>
<?php } ?>
<div><p>&nbsp;</p></div>
<div class="container">
<?php
if ($position=="admin") {
# code...

?>
<div class="container" align="right" id="view" >
<p>
&nbsp;
<form action="../redirect.php" method="POST">
            <label id="nav_lable"> <?php echo
            $_SESSION['view_as']=$_SESSION['SESS_LAST_NAME'];
             $_SESSION["view_as"]; ?>'s view, change to: </label></br>
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
                <option value="admin">admin</option>                        
            </select>
            <button id="submitbtn" style="display: none;">submit</button>
        </form></p></div>
    <?php } ?>

<div class="row">
<div class="col-sm">
<div class="card alert alert-success" style="width: 20rem;">
<img class="card-img-top" >
<div class="card-body">

<a href="loggedin.php?response=0" >
<h5 class="card-title">users logged in</h5>    
<p class="card-text "><?php  echo $rowcount; ?></p></a>
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
</div>
</div>
</div>
</a>
<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>