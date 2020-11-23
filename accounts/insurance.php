<?php 
require_once('../main/auth.php');
include('../connect.php');
 ?> 
 <!DOCTYPE html>
<html>
<title>insurance reports</title>
<?php
include "../header.php";
?>
</head>
  <body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header>
  <?php include('side.php'); ?>
  <div class="content-wrapper"> 
  <script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>
<script>
  $( function() {
    $( "#mydate" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

  </script>
  <script>
  $( function() {
    $( "#mydat" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>  
      <div class="jumbotron" style="background: #95CAFC;">
        <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">insurance companies reports</li>
    <li class="breadcrumb-item active" aria-current="page" style="float: right;"><a href="ins_pay.php"> insurance payments</a></li>
   </ol>
      <div class="container" align="center">         
<form action="insurance.php" method="GET">
  <select  name="insurance" class="selectpicker" data-live-search="true" title="select company..." style="width: 268px; height:30px;" required="required"  >
  <option value="" disabled="">-- Select company--</option><?php 
$result = $db->prepare("SELECT * FROM insurance_companies  ");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['company_id'].">".$row['name']."</option>";
         }
        
        ?>
      </select>
  from: <input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick start date" required="true"/> to: <input type="text" id="mydat"  name="d2" autocomplete="off" placeholder="pick end date" required="true"/>
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      </div> 
</form>
<?php 
if (isset($_GET["d1"])) {

  # code...

?>
<?php 
$company=$_GET['insurance'];
$result = $db->prepare("SELECT * FROM insurance_companies WHERE company_id=:d  ");
        $result->bindParam(':d',$company);
        $result->execute(); 
        for($i=0; $row = $result->fetch(); $i++){
           $ins_mark_up=$row['ins_mark_up'];
         }
        
        ?>
<?php  
      
       $d1=$_GET['d1']." 00:00:00"; 
       $d2=$_GET['d2']." 23:59:59";
       $date1=date("Y-m-d H:i:s", strtotime($d1));
       $date2=date("Y-m-d H:i:s", strtotime($d2));
        $e=0;        
       ?>
<p>&nbsp;</p>
<?php
       
       //get sum amount from pharmacy for the user 

        $result = $db->prepare("SELECT sum(amount) AS pharmacy_cash FROM cash WHERE date>=:a AND date<=:b AND confirmation=:c AND paid=:e");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$company);
        $result->bindParam(':e',$e);      
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $pharmacy_cash = $row['pharmacy_cash']; 
    }
     //get sum amount from lab for the user     
        $result = $db->prepare("SELECT sum(amount) AS lab_cash FROM lab_cash WHERE date>=:a AND date<=:b AND confirmation=:c AND paid=:e ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$company);
        $result->bindParam(':e',$e);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $lab_cash = $row['lab_cash'];  
    }
    //get sum amount from fees for the user     
        $result = $db->prepare("SELECT sum(amount) AS totalfees FROM fees_total WHERE date>=:a AND date<=:b AND confirmation=:c AND paid=:e ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$company);
        $result->bindParam(':e',$e);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $fees_cash = $row['totalfees'];    }
    //get sum amount from pharmacy for the user     
        $result = $db->prepare("SELECT sum(amount) AS clinicfees FROM clinics_total WHERE date>=:a AND date<=:b AND confirmation=:c AND paid=:e ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$company);
        $result->bindParam(':e',$e);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $clinicfees = $row['clinicfees'];
 ?>
</hr>

<div class="container" id="print">
     <p></p>
     <center><b>summary fom <?php 
$result = $db->prepare("SELECT * FROM insurance_companies WHERE company_id=:d  ");
        $result->bindParam(':d',$company);
        $result->execute(); 
        for($i=0; $row = $result->fetch(); $i++){
           echo $row['name'];
         }
        
        ?> </b></center>
     <center><b>period: <?php echo date("d-m-Y", strtotime($d1)); ?> - <?php echo date("d-m-Y", strtotime($d2)); ?> </b></center>
     <p></p>
     <p></p>
     <div class="container" id="print">
<table class="table" style="width: 50%;" align="center" >
<thead>
<tr>
<th>total cash from pharmacy</th>
<th style="text-align: right;"><?php echo $ins_mark_up*$pharmacy_cash; ?></th>
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
<th style="text-align: right;"><?php echo $ins_mark_up*$lab_cash; ?></th>
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
<th style="text-align: right;"><?php echo $ins_mark_up*$fees_cash; ?></th>
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

<th style="text-align: right;"><?php echo $ins_mark_up*$clinicfees; ?></th>
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
<th style="text-align: right;"><?php echo $ins_mark_up*($clinicfees+$fees_cash+$lab_cash+$pharmacy_cash); ?></th>
<thead>
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<button class="btn btn-success btn-large" style="width: 46%;margin-left: 27%;" id="print" align="center" onclick="printContent('print');">print report</button>
<?php } ?>
</body>
</html>