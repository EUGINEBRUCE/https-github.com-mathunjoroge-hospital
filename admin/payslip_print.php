<?php 
require_once('../main/auth.php');
include ('../connect.php');
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
<div class="container" id="content">
  <div class="container" align="center">
  <?php
   $result = $db->prepare("SELECT * FROM settings");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $hospital=$row['name'];
        $address=$row['address'];
        $phone=$row['phone'];
        $email=$row['email'];
        $slogan=$row['slogan']; ?>
    <h6 ><?php echo $hospital; ?></h6>
    <h6 ><?php echo $address; ?></h6>
    <h6 ><?php echo $phone; ?></h6>
    <h6 ><?php echo $email; ?></h6>
  <?php } ?>
  </div>
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
   </ol><?php } ?>
     <table class="table" >
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php  $b=date('Y-m-d');
       $result = $db->prepare("SELECT*  FROM salaries_payments WHERE employee_id=:a AND date(date)=:b");
        $result->bindParam(':a',$employee_id);
        $result->bindParam(':b',$b);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $basic_salary = $row['amount'];
      $gross_pay = $row['gross_pay'];
      $nfdw = $row['dw']/30;

         ?>
<tbody>
<tr>
<td style="width: 81.5%;">gross pay</td>
<td><?php echo $gross_pay; ?></td>
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
          <?php
   $b=date("Y-m-d");   
            $result = $db->prepare("SELECT sum(amount) AS total  FROM other_allowances WHERE employee_id=:a AND date(date)=:b");
   $result->bindParam(':a',$_GET['employee_id']);
   $result->bindParam(':b',$b);
   $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
      $other_allowances = $row['total'];
    
      if (isset($other_allowances)) {      
  ?>
  <table class="table" >
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr><?php
  $result = $db->prepare("SELECT*  FROM other_allowances WHERE employee_id=:a AND date(date)=:b");
   $result->bindParam(':a',$_GET['employee_id']);
   $result->bindParam(':b',$b);
   $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $name = $row['name'];
      $amount = $row['amount']; 
      ?>
<td style="width: 81.5%;"><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
</tr> 
<?php } ?>
</tbody>
</table>
<?php }  ?>

<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php   
        $result = $db->prepare("SELECT* FROM nhif WHERE net_salary<=$gross_pay ORDER BY id DESC LIMIT 1");
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $nhif =$row['deduction'];

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
    $result = $db->prepare("SELECT* FROM tax_paid WHERE employee_id=:a AND date(date)=:b");
   $result->bindParam(':a',$_GET['employee_id']);
   $result->bindParam(':b',$b);
   $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $tax_total = $row['amount'];
      
         ?>
<tbody>
<tr>
<td style="width: 81.5%;">PAYE AUTO</td>
<td><?php  echo $tax_total;  ?></td>
<?php }?>

</tr>
<tr> 
</tbody>
</table>
<?php
if ($tax_total>=1229.8) {
  $tax_relief=1408;
}
else{
  $tax_relief=0;
}
?>
<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 81.5%;"><b>tax relief</b></td>
<td><b><?php echo($tax_relief); ?></b></td>
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
<td style="width: 81.5%;"><b>nett pay</b></td>
<td><b><?php echo($basic_salary); ?></b></td>
</tr>
<tr> 
</tbody>
</table>

</div>
<div><button value="content" id="goback" onclick="javascript:printDiv('content')">print payslip</button></div>
<script type="text/javascript">
   function printDiv(content) {
            //Get the HTML of div
            var divElements = document.getElementById(content).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;          
        }


</script>
</div>
<?php } ?>
</body>
</html>