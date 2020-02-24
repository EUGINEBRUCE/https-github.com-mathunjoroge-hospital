<?php 
include('../connect.php');
$tag="mathu ondiek, kamau mucunu, john muchir, mwangi";
$tags= explode(",", $tag);

foreach ($tags as $mytag) {	

?>


	<?php $inserts="(NULL".","."'".$mytag."'".","."'15/2018'".","."' '".","."'mathu')";	



	  ?>
	 
	  <P><?php
	  include('../connect.php');
	   $sql = "INSERT INTO `lab` (`id`, `test`, `opn`, `results`, `reqby`) VALUES $inserts";
	  $q = $db->prepare($sql);
    $q->execute(); ?></P>

	

<?php } ?>


	

