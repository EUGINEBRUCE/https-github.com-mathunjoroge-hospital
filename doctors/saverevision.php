<?php
session_start(); 
include('../connect.php');
    $a=$_POST['plan'];
    $id=$_POST['id'];
    $pn=$_POST['pn'];
    $previous=$_POST['previous'];
    $date=date('Y-m-d');
$sql = "UPDATE prescriptions
        SET  plan=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$id)); 
if (!empty($previous)) {	
$d = $_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO revised_prescriptions (patient,previous,date,edited_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$pn,':b'=>$previous,':c'=>$date,':d'=>$d));
}
 ?>
 <?php
 header("location: revise.php?search=$pn&response=1");
  ?>