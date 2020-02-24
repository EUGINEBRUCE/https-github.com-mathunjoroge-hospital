<?php
session_start(); 
include('../connect.php');
$a=$_POST['employee_name'];
$b=$_POST['id_number'];
$c = $_POST['jg']; 
$d=$_POST['nhif'];
$e = $_POST['nssf'];   
$f = $_POST['acc'];
$g= $_POST['bank'];
$id= $_POST['id'];       
$sql = "UPDATE employees
        SET  employee_name=?,
             id_no=?, 
             jg_id=?,
             nhif=?,
             nssf=?,
             account_number=? ,
            bank= ?           
		WHERE employee_id= ?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$d,$e,$f,$g,$id));
header("location: payroll.php?response=0&page=payrol");

 ?>
 