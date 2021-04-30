<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
<!DOCTYPE html>
<html>
<title>done surgeries</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php
  include "../header.php";
  ?>
</head>
<body>

  <header class="header clearfix" style="background-color: #95CAFC;">
    

    </button>
    <?php include('../main/nav.php'); 
    include('../connect.php');?>
   
  </header><?php
  include('side.php'); ?>  
      <div class="jumbotron" style="background: #95CAFC;">
         <body onLoad="document.getElementById('country').focus();">

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
       <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">surgical patients</li>
    <li class="breadcrumb-item active" aria-current="page">surgeries completed</li>
    <li class="breadcrumb-item" style="float: right;"><a href="theatre.php">pending surgeries</a></li>
  </ol>
</nav>      
      
      <div class="container" id="results" >
      
    <a rel="facebox" href="add.php"> <button class="btn-success" style="" >add patient to list</button></a></span></br><p></p> 
      <input type="text" id="search" onkeyup="myFunction()" placeholder="Search for patient.." title="Type in a patient number or name">
     <table class="table table-bordered" id="products_table" >
<thead class="bg-primary">
<tr>
<th>patient name</th>
<th>IP Number</th>
<th>age</th>
<th>sex</th>
<th>operation</th>
<th>type</th>
<th>category</th>
<th>other details</th>
<th>surgical notes</th>
</tr>
</thead>
<?php  $done=1;
        $result = $db->prepare("SELECT*  FROM surgeries RIGHT OUTER JOIN patients ON surgeries.patient=patients.opno WHERE status=:a");
        $result->BindParam(':a',$done);
        $result->execute();
       for($i=0; $row = $result->fetch(); $i++){        
      $category = $row['speciality'];
      $surg_id = $row['surg_id'];
      $patient = $row['name'];
      $ip_no = $row['opno'];
      $b= $row['age'];
      $sex= $row['sex'];
      $operation= $row['operation'];
      $type= $row['type'];
      $status= $row['status'];
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
<td><?php  if ($category==1) {
  echo "general";
 
}
 ?></td>
<td><?php  if ($category==2) {
  echo "obstetrics";
 
} 
 if ($category==3) {
  echo "pediatric";
 
}
 if ($category==4) {
  echo "ENT";
 
}
 if ($category==5) {
  echo "gaenecology";
 
}
 if ($category==6) {
  echo "neurosurgery";
 
}
 if ($category==7) {
  echo "cardiothoracic";
 
}
 if ($category==8) {
  echo "orthorpedic";
 
} if ($category==9) {
  echo "opthamology";
 
}
 ?> </td>
<td><a  href="details.php?id=<?=$ip_no; ?>">details</a></td>
<td><a rel="facebox" href="surgical_notes.php?id=<?=$surg_id; ?>">surgical notes</a></td><?php }?>
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