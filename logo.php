<?php 
unlink('index.php');
rename('localview.php', 'index.php');
header ("location: index.php");
?>