<?php
include('../connect.php');
session_start();
$a=date('Y-m-d');
$doctor = $_SESSION['SESS_FIRST_NAME'];
$j = $_POST['pn'];
$physical = $_POST['physical_examination'];
//inserting data into physical examinations table
$sql = "INSERT INTO physicals (patient, description) VALUES (:a, :b)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $j,
':b' => $physical
));
if (isset($_POST['emergency'])) {
$emergency = $_POST['emergency'];
$a = date('Y-m-d H:i:s');
$sql = "INSERT INTO patient_notes (created_at,patient,notes,posted_by) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(
':a' => $a,
':b' => $j,
':c' => $emergency,
':d' => $doctor
));
if (isset($_POST['lab'])) {
$labs = $_POST['lab'];
foreach ($labs as $lab) {
$sql = "INSERT INTO lab (test,opn,reqby) VALUES (:a,:b,:c)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $lab,
':b' => $j,
':c' => $doctor
));
}
}
if (isset($_POST['ddx'])) {
$ddxs = $_POST['ddx'];
foreach ($ddxs as $ddx) {
$sql = "INSERT INTO ddx (patient, disease) VALUES (:a, :b)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $j,
':b' => $ddx
));
}
}
if (isset($_POST['dx'])) {
$dxs = $_POST['dx'];
foreach ($dxs as $dx) {
$sql = "INSERT INTO dx (patient, disease) VALUES(:a,:b)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $j,
':b' => $dx
));
}
}
if (isset($_POST['image'])) {
$images = $_POST['image'];
foreach ($images as $image) {
$sql = "INSERT INTO req_images (test,opn,reqby) VALUES (:a,:b,:c)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $image,
':b' => $j,
':c' => $doctor
));
}
}
header("location: emergency.php?search=%20&response=0&message=1");
exit();
}
$b   = $_POST['hpi'];
$c   = $_POST['pmh'];
$d   = $_POST['cc'];
$e   = $_POST['soh'];
$g   = $_POST['ph'];
$l   = $_POST['fh'];
$sql = "INSERT INTO prescriptions (date,hpi,pmh,cc,soh,mh,opno,fh) VALUES (:a,:b,:c,:d,:e,:g,:j,:l)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $a,
':b' => $b,
':c' => $c,
':d' => $d,
':e' => $e,
':g' => $g,
':j' => $j,
':l' => $l
));
?>
<?php
$reset = 0;
$sql   = "UPDATE patients
SET  served=?
WHERE opno=?";
$q     = $db->prepare($sql);
$q->execute(array(
$reset,
$j
));
?>
<?php
if (isset($_POST['lab'])) {
$labs = $_POST['lab'];
foreach ($labs as $lab) {
$sql = "INSERT INTO lab (test,opn,reqby) VALUES (:a,:b,:c)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $lab,
':b' => $j,
':c' => $doctor
));
}
}
if (isset($_POST['ddx'])) {
$ddxs = $_POST['ddx'];
foreach ($ddxs as $ddx) {
$sql = "INSERT INTO ddx (patient, disease) VALUES (:a, :b)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $j,
':b' => $ddx
));
}
}
if (isset($_POST['dx'])) {
$dxs = $_POST['dx'];
foreach ($dxs as $dx) {
$sql = "INSERT INTO dx (patient, disease) VALUES(:a,:b)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $j,
':b' => $dx
));
}
}
if (isset($_POST['image'])) {
$images = $_POST['image'];
foreach ($images as $image) {
$sql = "INSERT INTO req_images (test,opn,reqby) VALUES (:a,:b,:c)";
$q   = $db->prepare($sql);
$q->execute(array(
':a' => $image,
':b' => $j,
':c' => $doctor
));
}
}
$reset = 0;
$sql   = "UPDATE patients
SET  served=?
WHERE opno=?";
$q     = $db->prepare($sql);
$q->execute(array(
$reset,
$j
));
?>
<?php
if (isset($_GET['resp'])) {
header("location: inpatient.php?search= &response=1");
# code...
}
if (!isset($_GET['resp'])) {
# code...
$code = rand();
header("location: newprescription.php?search=$j&response=0&code=$code");
}
?>