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
$sql="SELECT drug_id AS drug,pharm_qty, price*mark_up AS price FROM drugs WHERE drug_id = '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
	$price=$row['price'];
	$drug=$row['drug'];
	$qty=$row['pharm_qty'];
    
    ?>
<?php }?>
<span><input type="hidden" name="id" value="<?php echo $drug; ?>">
<input type="number"  value="<?php echo $price; ?>" >
<input type="number"  value="<?php echo $qty; ?>" >
<input name="qty" style="height: 2em;width:3em;" type="number" min="1" max="<?php echo $qty;  ?>" placeholder="qty" required/>
    
    <?php
mysqli_close($con);
?>

</body>
</html>