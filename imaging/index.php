<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
<!DOCTYPE html>
<html>
<title>lab</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=false">
<meta http-equiv="refresh" content="30">
<?php 
include "../header.php";
?>
    
</head>

<body>
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">
      <div class="jumbotron" style="background: #95CAFC;">
     
      <p>&nbsp;</p>
  
<div class="container" >   <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">lab patients</li>
    <li class="breadcrumb-item active" aria-current="page">waiting list</li>
    <li class="breadcrumb-item"><a href="edit.php?search= &response=0">edit results</a></li>
  </ol>
</nav> 
<?php if (isset($_REQUEST["failed"])) {
  # code...
 ?>
 <b class="alert-danger"> you did not tick all the comments. please repeat and post</b>
<?php } ?>
<?php if (isset($_REQUEST["success"])) {
  # code...
 ?>
 <b class="alert-success"> data posted successifully</b>
<?php } ?>
   
<?php
$a =0;
$result = $db->prepare("SELECT DISTINCT(opno),age,sex,name FROM patients RIGHT OUTER JOIN lab ON lab.opn=patients.opno WHERE lab.served=:a");
$result->bindParam(':a',$a);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $b = $row['age'];
      $sex = $row['sex'];
      $number= $row['opno'];

         ?>

<?php }?>
</tr>

</tbody>
</table>
<label>imagings requested for</label></br> 
<table class="table table-bordered" >
<thead class="bg-primary">
<tr>
<th>patient name</th>
<th>sex</th>
<th>age</th>

</tr>
</thead>
<?php  
$result = $db->prepare("SELECT DISTINCT(opno),name,age,sex FROM patients RIGHT OUTER JOIN  req_images ON  req_images.opn=patients.opno WHERE  req_images.served=:a");
$result->bindParam(':a',$a);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $b = $row['age'];
      $sex = $row['sex'];
      $number= $row['opno'];

         ?>
        
<tbody>
<tr>
<td><a  href="details.php?search=<?php echo $number ?>&response=<?php echo '0'; ?>"><?php echo $name; ?></a></td>
<td><?php echo $sex; ?></td>
<td>  <?php 
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
  } ?></td>

<?php }?>
</tr>

</tbody>
</table></div></div>
 </br>
</div></div></div></div></div></div></div></div>

</body>
</html>