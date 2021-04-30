<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
<!DOCTYPE html>
<html>
<title>theatre list</title>
<?php
  include "../header.php";
  ?>
</head>

<body>
<header class="header clearfix" style="background-color: #3786d6;">
</button>
<?php include('../main/nav.php'); ?>   
</header><?php include('side.php'); ?>
      <div class="jumbotron" style="background: #95CAFC;">
       <?php
      if (isset($_GET['response']) && $_GET['response']==1) {
         # code...
       ?>
       <div class="alert-success" style="width: 16%;">patient entered to list!</div>
       <?php } ?>  
       <?php
      if (isset($_GET['response']) && $_GET['response']==2) {
         # code...
       ?>
       <div class="alert-success" style="width: 16%;">patient surgical notes saved!</div>
       <?php } ?>
       <?php
      if (isset($_GET['response']) && $_GET['response']==3) {
         # code...
       ?>
       <div class="alert-success" style="width: 26%;">surgery started at <?=date('d/m/Y H:i:s'); ?></div>
       <?php } ?>
       <?php
      if (isset($_GET['response']) && $_GET['response']==4) {
         # code...
       ?>
       <div class="alert-success" style="width: 26%;">surgery completed at <?=date('d/m/Y H:i:s'); ?></div>
       <?php } ?>
       <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">surgical patients</li>
    <li class="breadcrumb-item active" aria-current="page">theatre list</li>
    <li class="breadcrumb-item" style="float: right;"><a href="surgeries.php">done surgeries</a></li>
  </ol>
</nav>      
      
      <div class="container" id="results" >
      
    <a rel="facebox" href="add.php"> <button class="btn-success" style="" >add patient to list</button></a></span></br><p></p> 
      <input type="text" id="search" onkeyup="myFunction()" placeholder="Search for patient.." title="Type in a patient number or name">
     <table class="table-bordered" id="products_table" >
<thead class="bg-primary">
<tr>
<th>patient name</th>
<th>IP Number</th>
<th>age</th>
<th>sex</th>
<th>operation</th>
<th>type</th>
<th>status</th>
<th>other details</th>
<th>sign in</th>
<th>sign out</th>
<th>surgical notes</th>
</tr>
</thead>
<?php  $done=0;
        $result = $db->prepare("SELECT*  FROM surgeries RIGHT OUTER JOIN patients ON surgeries.patient=patients.opno WHERE status=:a");
        $result->BindParam(':a',$done);
        $result->execute();
       for($i=0; $row = $result->fetch(); $i++){
     $surg_id = $row['surg_id'];
      $patient = $row['name'];
      $ip_no = $row['opno'];
      $b= $row['age'];
      $sex= $row['sex'];
      $operation= $row['operation'];
      $type= $row['type'];
      $status= $row['status'];
      $sign_in= $row['sign_in'];
         ?>
<tbody>
<tr>
<td><?php echo $patient; ?></td>
<td><?php echo $ip_no; ?></td>
<td ><?php 
  $now = time('Y/m/d'); 
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
  } ?> </td>
<td ><?php echo $sex; ?></td>
<td ><?php  echo $operation; ?></td>
<td><?php  if ($type==1) {
  echo "elective";
 
} else{
  echo "emergency";
}
 ?> </td>
<td><?php if ($sign_in==0) {
    echo "waiting for sign in";
    # code...
  }
  elseif ($sign_in==1) {
    echo "surgery ongoing"; 
      
  }
  elseif ($sign_in==2) {
    echo "surgery completd"; 
      
  }
  else{
      
  }
    ?> </td>
<td><a  href="details.php?id=<?=$ip_no; ?>">details</a></td>
<td><?php if ($sign_in==0) { ?><a rel="facebox" href="checklist.php?id=<?=$surg_id; ?>">checklist</a><?php } ?> <?php 
    if ($sign_in==1) {
    echo "surgery ongoing"; } ?>
       </td>
<td>
  <?php if ($sign_in==0) {
    echo "waiting for sign in";
    # code...
  }
    ?><?php 
    if ($sign_in==1) {
   ?>
  <a rel="facebox" href="sign_out.php?id=<?=$surg_id; ?>">sign out</a><?php } ?>
<?php 
    if ($sign_in==2) {
      echo "surgery completed";
    }
   ?></td>
<td><a rel="facebox" href="surg_notes.php?id=<?=$surg_id; ?>&search=<?=$ip_no; ?>">notes if done</a> <?php
if ($sign_in !=2 ) { echo " no sign is registerd!";
   # code...
 } ?></td><?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>   

</div> </div>      
      
</div>
<script>
var $rows = $('#products_table tbody tr');
$('#search').keyup(function() {
    
    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;
    
    $rows.show().filter(function() {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});
</script>

  <script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>