<?php
session_start(); 
include('../connect.php');
    $id=$_POST['patient'];
    $a=$_POST['clinic'];
    $c=$_POST['total'];
      
 $aas=explode(",",$a);
foreach ($aas as $aa) {
    
      ?>
<p><?php 
       $sql = "INSERT INTO `clinic_fees` (`clinic_id`, `patient`) VALUES ( '$aa', '$id')";
       $q = $db->prepare($sql);
       $q->execute();

 ?>
</p>
    <?php
    $served=0;
    $sql = "UPDATE patients
        SET  served=?
    WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($served,$id));
    header("location: pclinics.php?search= &response=4");
     }
    ?>