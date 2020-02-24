<?php
session_start(); 
include('../connect.php');
    $a=$_POST['id'];
    $b=$_POST['notes'];
    $e=$_POST['search'];
    $c=1;
    $d=date('m-d-y H:i:s');      
   $sql = "UPDATE surgeries     
        SET  surgical_notes=?,
             status=?,
             surge_done_on=?           
		WHERE surg_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$c,$d,$a));
$code=rand();
header("location: prescribe_inp.php?search=2/2019&code=$code&response=0"); ?>