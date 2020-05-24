<?php
session_start(); 
include('../connect.php');
$a=$_POST['id'];
$b=$_POST['name'];
$c=(($_POST['mark_up']/100)+1);
$sql = "UPDATE insurance_companies
SET  name=?,
ins_mark_up=?            
WHERE company_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$c,$a));
header("location: insurance.php?response=2");

?>
