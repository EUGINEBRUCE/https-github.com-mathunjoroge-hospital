 <?php
session_start(); 
include('../connect.php');

?>
<?php 
$j = $_GET['pn'];
$image = $_GET['image'];
$doctor =$_SESSION['SESS_FIRST_NAME'];

$arr = explode(',', $image);
foreach ($arr as $value) { ?>
	<P><?php 
    
    $insertss="(NULL".","."'".$value."'".","."'".$j."'".","."' '".","."'".$doctor."'".")"; 

       $sql = "INSERT INTO `req_images` (`id`, `test`, `opn`, `results`, `reqby`) VALUES $insertss";
      $q = $db->prepare($sql);
    $q->execute(); ?></P>
    
 <?php } ?>
    
  