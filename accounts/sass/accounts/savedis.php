<?php
session_start(); 
include('../connect.php');
    $id=$_POST['id'];
    $a=$_POST['pharm'];
    $b=$_POST['lab'];
    $c=$_POST['clin'];
    $d=$_POST['collection'];
    $e=$_POST['grand'];
    $tender=$_POST['tendered'];
    $cashier=$_SESSION['SESS_FIRST_NAME'];
    $reset=1;
    $date=date('Y-m-d');
    // relese the patent
$sql = "UPDATE admissions
        SET  discharged=?,
             discharge_date=?             
		  WHERE  ipno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$date,$id));
// release bed
$pt="";
$occ=0;
$sql = "UPDATE beds
        SET  patient=?,
             ocuppied=?             
          WHERE  patient=?";
$q = $db->prepare($sql);
$q->execute(array($pt,$occ,$id));
//save for pharmacy
$sql = "INSERT INTO cash (amount,cashtendered,tendered_by,patient) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$a,':c'=> $cashier,':d'=> $id));
//save for clinics
$sql = "INSERT INTO clinics_total (amount,cashtendered,tendered_by,paid_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$c,':b'=>$c,':c'=> $cashier,':d'=> $id));
//save for fees
$sql = "INSERT INTO fees_total (amount,cashtendered,tendered_by,paid_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$d,':b'=>$b,':c'=> $cashier,':d'=> $id));
// save for lab
$sql = "INSERT INTO lab_cash (amount,cashtendered,tendered_by,patient) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$b,':b'=>$b,':c'=> $cashier,':d'=> $id));
	
header("location: discharge_rct.php?search=$id&response=0&cash=$tender&grand=$e"); 
 ?>
