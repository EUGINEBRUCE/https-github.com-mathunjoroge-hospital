<?php
session_start(); 
include('../connect.php');
    $a=$_POST['id'];
    $b=date('Y-m-d H:i:s');
    $c=2;     
   $sql = "UPDATE surgeries     
        SET  sign_in=?,
             surgery_stop=?           
		WHERE surg_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b,$a));
header("location: theatre.php?response=4"); ?>