<?php 
require_once('../main/auth.php');
include ('../connect.php');
$shownav=0; ?>
<!DOCTYPE html>
<html>
<title>test list</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
<button type="button" id="toggleMenu" class="toggle_menu">
<i class="fa fa-bars"></i>
</button>
<?php include('../main/nav.php'); ?>   
</header><?php include('side.php'); ?>
<div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
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
<?php if (isset($_GET['response'])) {
# code...
?>
<p class="alert-success">parameters saved!</p>
<?php } ?>
<table class="resultstable" >
<thead>
<tr>
<th> name</th>
<th>amount</th>
<th>view parameters</th>
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
$template = $row['template']; 
?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><?php
// check if a template for the lab results is not empty
if (empty($template)){ ?>no set parameters<?php } ?> 
<?php if (!empty($template)) {
# code...
?><a rel="facebox" href="test_details.php?lab_id=<?php echo $row['id']; ?>&test_name=<?php echo $name; ?>">view parameters</a><?php } ?></td>
<td><a href="form.php?id=<?php echo $row['id']; ?>&test=<?php echo $name; ?>">add params</a></td>
<td><a rel="facebox" href="edittest.php?id=<?php echo $row['id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>

</div>
</body>
</html>