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
<?php 
include "../header.php";
?>
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