<?php 
require_once('../main/auth.php');
<<<<<<< HEAD
?>
<!DOCTYPE html>
=======
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount.date("/Y");
        include "../header.php";
 ?>
 <!DOCTYPE html>
>>>>>>> d6494f18a9c43fc885690af91712f2f1873da227
<html>
<title>register patient</title>
<?php 
include('../header.php');
?>
</head>
<<<<<<< HEAD
<header class="header clearfix" style="background-color: #3786d6;">
</button>
<?php include('../main/nav.php'); ?>   
</header><?php include('side.php'); ?>
<div class="content-wrapper">    
<div class="jumbotron" style="background: #95CAFC;">  

<script>
$( function() {
$( "#mydate" ).datepicker({
yearRange: "-100:+0",
changeMonth: true,
changeYear: true
});
} );
=======
 
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">      
      <div class="jumbotron" style="background: #95CAFC;">
        <link rel="stylesheet" href="../main/jquery-ui.css">

  <script>
  $( function() {
    $( "#mydate" ).datepicker({
    	yearRange: "-100:+0",
      changeMonth: true,
      changeYear: true
    });
  } );
>>>>>>> d6494f18a9c43fc885690af91712f2f1873da227

</script>
<div class="wrapper">  
<?php
$a=$_GET['attempt'];
if ($a==0) { echo "";
?>
<?php
$end = date('Y-m-d', strtotime('-5 years'));
} ?>
<?php 
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients ORDER BY id DESC LIMIT 1");
$result->execute();
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$req= substr($row['opno'],-4);
}
if ($req==date('Y')){
$a='/'.$req;
$result = $db->prepare("SELECT * FROM patients WHERE opno LIKE '%$a%'");
$result->execute();
$patient = $result->rowcount()+1;
$patient_number=$patient."/".date('Y');
}
if ($req!==date('Y')){
$patient_number='1'."/".date('Y');
}
?>
<div class="container pd-3" style="">
<?php
$a=$_GET['attempt']; 
if ($a==2) {

?>
<p class="alert alert-success h6" style="float:left;font-size:1.5rem;" > <?php echo $_GET['name']; ?> has been allocated a bed.</p><?php } ?>
<?php
$a=$_GET['attempt']; 
if ($a==3) {

?>
<p class="alert alert-success h6"  style="float:left;font-size:1.5rem;"> <?php echo $_GET['name']; ?> data has been saved.</p><?php } ?>
</div>

<h3>register patient</h3>
<style type="text/css">
#register{
border-style: inset;  background-image: url('../images/bg.jpg');
margin-left: -30%;

}
@media only screen and (max-width: 600px) {
#register {
margin-left: 0%;
}
}
</style>
<div class="container" id="register" >
<form action="savepatient.php" method="post">
<div class="form-row">
<div class="form-group col-md-6">
<label for="name">patient name</label>
<input type="text" class="form-control" name="name"  placeholder="patient name" required="true" />
</div>
<div class="form-group col-md-6">
<label for="inputtext4">date of birth</label>
<input type="text" id="mydate" class="form-control" name="age" placeholder="date of birth in dd-mm-yyyy" autocomplete="off" required>
</div>
<div class="form-group col-md-6">

<label for="inputtext4">sex</label>
<select name="sex" class="form-control" required><option>select sex</option><option >male</option><option >female</option></select>
</div>    
<div class="form-group col-md-6">
<label for="inputPassword4">patient address</label>
<input type="text" class="form-control" name="address" placeholder="enter patient address" required/>
</div>
<div class="form-group col-md-6">
<label for="contact">patient contact</label>
<input type="text" class="form-control" name="contact"  placeholder="patient contact" required="true">
</div>

<div class="form-group col-md-6">
<label for="inputPassword4">select inpatient or outpatient</label>
<select name="dept" class="form-control" required/><option disabled>select dept</option><option value="1">out-patient</option><option value="2">in-patient</option></select>
</div>
<div class="form-group col-md-6">
<label for="nexofkin">next of kin</label>
<input type="text" class="form-control" name="nok"  placeholder="next of kin">
</div>

<div class="form-group col-md-6">
<label for="inputPassword4">select fees to be paid</label>
<select id="fee" class="selectpicker"  title="select fees"  name="fees[]" class="form-control" multiple  required/>
<option value="">-- Select payable fees--</option><?php 
include ('../connect.php');
$result = $db->prepare("SELECT * FROM fees");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo "<option value=".$row['fees_id'].">".$row['fees_name']."</option>";
}

?>      
</select>
</div>
<div class="form-group col-md-6">
<label>next of kin contact</label>
<input type="text" class="form-control" name="nokc"   placeholder="next of kin contact">
</div>

<div class="form-group col-md-6">
<label for="inputPassword4">Patient number(autogenerated)</label>
<input type="text" class="form-control" name="number" value="<?php echo str_pad($patient_number, 12, '0', STR_PAD_LEFT); ?>" readonly>
</div>
</div>
<button class="btn btn-success btn-large" style="width: 80%; margin-left:10%;">save</button></form>

</div></div>
</div></div>
</div></div>

</body>
</html>