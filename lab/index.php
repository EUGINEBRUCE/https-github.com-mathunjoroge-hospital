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
     <table class="table table-bordered" >
<thead class="bg-primary">
<tr>
<th>patient name</th>
<th>sex</th>
<th>age</th>

</tr>
</thead>
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
        
<tbody>
<tr>
<td><a  href="details.php?search=<?php echo $number ?>&response=<?php echo '0'; ?>"><?php echo $name; ?></a></td>
<td><?php echo $sex; ?></td>
<td> <?php 
$now = date('Y-m-d');
$dob = date("Y-m-d", strtotime($b));  
$date1=date_create($dob);
$date2=date_create($now);
$diff=date_diff($date1,$date2);
$days=(float)$diff->format("%R%a");
if ($days<30) {
echo $days." days";
}
else if((30 <= $days) && ($days <=365)) {
    
echo number_format((float)($days/30), 2, '.', '')." months"; 
}
else{
    echo number_format((float)($days/365), 2, '.', '')." years";
}
?></td>

<?php }?>
</tr>

</tbody>
</table>
</div></div>
 </br>
</div></div></div></div></div></div></div></div>

</body>
</html>