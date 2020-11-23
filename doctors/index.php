<?php 
require_once('../main/auth.php');
?>
<!DOCTYPE html>
<html>
<title>doctors</title>
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
<li><a rel="facebox" href='disease_add.php'>add disease</a></li>
<?php
if (!empty($_GET["search"])) {
$search=$_GET['search'];
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$a=$row['name'];
$b=$row['age'];
$c=$row['sex'];
$d=$row['opno'];

?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?> age: <?php 
$now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
echo $age."years";
# code...
}
if ($age<1) {
echo $age*12; echo "&nbsp;"."Months";
# code...
} ?> &nbsp; sex: <?php echo $c; ?></li>
<?php } ?>

</ol>
</nav>
<body onLoad="document.getElementById('patient').focus();">
<form action="index.php?" method="GET">
<span><?php
include "../pharmacy/patient_search.php";
?> 
<input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
</form>

<?php
$search=$_GET['search'];
$nothing="";

if ($search!=$nothing) {
# code...
?><?php } ?>
<?php 
$search=$_GET['search'];
$response=0;
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$a=$row['name'];
$b=$row['age'];
$c=$row['sex'];
$d=$row['opno'];

?>


<h3 align="center">patient medical information</h3>
<script>
$(document).ready(function(){
$("#hide").click(function(){
$("#vitals").fadeToggle('swing');    
});
});
</script>
<button id="hide">Click to see/hide vitals</button><br>
<div class="container" id="vitals">
<?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$e=$row['systolic'];
$f=$row['diastolic'];
$g=$row['rate'];
$h=$row['height'];
$j=$row['weight'];
$k=$row['temperature'];
$l=$row['breat_rate'];
$search=$search; 
$rbs=$row['rbs'];
$date=$row['date'];
?>
<div class="container-fluid">
<?php
if (isset($e)) {
?>
<table class="table">
<tr>
<th>date</th>
<th>systolic</th>
<th>diastolic</th>
<th>rate</th>
<th>comments</th>
</tr>
<?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$e=$row['systolic'];
$f=$row['diastolic'];
$g=$row['rate'];        
?>
<tr>
<td><?php echo $date; ?></td>
<td><?php echo $e;  ?></td>
<td><?php echo $f; ?></td>
<td><?php echo $g;  ?></td>
<?php
if (($e<90) || ($f<60)){
$alert="the patient is hypotensive, rapid action is needed,"."</br>"." as this my lead to renal failure or even death!";
}
if ((90 <= $e) && ($e <= 119) || (60 <= $f) && ($f <= 80)) {
$alert="blood pressure is normal";

}
if ((121 <= $e) && ($e <= 139) || (81 <= $f) && ($f <= 89)) { 
$alert="the patient is prehypertensive";
}
if ((140 <= $e) && ($e <= 159) || (90 <= $f) && ($f <= 99)) { 
$alert="patient in stage 1 hypertension, action needed";
}
if (($e>=160) || ($f>=100)) { 
$alert="patient in stage 2 hypertension,action needed";
}
$haystack =$alert;
$needle   = "needed";
if( strpos( $haystack, $needle ) !== false ) {
$myclass="alert alert-danger";
}
if( strpos( $haystack, $needle ) == false ) {
$myclass="alert alert-success";
}
?>
<td class="<?php echo $myclass ?>"> <?php echo $alert; ?> </td>
<?php } ?>
</tr>
</table>
<?php } ?>
<?php
if (isset($rbs)) {
?>
<table class="table">
<tr>
<th>date</th>
<th>rbs</th>
<th>comments</th>
</tr>
<?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$rbs=$row['rbs'];        
?>
<tr>
<td><?php echo $date; ?></td>
<td><?php echo $rbs; ?></td>
<?php
if ($rbs<4.4) {
$message="patient is hypoglycemic";
$class="alert alert-danger";
}
if ($rbs >= 4.4 && $rbs <= 7.8) {
$message="rbs is normal";
$class="alert alert-success";
} 
if ($rbs >= 7.8 && $rbs <= 11.1 ) {
$message="patient is prediabetic";
$class="alert alert-warning";
}
if ($rbs>11.1) {
$message="patient is diabetic";
$class="alert alert-danger";
}
?>
<td class="<?php echo $class; ?>"> <?php echo $message; ?></td>
</tr><?php } ?>
</table>
<?php } ?>
<?php
if (isset($k)) {
?>
<table class="table">
<tr>
<th>date</th>
<th>temperature</th>
<th>comments</th>
</tr>
<?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$k=$row['temperature'];        
?>
<tr>
<td><?php echo $date; ?></td>
<td><?php echo $k; ?>&#x2103;</td>
<?php        
if ($k<36.1) {
$tmessage="patient is hypothermic";
$tclass="alert alert-danger";


}
if (($k >= 36.1 && $k <= 38) ) {
$tmessage="temperature is normal";
$tclass="alert alert-success";
}

if ($k>38) {
$tmessage="patient has fever";
$tclass="alert alert-danger";
}

?>
<td class="<?php echo $tclass; ?>"> <?php echo $tmessage; ?></td>
</tr><?php } ?>
</table>
<?php } ?>  
<?php
if (isset($l)) {
?>
<table class="table">
<tr>
<th>date</th>
<th>breath rate</th>
<th>comments</th>
</tr>
<?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$l=$row['breat_rate'];        
?>
<tr>
<td><?php echo $date; ?></td>
<td><?php echo $l; ?> bpm</td>
<?php        
if ($l<12) {
$bmessage="patient is hypopnic";
$bclass="alert alert-danger";
}
if (($l >= 12 && $l <= 25) ) {
$bmessage="normal breathing rate";
$bclass="alert alert-success";
}
if ($l>25) {
$bmessage="patient has tarchypnic";
$bclass="alert alert-danger";
}
?>
<td class="<?php echo $bclass; ?>"> <?php echo $bmessage; ?></td>
</tr><?php } ?>
</table>
<?php } ?> <?php
if (isset($h)) {
?>
<table class="table">
<tr>
<th>date</th>
<th>weight</th>
<th>height</th>
<th>BSA</th>
<th>BMI</th>
</tr>
<?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$j=$row['weight']; 
$h=$row['height'];
if (is_numeric($h)) { 
$hm=($h/100); 
$hms=(pow(2,$hm));
} 
if (is_numeric($j) && is_numeric($h)) {
$bsi=sqrt(($h*$j)/3600);
}        
?>
<tr>
<td><?php echo $date; ?></td>
<td><?php echo $j; ?> kg</td>
<td><?php if (is_numeric($h)) {
# code...
echo $h;  } ?> cm</td> 
<td><?php if (is_numeric($bsi)) { echo round($bsi,3); } ?> M&sup2;</td>
<td><?php  if (is_numeric($j)) { echo round(($j/($hms)),2); } ?> Kg/M&sup2;</td>
</tr><?php } ?>
</table>
<?php } ?>
</div>
<?php } ?>
<div class="container">
<form action="savepatient.php" method="POST">
<input type="hidden" name="pn" value="<?php echo $search; ?> ">
<div class="col-sm-6" ><label>presenting complaint</label></br>
<input type="text" name="cc" style="width: 105%;height: 5%;">

