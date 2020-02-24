<?php 
include('../connect.php');
require_once('../main/auth.php');
$d1=date('Y-m-d')." 00:00:00";
$receipt=$_GET['receipt'];
$result = $db->prepare("SELECT * FROM receipts WHERE   receipt_no=$receipt");

        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $mark_up=$row['mark_up'];
        }
 ?> 
 <!DOCTYPE html>
<html>
<title>cashier</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link href='src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../stores/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="dist/js/bootstrap-select.js"></script>
  <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="../src/facebox.js" type="text/javascript"></script>
</head>
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); 
    ?>   
  </header>
  <?php include('side.php'); ?>
  <div class="content-wrapper">   
<div class="jumbotron" style="background: #95CAFC;">
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">patient bill</li>

    <?php
    $receipt=$_GET['receipt'];
    ?>
 
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
      <button class="btn btn-success btn-large" style="margin-left: 45%;" value="content" id="goback" onclick="javascript:printDiv('content')" >print receipt</button>
<div class="jumbotron" >
<div id="content"> 
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
<?php }
echo "receipt copy".'</br>'; 
echo "invoice number: ". $receipt.'</br>'; 


 ?></label></br>
<?php

 if ($_GET['insurance']>0) {
    $insurance=$_GET['insurance'];
    $result = $db->prepare("SELECT * FROM insurance_companies WHERE company_id=:a");
    $result->BindParam(':a', $insurance);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $company=$row['name'];
        $row['mark_up']=$row['ins_mark_up'];
        
    echo "<label>"."invoice to: ".$company."</lable>";
  }
}
if (!isset($row['mark_up'])) {
  $row['mark_up']=1;
}
else{
  $row['mark_up']=$row['mark_up'];
}
 ?>
</div>
  <?php

$receipt=$_GET['receipt'];
$result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,price*drugs.mark_up AS price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE receipt_no='$receipt'");
        $result->execute();
        $med_count = $result->rowcount();  
  //Check whether the query was successful or not
    if($med_count>0) {
?>
 <label>medicines paid for</label></br> 
     <table class="table" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>quantity</th>
<th>price</th>
<th>total</th>
</tr>
</thead>
<?php
       
        $result = $db->prepare("SELECT drugs.drug_id,token,generic_name,brand_name,price*drugs.mark_up AS price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE receipt_no='$receipt'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
      $drug_id= $row['drug_id'];
      $token= $row['token'];
         ?>
<tbody> 
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td><?php echo $qty; ?></td>
<td><?php echo ceil($price); ?></td>
<td ><?php  echo ceil($qty*$price); ?></td><?php } ?>
</tr>
<tr> <?php 
        $result = $db->prepare("SELECT sum(price*dispensed_drugs.quantity*drugs.mark_up) as total FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id =dispensed_drugs.drug_id WHERE  receipt_no='$receipt'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
   ?>
      <th> </th>
      <th>  </th>
      <th>  </th>
      <th>  </th>
      <td> Total Amount: </td>      
    </tr>
      <tr>
        <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;"> <?php $amount=$row['total'];  echo ceil($amount); ?></strong> </td>
</tbody>
</table><?php } ?><?php } ?>
 </br>
 <?php if($med_count<1) { 
  ?>

<?php } ?>
<?php 

$result = $db->prepare("SELECT name, test,opn,reqby,lab_tests.cost FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE   receipt_no='$receipt'");
        $result->execute();
        $lab_count = $result->rowcount();
  
  //Check whether the query was successful or not
    if($lab_count>0) {
?>
<div class="container" > <label>lab tests  paid for</label></br> 
     <table class="table" >
<thead>
<tr>
<th>test</th>
<th>requested by</th>
<th>cost</th>
</tr>
</thead>
<?php
       
        $result = $db->prepare("SELECT name,updated_at, test,opn,reqby,lab_tests.cost FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE receipt_no='$receipt' ");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $reqby = $row['reqby'];
      $cost= $row['cost']*$row['mark_up'];
      $updated= $row['updated_at'];

         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $reqby; ?></td>
<td><?php echo $cost; ?></td>
<?php }?>
</tr>
<tr> <?php 
        $result = $db->prepare("SELECT sum(lab_tests.cost) as total FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE receipt_no='$receipt'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      <th>  </th>
      <td> Total Amount: </td>
      </tr>
      <tr>
        <th colspan="2"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;"> <?php $amount_lab=$row['total']*$row['mark_up']; echo $amount_lab; ?> </td><?php } ?>
</tbody>
</table>
 </br> 
   <?php }  ?>
 <?php
  if($lab_count<1) { 
  ?>
<?php } ?> 
<?php 

