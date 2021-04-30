<?php 
require_once('../main/auth.php');
include('../connect.php');
$token=$_GET['token'];
?>
<!DOCTYPE html>
<html>
<title>pharmacy</title>
<?php
  include "../header.php";
  ?>
</head>
<body>
<header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>   
</header>
<?php include('side.php'); ?>
<div class="content-wrapper" style=" background-image: url('../images/doctor.jpg');">
<div class="jumbotron" style="background: #95CAFC;">
<?php 
$result = $db->prepare("SELECT * FROM orders");
$result->execute();
$rowcountt = $result->rowcount();
$rowcount = $rowcountt+1;
$code=$rowcount;
?>   
</header>
<div class="content-wrapper">   
<div>
<nav aria-label="breadcrumb" style="width: 90%;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">patient</li>
<li class="breadcrumb-item active" aria-current="page">search patient</li>
<?php
$search=$_GET['search'];
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$a=$row['name'];
$b=$row['age'];
$c=$row['sex'];

?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php include '../doctors/age.php'; } ?>
<li style="float:right;"><a href="waiting.php?list=3">oncology waiting list</a></li>
<li style="float:right;"><a href="waiting.php?list=2">inpatient waiting list</a></li>
<li style="float:right;"><a href="waiting.php?list=1">outpatient waiting list</a></li></ol>
<form action="index.php?" method="GET">
<input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
<span><?php
  include "../pharmacy/patient_search.php";
  ?> 
<input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
</form>

<?php
$search=$_GET['search'];
if (isset($search) &&empty($a)) {        
?>
<p class="alert alert-danger" style="width: 50%;font-size: 1em;">no information available  </p>
<?php } ?>
<?php 
$search=$_GET['search'];
$response=0;      
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$a=$row['name'];
$b=$row['age'];
$c=$row['sex'];
$d=$row['opno'];
$pn=$search;
?> 
<?php } ?>
<?php if (isset($a)) {
# code...
?>
<div class="container">
<label>prescription</label>
<?php       
$result = $db->prepare("SELECT * FROM admissions WHERE ipno=:o");
$result->BindParam(':o', $search);
$result->execute();
$admitted = $result->rowcount();{
?> 
<?php } ?>


<table class="table-bordered" style="width: 100%;">
    <thead class="bg-primary">
<tr>
<th>drug</th>
<th>dosage form</th>
<th>strength</th>
<th>frequency</th>
<th>duration</th>
</tr>
</thead>
<?php 
$served=0;
if ($useFdaDrugsList == 1) {
$result = $db->prepare("SELECT ActiveIngredient, DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.strength AS strength,roa FROM prescribed_meds RIGHT OUTER JOIN meds ON prescribed_meds.drug=meds.id  WHERE dispensed=:a AND patient=:b");
} else {
$result = $db->prepare("SELECT generic_name AS ActiveIngredient, brand_name AS DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.strength AS strength,roa FROM prescribed_meds RIGHT OUTER JOIN drugs as meds ON prescribed_meds.drug=meds.drug_id  WHERE dispensed=:a AND patient=:b");       
}
$result->BindParam(':a', $served);
$result->BindParam(':b', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$genericname=$row['ActiveIngredient'];
$brandname=$row['DrugName'];
$roa=$row['roa'];
$strength=$row['strength'];
$duration=$row['duration'];
$frequency=$row['frequency'];
$code=$row['code'];  
$id=$row['id'];   
?>
<tr>
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
<td><?php echo $duration."&nbsp; days"; ?> </td>
<?php } ?>
</tr>
<!----oncology --->
</table>
<?php 
$result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o  ORDER BY vitals.id DESC LIMIT 1");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$h=$row['height'];
$j=$row['weight'];
}
if (isset($j) && is_numeric($j) && is_numeric($h) ) {
$bsi=sqrt(($h*$j)/3600);
}
if (isset($j) && is_numeric($j) ) {
  
  $weight=$j;
  # code...
}
?>
<table class="table-bordered" style="width: 100%;">
  <caption>oncology prescription</caption>
<thead class="bg-primary">
<tr>
<th>drug</th>
<th>dosage form</th>
<th>strength</th>
<th>frequency</th>
<th>duration</th>
</tr>
</thead>
<?php 
$anticancer=1;
$result = $db->prepare("SELECT Name AS ActiveIngredient, Name AS DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.strength AS strength,roa FROM prescribed_meds RIGHT OUTER JOIN cancer_drugs ON prescribed_meds.drug=cancer_drugs.id   WHERE dispensed=:a AND patient=:b AND patient=:b AND is_anticancer=:c");      
$result->BindParam(':a', $served);
$result->BindParam(':b', $search);
$result->BindParam(':c', $anticancer);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$genericname=$row['ActiveIngredient'];
$brandname=$row['DrugName'];
$roa=$row['roa'];
$strength=$row['strength'];
$duration=$row['duration'];
$frequency=$row['frequency'];
$code=$row['code'];  
$id=$row['id'];   
?>
<tr class="table-success">
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
<td><?php 
if (strpos($strength, '/kg') !== false && isset($weight)) {
    echo ((double)(strtok($strength, '-'))*$weight)." mg"." (".$strength.")";
}
elseif (strpos($strength, '/M') !== false && isset($bsi)) {
    echo ((double)(strtok($strength, '-'))*$bsi)." mg" ." (".$strength.")";
}
elseif (strpos($strength, '/kg') !== false && !isset($weight)) {
    echo $strength.'<font style="color:red;">'." weight not taken!".'</font>';
}
elseif (strpos($strength, '/M') !== false && !isset($bsi)) {
    echo $strength.'<font style="color:red;">'."  height or weight missing!".'</font>';
}
else{ 
    echo $strength;
}
  ?></td>
