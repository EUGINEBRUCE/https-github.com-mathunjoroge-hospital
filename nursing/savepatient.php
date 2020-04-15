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
//post data to gyn table if is posted
if (isset($_POST['lmp'])) {
$lmp = date("Y-m-d", strtotime($_POST['lmp']));
$edd = date("Y-m-d", strtotime($_POST['edd']));
$para = $_POST['para'];
$gravid = $_POST['gravid'];
$live_births = $_POST['live_births'];
$births_alive = $_POST['births_alive'];
$sql = "INSERT INTO gyn (patient,lmp,edd,para,gravid,live_births,births_alive) VALUES (:a,:b,:c,:d,:e,:f,:g)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$d,':b'=>$lmp,':c'=>$edd,':d'=>$para,':e'=>$gravid,':f'=>$live_births,':g'=>$births_alive));
	
}
//remove patient from waiting list
$reset=0;
$sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$d));
header("location: index.php?search= &response=1");	
?>