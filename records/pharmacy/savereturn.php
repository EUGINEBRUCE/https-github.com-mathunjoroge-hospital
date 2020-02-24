<?php
session_start(); 
include('../connect.php');
$a = $_POST['pn'];
$b = $_POST['id'];
$c = $_POST['qty'];
$d = $_SESSION['SESS_FIRST_NAME'];
$e = $_POST['adm'];
$sql = "INSERT INTO returned_drugs (patient,drug_id,quantity,posted_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));
if ($e==1) {
	$sql = "UPDATE drugs
        SET  pharm_qty=pharm_qty+?
		WHERE drug_id=?";
		//update quantity because patient is admitted
$q = $db->prepare($sql);
$q->execute(array($c,$b));
}

    header("location: return.php?search=$a&response=0"); 
?>

    