<?php
include('../connect.php');
session_start(); 
$a = date('Y-m-d');
$doctor =$_SESSION['SESS_FIRST_NAME'];
$j = $_POST['pn'];
$emergency= $_POST['emergency'];
if (isset($_POST['emergency'])) {
    $a = date('Y-m-d H:i:s');
$sql = "INSERT INTO patient_notes (created_at,patient,notes,posted_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$j,':c'=>$emergency,':d'=>$doctor));
if (isset($_POST['lab'])){
$labs = $_POST['lab'];
foreach ($labs as $lab) {
     $sql = "INSERT INTO `lab` (`test`,`opn`,`reqby) VALUES ('$lab', '$j', '$doctor')";
      $q = $db->prepare($sql);
      $q->execute();
  }
}

if (isset($_POST['ddx'])) {
     $ddxs=$_POST['ddx'];
     foreach ($ddxs as $ddx) {
        $differential_ddx="("."'".$ddx."'".","."'".$j."'".")";

    $sql = "INSERT INTO `ddx` (`patient`, `disease`) VALUES ('$j', '$ddx')";
      $q = $db->prepare($sql);
      $q->execute();
    # code...
}
}
if (isset($_POST['dx'])) {
     $dxs=$_POST['dx'];
     foreach ($dxs as $dx) {

    $sql = "INSERT INTO `dx` (`patient`, `disease`) VALUES ('$j', '$dx')";
      $q = $db->prepare($sql);
      $q->execute();
    # code...
}
}

if (isset($_POST['image'])){
$images = $_POST['image'];
   foreach ($images as $image) {
    $sql = "INSERT INTO `req_images` (`test`,`opn`,`reqby) VALUES ('$lab', '$image', '$doctor')";
      $q = $db->prepare($sql);
      $q->execute();
    }
    
} 
header("location: emergency.php?search=%20&response=0&message=1");
exit();
    }
$b = $_POST['hpi'];
$c = $_POST['pmh'];
$d = $_POST['cc'];
$e = $_POST['soh'];
$g = $_POST['ph'];
$l = $_POST['fh'];
$sql = "INSERT INTO prescriptions (date,hpi,pmh,cc,soh,mh,opno,fh) VALUES (:a,:b,:c,:d,:e,:g,:j,:l)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':g'=>$g,':j'=>$j,':l'=>$l));
?>
<?php
    $reset=0;
    $sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$j)); 

?>
<?php
if (isset($_POST['lab'])){
$labs = $_POST['lab'];
foreach ($labs as $lab) {
     $sql = "INSERT INTO `lab` (`test`,`opn`,`reqby`) VALUES ('$lab', '$j', '$doctor')";
      $q = $db->prepare($sql);
      $q->execute();
  }
}

if (isset($_POST['ddx'])) {
     $ddxs=$_POST['ddx'];
     foreach ($ddxs as $ddx) {
      $sql = "INSERT INTO `ddx` (`patient`, `disease`) VALUES ('$j', '$ddx')";
      $q = $db->prepare($sql);
      $q->execute();
    # code...
}
}
if (isset($_POST['dx'])) {
     $dxs=$_POST['dx'];
     foreach ($dxs as $dx) {

    $sql = "INSERT INTO `dx` (`patient`, `disease`) VALUES ('$j', '$dx')";
      $q = $db->prepare($sql);
      $q->execute();
    # code...
}
}

if (isset($_POST['image'])){
$images = $_POST['image'];
   foreach ($images as $image) {
    $sql = "INSERT INTO `req_images` (`test`,`opn`,`reqby) VALUES ('$lab', '$image', '$doctor')";
      $q = $db->prepare($sql);
      $q->execute();
    }
} 

$reset=0;
$sql = "UPDATE patients
        SET  served=?
		WHERE opno=?";
		$q = $db->prepare($sql);
        $q->execute(array($reset,$j)); 
         ?>
         <?php
    if (isset($_GET['resp'])) {
        header("location: inpatient.php?search= &response=1");
        # code...
    }
    if (!isset($_GET['resp'])) {
        # code...
        $code=rand();
    
    header("location: newprescription.php?search=$j&response=0&code=$code"); 
     } ?>
