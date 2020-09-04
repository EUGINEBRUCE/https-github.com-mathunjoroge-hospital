<?php 
require_once('../main/auth.php');
include ('../connect.php');
$result = $db->prepare("SELECT * FROM purchases");
$result->execute();
$rowcountt = $result->rowcount();
$rowcount = $rowcountt+1;
$code=$rowcount;

?>

<!DOCTYPE html>
<html>
<title>order</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href='src/vendor/normalize.css/normalize.css' rel='stylesheet'>
<link href='src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
<link href="dist/vertical-responsive-menu.min.css" rel="stylesheet">
<link href="demo.css" rel="stylesheet">
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
</head><body><header class="header clearfix" style="background-color: #3786d6;">

<?php include('../main/nav.php'); ?>   
</header><?php include('side.php'); ?>
<div class="content-wrapper">
<div class="jumbotron" style="background: #95CAFC;">
<body onLoad="document.getElementById('country').focus();">


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

<div class="container-fluid">


<div class="container" ><label>select medicines to order</label></br>
<form action="savepurchases.php" method="POST">
<input type="hidden" name="pnumber" value="<?php echo $_GET['req']; ?>">


<span><select id="medicine" name="med" class="selectpicker" data-live-req="true" title="Please select a medicine..." >
<?php 
include ('../connect.php');
$result = $db->prepare("SELECT * FROM drugs");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo "<option value=".$row['drug_id'].">".$row['generic_name']."-".$row['brand_name']."</option>";
}

?> 
</select>

<input name="qty" style="height: 2em;width:3em;" type="number" min="1" placeholder="qty">
<input name="batch" style="height: 2em;width:3em;" type="text" min="1" placeholder="batch">
<input name="cost" style="height: 2em;width:3em;" type="number" min="1" placeholder="cost"><button class="btn btn-success btn-large">add</button></form></span></div>

<div class="container" id="results" > <label>selected meds</label></br> 
<table class="resultstable" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>quantity</th>
<th>price</th>
<th>total</th>
<th>action</th>
</tr>
</thead>
<?php
$invoice=$_GET['req'];
$result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,purchases.price AS price,purchases.qty FROM purchases RIGHT OUTER JOIN drugs ON drugs.drug_id=purchases.drug_id WHERE inv='$invoice'");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$drug = $row['generic_name'];
$brand = $row['brand_name'];
$price= $row['price'];
$qty= $row['qty'];
?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<td><a rel="facebox" href="editqty.php?id=<?php echo $row['dispense_id']; ?>&qty=<?php echo $qty; ?>&gname=<?php echo $drug; ?>&bname=<?php echo $brand; ?>&pn=<?php echo $pn; ?>"><button class="btn btn-success" style="height: 5px;" title="Click to edit quantity"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> <?php $invoice=$_GET['req'];
$result = $db->prepare("SELECT sum(purchases.price*purchases.qty) as total FROM purchases RIGHT OUTER JOIN drugs ON drugs.drug_id =purchases.drug_id WHERE inv='$invoice'");
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
<td colspan="1" id="myvalue"><strong style="font-size: 12px; color: #222222;"> <?php echo $row['total']; ?> </td>
</tbody>
</table>
</br>
<a rel="facebox" href="checkout.php?invoice=<?php echo $invoice; ?>&total=<?php echo $row['total']; ?>">
<button class="btn btn-success btn-large" style="width: 100%;">save</button></a><?php } ?>


</div> </div>


</div>


<script>
$(document).ready(function () {
var mySelect = $('#first-disabled2');

$('#special').on('click', function () {
mySelect.find('option:selected').prop('disabled', true);
mySelect.selectpicker('refresh');
});

$('#special2').on('click', function () {
mySelect.find('option:disabled').prop('disabled', false);
mySelect.selectpicker('refresh');
});

$('#basic2').selectpicker({
livereq: true,
maxOptions: 1
});
});
</script>


<script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>