<?php 

include("../connect.php");
$id=$_POST["id"];
$data=$_POST["mytable"];
$sql = "UPDATE lab_tests
        SET  template=?            
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($data,$id));
header("location: fees.php?response=6");
?>