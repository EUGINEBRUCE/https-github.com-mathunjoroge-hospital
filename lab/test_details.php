<?php
include('../connect.php');
if (isset($_GET['test_name'])) {
?>
<h4 align="center"><?php echo $_GET['test_name']; ?></h4>
<form action="submit.php" method="POST">
<table class="resultstable" >
<thead>
<tr>
<th>parameter</th>
<th>normal range</th>
</tr>
</thead>
<tbody>
<?php
//lab id is unique id on lab table and will be used to update the template	
$lab_id=$_GET["lab_id"];
?><?php
$result = $db->prepare("SELECT*  FROM refs_table WHERE test_id=:a ");
$result->bindParam(':a',$lab_id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$parameter_name= $row['parameter_name'];
$normal_range= $row['normal_range'];

?>
<tr>
<input type="hidden" name="ref_id[]" value="<?php echo $ref_id; ?>">
<td><?php echo $parameter_name; ?></td>
<td><?php echo $normal_range; ?></td>

<?php } ?>
</tr>
</tbody>
</table>
<?php } ?>