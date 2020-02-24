<?php
include('../connect.php');
  ?><center><h3>Add allowance</h3></center>
</hr>
  <form action="save_allowance.php" method="POST">
	<table class="thead-dark" style="width:80%;" >
<thead>
<tr>
<th>name</th>
<th>amount</th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="text" name="allowance_name" style="outline: none;" required/></td>
<td><input type="number" name="amount" style="outline: none;" required/></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>