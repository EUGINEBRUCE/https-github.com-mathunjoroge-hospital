<?php
if (isset($_SESSION['SESS_MEMBER_ID'])) {
$result = $db->prepare("SELECT * FROM settings");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				    $useFdaDrugsList =$row['fda_user'];
				    
				}
}
else{
		
	}
?>