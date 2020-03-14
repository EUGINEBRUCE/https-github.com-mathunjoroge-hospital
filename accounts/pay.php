<?php include ('../connect.php');
       $patient=$_GET['id'];
       $med_amount=$_GET['med_amount'];
       $lab=$_GET['lab'];
       $clinic=$_GET['clinic'];
       $fees=$_GET['fees'];
       $total=$_GET['total'];
        $result = $db->prepare("SELECT  GROUP_CONCAT(drugs.drug_id) as drug_id,GROUP_CONCAT(dispensed_drugs.quantity) as quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by=''");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
      $drug_id= $row['drug_id'];
      $quantity= $row['quantity'];    
      
         ?>
  <script type="text/javascript">
  $("#payment").change(function(){
    if($(this).val() == 2){
      $("#mpesa").show();
      $("#mpe").show();
      $("#mpes").show();
      $("#insurance").hide();
      $("#ins").hide();
      $("#insu").hide();
      $("#insurance").value="";
    }
    else if($(this).val() == 3){
      $("#insurance").show();
      $("#ins").show();
      $("#insu").show();
      $("#mpesa").hide();
      $("#mpe").hide();
      $("#mpes").hide();
    }
    else{
      $("#mpesa").hide();
      $("#mpe").hide();
      $("#mpes").hide();
      $("#insurance").hide();
      $("#ins").hide();
      $("#insu").hide();

    }
    
});
</script>
         <h5 align="center">cash payment</h5>
<form action="savepay.php" method="POST">
  <table class="resultstable" >
<thead>
<tr>
<th>total amount</th>
<th>cash tendered</th>
<th>payment mode</th>
<th id="mpes">Mpesa</th>
<th id="insu">Insurance</th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $total; ?></td>
<td><input style="outline: none;width: 7em;" type="number" name="tendered" >
<td><select id="payment" name="payment_mode">
<option>chose payment mode</option>
<option value="1">cash</option>
<option value="2">Mpesa</option>
<option value="3">Insurance</option> 
</select></td>
<td id="mpe"><input name="mobile" placeholder="enter mpesa code" id="mpesa"></td>
<td id="ins"><select id="insurance" name="insurance">
  <option></option>
  <option>Choose insurance company</option>
<?php 
        $result = $db->prepare("SELECT * FROM insurance_companies");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){                   
        ?> 
        <option value="<?php echo $row['company_id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>     
</select> </td>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="med_amount" value="<?php echo $med_amount; ?>">
<input type="hidden" name="clinic" value="<?php echo $clinic; ?>">
<input type="hidden" name="fees" value="<?php echo $fees; ?>">
<input type="hidden" name="lab" value="<?php echo $lab; ?>">
<input type="hidden" name="amount" value="<?php echo $total; ?>">
<input type="hidden" name="ward" value="<?php echo $_GET['wards_income']; ?>">
<input type="hidden" name="updated" value="<?php echo $_GET['updatedat']; ?>">
<input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
<input type="hidden" name="drug_id[]" value="<?php echo $drug_id; ?>">
<input type="hidden" name="quantity[]" value="<?php echo $quantity; ?>">
</tbody>
</table></br>
<button class="btn btn-success btn-large" style="width: 100%;">save</button>  
</form><?php } ?>
