<?php 
include('../connect.php');
$a=$_POST['name'];
$b=(($_POST['mark_up']/100)+1);
$result = $db->prepare("SELECT * FROM insurance_companies WHERE `name`=:a");
        $result->bindParam(':a', $a);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt>0) {
	header("location: insurance.php?response=8");
}
  if ($rowcountt==0) {    

$sql = "INSERT INTO insurance_companies (name,ins_mark_up) VALUES ('$a','$b')";
$q = $db->prepare($sql);
$q->execute();


header("location: insurance.php?response=9&name=$a");
?>
<?php } ?>