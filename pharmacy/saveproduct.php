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
$f = $_POST['category'];
$k= $_POST['selling'];
$g=(($k-$e)/$e)+1;
$h = $_POST['reorderph'];
$j = $_POST['reorderst'];

$sql = "INSERT INTO drugs (generic_name,brand_name,quantity,price,category,mark_up,reorder_ph,reorder_st) VALUES (:b,:c,:d,:e,:f,:g,:h,:j)";
$q = $db->prepare($sql);
$q->execute(array(':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':j'=>$j));
header("location: stocks.php");
?>