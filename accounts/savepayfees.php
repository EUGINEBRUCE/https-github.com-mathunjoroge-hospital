<?php
session_start(); 
include('../connect.php');
    $a=$_POST['amount'];
    $id=$_POST['id'];
    $tender=$_POST['tendered'];
    $cashier=$_SESSION['SESS_FIRST_NAME'];
    $reset=1;
    $date=date('Y-m-d H:i:s');
$sql = "UPDATE collection.
        SET  paid=?,
             cashed_by=?
	   WHERE patient=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$cashier,$id));


$sql = "INSERT INTO fees_total (amount,cashtendered,tendered_by,paid_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$tender,':c'=> $cashier,':d'=> $id));
//ALTER TABLE `clinics_total` ADD `cashtendered` INT(10) NOT NULL AFTER `tendered_by`;


	?>
	 
<?php 
header("location: receiptfees.php?search=$id&response=0&cash=$tender"); 
 ?>
