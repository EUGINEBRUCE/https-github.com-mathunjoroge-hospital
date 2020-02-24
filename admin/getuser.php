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
$sql="SELECT * FROM user WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    ?>
<style type="text/css">
    input {margin-bottom:5px;}
</style>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<span>username </span><input type="text" name="username" value="<?php echo $row['username']; ?>" style="margin-left: 9.8%;"></br>
<span>password </span><input type="password" name="password" value="<?php echo $row['password']; ?>" style="margin-left: 10%;"></br>
<span>name</span><input type="" name="name" value="<?php echo $row['name']; ?>" style="margin-left: 18.5%;"></br>
<span>usertype</span><select placeholder="select" name="usertype" style="margin-left: 12.5%;width: auto;"><option disabled>select user type</option>
        <option>admin</option>
        <option>cashier</option>
        <option>doctor</option>
        <option>lab</option>
        <option>nurse</option>
        <option>pharmacist</option>        
        <option>registration</option>
        <option>stores</option>
    </select></br>
<?php
}
mysqli_close($con);
?>
</body>
</html>