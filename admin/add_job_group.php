<?php
include('../connect.php');
  ?><center><h3>Add job group</h3></center>
</hr>
  <form action="save_jb.php" method="POST">
	<table class="thead-dark" style="width:80%;" >
<thead>
<tr>
<th>name</th>
<th>basic salary</th>
</tr>
</thead>
<tbody>
<tr>
<td><input type="text" name="jb" style="outline: none;" required/></td>
<td ><input type="text" name="amount" required/></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>