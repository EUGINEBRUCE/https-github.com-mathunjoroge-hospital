<?php
        include('../connect.php');
        $id=$_GET['id'];
        $result = $db->prepare("SELECT* FROM reagents WHERE  drug_id=:c");
        $result->bindParam(':c',$id);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $a = $row['generic_name'];
      $b = $row['brand_name'];
      $c= $row['category'];
      $d= $row['quantity'];
      $e= $row['pharm_qty'];
      $f= $row['price'];
      $gg = $row['mark_up'];
      $g = ($gg-1)*100;
      $h= $row['reorder_ph'];
      $j= $row['reorder_st'];
     
  }
         ?>
         <h5 align="center">edit product</h5>
<form action="saveeditstock.php" method="POST">
	<table class="resulttable" style="width:80%;" >
<thead>
<tr>
<th>common name</th>
<th>brand name</th>
<th>category</th>
<th>qty st</th>
<th>qty lab</th>


</tr>
</thead>

<tbody>
<tr>
<td><input type="text" name="a" value="<?php echo $a; ?>" ></td>
<td><input type="text" name="b" value="<?php echo $b; ?>"></td>
<td><select name="c">
    <option value="" disabled="">-- Select category--</option><?php 
$result = $db->prepare("SELECT * FROM reagents_category");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>"; }
         
        
        ?>      
</select></td>
<td ><input type="text" name="d" value="<?php echo $d; ?>"></td>
<td ><input type="text" name="e" value="<?php echo $e; ?>"></td>
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
<th>reoder lab</th>
<th>reoder store</th>

</tr>
</thead>

<tbody>
<tr>

<td><input type="text" name="f" value="<?php echo $f; ?>"></td>
<td><input type="text" name="g" value="<?php echo $g; ?>"></td>
<td><input type="text" name="h" value="<?php echo $h; ?>" ></td>
<td><input type="text" name="j" value="<?php echo $j; ?>"></td>
<td><input type="hidden" name="k" value="<?php echo $id; ?>"></td>

</tr>
<tr> 
</tbody>
</table>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 100%;">save</button>
</form>
	
</form>
