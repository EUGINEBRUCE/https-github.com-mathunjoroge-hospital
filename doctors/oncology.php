<?php 
require_once('../main/auth.php');
include('../connect.php');
?>
<!DOCTYPE html>
<html>
<title>oncology</title>
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
<li class="breadcrumb-item active" aria-current="page">out patient</li>
<li class="breadcrumb-item active" aria-current="page">new prescription</li>
<?php
if (!empty($_REQUEST["search"])) {
$search=$_REQUEST['search'];
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$a=$row['name'];
$b=$row['age'];
$c=$row['sex'];
$d=$row['opno'];

?>

<li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?> &nbsp; age:  <?php 
$now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
echo $age." Years";
# code...
}
if ($age<1) {
echo $age*12; echo "&nbsp;"."Months";
# code...
} ?>  &nbsp; sex: <?php echo $c; ?></li>
<?php }} ?>
</ol>
</nav>
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
<div class="container">
<form action="oncology.php" method="GET">
<span><?php
include "../pharmacy/patient_search.php";
?><input type="hidden" name="code" value="<?php echo $_REQUEST["code"]; ?>">&nbsp;<button>submit</button></form>
<p>&nbsp;</p>
<!-- set this div to show when patient name is set -->
<?php
if (isset($_REQUEST["search"])) {
 	  ?>
<div class="container">
<form action="save_oncology.php" method="POST">
<span><select id='anticancer' style='width: 20%;' name="drug" data-live-search="true" required/>
<option value='0' ></option>
</select>&nbsp;
<input type="number" name="strength" placeholder="enter strength" type="number" style="width: 12%;"  required/>
<select name="units"><option value="" selected disabled>Please select units<optgroup label="general"><option>mg</option><option>units</option></optgroup><optgroup label="kg or M&sup2;"><option>mg/kg</option><option>mg/M&sup2;</option></optgroup></select>
<select name="roa" placeholder="ROA"><option value="" selected disabled>route</option><option value="1">P.O</option><option value="2">IV</option><option value="3">IM</option><option value="4">SC</option><option value="5">topical</option></select>
<input name="freq" type="text" placeholder="enter frequency" style="width: 10%;" required/>&nbsp;<input type="text" name="duration" placeholder="enter duration" required>
<input type="hidden" name="pn" value="<?php echo $search; ?>">
<input type="hidden" name="code" value="<?php echo $_REQUEST['code']; ?>">
<button class="btn btn-success">add</button>
<div class="suggestionsBox" id="suggestions" style="display: none;">
<div class="suggestionList" id="suggestionsList"> </form>
&nbsp; </div></div></div>
</hr>
<?php
$code=$_REQUEST['code'];
$result = $db->prepare("SELECT* FROM prescribed_meds WHERE code=:o");
$result->BindParam(':o', $code);
$result->execute(); 
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$trigger=$row['code'];
if (isset($trigger)) {    # code...


?>
<div class="container">
<table class="table-bordered" style="width: 100%;">
<tr>
<th>drug</th>
<th>dosage form</th>
<th>strength</th>
<th>frequency</th>
<th>duration</th>
<th>delete</th>
</tr>
<?php 
$code=$_REQUEST['code'];
$result = $db->prepare("SELECT Name AS ActiveIngredient, Name AS DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.strength AS strength,roa FROM prescribed_meds RIGHT OUTER JOIN cancer_drugs ON prescribed_meds.drug=cancer_drugs.id  WHERE code=:o");
$result->BindParam(':o', $code);
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
<td><a  href="delete.php?id=<?php echo $id; ?>&code=<?php echo $code; ?>&search=<?php echo $search; ?>&anticancer=1"><button class="btn btn-danger">delete</button></a></td><?php } ?>
</tr>
</table>
<p>&nbsp;</p>
<a href="inpatient.php?search= &response=1"><button class="btn btn-success" style="width: 70%;">save</button></a>
</div>
<?php } ?>
<?php }} ?></div></div></div></div></div></div>
<script>

$(document).ready(function(){

$("#anticancer").select2({
placeholder:"find anticancer",
minimuminputLength:3,
theme: "classic",
ajax: {
url: "anticancer.php?q=term",
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

$(document).ready(function(){

$("#patient").select2({
placeholder:"enter patient name or number",
minimuminputLength:3,
theme: "classic",
ajax: {
url: "patient.php?q=term",
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
</body>
</html>