<?php
session_start(); 
include('../connect.php');
?>

 <?php

$j = $_POST['pn'];
$b = $_POST['dx'];
$d = date('Y-m-d h:i:s');
$e=$_SESSION['SESS_FIRST_NAME'];
$f = $_POST['plan'];
?>
<?php
    $reset=0;
$sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$j)); 

?><?php
if (isset($_POST['lab'])){
$lab = $_POST['lab'];
$j = $_POST['pn'];
$doctor =$_SESSION['SESS_FIRST_NAME'];
$tags=$lab;
foreach ($tags as $mytag) {
    $inserts="(NULL".","."'".$mytag."'".","."'".$j."'".","."' '".","."'".$doctor."'".")"; 
       $sql = "INSERT INTO `lab` (`id`, `test`, `opn`, `results`, `reqby`) VALUES $inserts";
      $q = $db->prepare($sql);
    $q->execute(); ?></P>
<?php } ?><?php } ?>

 <?php
if (isset($_POST['image'])){
$image = $_POST['image'];
$j = $_POST['pn'];
$doctor =$_SESSION['SESS_FIRST_NAME'];
$matags=$image;
foreach ($matags as $matag) {
    $inserted_im="(NULL".","."'".$matag."'".","."'".$j."'".","."' '".","."'".$doctor."'".")"; 
    echo $inserted_im;
       $sql = "INSERT INTO `req_images` (`id`, `test`, `opn`, `results`, `reqby`) VALUES $inserted_im";
       $q = $db->prepare($sql);
    $q->execute(); ?>
<?php } ?>
<?php } ?>
    <?php 
$reset=0;
$sql = "UPDATE patients
        SET  served=?
        WHERE opno=?";
        $q = $db->prepare($sql);
        $q->execute(array($reset,$j));

    if (isset($_POST['dx'])) {
     $dxs=$_POST['dx'];
     foreach ($dxs as $dx) {

    $sql = "INSERT INTO `dx` (`patient`, `disease`) VALUES ('$j', '$dx')";
      $q = $db->prepare($sql);
      $q->execute();
    # code...
}
}
         ?>
         <?php
        header("location: lab.php?search=$j&response=0");
        # code...
     ?>