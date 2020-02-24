<h5 align="center">cash payment</h5>
<form action="savedis.php" method="POST">
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
<td><?php echo $_GET['grand']; ?></td>
<td ><input style="outline: none;width: 7em;" type="number" name="tendered" ></td>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="pharm" value="<?php echo $_GET['parm']; ?>">
<input type="hidden" name="lab" value="<?php echo $_GET['lab']; ?>">
<input type="hidden" name="clin" value="<?php echo $_GET['clin']; ?>">
<input type="hidden" name="collection" value="<?php echo $_GET['col']; ?>">
<input type="hidden" name="grand" value="<?php echo $_GET['grand']; ?>">
</tbody>
</table></br>
<button class="btn btn-success btn-large" style="width: 100%;">save</button>