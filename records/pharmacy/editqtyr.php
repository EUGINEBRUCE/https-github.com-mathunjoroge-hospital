<h5 align="center">edit quantity</h5>
<form action="saveeditr.php" method="POST">
	<table class="resultstable" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>quantity</th>
</tr>
</thead>
<tbody>
<tr>
<td><?php echo $_GET['gname']; ?></td>
<td><?php echo $_GET['bname']; ?></td>
<td ><input style="outline: none;width: 7em;" type="number" name="qty" value="<?php echo $_GET['qty']; ?>" ></td>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="pn" value="<?php echo $_GET['pn']; ?>">
<input type="hidden" name="orr" value="<?php echo $_GET['qty']; ?>">
<input type="hidden" name="drug" value="<?php echo $_GET['drug']; ?>">
</tbody>
</table>
<button class="btn btn-success btn-large" style="width: 100%;">save</button>
	
</form>
