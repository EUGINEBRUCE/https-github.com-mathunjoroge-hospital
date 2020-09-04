<?php 
require_once('../main/auth.php');
include ('../connect.php');
$shownav=0; ?>
<!DOCTYPE html>
<html>
<title>fees</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
<body><header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>   
</header><?php include('sidee.php'); ?>
<div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
<body >
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
</style><div class="container">

<h3>standard charges</h3><span>
<a rel="facebox" href="addcharge.php"> <button class="btn-success" style=""  >add charges</button></a></span></br><p></p> 
<?php 
if ($_GET["response"]=1) {
?>
<?php 
if ($_GET["response"]=2) {
?>
<?php } ?><?php } ?> 
<table class="resultstable" >
<thead>
<tr>
<th> name</th>
<th>amount</th>
<th>payable before</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM fees WHERE is_nursing=0");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){     
$name = $row['fees_name'];
$amount = $row['amount'];
$payable_before = $row['payable_before'];
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><?php if ($payable_before==0) {
echo "NO";
# code...
} 
else{
echo "YES";
} ?></td>

<td><a rel="facebox" href="editcharge.php?id=<?php echo $row['fees_id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
<h3>standard charges</h3><span>
<a rel="facebox" href="addnursin.php"> <button class="btn-success" style=""  >add nursing charge</button></a></span></br><p></p> 
<?php 
if ($_GET["response"]=1) {
?>
<?php 
if ($_GET["response"]=2) {
?>
<?php } ?><?php } ?> 
<table class="resultstable" >
<thead>
<tr>
<th> name</th>
<th>amount</th>
<th>payable before</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM fees WHERE is_nursing=1");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){     
$name = $row['fees_name'];
$amount = $row['amount'];
$payable_before = $row['payable_before'];
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><?php if ($payable_before==0) {
echo "NO";
# code...
} 
else{
echo "YES";
} ?></td>

<td><a rel="facebox" href="editcharge.php?id=<?php echo $row['fees_id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
<p></p>
<a rel="facebox" href="add_pocedure.php"> <button class="btn-success" style=""  >add procedure charges</button></a></span></br><p></p> 
<?php 
if ($_GET["response"]=1) {
?>
<?php 
if ($_GET["response"]=2) {
?>
<?php } ?><?php } ?> 
<table class="resultstable" >
<thead>
<tr>
<th> name</th>
<th>amount</th>
<th>payable before</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM fees WHERE is_nursing=2");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){     
$name = $row['fees_name'];
$amount = $row['amount'];
$payable_before = $row['payable_before'];
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><?php if ($payable_before==0) {
echo "NO";
# code...
} 
else{
echo "YES";
} ?></td>

<td><a rel="facebox" href="editcharge.php?id=<?php echo $row['fees_id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
<h3>lab charges</h3><span>

<a rel="facebox" href="addtest.php"> <button class="btn-success" style="">add lab test</button></a></span></br><p>

<?php 
if ($_GET["response"]=1) {
?>
<?php 
if ($_GET["response"]=2) {
?>

<?php } ?><?php } ?> 
<table class="resultstable" >
<thead>
<tr>
<th> name</th>
<th>amount</th>
<th>payable before</th>
<th>multiple param</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM lab_tests");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$name = $row['name'];
$amount = $row['cost']; 
$payable = $row['payable_before']; 
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><?php if ($payable==0) {
echo "NO";
# code...
} 
else{
echo "YES";
} ?></td>
<td><a href="ceditor.php?id=<?php echo $row['id']; ?>&test=<?php echo $name; ?>">add params</a></td>
<td><a rel="facebox" href="edittest.php?id=<?php echo $row['id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
</br>
<h3>imaging charges</h3><span>
<a rel="facebox" href="addimaging.php"> <button class="btn-success" style=""  >add imaging</button></a></span></br><p></p>
<?php 
if ($_GET["response"]==4) {
?>
<p class="lert alert warning">imaging method exist</p><?php } ?>
<?php 
if ($_GET["response"]==5) {
?>
<p class="alert alert success">imaging method created success!</p><?php } ?>
<table class="resultstable" >
<thead>
<tr>
<th>imaging name</th>
<th>amount</th>
<th>payable before</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM imaging");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){     
$name = $row['imaging_name'];
$amount = $row['cost'];
$payable_before = $row['payable_before'];
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><?php if ($payable_before==0) {
echo "NO";
# code...
} 
else{
echo "YES";
} ?></td>

<td><a rel="facebox" href="editcharge.php?id=<?php echo $row['fees_id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
</br>
<h3>clinics</h3><span>
<a rel="facebox" href="addclinic.php"> <button class="btn-success" style=""  >add clinic</button></a></span></br><p></p>
<table class="resultstable" >
<thead>
<tr>
<th>clinic name</th>
<th>amount</th>
<th>payable before</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM clinics");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){     
$name = $row['clinic_name'];
$amount = $row['cost'];
$payable_before = $row['payable_before'];
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><?php if ($payable_before==0) {
echo "NO";
# code...
} 
else{
echo "YES";
} ?></td>

<td><a rel="facebox" href="editcharge.php?id=<?php echo $row['fees_id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
<h3>ward charges</h3><span>
<a rel="facebox" href="addward.php"> <button class="btn-success" style="">add ward</button></a></span></br><p></p> 
<?php 
if ($_GET["response"]=1) {
?>
<?php 
if ($_GET["response"]=2) {
?>

<?php } ?><?php } ?> 
<table class="resultstable" >
<thead>
<tr>
<th> name</th>
<th>beds</th>
<th>daily charges</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM wards");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$name = $row['name'];
$beds = $row['beds'];
$amount = $row['charges'];
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $beds; ?></td>
<td><?php echo $amount; ?></td>
<td><a rel="facebox" href="#"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
<?php
// expense name exists
if ($_GET['response']==10) {
?>
<p class="alert alert-warning">expense by that name exists. creating failed!</p>
<?php } ?>
<?php
// expense create success
if ($_GET['response']==11) {
?>
<p class="alert alert-success">expense create success</p>
<?php } ?>
<h3>expenses</h3><span> 
<a rel="facebox" href="add_expense.php"> <button class="btn-success" style=""  >add expense</button></a></span></br><p></p>
<table class="resultstable" >
<thead>
<tr>
<th>expense name</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM expenses");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){     
$name = $row['expense_name'];
$id = $row['expense_id'];
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><a rel="facebox" href="edit_expense.php?id=<?php echo $row['expense_id']; ?>&name=<?php echo $name; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
</div>
</body>
</html>