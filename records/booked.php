<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>book clinic</title><?php 
include('../header.php');
?>
</head><body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">         
<form action="booked.php" method="GET">
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#mydate" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

  </script>
  
</head>
  <span><form action="booked.php?" method="GET">
    <input type="text" id="mydate" required="required" name="date" placeholder="pick date" autocomplete="off"><select id="clinic" name="clinic" class="selectpicker" data-live-search="true" title="select clinic..." required="required" >
<option value="" disabled>-- Select clinic--</option><?php 
 include ('../connect.php');
$result = $db->prepare("SELECT * FROM clinics");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['clinic_id'].">".$row['clinic_name']."</option>";
         }
        
        ?>      
</select>
</select> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button>
  </form>
   <?php
  include('../connect.php');
       $date=date("Y-m-d", strtotime($_GET['date']));
       $clinic= $_GET['clinic'];
  $result = $db->prepare("SELECT name,clinic_name,opno,bookings.date AS date FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id LEFT OUTER JOIN patients ON patients.opno=bookings.patient WHERE bookings.date='$date' AND bookings.clinic_id='$clinic'");
        $result->execute();
        $rowcount = $result->rowcount();
        
        
   ?>
   <?php 
   if ($rowcount<1) {
     
    ?>
    <script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("button").hide();
    });
});
</script>
    <div class="alert-warning" style="width: 40%;" >no clinic booked </div><?php } ?>
     <?php 
   if ($rowcount>0) {
     
    ?>
  
   <table class="resultstable" >
<thead>
<tr>
      <th>patient name</th>
      <th>number</th>
      <th>clinic</th>
      <th>date</th>
    </tr>
</thead>
 <tbody>
  <?php
  include('../connect.php');
       $date=date("Y-m-d", strtotime($_GET['date']));
       $clinic= $_GET['clinic'];
  $result = $db->prepare("SELECT name,clinic_name,opno,bookings.date AS date FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id LEFT OUTER JOIN patients ON patients.opno=bookings.patient WHERE bookings.date='$date' AND bookings.clinic_id='$clinic'");
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo $row['name']; ?>:&nbsp;</td>
      <td> &nbsp;<?php echo $row['opno']; ?>
         <td> &nbsp;<?php echo $row['clinic_name']; ?>
           <td> &nbsp;<?php echo $row['date']; ?>
            </td><?php } } ?></tbody>
</table>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</body>
</html>