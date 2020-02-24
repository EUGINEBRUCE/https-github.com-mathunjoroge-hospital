<?php 
require_once('../main/auth.php');
include ('../connect.php');
$result = $db->prepare("SELECT * FROM lab_orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;

 ?>
 
 <!DOCTYPE html>
<html>
<title>lab orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
 <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
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
<script>
function showDrug(str) {
    if (str == "") {
        document.getElementById("texxtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("texxtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","get_drug.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head><body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper"> 
      <div class="jumbotron" style="background: #95CAFC;">
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
       
      <div class="container" ><label>select reagent to record</label></br>
        <table class="table dark-table" style="width: 70%;">
<thead>
<tr>
<th style="width: 32%;">name</th>
<th>price</th>
<th>qty avl</th>
<th>qty</th>
</tr>
</thead> </table>     
      <span><form action="savepatient.php" method="POST">
        <input type="hidden" name="pn" value="<?php echo $_GET['search']; ?>">
        <input type="hidden" name="adm" value="<?php echo $admitted; ?>">       
          <select id="medicine" name="med" class="selectpicker" data-live-search="true" title="Please select a reagent..." onchange="showDrug(this.value)">

          <?php 
           include ('../connect.php');
          $result = $db->prepare("SELECT * FROM reagents");
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
                     echo "<option value=".$row['drug_id'].">".$row['generic_name']."-".$row['brand_name']."</option>";
                   }
                  
                  ?>      
          </select>
          <b><span id="texxtHint"></b></form></span>
      
      <div class="container" id="results" > <label>selected reagents</label></br> 
        <?php
        $patient=$_GET['search'];
        $result = $db->prepare("SELECT reagents.drug_id,generic_name,brand_name,price,dispense_id,dispensed_reagents.quantity FROM dispensed_reagents RIGHT OUTER JOIN reagents ON reagents.drug_id=dispensed_reagents.drug_id WHERE patient='$patient' AND cashed_by=''");
         $result->execute();
        $rowcount = $result->rowcount();
        if ($rowcount>0) {
          # code...
        
         ?>
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
       $patient=$_GET['search'];
       $cashier="";
        $result = $db->prepare("SELECT reagents.drug_id AS drug,dispense_id,generic_name,brand_name,price*mark_up AS price,dispense_id,dispensed_reagents.quantity FROM dispensed_reagents RIGHT OUTER JOIN reagents ON reagents.drug_id=dispensed_reagents.drug_id WHERE patient=:a AND cashed_by=:b");
        $result->bindParam(':a',$patient);
        $result->bindParam(':b',$cashier);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
      $drug_id= $row['drug'];
      $dispense_id= $row['dispense_id'];
         ?>
<tbody>
  <form action="saveorder.php" method="POST">
          <input type="hidden" name="drug_id[]" value="<?php echo $drug_id; ?>">
        <input type="hidden" name="disp_id[]" value="<?php echo $dispense_id; ?>">
        <input type="hidden" name="pn" value="<?php echo $search; ?>">
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><input type="text" name="qty[]" value="<?php echo $qty; ?>" ></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<td><a href="deleter.php?id=<?php echo $row['dispense_id']; ?>&pn=<?php echo $_GET['search']; ?>"> <button class="btn btn-danger" style="height: 8px;" title="Click to Delete"></button></a> </td><?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
$cashier="";
        $result = $db->prepare("SELECT sum(price*dispensed_reagents.quantity*mark_up) as total FROM dispensed_reagents RIGHT OUTER JOIN reagents ON reagents.drug_id =dispensed_reagents.drug_id WHERE patient=:a AND cashed_by=:b");
        $result->bindParam(':a',$patient);
        $result->bindParam(':b',$cashier);
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
 <button class="btn btn-success btn-large" style="width: 100%;">save</button></form><?php } ?>
</div>      
</div>
</div>      
</div></div>      
</div>
<?php if ($_GET['response']==1) {
  # code...
?>
<p></p>
<div class="alert alert-success" style="width: 35%;">reagents returned and stock adjusted appropriately</div><?php } ?><?php } ?>
  <script src="dist/vertical-responsive-menu.min.js"></script>
</body>
</html>