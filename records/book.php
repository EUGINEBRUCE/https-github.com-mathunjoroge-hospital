<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>book clinic</title><?php 
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
<form action="saveclinic.php" method="POST">
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
 
</head>
  <span><?php 
include('../pharmacy/patient_search.php');
?>

<select id="clinic" name="clinic" class="selectpicker" data-live-search="true" title="select clinic..." required="required" >
    <option value="" disabled="">-- Select clinic--</option><?php 
    include('../connect.php');
$result = $db->prepare("SELECT * FROM clinics");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['clinic_id'].">".$row['clinic_name']."</option>";
         }
        
        ?>      
</select> <input type="text" id="mydate" required="true" name="date" autocomplete="off" placeholder="pick date">
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>

<script src="../resources/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>
<?php
if ($_GET['response']==1) {
  # code...


 ?>
<div class="alert alert-success"  style="width: 21%;margin-left: 20%;"> patient clinic booked successifuly</div>
<?php } ?>
<?php 
if ($_GET['response']==0) {
  
}
 ?>

</body>
</html>