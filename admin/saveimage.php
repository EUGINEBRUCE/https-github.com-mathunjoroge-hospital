<?php 
include('../connect.php');
$a=$_POST['image'];
$b=$_POST['amount'];
$result = $db->prepare("SELECT * FROM imaging WHERE `imaging_name`=:a");
        $result->bindParam(':a', $a);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: index.php?response=12");
}
  if ($rowcountt==0) {    

$sql = "INSERT INTO `imaging` (`imaging_name`,`cost`) VALUES ('$a','$b')";
$q = $db->prepare($sql);
$q->execute();


header("location: index.php?response=13");


?>
<?php } ?>
