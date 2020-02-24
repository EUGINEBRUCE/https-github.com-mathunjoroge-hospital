<!DOCTYPE html>
<html>
<body>

<?php
$a=$_GET['bed'];
if ($a>0) {
  # code...

include('../connect.php');
$a=$_GET['bed'];
$b=$_GET['sex'];
$c=$_GET['name'];

$result = $db->prepare("SELECT * FROM wards WHERE `name`=:a AND `sex`=:b");
        $result->bindParam(':a', $c);
		$result->bindParam(':b', $b);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt==0) {
        	# code...
        

$number = range(1,$a);
$values ="','NULL','$b','$c'),('";
$value ="','NULL','$b','$c')";

$commaList =  "('" .implode( $values,$number). $value;

$sql = "INSERT INTO `wards` (`beds`,`id`,`sex`,`name`) VALUES $commaList";
$q = $db->prepare($sql);
$q->execute();

?>
<div class="container">
	<div class="alert alert-success" style="width: 50%;margin-left: 10%;margin-top: -30%;"><p>Ward has been created successifuly!</p></div></div>
<?php
}
if ($rowcountt>0) { ?>
<div class="container">
	<div class="alert alert-danger" style="width: 50%;margin-left: 10%;margin-top: -30%;"><p>that ward already exists. create a ward with a different name</p></div></div>

<?php }

?>
<?php } ?>

</body>
</html>