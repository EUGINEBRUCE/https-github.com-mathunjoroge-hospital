<?php 
require_once('../main/auth.php');
?>
<!DOCTYPE html>
<html>
<title>patient history</title>
<?php
include "../header.php";
?>
</head>

<body>
<header class="header clearfix" style="background-color: #3786d6;">
</button>
<?php include('../main/nav.php'); ?>   
</header><?php include('side.php'); ?>

<div class="content-wrapper" style=" background-image: url('../images/doctor.jpg');">

<div class="jumbotron" style="background: #95CAFC;">
<nav aria-label="breadcrumb" style="width: 90%;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">patient history</li>
<?php
$search=$_GET['search'];
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$a=$row['name'];
$c=$row['sex'];


?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php } ?>
</ol>
</nav>    
<form action="history.php" method="GET">
<span><?php
include "../pharmacy/patient_search.php";
?>
<input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
<div class="suggestionsBox" id="suggestions" style="display: none;">
<div class="suggestionList" id="suggestionsList"> &nbsp; </div></form></div>
<p>&nbsp;</p>
<?php
if ($search!=0) {
# code...

?>
<div class="container">
    <?php if($_SESSION['SESS_LAST_NAME']=="pharmacist" ||$_SESSION['view_as']=="pharmacist" ){ ?>
    <input type="button" value="less details/ more details" id="myButton1" onclick="myFunction()"></input> 
   <?php } ?>
<div class="container" id="details">
  <h4>physical examination</h4>
  <?php
$result = $db->prepare("SELECT * FROM physicals WHERE patient=:patient");
$result->BindParam(':patient', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$date=date("d-m-Y H:i:s", strtotime($row['date']));
$description=$row['description'];
$datep=$row['date'];     
?>
<p>
  <h5><?php echo $date; ?></h5>
  <?php echo $description; ?>
</p>
<?php } ?>
       
<center>diagnosis and prescriptions</center>
<div class="container" id="content">
<table class="table table-bordered"  >
<thead class="bg-primary">
<tr>
<th>date</th>
<th>cc</th>
<th>hpi</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT * FROM prescriptions WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$cc=$row['cc'];
$hpi=$row['hpi'];
$datep=date("d-m-Y H:i:s", strtotime($row['date']));     
?>
<tbody>
<tr>
<?php if (!empty($cc)) {
# code...
?>
<td><?php echo $datep;?></td>
<td><?php echo $cc;?></td>
<td><?php echo $hpi;?></td><?php } ?><?php }?>
</tr>
</tbody>
</table>
<hr>
<label>differential diagnosis</label>
<table class="table table-bordered"  >
<thead class="bg-primary">
<tr>
<th>date</th>
<th>differential diagnosis</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT * FROM ddx JOIN icd_second_level_codes ON ddx.disease=icd_second_level_codes.code  WHERE patient=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$ddx=$row['title'];
$datep=date("d-m-Y H:i:s", strtotime($row['date']));     
?>
<tbody>
<tr>
<?php if (!empty($ddx )) {
?>
<td><?php echo $datep;?></td>
<td><?php echo $ddx;?></td>
<?php } ?>  
<?php }?>
</tr>
</tbody>
</table>
<p></p>
<center>lab requests</center>
<table class="table" >
<thead class="bg-primary">
<tr>
<th> request date</th>
<th>test</th>
<th>requested by</th>
<th>comments</th>
<th>view dails</th>
</tr>
</thead>
<?php
//if true for lab request, get the results
$patient=$_GET['search'];
$result = $db->prepare("SELECT  lab.id AS id,template,name, test,opn,reqby,comments,created_at FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE opn='$patient' ");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$date = $row['created_at'];
$name = $row['name'];
$lab_id = $row['id'];
$reqby = $row['reqby'];
$comments= $row['comments'];
$template= $row['template'];

?>
<tbody>
<tr>
<td><?php echo $date; ?></td>
<td><?php echo $name; ?></td>
<td><?php echo $reqby; ?></td>
<td><?php echo $comments; ?></td>
<td><?php
if ($template == 0) {
?>no details template<?php
}
?>
<?php
if (($template == 1)) {
# code...
?><a rel="facebox" href="../lab/template.php?request_id=<?php  echo $lab_id; ?>&view=true&name=<?php echo $name; ?>">view details</a><?php
}
?></td>
<?php }?>
</tr>

</tbody>
</table>
<hr>
<label>diagnosis</label>
<table class="table table-bordered"  >
<thead class="bg-primary">
<tr>
<th>date</th>
<th>diagnosis</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT * FROM dx JOIN icd_second_level_codes ON dx.disease=icd_second_level_codes.code  WHERE patient=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$ddx=$row['title'];
$datep=date("d-m-Y H:i:s", strtotime($row['date']));     
?>
<tbody>
<tr>
<?php if (!empty($ddx )) {
# code...
?>
<td><?php echo $datep;?></td>
<td><?php echo $ddx;?></td>
<?php }?>