<label>history of presenting illness</label></br> 
<textarea name="hpi" style="width: 105%;height: 10%;"></textarea></br>
<label>family history.</label></br> 
<textarea name="fh" style="width: 105%;height: 10%;" placeholder="is there any history of chronic conditions in the family..."></textarea>      
<label>Past medical history.</label></br> 
<textarea name="pmh" style="width: 105%;height: 10%;" placeholder="Has the patient had any diseases like diabetes?..."></textarea></br>
</textarea>      
<label>Physical examination.</label></br> 
<textarea name="physical_examination" style="width: 105%;height: 10%;" placeholder="patient physical examination" required/></textarea></br>
<label>differential diagnosis</label></br>
<select id='ddx' style='width: 105%;' name="ddx[]" data-live-search="true"  multiple>
<option value='0' ></option>
</select>
</div>      
<div class="col-sm-6" > <label>Medication history</label></br> 
<textarea name="ph" style="width: 105%;height: 10%;" placeholder="Has the patient been on any medications?..."></textarea></br>      
<label>social and occupational history</label></br>
<textarea name="soh" style="width: 105%;height: 10%;"></textarea></br>      
<label>request lab tests</label></br>
<select id="maxOption2" class="selectpicker show-menu-arrow form-control" data-live-search="true" title="Please select lab tests" name="lab[]" multiple >
<option value="" disabled="">-- Select test--</option><?php 
$result = $db->prepare("SELECT * FROM lab_tests");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo "<option value=".$row['id'].">".$row['name']."</option>";
}

?>      
</select>
<label>request imagings</label></br>
<select  class="selectpicker show-menu-arrow form-control" data-live-search="true" title="Please select imaging" name="image[]" multiple>
<option value="" disabled="">-- Select imaging--</option><?php 
$result = $db->prepare("SELECT * FROM imaging");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo "<option value=".$row['imaging_id'].">".$row['imaging_name']."</option>";
}

?>      
</select>      
<div class="container">
<label>diagnosis</label></br>             
<select id='disease' style='width: 105%;' name="dx[]" data-live-search="true"  multiple>
<option value='0' ></option>
</select>

<script>

$(document).ready(function(){

$("#disease").select2({
placeholder:"find disease",
minimuminputLength:3,
theme: "classic",
ajax: {
url: "diseases.php?q=term",
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

$("#ddx").select2({
placeholder:"find disease",
minimuminputLength:3,
ajax: {
url: "diseases.php?q=term",
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
</div>    
</div>
<div class="container">
<p>&nbsp;</p>
<button class="btn btn-success btn-large" style="width: 80%;margin-left: 10%;" >save</button></div></form><?php }  ?></div>
<?php
$respose=$_GET['response'];

if ($respose==1) {

?>
<div class="alert alert-success" style="width: 20%;margin-left: 20%;"><p> patient data saved successifully</p></div>

</div><?php } ?>
</div>
</div>

</div></div></div>                
</div></div></div>


<?php } ?>

</div></div>
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

</body>
</html>