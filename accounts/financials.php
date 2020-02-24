<?php 
require_once('../main/auth.php');
include('../connect.php');
 ?> 
 <!DOCTYPE html>
<html>
<title>total cash</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
</head><body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">
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
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
      <div class="jumbotron" style="background: #95CAFC;">
      <div class="container" align="center">         
<form action="financials.php" method="GET">
  from: <input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick start date" required/> to: <input type="text" id="mydat"  name="d2" autocomplete="off" placeholder="pick end date" required/>
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      </div>
</form>
<?php 
if (isset($_GET["d1"])) {
	# code...

?>
<?php
       $d1=$_GET['d1']." 00:00:00"; 
       $d2=$_GET['d2']."".date("H:i:s");
       $date1=date("Y-m-d H:i:s", strtotime($d1));
       $date2=date("Y-m-d H:i:s", strtotime($d2)); 
 ?>
  
<p>&nbsp;</p>

<?php
       
       //get sum amount from pharmacy for the user     
        $result = $db->prepare("SELECT sum(amount) AS pharmacy_cash FROM cash WHERE (date >=:a AND date<= :b) ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);      
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $pharmacy_cash = $row['pharmacy_cash']; 
    }
     //get sum amount from lab for the user     
        $result = $db->prepare("SELECT sum(amount) AS lab_cash FROM lab_cash WHERE (date >=:a AND date<= :b) ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);      
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $lab_cash = $row['lab_cash'];  
    }
    //get sum amount from fees for the user     
        $result = $db->prepare("SELECT sum(amount) AS totalfees FROM fees_total WHERE (date >=:a AND date<= :b) ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);      
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $fees_cash = $row['totalfees'];    }
    //get sum amount from pharmacy for the user     
        $result = $db->prepare("SELECT sum(amount) AS clinicfees FROM clinics_total WHERE (date >=:a AND date<= :b) ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);      
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $clinicfees = $row['clinicfees'];
 ?>
</hr>
<div class="container" id="print">
     <p></p>
     <center><b>period: <?php echo $date1; ?> - <?php echo $date2; ?> </b></center>
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
<table class="table">
  <tr>
    <th>date</th>
    <th>expense</th>
    <th>amount</th>
    <th>paid in by</th>
  </tr>
<?php $result = $db->prepare("SELECT* FROM overheads  RIGHT OUTER JOIN expenses ON expenses.expense_id=overheads.expense_id WHERE payment_date>=:a AND payment_date<=:b ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);     
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){      
   ?>
   <td><?php echo $row['payment_date']; ?></td>
   <td><?php echo $row['expense_name']; ?></td>
   <td><?php echo $row['amount']; ?></td>
   <td><?php echo $row['paid_by']; ?></td>
    </tr>
    <?php
    } ?>
   </table> 
   <table class="table">
   <?php 
   $result = $db->prepare("SELECT sum(amount) AS total FROM overheads WHERE payment_date>=:a AND payment_date<=:b ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);     
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
  $total_expenses=$row['total']; 
   ?>   
     <tr>
       <td>total expenses</td>
       <td><b><?php echo $total_expenses; ?></td></b></tr>
         <?php } ?>
          </table>
          <table class="table">
  <tr>
    <th>date</th>
    <th>employee</th>
    <th>amount</th>
  </tr>
<?php $result = $db->prepare("SELECT* FROM salaries_payments  RIGHT OUTER JOIN employees ON employees.employee_id=salaries_payments.employee_id WHERE date>=:a AND date<=:b ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);     
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){      
   ?>
   <td><?php echo $row['date']; ?></td>
   <td><a href="payslip.php?employee_id=<?php echo $row['employee_id']; ?>&date=<?php echo $row['date']; ?>"><?php echo $row['employee_name']; ?></a></td>
   <td><?php echo $row['gross_pay']; ?></td>
    </tr>
    <?php
    } ?>
   </table> 
   <table class="table">
   <?php 
   $result = $db->prepare("SELECT sum(gross_pay) AS total FROM salaries_payments WHERE date>=:a AND date<=:b ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);     
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
  $total_salaries=$row['total']; 
   ?>   
     <tr>
       <td>total salaries</td>
       <td><b><?php echo $total_salaries; ?></td></b></tr>
         <?php } ?>
          </table>
          <table class="table">
            <tr>
              <td>cash after expenses and salaries</td>
              <td><b><?php echo ( $clinicfees+$fees_cash+$lab_cash+$pharmacy_cash)-($total_expenses+$total_salaries); ?></b></td>              
            </tr>
          </table>
</div>
</div>
<button class="btn btn-success btn-large" style="width: 46%;margin-left: 27%;" id="print" align="center" onclick="printContent('print');">print report</button>
</div>
<?php } ?>
</body>
</html>