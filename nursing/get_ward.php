<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

include('../db_connect.php');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"ajax_demo");
$sql = "SELECT* FROM beds JOIN wards ON beds.ward=wards.name WHERE wards.id=$q AND ocuppied=0";
$result = mysqli_query($con,$sql);                   
while($row = mysqli_fetch_array($result)) {
	$bed=$row['bed_no'];
	$ward=$row['ward'];
    
    ?>
<?php }?>

<p><?php echo $bed; ?></p>
    <?php
mysqli_close($con);
?>

</body>
</html>