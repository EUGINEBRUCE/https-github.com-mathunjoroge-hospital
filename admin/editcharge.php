<h5 align="center">edit charge</h5>
<form action="saveeditcharge.php" method="POST">
	<table class="resultstable" >
<thead>
<tr>
<th>name</th>
<th>amount</th>
<th>payable before</th>
</tr>
</thead>
<tbody>
<tr>
<td ><input style="outline: none;width: 7em;" type="text" name="name" value="<?php echo $_GET['name']; ?>"required/></td>
<td ><input type="text" name="amount" value="<?php echo $_GET['amount']; ?>" required/></td >
<td><select name="payable"><option disabled>select</option><option value="1">YES</option><option value="0">NO</option></select></td>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
</tr>
</tbody>
</table>
<button class="btn btn-success btn-large" style="width: 100%;">save</button>
	
</form>
