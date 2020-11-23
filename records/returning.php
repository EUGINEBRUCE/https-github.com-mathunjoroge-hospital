<?php 
require_once('../main/auth.php');
?>
 <!DOCTYPE html>
<html>
<title>returning patient</title>
<?php 
include('../header.php');
?>
</head>
 <body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">    
      <div class="jumbotron" style="background: #95CAFC;">         
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#mydate" ).datepicker({
      yearRange: "-0:+10",
      changeMonth: true,
      changeYear: true

    });
  } );

  </script>
  
</head><div>
     <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">returning patient</li>
    <?php
    if (isset($_REQUEST["search"])) {
      # code...
    
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
  echo $age." Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"." Months";
    # code...
  } ?> &nbsp; sex: <?php echo $c; ?></li><?php }} ?>
</nav> 
</div>
<form method="GET" action="returning.php" >
  <span><?php 
include('../pharmacy/patient_search.php');
?>

  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
<?php if (isset($_REQUEST["search"])) {
  # code...
 ?>
&nbsp;
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="container">
  <form method="POST" action="save_returning.php">
    <input type="hidden" name="patient" value="<?php echo $_REQUEST["search"]; ?>">
    <input type="hidden" name="name" value="<?php echo $a; ?>">
    <select id="fee" class="selectpicker"  title="select fees"  name="fees[]" class="form-control" style="width: 70%;" multiple  required/>
    <option value="">-- Select payable fees--</option><?php 
 include ('../connect.php');
$result = $db->prepare("SELECT * FROM fees");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['fees_id'].">".$row['fees_name']."</option>";
         }
        ?>      
</select> 
<button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button>
    
  </form>
</div>
<?php } ?>
</div></div></div>

<?php
if ($_GET['response']==1) {
  # code...


 ?>
<div class="alert alert-success"  style="width: 21%;margin-left: 20%;"> patient data successifuly</div>
<?php } ?>
<?php 
if ($_GET['response']==0) {
  
}
 ?>

</body>
</html>