<?php
include('../connect.php');
  ?><center><h3>Add nursing charge</h3></center>
</hr>
  <form action="savenursing.php" method="POST">
	<table class="thead-dark" style="width:80%;" >
<thead>
<tr>
<th>name</th>
<th>amount</th>
<th>payable before</th>
</tr>
</thead>

<tbody>
<tr>
<td><input type="text" name="name" style="outline: none;"></td>
<td ><input type="text" name="amount"></td>
<td><select name="payable"><option disabled>select</option><option value="1">YES</option><option value="0">NO</option></select></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>