<?php
session_start();

include('../connect.php');
$a=$_GET['id'];
$sql = "DELETE FROM `orders` WHERE `dispense_id` = $a";
$q = $db->prepare($sql);
$q->execute();

?>
<script type="text/javascript">
	history.back();
</script>