$result = $db->prepare("SELECT clinic_name, cost FROM clinics RIGHT OUTER JOIN clinic_fees ON clinic_fees.clinic_id=clinics.clinic_id WHERE  receipt_no='$receipt'");
        $result->execute();
        $clinic_count = $result->rowcount();
  
  //Check whether the query was successful or not
    if($clinic_count>0) {
?>
<div class="container" > <label>clinics to be paid for</label></br> 
     <table class="table" >
<thead>
<tr>
<th>clinic</th>
<th>cost</th>
</tr>
</thead>
<?php
       
        $result = $db->prepare("SELECT clinic_name, cost FROM clinics RIGHT OUTER JOIN clinic_fees ON clinic_fees.clinic_id=clinics.clinic_id WHERE receipt_no='$receipt'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $name = $row['clinic_name'];
      $cost= $row['cost'];
         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $cost; ?></td>
<?php }?>
</tr>
<tr> <?php 
        $result = $db->prepare("SELECT sum(clinics.cost) as total FROM clinics RIGHT OUTER JOIN clinic_fees ON clinic_fees.clinic_id=clinics.clinic_id WHERE receipt_no='$receipt'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th>Total Amount: </th>
      <td> <?php $amount_clinic=$row['total'];
      echo $amount_clinic; ?> </td>
      </tr>
      <?php } ?>
</tbody>
</table>
 </br> 
  <?php }  ?>
 <?php
  if($clinic_count<1) { 
  ?>
<?php } ?>
<?php
$b=$_GET['search'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE receipt_no='$receipt'");
         $result->execute();
        $fees_count = $result->rowcount();
        if ($fees_count<0) {
          # code...
                 
 ?>
 <p> no fees to be paid for</p>
 <?php
 }
        if ($fees_count>0) { 
  ?>
<table class="table" >
<thead>
<tr>
    <th>payment</th>
      <th>amount</th>
    </tr>
</thead>    
      <?php
      $b=$_GET['search'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE receipt_no='$receipt'");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?>
      <tbody>
<tr> <td><?php echo $row['fees_name']; ?>:&nbsp;</td>
      <td> &nbsp;<?php echo $row['amount']*$row['mark_up']; ?>

</td><?php } ?></tbody>
</table>
<hr>
<?php
 $result = $db->prepare("SELECT sum(amount) AS total FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE receipt_no='$receipt'");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
 ?>
 <table class="table" >
<thead>
<tr>
    <th>total</th>
    <th>&nbsp;</th>
      <th><?php $total_fees=$row['total']*$mark_up; echo $total_fees;   ?></th>
    </tr>
</thead> 
 </table>
 
 <?php } ?>
 <?php } ?>
   <?php
 $reset=1;
 $result = $db->prepare("SELECT charges AS charges,adm_date,discharge_date FROM admissions RIGHT OUTER JOIN wards ON wards.id=admissions.ward WHERE ipno=:a AND discharged=:b");
        $result->bindParam(':a', $search);
        $result->bindParam(':b', $reset);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $discharge_date=$row['discharge_date'];
          if ($discharge_date="0000-00-00") {
            $discharge_date=date("Y-m-d");
          }
          $adm_date=$row['adm_date'];
      $startdate = strtotime($adm_date);
      $enddate = strtotime($discharge_date);
      $datediff = $enddate - $startdate;
      $days=round($datediff / (60 * 60 * 24));
      if (isset($days)) {
  ?>
  </tr><?php 

  ?>
  <table class="table" >
<thead>
<tr>
    <th>total for admission</th>
    <th>&nbsp;</th>
      <th><?php $admission_total=$days*$row['charges']*$row['mark_up']; echo $admission_total;   ?></th>
    </tr>
</thead> 
 </table>
 <?php } ?>
<?php } ?>
<table class="table" >
<thead>
<tr>
    <th>grand total:</th>
    <th width="70%">&nbsp;</th>
      <th><?php if (!isset($amount)) 
 { $amount=0;   # code...
 } 
 if (!isset($amount_lab)) {
  $amount_lab=0;   # code...
 }
 if (!isset($amount_clinic)) {
  $amount_clinic=0;
   # code...
 }
 if (!isset($total_fees)) { 
  $total_fees=0; }

  if (!isset($admission_total)) { 
  $admission_total=0; 
}
  if (!isset($token)) { 
  $token=""; 
}
 
 ?>
 <?php
 $grand_total=round($amount+$amount_lab+$amount_clinic+$total_fees+$admission_total); 
 if (isset($grand_total)) {
     # code...
    echo  $grand_total; }    ?></th>
    </tr>
</thead> 
 </table>
 </tbody><?php if (isset($grand_total)) {
   # code...
  ?>
 
 <?php } ?>
</div></div></div>
<script src="dist/vertical-responsive-menu.min.js"></script>

</body>
</html>