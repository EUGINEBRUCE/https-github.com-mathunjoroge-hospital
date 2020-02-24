
         <h5 align="center">cash payment for clinics</h5>
<form action="savepayclinic.php" method="POST">
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
</tbody>
</table></br>
<button class="btn btn-success btn-large" style="width: 100%;">save</button>	
</form>
