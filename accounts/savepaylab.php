<?php
session_start(); 
include('../connect.php');
    $a=$_POST['amount'];
    $id=$_POST['id'];
    $tender=$_POST['tendered'];
    $cashier=$_SESSION['SESS_FIRST_NAME'];
    $reset=1;
    $date=date('Y-m-d H:i:s');

$sql = "UPDATE lab
        SET  paid=?
		WHERE opn=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$id));


$sql = "INSERT INTO lab_cash (amount,cashtendered,tendered_by,patient) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$tender,':c'=> $cashier,':d'=> $id));


	?>
	 
<?php 
header("location: receiptlab.php?search=$id&response=0&cash=$tender"); 
 ?>
