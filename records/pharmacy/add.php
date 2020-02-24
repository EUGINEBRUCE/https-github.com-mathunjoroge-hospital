<?php
include('../connect.php');
  ?><center><h3>Add product</h3></center>
</hr>
  <form action="saveproduct.php" method="POST">
	<table class="thead-dark" style="width:80%;" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>category</th>
<th>quantity</th>


</tr>
</thead>

<tbody>
<tr>
<td><input type="text" name="gen" style="
    outline: none;"></td>
<td><input type="text" name="brand"></td>
<td><select name="category">
    <option value="" disabled="">-- Select category--</option><?php 
$result = $db->prepare("SELECT * FROM drug_category");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>"; }
         
        
        ?>      
</select></td>
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
<th>mark up</th>
<th>reoder pharm</th>
<th>reoder store</th>

</tr>
</thead>

<tbody>
<tr>

<td><input type="text" name="price"></td>
<td><input type="text" name="markup" placeholder="as %"></td>
<td><input type="text" name="reorderph" ></td>
<td><input type="text" name="reorderst" ></td>

</tr>
<tr> 
</tbody>
</table>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>