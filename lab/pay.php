<?php include ('../connect.php');
       $patient=$_GET['id'];
        $result = $db->prepare("SELECT  GROUP_CONCAT(drugs.drug_id) as drug_id,GROUP_CONCAT(dispensed_drugs.quantity) as quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by=''");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
      $drug_id= $row['drug_id'];
      $quantity= $row['quantity'];
     
      
         ?>
         <h5 align="center">cash payment</h5>
<form action="savepay.php" method="POST">
	<table class="resultstable" >
<thead>
<tr>
<th>total amount</th>
<th>cash tendered</th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $_GET['amount']; ?></td>
<td ><input style="outline: none;width: 7em;" type="number" name="tendered" ></td>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="amount" value="<?php echo $_GET['amount']; ?>">
<input type="hidden" name="drug_id[]" value="<?php echo $drug_id; ?>">
<input type="hidden" name="quantity[]" value="<?php echo $quantity; ?>">
</tbody>
</table></br>
<button class="btn btn-success btn-large" style="width: 100%;">save</button>	
</form><?php } ?>
