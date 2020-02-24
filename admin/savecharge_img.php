<?php
session_start(); 
include('../connect.php');
$a = $_POST['amount'];
$b = $_POST['name'];
$c = $_POST['payable'];
$result = $db->prepare("SELECT * FROM imaging WHERE `imaging_name`=:a");
        $result->bindParam(':a', $a);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: fees.php?response=4");
}
  if ($rowcountt==0) {    

$sql = "INSERT INTO `imaging` (`cost`,`imaging_name`,`payable_before`) VALUES ('$a','$b','$c')";
$q = $db->prepare($sql);
$q->execute();
header("location: fees.php?response=5");
}
?>
