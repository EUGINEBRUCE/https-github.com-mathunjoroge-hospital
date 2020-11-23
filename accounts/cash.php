<?php 
require_once('../main/auth.php');
include('../connect.php');
$d1=date('Y-m-d')." 00:00:00";
$d2=date('Y-m-d H:i:s');
 ?> 
 <!DOCTYPE html>
<html>
<title>total cash</title>
<?php 
  include "../header.php"; 
  ?>
</head>
  <script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); 
    ?>
   
  </header>
<?php 

include('side.php'); ?>
  <div class="content-wrapper">  
<div class="jumbotron" style="background: #95CAFC;">         
<form action="cash.php" method="GET">
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
<p>&nbsp;</p>
<?php
       $date1=$_GET['d1']; 
       $date2=$_GET['d2'];
       $cashier=$_SESSION['SESS_FIRST_NAME'];
       //get sum amount from pharmacy for the user     
        $result = $db->prepare("SELECT sum(amount) AS pharmacy_cash FROM cash WHERE (date >=:a AND date <=:b)");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $pharmacy_cash = $row['pharmacy_cash'];
    }
     //get sum amount from lab for the user     
        $result = $db->prepare("SELECT sum(amount) AS lab_cash FROM lab_cash WHERE (date >=:a AND date <=:b)");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $lab_cash = $row['lab_cash'];  
    }
    //get sum amount from fees for the user     
        $result = $db->prepare("SELECT sum(amount) AS totalfees FROM fees_total WHERE (date >=:a AND date <=:b)");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $fees_cash = $row['totalfees'];    }
    //get sum amount from pharmacy for the user     
        $result = $db->prepare("SELECT sum(amount) AS clinicfees FROM clinics_total WHERE (date >=:a AND date <=:b)");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $clinicfees = $row['clinicfees'];
 ?>
</hr><div class="container" id="print">
      <center><b>cash report from <?php echo $cashier; ?></b></center>
     <p></p>
     <center><b>period: <?php echo $date1; ?> to <?php echo $date2; ?> </b></center>
     <p></p>
     <p></p>
     <div class="container" id="print">
<table class="table" style="width: 50%;" align="center" >
<thead>
<tr>
<th>total cash from pharmacy</th>
<th style="text-align: right;"><?php echo $pharmacy_cash; ?></th>
<thead>
         </tr>
</thead>
<tbody>
</tbody>
</table>
<?php
//end of pharmacy table
 } ?>

<table class="table" style="width: 50%;" align="center" >
<thead>
<tr>
<th>total cash from lab</th>
<th style="text-align: right;"><?php echo $lab_cash; ?></th>
<thead>
         </tr>
</thead>
<tbody>
</tbody>
</table>
<table class="table" style="width: 50%;" align="center" >
<thead>
<tr>
<th>total cash from fees</th>
<th style="text-align: right;"><?php echo $fees_cash; ?></th>
<thead>
         </tr>
</thead>
<tbody>
</tbody>
</table>
<table class="table" style="width: 50%;" align="center" >
<thead>
<tr>
<th>total cash from clinics</th>

<th style="text-align: right;"><?php echo $clinicfees; ?></th>
<thead>
         </tr>
</thead>
<tbody>
</tbody>
</table>
<table class="table" style="width: 50%;" align="center" >
<thead>
<tr>
<th>total cash collected</th>

<th style="text-align: right;"><?php echo $clinicfees+$fees_cash+$lab_cash+$pharmacy_cash; ?></th>
<thead>
         </tr>
</thead>
<tbody>
</tbody>
</table>
<hr align="center" style="width: 70%;">
<h4 align="center">summary</h4>
<table class="table" align="center">
  <head>
    <tr>
    <th>payment method</th>
    <th>amount</th>
    </tr>
  </head>
  <tbody>
    <?php    
    $result = $db->prepare("SELECT sum(total) AS amount, type AS name FROM receipts WHERE (date >=:a AND date <=:b) GROUP BY type");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);      
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $amount = $row['amount'];
      $name = $row['name'];
 ?>
  <tr> 
  <td><?php
  if ($name==1) {
     $payment_method="cash";
   } 
   if ($name==2) {
     $payment_method="Mpesa";
   } 
   if ($name==3) {
     $payment_method="insurance";
   } 
   if ($name==4) {
     $payment_method="bank";
   } 
   echo $payment_method; ?></td>
  <td><?php echo $amount; ?></td>   
  </tr>
<?php } ?>
  </tbody>  
</table>
</div>
</div>
<button class="btn btn-success btn-large" style="width: 46%;margin-left: 27%;" id="print" align="center" onclick="printContent('print');">print report</button>
</body>
</html>