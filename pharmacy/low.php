<script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>
<div id="print">
<table class="resultstable" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>qty in store</th>
<th>qty in pharmacy</th>
<th>price</th>
<th>total</th>
</tr>
</thead>
<?php
include('../connect.php');
        $result = $db->prepare("SELECT * FROM drugs WHERE pharm_qty<=reorder_ph");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
      $qtyp= $row['pharm_qty'];
         ?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<td ><?php echo $qtyp; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>
 
      

</div> </div>
      
      
</div>

 <button class="btn btn-success btn-large" style="width: 100%;" id="print" onclick="printContent('print');">print</button>