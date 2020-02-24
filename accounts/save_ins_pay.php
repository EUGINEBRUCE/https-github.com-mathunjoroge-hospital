<?php
session_start();
include('../connect.php');
$as=$_POST["receipt"];
$reset=1;
foreach ($as as $a) {
	# code...

$sql = "UPDATE receipts
        SET  status=?
		WHERE receipt_no=?";
		$q = $db->prepare($sql);
$q->execute(array($reset,$a));
}
//redirect to original page 
header("location:ins_pay.php?status=1");
?>