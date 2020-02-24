<?php
session_start(); 
include('../connect.php');
$a=$_GET['qty'];
$b=$_GET['ids'];
$vs=explode(",",$b);
$ws=explode(",",$a);
foreach (array_combine($vs, $ws) as $v => $w){ 
    ?>
    <p><?php
$sql = "UPDATE reagents
        SET  pharm_qty=pharm_qty-$w
        WHERE drug_id=$v";
        $q = $db->prepare($sql);
        $q->execute();

 ?>

</p>
<?php
        header("location: index.php?search=%20&response=5");

 ?>
<?php } ?>
    