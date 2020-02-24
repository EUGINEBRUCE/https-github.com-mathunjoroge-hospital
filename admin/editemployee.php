<?php
include('../connect.php');
  ?><center><h3>edit employee details</h3></center>
</hr>
  <form action="save_edit_employee.php" method="POST">
	<table class="thead-dark" style="width:80%;" >
<thead>
<tr>
<th>name</th>
<th>job group</th>
<th>id Number</th>
</tr>
</thead>
<tbody>
<tr>
  <?php $employee_id=$_GET['id'];
        $result = $db->prepare("SELECT * FROM employees WHERE employee_id=:a");
        $result->bindParam(':a',$employee_id);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
     
             
      ?>
    <input type="hidden" name="id" value="<?php echo $employee_id; ?>  ">
<td><input type="text" name="employee_name" style="outline: none;" value="<?php echo $row['employee_name']; ?>" required/></td>
<td><select name="jg" >
<?php
$result = $db->prepare("SELECT*  FROM job_groups");
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $jg_id= $row['jg_id'];
      $jg_name= $row['jg_name']; ?>
      <option disabled>select job group</option>
      <option value="<?php echo $jg_id; ?>"><?php echo $jg_name; ?></option><?php } ?></select></td>
<td><input type="text" name="id_number" style="outline: none;" required/></td>
</tr>
<tr>
<th>NHIF NO</th>
<th>NSSF NO</th>
<th>bank</th>
</tr>
<tr>
	<td><input type="text" name="nhif" style="outline: none;"value="<?php echo $row['nhif']; ?>" /></td>
<td><input type="text" name="nssf" style="outline: none;" value="<?php echo $row['nssf']; ?>" ></td>
<td><input type="text" name="bank" style="outline: none;" value="<?php echo $row['bank']; ?>" ></td>
</tr>
</tbody>
</table>
<label>account no</label></br>
<input type="text" name="acc" style="outline: none;" value="<?php echo $row['account_number']; ?>" >
<p>&nbsp;</p>
<?php } ?>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>