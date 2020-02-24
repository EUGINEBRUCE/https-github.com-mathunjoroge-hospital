<?php 
include('../connect.php');
$a=$_POST['clinic'];
$b=$_POST['amount'];
$c=$_POST['payable'];
$result = $db->prepare("SELECT * FROM clinics WHERE `clinic_name`=:a");
        $result->bindParam(':a', $a);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: index.php?response=10");
}
  if ($rowcountt==0) {    

$sql = "INSERT INTO `clinics` (`clinic_name`,`cost`,`payable_before`) VALUES ('$a','$b','$c')";
$q = $db->prepare($sql);
$q->execute();


header("location: index.php?response=11");


?>
<?php } ?>
