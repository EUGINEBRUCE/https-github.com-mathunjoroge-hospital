<?php 
require_once('../main/auth.php');
include('../connect.php');
$token=$_GET['token'];
?>
<!DOCTYPE html>
<html>
<title>pharmacy</title>
<?php
include "../header.php";
?>
</head>
<body>
<header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>   
</header>
<?php include('side.php'); ?>
<div class="content-wrapper" style=" background-image: url('../images/doctor.jpg');">
<div class="jumbotron" style="background: #95CAFC;">
<?php 
$result = $db->prepare("SELECT * FROM orders");
$result->execute();
$rowcountt = $result->rowcount();
$rowcount = $rowcountt+1;
$code=$rowcount;
?>   
</header>
<div class="content-wrapper">   
<div>
<nav aria-label="breadcrumb" style="width: 90%;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">patient</li>
<li class="breadcrumb-item active" aria-current="page">search patient</li>
<?php
$search=$_GET['search'];
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$a=$row['name'];
$b=$row['age'];
$c=$row['sex'];

?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php include '../doctors/age.php'; } ?>
<li style="float:right;"><a href="waiting.php?list=3">oncology waiting list</a></li>
<li style="float:right;"><a href="waiting.php?list=2">inpatient waiting list</a></li>
<li style="float:right;"><a href="waiting.php?list=1">outpatient waiting list</a></li></ol>
<?php
$dept=$_GET['list'];
if($dept==1){

$caption="outpatient waiting list";  
}
elseif($dept==2){
$caption="inpatient waiting list"; 
}
else{
$caption="oncology waiting list"; 
}
?>
<caption><?=$caption; ?></caption>
<table class="table table-bordered" >
<thead class="bg-primary">
<tr>
<th>patient name</th>
<th>sex</th>
<th>age</th>

</tr>
</thead>
<?php
$dept=$_GET['list'];
if($dept==1){
$b =0;
}
else{
$b =1; 
}
$a =0;
$result = $db->prepare("SELECT DISTINCT(opno),age,sex,name FROM prescribed_meds LEFT OUTER JOIN patients ON prescribed_meds.patient=patients.opno RIGHT OUTER JOIN meds ON prescribed_meds.drug=meds.id  WHERE dispensed=:a AND is_anticancer=:b");
$result->bindParam(':a',$a);
$result->bindParam(':b',$b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){

$name = $row['name'];
$b = $row['age'];
$sex = $row['sex'];
$number= $row['opno'];

?>

<tbody>
<tr>
<td><a  href="index.php?search=<?php echo $number ?>&response=0&token<?php echo rand(); ?>"><?php echo $name; ?></a></td>
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