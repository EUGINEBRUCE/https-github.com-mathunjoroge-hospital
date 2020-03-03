<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
 <!DOCTYPE html>
<html>
<title>payslip</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../pharmacy/ckeditor/ckeditor.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../pharmacy/dist/js/bootstrap-select.js"></script>
  <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../src/facebox.js" type="text/javascript"></script>
</head>
<body><header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>   
  </header><?php include('sidee.php'); ?>
  <div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
         <body >
<div class="container" id="content">
  <div class="container" align="center">
  <?php
   $result = $db->prepare("SELECT * FROM settings");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $hospital=$row['name'];
        $address=$row['address'];
        $phone=$row['phone'];
        $email=$row['email'];
        $slogan=$row['slogan']; ?>
    <h6 ><?php echo $hospital; ?></h6>
    <h6 ><?php echo $address; ?></h6>
    <h6 ><?php echo $phone; ?></h6>
    <h6 ><?php echo $email; ?></h6>
  <?php } ?>
  </div>
        <?php 
          $employee_id=$_GET['employee_id'];
        $result = $db->prepare("SELECT*  FROM employees  JOIN job_groups ON employees.jg_id=job_groups.jg_id WHERE employee_id=:a");
        $result->bindParam(':a',$employee_id);
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $employee_id = $row['employee_id'];    
      $name = $row['employee_name'];
      $deployed_date=$row['date_deployed'];
      $jg = $row['jg_name'];
      $basic_pay = $row['basic_salary'];
      $status = $row['status'];
         ?>
         <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">payslip</li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $name;  ?></li>
    <li class="breadcrumb-item active" aria-current="page">job group:</b> <?php echo $jg;  ?></li>
   </ol><?php } ?>
<table class="table" >
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php  
		$period = date('Y-m');
		$result = $db->prepare("SELECT*  FROM salaries_payments WHERE employee_id=:a AND CONCAT(YEAR(date),'-',RIGHT(CONCAT('0',MONTH(DATE)),2))=:b");
        $result->bindParam(':a',$employee_id);
        $result->bindParam(':b',$period);
        $result->execute();
		$row = $result->fetch(); 
		$net_pay = $row['amount'];
		$gross_pay = $row['gross_pay'];
		$nfdw = $row['dw']/30;

         ?>
<tbody>
<tr>
<td style="width: 81.5%;">Basic pay</td>
<td><?php echo $basic_pay; ?></td>
</tr>
</tbody>
</table>

<table class="table" >
<thead>
<tr>
<th>Allowances</th>
<th></th>
</tr>
</thead>
<?php  
        $result = $db->prepare("SELECT *  FROM other_allowances  WHERE employee_id=:a AND CONCAT(YEAR(date),'-',RIGHT(CONCAT('0',MONTH(DATE)),2))=:b");
        $result->bindParam(':a',$employee_id);
        $result->bindParam(':b',$period);
        $result->execute();
		for($i=0; $row = $result->fetch(); $i++){ 
			$amount = $row['amount'];
			$name = $row['name'];		
?>
<tr>
<td style="width: 81.5%;"><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
</tr>

<?PHP
		}
?>
<tbody>
</tbody>
</table>


<table class="table" >
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<tr> 
<tr>
<td style="width: 81.5%;">Gross pay</td>
<td><?php echo $gross_pay; ?></td>
</tr>
<tr> 
</tbody>
</table>


<table class="table">
<thead>
<tr>
<th>Deductions</th>
<th></th>
</tr>
</thead>
<?php   
        $result = $db->prepare("SELECT* FROM nhif_payments WHERE employee_id=$employee_id AND CONCAT(YEAR(date),'-',RIGHT(CONCAT('0',MONTH(DATE)),2))=:a");
        $result->bindParam(':a',$period);
        $result->execute();
		$nhif =$result->fetch()['amount'];
		$nssf = 200;
         ?>
<tbody>
<tr>
<td style="width: 81.5%;">NHIF</td>
<td><?php echo $nhif; ?></td>
</tr>
<tr>
<td style="width: 81.5%;">NSSF</td>
<td><?php echo $nssf; ?></td>
</tr>
<tr> 
<?PHP 

$result = $db->prepare("SELECT*  FROM other_deductions WHERE employee_id=:a AND CONCAT(YEAR(date),'-',RIGHT(CONCAT('0',MONTH(DATE)),2))=:b");
$result->bindParam(':a',$employee_id);
$result->bindParam(':b',$period);
$result->execute();

for($i=0; $row = $result->fetch(); $i++){ 
		$amount = $row['amount'];
		$name = $row['name'];
?>
<tr>
	<td><?PHP echo $name?></td>
	<td><?PHP echo $amount?></td>
<tr> 
<?PHP 
}
?>
</tbody>
</table>
<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<?php   
    $result = $db->prepare("SELECT* FROM tax_paid WHERE employee_id=:a AND CONCAT(YEAR(date),'-',RIGHT(CONCAT('0',MONTH(DATE)),2))=:b");
   $result->bindParam(':a',$_GET['employee_id']);
   $result->bindParam(':b',$period);
   $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $paye = $row['amount'];
      
         ?>
<tbody>
<tr>
<td style="width: 81.5%;">PAYE AUTO</td>
<td><?php  echo $paye;  ?></td>
<?php }?>

</tr>
</tbody>
</table>
<table class="table">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 81.5%;"><b>Net pay</b></td>
<td><b><?php echo($net_pay); ?></b></td>
</tr>
<tr> 
</tbody>
</table>

</div>
<div><button value="content" id="goback" onclick="javascript:printDiv('content')">Print Payslip</button></div>
<script type="text/javascript">
   function printDiv(content) {
            //Get the HTML of div
            var divElements = document.getElementById(content).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;          
        }


</script>
</div>
</body>
</html>