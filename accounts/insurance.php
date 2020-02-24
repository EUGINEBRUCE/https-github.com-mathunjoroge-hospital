<?php 
require_once('../main/auth.php');
include('../connect.php');
 ?> 
 <!DOCTYPE html>
<html>
<title>insurance reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../pharmacy/dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../pharmacy/dist/js/bootstrap-select.js"></script>
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
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