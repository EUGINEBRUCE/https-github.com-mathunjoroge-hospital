<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>clinic</title><?php 
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
  
</head>
  <span><form action="pclinics.php?" method="GET">
  <span><?php 
include('../pharmacy/patient_search.php');
?>
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
    
    <?php
    $search=$_GET['search'];
    $nothing="";


    if ($search!=$nothing) {
       # code...
      ?><?php } ?>
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

 ?>
  <?php
  $patient=$_GET['search'];
       $date=date('Y-m-d');
  $result = $db->prepare("SELECT* FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date='$date'");
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
    <div class="alert-success" style="width: 40%;" >no clinic booked for patient today. check <a href="pclinics.php?search=<?php echo $patient; ?>&response=0&others=6"><button class="btn btn-success" id="hide">later dates</button></a></div><?php } ?>
     <?php 
   if ($rowcount>0) {
     
    ?>

 <table class="resultstable" >
<thead>
<tr>
<th>patient name</th>
<th>age</th>
<th>sex</th>
<th>clinic</th>
<th>date</th>
<th>cost</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
       $date=date('Y-m-d');
        $result = $db->prepare("SELECT* FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date='$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $clinic_id = $row['clinic_id'];     
      $clinic = $row['clinic_name'];
      $cost= $row['cost'];
      $pt= $row['patient'];
      $date= date("d-m-Y", strtotime($row['date']));    
         ?>
         
<tbody>
<tr>
<td><?php echo $a; ?></td>
<td><?php $now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age."Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  }?> </td>
<td ><?php  echo $c; ?></td>
<td><?php echo $clinic; ?></td>
<td><?php echo $date; ?></td>
<td ><?php echo $cost; ?></td>


<?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
$date=date('Y-m-d');
        $result = $db->prepare("SELECT sum(cost) AS total FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date='$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      <th>  </th>
      <th>  </th>
      <th>  </th>
      <td> Total Amount: </td>
      
    </tr>
      <tr>
        <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1" id="myvalue"><strong style="font-size: 12px; color: #222222;"> <?php $total=$row['total']; echo $row['total']; ?> </td><?php } ?>

</tbody>
</table>
 </br>
 <?php $patient=$_GET['search'];
       $date=date('Y-m-d');
        $result = $db->prepare("SELECT GROUP_CONCAT(bookings.clinic_id) AS clinic_id FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND bookings.date='$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $clinic_id = $row['clinic_id'];           
         ?>
 <form action="savefee.php" method="POST" >
  <input type="hidden" name="clinic" value="<?php echo $clinic_id; ?>">
  <input type="hidden" name="patient" value="<?php echo $pt; ?>">
  <input type="hidden" name="total" value="<?php echo $total; ?>">
  <button class="btn btn-success" style="width: 100%;">submit patient</button>   
 </form>
 <?php } ?>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>
<?php
if ($_GET['response']==1) {
  # code...


 ?>
<div class="alert alert-success"  style="width: 21%;margin-left: 20%;"> patient clinic booked successifuly</div>
<?php } ?>
<?php
if ($_GET['response']==4) {
  # code...


 ?>
<div class="alert alert-success"  style="width: 21%;margin-left: 20%;"> patient clinic submited to doctor</div>
<?php } ?>
<?php 
if ($_GET['response']==0) {
  
}
 ?><?php }?>
 <?php 
 if (isset($_GET['others'])) {
   

 ?>
 <h6>bookings for later dates</h6>
 <table class="resultstable" >
<thead>
<tr>
<th>patient name</th>
<th>age</th>
<th>sex</th>
<th>clinic</th>
<th>date</th>
<th>cost</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
       $date=date('Y-m-d');
        $result = $db->prepare("SELECT* FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date>'$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $clinic = $row['clinic_name'];
      $cost= $row['cost'];
      $date= date("d-m-Y", strtotime($row['date']));
    
         ?>
<tbody>
<tr>
<td><?php echo $a; ?></td>
<td><?php echo $b; ?> </td>
<td ><?php  echo $c; ?></td>
<td><?php echo $clinic; ?></td>
<td><?php echo $date; ?></td>
<td ><?php echo $cost; ?></td>



</tr><?php } ?>
<?php } ?><?php }?>
</tbody>
</table>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>

</body>
</html>