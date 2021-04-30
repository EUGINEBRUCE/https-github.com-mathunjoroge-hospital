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
<?php
include "../header.php";
?>
</head><body><header class="header clearfix" style="background-color: #3786d6;">

<?php include('../main/nav.php'); ?>   
</header><?php include('side.php'); ?>
<div class="content-wrapper">
<div class="jumbotron" style="background: #95CAFC;">


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