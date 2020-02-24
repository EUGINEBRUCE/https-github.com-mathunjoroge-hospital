<?php
session_start(); 
include('../connect.php');
$a = $_POST['pn'];
$b = $_POST['id'];
$c = $_POST['qty'];
$token = $_POST['token'];
$d = $_SESSION['SESS_FIRST_NAME'];
$e = $_POST['adm'];
if ($e>0) {
	$sql = "UPDATE drugs
        SET  pharm_qty=pharm_qty-?
		WHERE drug_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$b));
?>
<?php } ?>
<?php 
$sql = "INSERT INTO dispensed_drugs (patient,drug_id,quantity,posted_by,token) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$token));
?>
	<script type="text/javascript">
		history.back();
	</script>

