<?php 
include('../connect.php');
$a=$_POST['expense_name'];
$result = $db->prepare("SELECT * FROM expenses WHERE `expense_name`=:a");
        $result->bindParam(':a', $a);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: fees.php?response=10");
}
  if ($rowcountt==0) {    

$sql = "INSERT INTO `expenses` (`expense_name`) VALUES ('$a')";
$q = $db->prepare($sql);
$q->execute();


header("location: fees.php?response=11");


?>
<?php } ?>
