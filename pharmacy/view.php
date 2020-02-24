<table class="resultstable" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>quantity</th>
<th>price</th>
<th>total</th>
</tr>
</thead>
<?php include('../connect.php');
        $patient=$_GET['search'];
        $date1=date('Y-m-d')." 00:00:00";
        $date2=date('Y-m-d H:i:s');
        $cashier='';
        $result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE date BETWEEN :a AND :b AND cashed_by<>:c AND patient=:d");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$cashier);
        $result->bindParam(':d',$patient);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
      $drug_id= $row['drug_id'];
         ?>
<tbody> 

<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td><?php echo $qty; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<?php }?>
</tr></tbody>
</table>
