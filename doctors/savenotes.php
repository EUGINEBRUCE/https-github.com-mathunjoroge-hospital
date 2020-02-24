<?php
session_start(); 
include('../connect.php');

?>

 <?php
$a = date('Y-m-d H:i:s');
$j = $_POST['pn'];
$b = $_POST['notes'];
$doctor =$_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO patient_notes (created_at,patient,notes,posted_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$j,':c'=>$b,':d'=>$doctor));

?>

    <?php
    $reset=0;
$sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$j)); 

?>
<P><?php
if (!empty($_POST['lab'])){
$lab = $_POST['lab'];
$j = $_POST['pn'];
$doctor =$_SESSION['SESS_FIRST_NAME'];
$tags=$lab;
foreach ($tags as $mytag) {
    $inserts="(NULL".","."'".$mytag."'".","."'".$j."'".","."' '".","."'".$doctor."'".")"; 

       $sql = "INSERT INTO `lab` (`id`, `test`, `opn`, `results`, `reqby`) VALUES $inserts";
      $q = $db->prepare($sql);
    $q->execute(); ?></P>
    <?php 
$reset=0;
$sql = "UPDATE patients
        SET  served=?
        WHERE opno=?";
        $q = $db->prepare($sql);
        $q->execute(array($reset,$j));
        } ?>
    

    <?php 
    $image=$_POST['image'];
    if (isset($image)) {
        $im=implode(',', $_POST['image']);

        header("location: saveimage.php?image=$im&pn=$j");
        
    }
    if (!isset($image)) {
    header("location: inpatient.php?search= &response=1"); 
}
?>
<?php } ?>
<?php 
 header("location: inpatient.php?search= &response=1"); 
?>

    