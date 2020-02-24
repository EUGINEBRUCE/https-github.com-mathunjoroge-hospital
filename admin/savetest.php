<?php 
include('../connect.php');
$a=$_POST['test'];
$b=$_POST['amount'];
$c = $_POST['payable'];
$result = $db->prepare("SELECT * FROM lab_tests WHERE `name`=:a");
        $result->bindParam(':a', $a);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: index.php?response=14");
}
  if ($rowcountt==0) {    

$sql = "INSERT INTO `lab_tests` (`name`,`cost`,`payable_before`) VALUES ('$a','$b','$c')";
$q = $db->prepare($sql);
$q->execute();
}

if (isset($_POST["trigger"])) {

	header("location: fees.php?response=1");
	# code...
}
else{
	# code...
header("location: index.php?response=15");
?>
<?php } ?>
