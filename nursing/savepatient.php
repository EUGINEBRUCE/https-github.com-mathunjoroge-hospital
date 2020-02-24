<?php
session_start();
include('../connect.php');
$a = date('Y-m-d');
$b = $_POST['sys'];
$c = $_POST['height'];
$d = $_POST['opno'];
$e = $_POST['dys'];
$f = $_POST['rate'];
$g = $_POST['weight'];
$h = $_POST['temp'];
$j = $_POST['br'];
$k = $_POST['rbs'];
$l = $_POST['muac'];
$sql = "INSERT INTO vitals (date,systolic,height,pno,diastolic,rate,weight,temperature,breat_rate,rbs,muac) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:j,:k,:l)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h,':j'=>$j,':k'=>$k,':l'=>$l));
//remove patient from waiting list
$reset=0;
$sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$d));
header("location: index.php?search= &response=1");	
?>