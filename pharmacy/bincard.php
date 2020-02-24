<?php 
require_once('../main/auth.php');
include('../connect.php');
 $result = $db->prepare("SELECT * FROM orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
 ?>

 
 <!DOCTYPE html>
<html>
<title>bincard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../pharmacy/dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../pharmacy/dist/js/bootstrap-select.js"></script>
   <script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>
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
  <style>
#result {
  height:0.50em;
  font-size:16px;
  font-family:Arial, Helvetica, sans-serif;
  color:#333;
  padding:5px;
  margin-bottom:10px;
  background-color:#FFFF99;
}
#country{
  border: 1px solid #999;
  background: #95CAFC;
  padding: 5px 10px;
  box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
  position: absolute;
  left: 19%;
  margin: 0;
  width: 3.5em;
  top: 24%;
  padding:0px;
  background-color: #000;
  color: #fff;
  width: 18em;
}
.suggestionList {
  margin: 0px;
  padding: 0px;
}
.suggestionList ul li {
  list-style:none;
  margin: 0px;
  padding: 6px;
  border-bottom:1px dotted #666;
  cursor: pointer;
}
.suggestionList ul li:hover {
  background-color: #FC3;
  color:#95CAFC;
}
ul {
  font-family:Arial, Helvetica, sans-serif;
  font-size:11px;
  color:#FFF;
  padding:0;
  margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
  position:relative;
}
.combopopup{
  padding:3px;
  width:268px;
  border:1px #CCC solid;
}

</style>
</head>
  <body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>   
  </header>
  <?php include('side.php');  ?>
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
<select  name="drug" class="selectpicker" data-live-search="true" title="search drug..." style="width: 268px; height:30px;" required="required"  >
    <option value="" disabled="">-- Select a drug--</option><?php 
$result = $db->prepare("SELECT * FROM drugs");
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
  $result = $db->prepare("SELECT* FROM drugs WHERE  drug_id=:c");
        $result->bindParam(':c',$drug);
        $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
     
      $generic_name = $row['generic_name'];
      $brand_name = $row['brand_name'];
      $c_stock = $row['pharm_qty'];
     ?>
     <center><b>purchases and consumption report</b></center>
     <p></p>
     <center><b><?php echo date('d-m-Y',strtotime($d1)); ?> to <?php echo date('d-m-Y',strtotime($d2)); ?> </b></center>
     <p></p>
     <center><b> for: <?php echo $generic_name.' -'.$brand_name; ?></b></center><?php } ?>
     <p></p>
<table class="table" >
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
        $result = $db->prepare("SELECT* FROM orders WHERE (updated_at >=:a AND updated_at <= :b) AND drug_id=:c");
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
  <?php $result = $db->prepare("SELECT sum(qty_disp) AS total FROM orders WHERE (updated_at >=:a AND updated_at <= :b) AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total_orders = $row['total']; ?>
<th>total requested from store</th>
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
        $result = $db->prepare("SELECT* FROM purchases WHERE (date >= :a AND date <= :b) AND drug_id=:c");
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
  <?php $result = $db->prepare("SELECT sum(qty) AS total FROM purchases WHERE (date >= :a AND date <= :b) AND drug_id=:c");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total = $row['total'];
      }
       ?>
       <?php 
       $reset=1;
       $result = $db->prepare("SELECT sum(quantity) AS dis_total FROM dispensed_drugs WHERE (date >= :a AND date <= :b) AND drug_id=:c AND dispensed=:d");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$drug);
        $result->bindParam(':d',$reset);       
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $total_dispensed = $row['dis_total'];
       
    }
    ?>
<th>opening stock</th>
<th></th>
<th></th>
<th>
  <?php
$opening=$c_stock+$total_dispensed-$total_orders;
 echo $opening; ?></th>
</tr>
<th>purchases </th>
<th></th>
<th></th>
<th><?php
 echo $total; ?></th>
<thead>
  <tr>
    <th>total ordered for the period</th>
<th></th>
<th></th>
<th><?php echo $total_orders; ?></th>
<tr>
    <th>total dispensed </th>
<th></th>
<th></th>
<th><?php echo $total_dispensed; ?><?php } ?></th>
  </thead>
</tr>
<tr>
  <?php 
   $drug=$_GET['drug'];
  $result = $db->prepare("SELECT* FROM drugs WHERE  drug_id=:c");
        $result->bindParam(':c',$drug);
        $result->execute();
      for($i=0; $row = $result->fetch(); $i++){
     
      $generic_name = $row['generic_name'];
      $brand_name = $row['brand_name'];
      $c_stock = $row['pharm_qty'];
     ?>
    <th>stock available in pharmacy</th>
<th></th>
<th></th>
<th><?php echo $c_stock; ?></th>
  </thead>
</tr>
</tbody>
</table>
<hr>
<b>Note:purchases included in the stores bincard and not in this report</b>
<button class="btn btn-success btn-large" style="width: 100%;" id="print" onclick="printContent('print');">print</button>
</div><?php } ?>
<script src="../resources/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div>


</body>
</html>