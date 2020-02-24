<?php 
include('../connect.php');
$a=$_POST['fee'];
$b=$_POST['amount'];
$result = $db->prepare("SELECT * FROM fees WHERE `fees_name`=:a");
        $result->bindParam(':a', $a);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: index.php?response=8");
}
  if ($rowcountt==0) {    

$sql = "INSERT INTO `fees` (`fees_name`,`amount`) VALUES ('$a','$b')";
$q = $db->prepare($sql);
$q->execute();


header("location: index.php?response=9");


?>
<?php } ?>
