<?php 
include('../connect.php');
$surg_id=$_GET['id'];
$result = $db->prepare("SELECT surgical_notes,surge_done_on  FROM surgeries  WHERE surg_id=:a");
        $result->BindParam(':a',$surg_id);
        $result->execute();
       for($i=0; $row = $result->fetch(); $i++){        
      $notes = $row['surgical_notes'];
      $date = $row['surge_done_on'];

?>
<div>
	<label>surgical notes for surgery done on <?=$date;  ?> </label>
	<?=$notes; } ?>
</div>