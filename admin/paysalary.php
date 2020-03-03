<?php
session_start();
include('../connect.php');
$a=$_POST["employee"];
$b=$_POST["net_pay"];

if (isset($_POST["all_id"])) {
	$cs=explode(",",$_POST["all_id"]);  //allowance ids for future ref
} else {
	$cs = 0;
}
if (isset($_POST["alowances"])) {
	$ds=explode(",",$_POST["alowances"]);//amounts for the allwance
} else {
	$ds = 0;
}
	
$e=$_POST["nhif"];//amount paid for nhif
$f=$_POST["tax"];//amount posted for tax note autocalculated
$g=$_POST["nssf"];//amount posted for nssf
$date=date("Y-m-d H:i:s");
$dw=$_POST["dw"];
$gross_pay=$_POST["gross_pay"];
if (isset($cs)) {
		# code...
	foreach (array_combine($cs, $ds) as $c => $d){
		//insert allowances
		$sql = "INSERT INTO allowance_payments (employee_id,all_id,amount,date) VALUES (:a,:b,:c,:d)";
		$q = $db->prepare($sql);
		$q->execute(array(':a'=>$a,':b'=>$c,':c'=> $d,':d'=> $date));
	}
}
//insert basic salaries
$sql = "INSERT INTO salaries_payments (employee_id,amount,date,dw,gross_pay) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=> $date,':d'=> $dw,':e'=> $gross_pay));
//post nhif paid
$sql = "INSERT INTO nhif_payments (employee_id,amount,date) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$e,':c'=> $date));
//post tax paid
$sql = "INSERT INTO tax_paid (employee_id,amount,date) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$f,':c'=> $date));
//post nssf paid
$sql = "INSERT INTO nssf_payable (employee_id,amount,date) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$g,':c'=> $date));
//update that the salary has been paid
$reset=2;
$sql = "UPDATE employees
        SET  status=?
		WHERE employee_id=?";
		$q = $db->prepare($sql);
$q->execute(array($reset,$a));
//redirect to original page 
header("location:payslip_print.php?employee_id=$a&nfdw=$dw");



?>
