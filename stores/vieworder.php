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
<title>view order</title>
<?php include "../header.php";
?>
</head>
<body>
 <header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>
  </header><?php include('side.php'); ?>
  <div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
 <div class="container-fluid">
  <div class="container" ><label>selected medicines for order</label></br>
<div class="container" id="results" > <label>viewing order</label></br> 
     <table class="table table-bordered" >
<thead class="bg-primary">
<tr>
<th>generic name</th>
<th>brand name</th>
<th>qty requested for</th>
<th>qty issued</th>
<th>value</th>

</tr>
</thead>

<?php 
        $patient=$_GET['id'];
        $result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,price,dispense_id,orders.quantity, drugs.quantity as store_qty FROM orders RIGHT OUTER JOIN drugs ON drugs.drug_id=orders.drug_id WHERE patient='$patient' AND cashed_by=''");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name']; 
      $price= $row['price'];
      $qty= $row['quantity'];
      $store_qty= $row['store_qty'];
      $id= $row['drug_id'];
      $dispense_id= $row['dispense_id'];
         ?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<form action="saveorder.php" method="POST">
  <input type="hidden" name="order_id" value="<?php echo $patient; ?>">
  <input type="hidden" name="dispense_id[]" value="<?php echo $dispense_id; ?>">
  <input type="hidden" name="drug_id[]" value="<?php echo $id; ?>">
<td><input type="number" name="qty[]" max="<?php echo $store_qty; ?>" style="width: auto;"></td>
<td ><?php  echo $qty*$price; ?></td>
<?php } ?>
</tr>
<tr> <?php $patient=$_GET['id'];
        $result = $db->prepare("SELECT sum(price*orders.quantity) as total FROM orders RIGHT OUTER JOIN drugs ON drugs.drug_id =orders.drug_id WHERE patient='$patient' AND cashed_by=''");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      <th>  </th>
      <th>  </th>
      <th>  </th>
      <td> Total value: </td>
      
    </tr>
      <tr>
        <th colspan="4"><strong style="font-size: 12px; color: #222222;">value:</strong></th>
        <td colspan="1" id="myvalue"><strong style="font-size: 12px; color: #222222;"> <?php echo $row['total']; ?> </td><?php } ?>
</tbody>
</table>
 </br>
 <button class="btn btn-success btn-large" style="width: 100%;">save</button></form>      

</div> </div>     
      
</div>
<script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>