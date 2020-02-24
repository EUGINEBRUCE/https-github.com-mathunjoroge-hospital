<?php 
include('../connect.php');
$a=$_POST['ward'];
$b=$_POST['sex'];
$c=$_POST['beds'];
$d=$_POST['ward']."-".$b;
$e=$_POST['charges'];

$result = $db->prepare("SELECT * FROM wards WHERE `name`=:a");
        $result->bindParam(':a', $d);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: index.php?response=5");
}
  if ($rowcountt==0) {    

$number = range(1,$c);
$values ="','NULL','$d'),('";
$value ="','NULL','$d')";

$commaList =  "('" .implode( $values,$number). $value;

$sql = "INSERT INTO `wards` (`beds`,`id`,`name`,`charges`) VALUES ('$c','NULL','$d','$e')";
$q = $db->prepare($sql);
$q->execute();
$sql = "INSERT INTO `beds` (`bed_no`,`id`,`ward`) VALUES $commaList";
$q = $db->prepare($sql);
$q->execute();
if (isset($_POST["trigger"])) {

	header("location: fees.php?response=1");
	# code...
}
else{

header("location: index.php?response=4");
}

?>
<?php } ?>
