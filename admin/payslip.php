<?php 
require_once('../main/auth.php');
include ('../connect.php');
if (isset($_GET["nfdw"])) {
    $nfdw=($_GET["nfdw"]/30);
  # code...
}
else{
     $nfdw=1;
}

 ?>
 <!DOCTYPE html>
<html>
<title>payslip</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../pharmacy/ckeditor/ckeditor.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../pharmacy/dist/js/bootstrap-select.js"></script>
  <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../src/facebox.js" type="text/javascript"></script>
</head>
<body><header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>   
  </header><?php include('sidee.php'); ?>
  <div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
         <body >
<div class="container">
        <?php 
          $employee_id=$_GET['employee_id'];
        $result = $db->prepare("SELECT*  FROM employees  JOIN job_groups ON employees.jg_id=job_groups.jg_id WHERE employee_id=:a");
        $result->bindParam(':a',$employee_id);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $employee_id = $row['employee_id'];    
      $name = $row['employee_name'];
      $deployed_date=$row['date_deployed'];
      $jg = $row['jg_name'];
      $basic_salary = $row['basic_salary'];
       $status = $row['status'];
         ?>
         <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">payslip</li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $name;  ?></li>
    <li class="breadcrumb-item active" aria-current="page">job group:</b> <?php echo $jg;  ?></li>
    <li class="breadcrumb-item active" aria-current="page">deployment date:</b> <?php echo date('d-m-Y',strtotime($deployed_date));  ?></li>
    <li><?php if ($status==0) {
      echo "payslip not activated";
      # code...
    }
     if ($status==1) {
      echo "payslip  activated";
      # code...
    }
    if ($status==2) {
      echo "salary paid";
      # code...
    } ?></li>
    <li class="breadcrumb-item active" aria-current="page" style="float: right;"><a href="add_allowances.php?employee_id=<?php echo $employee_id; ?>"> add allowances</a></li>
   </ol><?php } ?>
     <table class="table" >
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php  
       $result = $db->prepare("SELECT*  FROM employees  JOIN job_groups ON employees.jg_id=job_groups.jg_id WHERE employee_id=:a");
        $result->bindParam(':a',$employee_id);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $employee_id = $row['employee_id'];    
      $name = $row['employee_name'];
      $deployed_date=$row['date_deployed'];
      $jg = $row['jg_name'];
      $basic_salary = $row['basic_salary']*$nfdw;

         ?>
<tbody>
<tr>
<td style="width: 81.5%;">basic salary</td>
<td><?php echo $basic_salary; ?></td>
<?php }?>
</tr>
<tr> 
</tbody>
</table>
  <?php
        $result = $db->prepare("SELECT*  FROM employee_allowances  WHERE employee_id=:a");
        $result->bindParam(':a',$employee_id);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $alowances = $row['allowance_ids'];    
     $employee_allowances=str_replace(","," OR all_id=",$alowances);
   }
         ?>
     <table class="table" >
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php
if (isset($alowances)) {
  # code...

        $result = $db->prepare("SELECT*  FROM alowances WHERE all_id=$employee_allowances");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $amount = $row['amount']*$nfdw;
       
     
         ?>
<tbody>
<tr>
<td style="width: 81.5%;"><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<?php } ?>
</tr>
<tr> 
</tbody>
</table>
 <?php
        $result = $db->prepare("SELECT sum(amount) AS amount FROM alowances WHERE all_id=$employee_allowances");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
      $total_allowances = $row['amount']*$nfdw; 
      
    }
  }
  if (!isset($total_allowances)) {
    # code...
    $total_allowances =0;
  }
    $gross_pay=$basic_salary+$total_allowances;
         ?>

<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php   
        $result = $db->prepare("SELECT* FROM nhif WHERE net_salary=:a ORDER BY ABS(net_salary - @input )");
        $result->bindParam(':a',$gross_pay);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $nhif = $row['deduction'];
      
         ?>
<tbody>
<tr>
<td style="width: 81.5%;">nhif</td>
<td><?php echo $nhif; ?></td>
<?php }?>

</tr>
<tr> 
</tbody>
</table>
<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php   
        $result = $db->prepare("SELECT * FROM tax WHERE amount<=:a ORDER BY tax_id DESC LIMIT 1");
        $result->bindParam(':a',$basic_salary);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $tax = $row['percentage_tax'];
      
         ?>
<tbody>
<tr>
<td style="width: 81.5%;">PAYE AUTO</td>
<td><?php $tax_total=($tax/100)*$gross_pay; echo $tax_total;  ?></td>
<?php }?>

</tr>
<tr> 
</tbody>
</table>
<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 81.5%;"><b>gross pay</b></td>
<td><b><?php echo($gross_pay); ?></b></td>
</tr>
<tr> 
</tbody>
</table>
<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 81.5%;"><b>net pay</b></td>
<td><b><?php
if (!isset($nhif)) {
   $nhif=0;
 } 
 if (!isset($tax)) {
   $tax=0;
 }
$total_deductions=$nhif+(($tax/100)*$gross_pay);
 echo($gross_pay)-$total_deductions; ?></b></td>
</tr>
<tr> 
</tbody>
</table>
<?php if ($status==1) {
  # code...
 ?>
 &nbsp;
 <form class="form-inline" method="GET" action="payslip.php">  
  <div class="form-group mx-sm-3 mb-2">
    <label for="nfdw" class="sr-only">days worked</label>
    <input type="number" class="form-control" id="nfdw" placeholder="days worked" name="nfdw" required/>
    <input type="hidden" name="employee_id" value="<?php echo $_REQUEST["employee_id"]; ?>">
  </div>
  <button type="submit" class="btn btn-primary mb-2">submit</button>
</form>
<form action="paysalary.php" method="POST">
  
  <input type="hidden" name="salary" value="<?php echo $basic_salary; ?>"></br>
  <?php
  if (isset($employee_allowances)) {
    # code...
  
 
     $result = $db->prepare("SELECT GROUP_CONCAT(amount) AS allowance_am, GROUP_CONCAT(all_id) AS all_id FROM alowances WHERE all_id=$employee_allowances");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $all_amount =$row['allowance_am'];
    $all_id =$row['all_id'];
    }
   ?>
   <div style="display: none;">
  <input type="hidden" name="all_id" value="<?php echo ($all_id); ?>"></br>
  <input type="hidden" name="alowances" value="<?php echo ($all_amount); ?>"></br>
  <?php } ?>    
  <input type="hidden" name="nhif" value="<?php echo $nhif; ?>"></br>
  <input type="hidden" name="tax" value="<?php echo $tax_total; ?>"></br>
  <input type="hidden" name="gross_pay" value="<?php echo $gross_pay; ?>"></br>
  <input type="hidden" name="nssf" value="0"></br>
  <?php
  if (isset($_GET["nfdw"])) {
    $dw=($_GET["nfdw"]);
  # code...
}
else{
     $dw=30;
} ?>
  <input type="hidden" name="employee" value="<?php echo $_REQUEST["employee_id"]; ?>">
<input type="hidden" name="dw" value="<?php echo $dw; ?>"></br></div>
  <button class="btn btn-success">post salary details</button>
</form>
<?php }  ?>
</div>
</body>
</html>