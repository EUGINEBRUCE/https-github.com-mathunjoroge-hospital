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

$con = mysqli_connect('localhost','root','','hospital');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM wards WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
?>
<style type="text/css">
    input {margin-bottom:5px;}
</style>
<input type="hidden" name="id" value="<?php echo $row['name']; ?>">
<span>name </span><input type="text" name="name" value="<?php echo strtok($row['name'], '-'); ?>" style="margin-left: 9.8%;"></br>
<span>charges</span><input type="text" name="charges" value="<?php echo strtok($row['charges'], '-'); ?>" style="margin-left: 9.8%;"></br>
<span>sex </span><input type="tex" name="sex" value="<?php echo substr($row['name'], strpos($row['name'], '-')+1); ?>" style="margin-left: 10%;" readonly/></br>
<span>sex</span><select placeholder="select" name="sex" style="margin-left: 12.5%;width: auto;"><option disabled>select sex</option>
        <option>male</option>
        <option>female</option>
        <option>pediatric</option>
    </select></br>
<?php
}
mysqli_close($con);
?>
</body>
</html>