<?php 
include('../connect.php');
require_once('../main/auth.php');
$d1=date('Y-m-d')." 00:00:00";
$d2=date('Y-m-d H:i:s');
 ?> 
 <!DOCTYPE html>
<html>
<title>cashier</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   
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
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    <?php include('../main/nav.php'); 
    ?>
   
  </header>
  <?php include('side.php'); ?>
  <div class="content-wrapper"><script>
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#country').addClass('load');
            $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#country').removeClass('load');
                }
            });
        }
    }

    function fill(thisValue) {
        $('#country').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }
</script>
<style>
#result {
    height:20px;
    font-size:16px;
    font-family:Arial, Helvetica, sans-serif;
    color:#333;
    padding:5px;
    margin-bottom:10px;
    background-color:#FFFF99;
}
#country{
    border: 1px solid #999;
    background: #EEEEEE;
    padding: 5px 10px;
    box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
    position: absolute;
    left: 10.2%;
    margin: 0;
    width: 268px;
    top: 32%;
    padding:0px;
    background-color: blue;
    color: #fff;
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
    color:#000;
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
<script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script> 
   
<div class="jumbotron" style="background: #95CAFC;">
  <div class="container" id="content">
<center>
<?php
      $search=$_GET['search'];
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
     
     ?>
<p>patient name: <?php echo $a; ?> <?php } ?></p></center>

<center><p>patient number: <?php echo $_GET['search']; ?> </p></center> 
</center>   
    <?php
    $search=$_GET['search'];
    $nothing="";


    if ($search!=$nothing) {
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
 
      <style type="text/css">
      	table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 70%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}.column {
    float: left;
    width: 50%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
      </style>
      <?php 
        $reset=0;
        $discharge_date=date('Y-m-d');
    $result = $db->prepare("SELECT * FROM admissions WHERE ipno=:o AND discharge_date=:a");
    $result->BindParam(':o', $search);
     $result->BindParam(':a', $discharge_date);
        $result->execute();
        $check = $result->rowcount();
        if ($check==0) {
          $admitted=0;
        }
        if ($check>0) {
          $admitted=1;
        }
         ?>
         <?php
         if ($admitted==0) {
           ?> 
           <h6 class="alert alert-warning" style="width: 43%;">The patient has been discharged or was not admitted</h6>
           <?php } ?>
           <?php
         if ($admitted==1) {
          ?>    
 <label>medicines  paid for</label></br> 
     <table class="resultstable" >
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
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by=' 
pharm-ward'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
      $drug_id= $row['drug_id'];
         ?>
<tbody> 

<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td><?php echo $qty; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
        $result = $db->prepare("SELECT sum(price*dispensed_drugs.quantity) as total FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id =dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by='pharm-ward'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      <th>  </th>
      <th>  </th>
      <th>  </th>
      <td> Total Amount: </td>
      
    </tr>
      <tr>
        <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;"> <?php $pharm_amount=$row['total'];  echo $pharm_amount; ?></strong> </td>
</tbody>
</table>

 </br>

 <label>lab tests  paid for</label></br> 
<table class="resultstable" >
<thead>
<tr>
<th>test</th>
<th>requested by</th>
<th>cost</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT name, test,opn,reqby,lab_tests.cost FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE opn='$patient'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $reqby = $row['reqby'];
      $cost= $row['cost'];

         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $reqby; ?></td>
<td><?php echo $cost; ?></td>
<?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
        $result = $db->prepare("SELECT sum(lab_tests.cost) as total FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE opn='$patient'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      <th>  </th>
      <td> Total Amount: </td>
      </tr>
      <tr>
        <th colspan="2"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;"> <?php $lab_amount=$row['total'];  echo $lab_amount; ?> </td><?php } ?>
</tbody>
</table>
 </br> 
  <label>clinics  paid for</label></br> 
     <table class="resultstable" >
<thead>
<tr>
<th>clinic</th>
<th>cost</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT clinic_name, cost FROM clinics RIGHT OUTER JOIN clinic_fees ON clinic_fees.clinic_id=clinics.clinic_id WHERE patient='$patient' AND paid=0");
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
<tr> <?php $patient=$_GET['search'];
        $result = $db->prepare("SELECT sum(clinics.cost) as total FROM clinics RIGHT OUTER JOIN clinic_fees ON clinic_fees.clinic_id=clinics.clinic_id WHERE patient='$patient'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th>Total Amount: </th>
      <td> <?php $clin_amount=$row['total'];  echo $clin_amount; ?> </td>
      </tr>
      <?php } ?>
</tbody>
</table>
 </br>
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
        $result = $db->prepare("SELECT* FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE paid_by=:a AND paid=:b");
        $result->bindParam(':a', $b);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?>
      <tbody>
<tr> <td><?php echo $row['fees_name']; ?>:&nbsp;</td>
      <td> &nbsp;<?php echo $row['amount']; ?>

</td><?php } ?></tbody>
</table>
<hr>
<?php
 $result = $db->prepare("SELECT sum(amount) AS total FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE paid_by=:a AND paid=:b");
        $result->bindParam(':a', $b);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
 ?>
 <table class="table" >
<thead>
<tr>
    <th>total</th>
    <th>&nbsp;</th>
      <th><?php $col_amount=$row['total']; echo $col_amount;  ?></th>
    </tr>
</thead> 
 </table>
 <table class="table" >
<thead>
<tr>
    <th>grand total</th>
    <th>&nbsp;</th>
      <th><?php echo $_GET['grand'];  ?></th>
    </tr>
</thead> 
 </table>
 <table class="table" >
<thead>
<tr>
    <th>cash tendered</th>
    <th>&nbsp;</th>
      <th><?php echo $_GET['cash'];  ?></th>
    </tr>
</thead> 
 </table>
 <table class="table" >
<thead>
<tr>
    <th>change</th>
    <th>&nbsp;</th>
      <th><?php echo $_GET['cash']-$_GET['grand'];  ?></th>
    </tr>
</thead> 
 </table>
 </div>
 
 <button class="btn btn-success btn-large" style="width: 100%;" id="myprint" onclick="printContent('content');">print</button>
 <script type="text/javascript">
  document.onkeydown = function () { 
//Run this function on keypress
keyAction(); 
}
function keyAction() { 
    var whichKey = event.keyCode; 
    switch (whichKey) { 
    case 80 /*H or h*/: 
    document.GetElemetById('myprint').click();
    break;
    }
}
      </script>
 <?php } ?>
 <?php } ?>
</div></div></div>
<?php
    $respose=$_GET['response'];

    if ($respose==1) {
       
      ?>
      <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> patient data saved successifully</p></div>
      
        
      <?php }} ?>
<script src="dist/vertical-responsive-menu.min.js"></script>
</body>
</html>
<?php } ?>