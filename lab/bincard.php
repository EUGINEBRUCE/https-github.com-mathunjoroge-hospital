<?php 
require_once('../main/auth.php');
include('../connect.php');
$result = $db->prepare("SELECT * FROM lab_orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
 ?>
 <!DOCTYPE html>
<html>
<title>bincard</title>
 <?php 
include "../header.php";
?>
</head>
  <body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">         
<form action="bincard.php" method="GET">
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
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
</head>
  <span>
<select  name="drug" class="selectpicker" data-live-search="true" title="search reagent..." style="width: 268px; height:30px;" required="required"  >
    <option value="" disabled="">-- Select a drug--</option><?php 
$result = $db->prepare("SELECT * FROM reagents");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['drug_id'].">".$row['generic_name']."-".$row['brand_name']."</option>";
         }
        
        ?>      
</select> from: <input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick date"> to: <input type="text" id="mydat"  name="d2" autocomplete="off" placeholder="pick date">
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
<p>&nbsp;</p>
<?php
$d1=$_GET['d1']." 00:00:00"; 
       $d2=$_GET['d2']." 23:59:59";
       $date1=date("Y-m-d H:i:s", strtotime($d1));
       $date2=date("Y-m-d H:i:s", strtotime($d2)); 
if ($_GET['drug']==0) {
  # code...
}
 ?>
 <?php
if ($_GET['drug']>0) {
  

 ?>
</hr><div class="container" id="print">
  <?php 
   $drug=$_GET['drug'];
  $result = $db->prepare("SELECT* FROM reagents WHERE  drug_id=:c");
        $result->bindParam(':c',$drug);
        $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
     
      $generic_name = $row['generic_name'];
      $brand_name = $row['brand_name'];
      $c_stock = $row['quantity'];
      $lc_stock = $row['pharm_qty'];
     ?>
     <center><b>purchases and consumption report</b></center>
     <p></p>
     <center><b>period: <?php echo $date1; ?> - <?php echo $date2; ?> </b></center>
     <p></p>
     <center><b> for: <?php echo $generic_name.' -'.$brand_name; ?></b></center><?php } ?>
     <p></p>
     <table class="table" >
<thead>
     <tr>
  <?php 
  $result = $db->prepare("SELECT sum(qty_disp) AS total FROM lab_orders WHERE updated_at BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total_orders = $row['total'];}
      $result = $db->prepare("SELECT sum(qty) AS total FROM lab_purchases WHERE date BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total = $row['total']; ?>
<th></th>
<th></th>
<th></th>
<th>
  <?php
$opening=$c_stock-$total+$total_orders;
 } ?></th>
</tr>

<table class="table" >
  <label>requests to lab</label>
  <hr>
<thead>
<tr>
<th>qty requested for</th>
<th>qty issued</th>
<th>requested by</th>
<th>issued by</th>
<th>date</th>

</tr>
</thead>
<?php 
        //get quantities     
        $result = $db->prepare("SELECT* FROM lab_orders WHERE updated_at BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $qtyreq = $row['quantity'];
      $qtydisp = $row['qty_disp'];
      $reqby= $row['posted_by'];
      $dispby= $row['cashed_by'];
      $disdate= $row['updated_at'];
      
         ?>
         <tbody>
<tr>
<td ><?php echo $qtyreq; ?></td>
<td><?php echo $qtydisp; ?></td>
<td><?php echo $reqby; ?></td>
<td ><?php echo $dispby; ?></td>
<td ><?php echo $disdate; ?></td><?php } ?>
</tr>
<thead>
<tr>
  <?php $result = $db->prepare("SELECT sum(qty_disp) AS total FROM lab_orders WHERE updated_at BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total_orders = $row['total']; ?>
<th>total for the period</th>
<th></th>
<th></th>
<th></th>
<th><?php echo $total_orders; ?><?php } ?></th>

</tr>
</thead>
</tbody>
</table>
<table class="table" >
<thead>
<tr>
<th>qty purchased</th>
<th>invoice</th>
<th>entered by</th>

<th>date</th>

</tr>
</thead>
<?php 

        //get quantities     
        $result = $db->prepare("SELECT* FROM lab_purchases WHERE date BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $qty_purchased = $row['qty'];
      $invoice = $row['inv'];
      $recordedby= $row['recorded_by'];
      $recdate= $row['date'];
      
         ?>
         <tbody>
<tr>
<td><?php echo $qty_purchased; ?></td>
<td ><?php echo $invoice; ?></td>
<td><?php echo $recordedby; ?></td>
<td><?php echo $recdate; ?></td>
<?php } ?>
</tr>
<thead>
<tr>
  <?php $result = $db->prepare("SELECT sum(qty) AS total FROM lab_purchases WHERE date BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total = $row['total']; ?>
<th>stock available in store</th>
<th></th>
<th></th>
<th>
  <?php
 echo $c_stock; ?></th>
</tr>
<thead>
  <tr>
    <th>total used in lab</th>
    <?php        
       $result = $db->prepare("SELECT sum(quantity) AS dis_total FROM dispensed_reagents WHERE date BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total_dispensed = $row['dis_total'];
       
    }
    ?>
<th></th>
<th></th>
<th><?php echo $total_dispensed; ?></th>
<tr>
    
<tr>
  <?php        
       $result = $db->prepare("SELECT sum(quantity) AS dis_total FROM dispensed_reagents WHERE date BETWEEN :a AND :b AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total_dispensed = $row['dis_total'];
       
    }
    ?>
    <th>lab closing stock </th>
<th></th>
<th></th>
<th><?php echo $lc_stock; ?><?php } ?></th>
  </thead>
</tr>
</tbody>
</table>
</div>
<button class="btn btn-success btn-large" style="width: 100%;" id="print" onclick="printContent('print');">print</button>
</div>
<?php } ?>

<script src="../resources/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div>


</body>
</html>