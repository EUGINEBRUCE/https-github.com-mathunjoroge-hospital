<?php
include('../connect.php');
  ?><center><h3>Add a reagent</h3></center>
</hr>
  <form action="saveproduct.php" method="POST">
	<table class="thead-dark" style="width:80%;" >
<thead>
<tr>
<th>reagent name</th>
<th>brand name</th>
<th>quantity</th>
</tr>
</thead>

<tbody>
<tr>
<td><input type="text" name="gen" style="
    outline: none;"></td>
<td><input type="text" name="brand"></td>
<td ><input type="text" name="qty"></td>


</tr>
<tr> 
</tbody>
</table>
<p>&nbsp;</p>
<table class="thead-dark" style="width:80%;" >
<thead>
<tr>

<th>buying price</th>
<th>reoder lab</th>
<th>reoder store</th>

</tr>
</thead>

<tbody>
<tr>
<td><input type="text" name="price"></td>
<td><input type="text" name="reorderph" ></td>
<td><input type="text" name="reorderst" ></td>
</tr>
<tr> 
</tbody>
</table>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>