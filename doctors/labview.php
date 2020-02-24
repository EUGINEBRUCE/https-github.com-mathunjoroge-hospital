<?php 
require_once('../connect.php');
 ?> 
  <label>pending lab results for <?php echo $_GET['name']; ?></label></br> 
     <table class="resultstable"  >
<thead>
<tr>
<th>test</th>
<th>requested by</th>
</tr>
</thead>
<?php
       $patient=$_GET['id'];
        $result = $db->prepare("SELECT  lab_tests.id AS id,name, test,opn,reqby,comments FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE (lab.paid=0)  AND opn='$patient'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $lab_id = $row['id'];
      $reqby = $row['reqby'];

         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $reqby; ?></td>


<?php }?>
</tr>

</tbody>
</table>
 </br>
