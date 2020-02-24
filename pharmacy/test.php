<!DOCTYPE html>
<html>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

// Create connection
$sql = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($sql->connect_error) {
    die("Connection failed: " . $sql->connect_error);
} 
$number = range(1,20);
$values ="','NULL','male','surgical'),('";
$value ="','NULL','male','surgical')";
$commaList =  "(" .implode( $values,$number). $value;

$sql = "INSERT INTO `wards` (`id`, `name`, `sex`, `beds`) VALUES (NULL, \'test\', \'f\', \'3\'), (NULL, \'test\', \'f\', \'4\')";
?>


</body>
</html>