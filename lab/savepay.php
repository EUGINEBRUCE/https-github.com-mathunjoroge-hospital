<?php
session_start(); 
include('../connect.php');
    $a=$_POST['amount'];
    $id=$_POST['id'];
    $tender=$_POST['tendered'];
    $cashier=$_SESSION['SESS_FIRST_NAME'];
    $reset=1;
    $date=date('Y-m-d H:i:s');

$sql = "UPDATE dispensed_drugs
        SET  dispensed=?,
             updated_at=?,
             cashed_by=?
		WHERE patient=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$date,$cashier,$id));

$deset=7;
$sql = "UPDATE patients
        SET  served=?             
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($deset,$id));

$sql = "INSERT INTO cash (amount,cashtendered,tendered_by,patient) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$tender,':c'=> $cashier,':d'=> $id));


	?>
	 <?php
  $g=$_POST['drug_id'];  
 $vs=explode(",",$g);
 $h=$_POST['quantity'];
 $ws=explode(",",$h);
foreach (array_combine($vs, $ws) as $v => $w){

	 
 ?>
<p><?php
$sql = "UPDATE drugs
        SET  quantity=quantity-$w
		WHERE drug_id=$v";
		$q = $db->prepare($sql);
        $q->execute();
 ?>
</p> 
<?php 

} ?>
<?php 
header("location: receipt.php?search=$id&response=0&cash=$tender"); 
 ?>
