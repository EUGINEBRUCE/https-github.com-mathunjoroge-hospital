<?php 
require_once('../main/auth.php');
include('../main/nav.php');

 ?>
 
 <!DOCTYPE html>
<html>
<title>cash</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
</head>
<body>        
<div class="container">   
      <div class="jumbotron" style="background: #95CAFC;">
         <body>
<?php
    $search=$_GET['search'];
    $nothing="";


     {
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
      <p>&nbsp;</p>
<script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>
<div class="container" id="print" align="center" >
  <caption align="left"><?php echo $a; ?> &nbsp; &nbsp; sex: <?php echo $c; ?> </caption></br>
  <table class="resultstable" >
<thead>
<tr>
<th style="width: 60%;">particulars</th>
<th>cost</th>

</tr>
</thead>
<tbody> 
 
<?php
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT clinic_name, cost FROM clinics RIGHT OUTER JOIN clinic_fees ON clinic_fees.clinic_id=clinics.clinic_id WHERE patient='$patient' AND paid=1");
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
        $result = $db->prepare("SELECT sum(clinics.cost) as total FROM clinics RIGHT OUTER JOIN clinic_fees ON clinic_fees.clinic_id=clinics.clinic_id WHERE patient='$patient' AND paid=1");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      
      </tr>
      <tr>
        <th colspan="1"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;"> <?php $amount=$row['total'];  echo $amount; ?> </td>
          <tr>
        <th colspan="1"><strong style="font-size: 12px; color: #222222;">cash tendered:</strong></th>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;"> <?php   echo $_GET['cash']; ?> </td></tr>
          <tr>
        <th colspan="1"><strong style="font-size: 12px; color: #222222;">change:</strong></th>
        <td colspan="1"><strong style="font-size: 12px; color: #222222;"> <?php   echo $_GET['cash']-$amount; ?> </td></tr><?php } ?>
</tbody>
</table>
<P>you were served by: <?php echo $_SESSION['SESS_FIRST_NAME']; ?></P></div>
<button class="btn btn-success btn-large" style="width: 100%;" id="print" onclick="printContent('print');">print</button>
</body>
  </html><?php } ?>