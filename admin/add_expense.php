<?php
include('../connect.php');
  ?><center><h3>Add expense</h3></center>
</hr>
  <form action="save_expense.php" method="POST">
	<table class="thead-dark" style="width:80%;" >
<thead>
<tr>
<th>name</th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="text" name="expense_name" style="outline: none;" required/></td>
<input type="hidden" name="trigger" value="1" />
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>