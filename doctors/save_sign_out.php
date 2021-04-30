<?php
session_start(); 
include('../connect.php');
    $a=$_POST['id'];
    $b=date('Y-m-d H:i:s');
    $c=2;   
    $d=1;  
   $sql = "UPDATE surgeries     
        SET  sign_in=?,
        surge_done_on=?,
        surgery_stop=?,
        status=?
		WHERE surg_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b,$b,$d,$a));
header("location: theatre.php?response=4"); ?>