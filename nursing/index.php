<?php 
require_once('../main/auth.php');
 ?>
 <!DOCTYPE html>
<html>
<title>search patient</title>
<head>
  <?php
  include "../header.php";
  ?>
</head>
<body>
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">  
  <div class="jumbotron" style="width:auto;background: #95CAFC;">
  <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">patient</li>
    <li class="breadcrumb-item active" aria-current="page">search patient</li>
    <?php
      $search=$_GET['search'];
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        $b=$row['age'];
        $c=$row['sex'];
        $d=$row['opno'];
     
     ?>
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a;  ?> <?php
include '../doctors/age.php';
?>
<?php } ?>
</nav>  
   <body onLoad="document.getElementById('patient').focus();">
<form action="index.php?&response=0" method="GET">
  <?php
  include "../pharmacy/patient_search.php";
  ?><input class="form-control" type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span> </form>
    <p>&nbsp;</p>
    <?php
    $search=$_GET['search'];
    $nothing="";
    if ($search!=$nothing) {
       # code...
      ?><?php } ?>
      <?php 
      $search=$_GET['search'];
      $response=0;
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        $b=$row['age'];
        $c=$row['sex'];
        $d=$row['opno'];
 ?>
  <div class="container">
       
      <h3>blood presure</h3>
      <form action="savepatient.php" method="POST">        
    <div class="container">
  
          <table class="table-bordered" id="notes" >
  <thead>
    <tr>
      <th>systolic</th>
      <th>diastolic</th>
      <th>pulse rate</th>
    </tr>
  </thead>
  
  <tbody>
    <tr><td><input class="form-control" type="number"  name="sys"></td>
<td><input class="form-control" type="number"   name="dys"></td>
<td><input class="form-control" type="number"   name="rate"></td>
    </tr>
  </tbody>
</table>
</div>
<div class="container">
  <h3>physical</h3>
  
          <table class="table-bordered">
           <thead>
    <tr>
      <th>height</th>
      <th>weight</th>
      <th>temperature</th>
    </tr>
  </thead>  
  <tbody>
    <tr>
   <td>
        <input class="form-control" type="number" class="form-control" step="0.001"   placeholder="cm" name="height">
      </td>
      <td>
        <input class="form-control" type="number" step="0.001"  placeholder="kgs"   name="weight">
      </td>
      <td>
        <input class="form-control" type="number" step="0.001"  placeholder="degrees c" name="temp">
      </td>
    </tr>
  </tbody>
</table>
</div>
<div class="container">
<table class="table-bordered">
  <thead>
    <tr>
      <th>breath rate</th>
      <th>rbs</th>
      <th>MUAC</th>
    </tr>
  </thead>
  
  <tbody>
    <tr>
    <td>
        <input class="form-control" type="number" step="0.001"  placeholder="bpm" name="br">
      </td>
      <td>
        <input class="form-control" type="number" step="0.001"  placeholder="mm/L" name="rbs">
<input class="form-control" type="hidden"  placeholder="bpm" name="opno" value="<?php echo $d ?>">
      </td>
      <td><input class="form-control" type="number" step="0.001"  placeholder="mm" name="muac"></td>
    </tr>
  </tbody>
</table>
<link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-1.12.4.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#lmp" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
  <script>
  $( function() {
    $( "#edd" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
<?php
if ($c=="female") {
   # code...
  ?><div class="container">
    <p>&nbsp;</p>
  <table class="table-bordered" style="width:auto;">
    <head>
      <tr>
        <th>LMP</th>
        <th>EDD</th>
        <th>para</th>
        <th>gravid</th>
        <th>live births</th>
        <th>births alive</th>
      </tr>
    </head>
    <tbody>
      <tr>
        <td><input type="text" id="lmp" name="lmp" autocomplete="off" ></td>
        <td><input type="text" id="edd" name="edd" value="" autocomplete="off"></td>
        <td><input type="number" name="para" style="width:4em;" value=""></td>
        <td><input type="number" name="gravid" style="width:4em;" value=""></td>
        <td><input type="number" name="live_births" style="width:4em;" value=""></td>
        <td><input type="number" name="births_alive" style="width:4em;" value=""></td>
      </tr>
    </tbody>
  </table>
  </div>
<?php } ?>
<p>&nbsp;</p>
<button class="btn btn-success btn-large" style="width: 65%;">save</button></form><?php }  ?> </form>
</div>
<?php
    $respose=$_GET['response'];

    if ($respose==1) {
       
      ?>
      <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> patient data saved successifully</p></div>
        
      </div><?php } ?>
      </div></div></div></div></div>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>

</body>
</html>