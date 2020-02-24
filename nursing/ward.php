<?php 
$a=$_GET['ward'];
$b=$_GET['sex'];
$c=$_GET['name'];
$d=$_GET['name']."-".$b;

$result = $db->prepare("SELECT * FROM wards WHERE `name`=:a");
        $result->bindParam(':a', $d);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt==0) {    

$number = range(1,$a);
$values ="','NULL','$d'),('";
$value ="','NULL','$d')";

$commaList =  "('" .implode( $values,$number). $value;

$sql = "INSERT INTO `wards` (`beds`,`id`,`name`) VALUES ('$a','NULL','$d')";
$q = $db->prepare($sql);
$q->execute();
$sql = "INSERT INTO `beds` (`bed_no`,`id`,`ward`) VALUES $commaList";
$q = $db->prepare($sql);
$q->execute();

?>
<div class="container">
	<div class="alert alert-success" style="width: 50%;margin-left: 10%;margin-top: -30%;"><p><?php echo $d;  ?> has been created successifuly!</p></div></div>
<?php
}
if ($rowcountt>0) { ?>
<div class="container">
	<div class="alert alert-danger" style="width: 50%;margin-left: 10%;margin-top: -30%;"><p><?php echo $d;  ?> already exists. create a ward with a different name</p></div></div>

<?php }

?>
<?php } ?>
</body>
</html>