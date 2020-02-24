<?php
session_start(); 
include('../connect.php');

?>

?>
 <?php
$b = $_POST['gen'];
$c = $_POST['brand'];
$d = $_POST['qty'];
$e = $_POST['price'];
$h = $_POST['reorderph'];
$j = $_POST['reorderst'];

$sql = "INSERT INTO reagents (generic_name,brand_name,quantity,price,reorder_ph,reorder_st) VALUES (:b,:c,:d,:e,:h,:j)";
$q = $db->prepare($sql);
$q->execute(array(':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':h'=>$h,':j'=>$j));
header("location: stocks.php");
?>