<?php }?>
</tr>
</tbody>
</table>
<center>patient notes</center>
<table class="table table-bordered"  >
<thead class="bg-primary">
<tr>
<th>date</th>
<th>details</th>
</tr>
</thead>
</thead>
<?php $result = $db->prepare("SELECT* FROM patient_notes  WHERE patient=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$date=$row['created_at'];
$notes=$row['notes'];
?>
<tbody>
<tr>

<td><?php echo $date; ?></td>
<td><?php echo $notes;  ?><?php } ?></td>
</tr>
</tbody>
</table> 
</tr>
</tbody>
</table>
<h4>imagings and other files</h4>
<table class="table table-bordered" style="width:100%;" >
<thead class="bg-primary">
<tr>
<th>file</th>
<th>posted by</th>
<th>date</th>
<th>report</th>
<th>posted by</th>
<th>posted on</th>
<th>zip and download</th>
</tr>
</thead>
<?php
$patient=$_GET['search'];
$result = $db->prepare("SELECT* FROM images  WHERE  patient='$patient'");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$path = $row['image_path'];
$posted = $row['posted_by'];
$date = date("d-m-Y H:i:s", strtotime($row['date']));
$type = $row['type'];
$report = $row['report'];
$posted_by = $row['reported_by'];
$posted_date = $row['report_date'];
?>
<tbody>
<tr><td><?php if ($type==1) {

?><a href="../lab/imageloader/tests/index.php?id=<?php echo $path; ?>&pn=<?php echo $search; ?>&reload=2"><?php echo 'dicom_data'.$path.'- is dicom'; ?></a><?php } ?><?php if ($type==2) {  
?><a href="view_image.php?id=<?php echo '../lab/'.'imageloader/'.'tests/'.'data/'.$path; ?>&pn=<?php echo $search; ?>&reload=2"><?php echo 'image'.$path.'- is image'; ?></a><?php } ?></td>
<td><?php echo $posted; ?></td>
<td><?php echo $date; ?></td>
<td><?php if (!empty($report)) {
?><a rel="facebox" href="report.php?search=<?php echo $_GET['search']; ?>&path=<?php echo $path; ?>">     
<button class="btn btn-primary">view report</button><?php } ?></a>
<?php
if (empty($report)) {
echo "No Report Yet";

} ?>
</td>
<td><?php echo $posted_by; ?></td>
<td><?php echo $posted_date; ?></td>
<td><?php
$filename = $path.'.zip'; 

if (file_exists($filename)) {

?>
<a href="<?php echo $filename; ?>">
<button class="btn-success">download</button></a>
<?php } ?>
<?php 
if (!file_exists($filename)) {
?>
<a href="zip.php?zip=<?php echo $path; ?>&name=<?php echo $search; ?>"><button class="btn-primary">make zip</button></a>
<?php } ?>
</td>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</div>
<center>prescribed medications</center>
<div class="container">
<label>prescription</label>
<thead class="bg-primary">
<table class="table-bordered" style="width: 100%;">
<tr>
    <th>date</th>
<th>drug</th>
<th>dosage form</th>
<th>stregth</th>
<th>frequency</th>
<th>duration</th>
<th>status</th>
</thead>
</tr>
<?php 
if ($useFdaDrugsList == 1) {
$result = $db->prepare("SELECT ActiveIngredient, DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.dispensed AS dispensed,prescribed_meds.strength AS strength,roa,prescribed_meds.date AS date FROM prescribed_meds RIGHT OUTER JOIN meds ON prescribed_meds.drug=meds.id  WHERE patient=:b");
} else {
$result = $db->prepare("
SELECT generic_name AS ActiveIngredient, brand_name AS DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.dispensed AS dispensed,prescribed_meds.strength AS strength,roa,prescribed_meds.date AS date FROM prescribed_meds RIGHT OUTER JOIN drugs as meds ON prescribed_meds.drug=meds.drug_id  WHERE patient=:b AND date> :c 
UNION 
SELECT ActiveIngredient, DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.dispensed AS dispensed,prescribed_meds.strength AS strength,roa,prescribed_meds.date AS date FROM prescribed_meds RIGHT OUTER JOIN meds ON prescribed_meds.drug=meds.id  WHERE patient=:b AND date<= :c
");
}
$date = '2020-03-18'; // This is the date when these configuration changes were adopted. Meant to cater for historical prescriptions whose drugs were by default being referenced from the meds table. 
$result->BindParam(':b', $search); 
$result->BindParam(':c', $date);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$genericname=$row['ActiveIngredient'];
$brandname=$row['DrugName'];
$roa=$row['roa'];
$strength=$row['strength'];
$duration=$row['duration'];
$frequency=$row['frequency'];
$status=$row['dispensed'];  
$id=$row['id'];  
$date=date("d-m-Y H:i:s", strtotime($row['date']));
?>
<tr>
    <td><?php echo $date; ?></td> 
<td><?php echo $genericname; ?> (<?php echo $brandname; ?>)</td>
<td><?php if ($roa==1) {echo "oral";
# code...
} 
if ($roa==2) {echo "iv";
# code...
}
if ($roa==3) {echo "IM";
# code...
}
if ($roa==4) {echo "SC";
# code...
}
if ($roa==5) {echo "topical";
# code...
}
?></td>
<td><?php echo $strength; ?></td>
<td><?php


if ($frequency==0) {
echo "STAT";
} else {
echo $frequency."&nbsp; times daily";
}
?></td>
<td><?php echo $duration."&nbsp; days"; ?> </td><td>
<?php
if ($status==0) {
echo "not yet dispensed";
} else {
echo "dispensed";
}
?></td>
<?php } ?>
</tr>
</table>


</div>
</div><?php } ?></div></div>
<script>
function myFunction() {
  var x = document.getElementById("details");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>