<td><?php
echo $frequency;
?></td>
<td><?php echo $duration; ?> </td>
<?php } ?>
</tr>
</table>

<label>select medicines for patient</label></br>
<table class="table dark-table" style="width: 70%;">
<thead>
<tr>
<th style="width: 32%;">name</th>
<th>price</th>
<th>qty avl</th>
<th>qty</th>
</tr>
</thead> </table>     
<span><form action="savepatient.php" method="POST">
<input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="hidden" name="adm" value="<?php echo $admitted; ?>">       
<select id="medicine" name="med"  data-live-search="true" class="selectpicker" data-live-search="true" title="Please select a medicine..." onchange="showDrug(this.value)" style="width:20rem;" >
<?php 

$result = $db->prepare("SELECT * FROM drugs");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
   echo "<option value=".$row['drug_id'].">".$row['generic_name']."-".$row['brand_name']."</option>";
 }

?>      
</select>
<b><span id="med"></b><button class="btn btn-success btn-large">add</button></form></span></div>      
<div class="container" id="results" > <label>selected meds</label></br> 
<?php
$patient=$_GET['search'];
$result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE token=:b");

$result->BindParam(':b', $token);
$result->execute();
$rowcount = $result->rowcount();

if ($rowcount>0) {
# code...

?>
<table class="table table-bordered" >
<thead class="bg-primary">
<tr>
<th>generic name</th>
<th>brand name</th>
<th>quantity</th>
<th>price</th>
<th>total</th>
<th>action</th>
</tr>
</thead>
<?php
$patient=$_GET['search'];
$result = $db->prepare("SELECT drugs.drug_id AS drug,generic_name,brand_name,price*drugs.mark_up AS price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE token=:b");
$result->BindParam(':b', $token);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$drug = $row['generic_name'];
$brand = $row['brand_name'];
$price= $row['price'];
$qty= $row['quantity'];
$drug_id= $row['drug'];
?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<td><a rel="facebox" href="editqty.php?id=<?php echo $row['dispense_id']; ?>&qty=<?php echo $qty; ?>&gname=<?php echo $drug; ?>&bname=<?php echo $brand; ?>&admitted=<?php echo $admitted; ?>&pn=<?php echo $pn; ?>&did=<?php echo $drug_id; ?>&token=<?php echo $_GET["token"]; ?>"><button class="btn btn-success" style="height: 5px;" title="Click to edit quantity"></button></a><a href="delete.php?id=<?php echo $row['dispense_id']; ?>&pn=<?php echo $pn; ?>&admitted=<?php echo $admitted; ?>&did=<?php echo $drug_id; ?>&qty=<?php echo $qty; ?>&token=<?php echo $_GET["token"]; ?>"> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button></a> </td><?php }?>
</tr>
<tr> <?php 
$result = $db->prepare("SELECT sum(price*dispensed_drugs.quantity*drugs.mark_up) as total FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id =dispensed_drugs.drug_id WHERE  token=:b");
$result->BindParam(':b', $token);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ ?>

</tr>
<tr>
<th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
<td colspan="1" id="myvalue"><strong style="font-size: 12px; color: #222222;"> <?php echo $row['total']; ?> </td><?php } ?>
</tbody>
</table>
</br>
<a href="savepharm.php?code=<?php echo $search; ?>">
<button class="btn btn-success btn-large" style="width: 100%;">save</button></a></div>
</div>      
</div>
<?php } ?>
</div> 
<?php } ?>

<?php if ($_GET['response']==1) {
# code...
?>
<p></p>
<div class="alert alert-success" style="width: 35%;">drugs returned and stock adjusted appropriately</div><?php } ?></div></div>
<script>
$(document).ready(function(){
$("#patient").select2({
placeholder:"enter patient name or number",
minimuminputLength:3,
theme: "classic",
ajax: {
url: "../doctors/patient.php?q=term",
dataType: 'json',
type: "POST",
delay: 250,
data: function (params) {
return {
q: params.term, // search term
};
},
processResults: function (data) {
return {
results: data
};
},
cache: true
}
});
});
</script>
<script>
function showDrug(str) {
  if (str == "") {
    document.getElementById("med").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("med").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","get_drug.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
</body>
</html>