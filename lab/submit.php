<?php 
include("../connect.php");
$data=$_POST["mydata"];
$test=$_POST["test_id"];
$patient=$_POST["pn"];
$sql = "UPDATE lab
        SET  lab_template=?
        WHERE id=? AND opn=?";
        $q = $db->prepare($sql);
        $q->execute(array($data,$test,$patient));
        header("location:index.php?search=$patient&response=0");
?>