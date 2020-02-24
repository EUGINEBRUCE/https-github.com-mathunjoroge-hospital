<?php
session_start(); 
include('../connect.php');
$a= implode(",", $_POST['qty']);
$b=$_POST['drug_id'];
$c= implode(",", $_POST['disp_id']);
$d=$_POST['pn'];
$vs= explode(",", $c); //vs== disp ids
$ws=explode(",", $a);// ws== qty
foreach (array_combine($vs, $ws) as $v => $w){ 
    ?>
    <p><?php
$sql = "UPDATE dispensed_reagents
        SET  quantity=$w
        WHERE dispense_id=$v";
        $q = $db->prepare($sql);
        $q->execute();
   // ==============================================>
    $drug_ids=implode(",", $b); // array for drug ids
    $qtys= $a; // array for qtys

 ?>

</p>
<?php
$posted_by=$_SESSION['SESS_FIRST_NAME'];
$reset=1;
$date=date('Y-m-d H:i:s');
$sql = "UPDATE dispensed_reagents
        SET  cashed_by=?,
        updated_at=?,
        dispensed=?
        WHERE patient=?";
        $q = $db->prepare($sql);
        $q->execute(array($posted_by,$date,$reset,$d));
       
       header("location: resaveorder.php?qty=$qtys&ids=$drug_ids");

 ?>
<?php } ?>
    