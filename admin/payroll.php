<?php 
require_once('../main/auth.php');
include ('../connect.php'); ?>
 <!DOCTYPE html>
<html>
<title>payroll</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : '../src/loading.gif',
      closeImage   : '../src/closelabel.png'
    })
  })
</script>
  <style type="text/css">
    table.resultstable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.resultstable td, table.resultstable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.resultstable tbody td {
  font-size: 13px;
}
table.resultstable tr:nth-child(even) {
  background: #D0E4F5;
}
table.resultstable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.resultstable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.resultstable thead th:first-child {
  border-left: none;
}

table.resultstable tfoot td {
  font-size: 14px;
}
table.resultstable tfoot .links {
  text-align: right;
}
table.resultstable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
  </style>
  
</head>
<body><header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>   
  </header><?php include('sidee.php'); ?>
  <div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
         <body ><div class="container">
          <ol class="breadcrumb primary">
    <li class="breadcrumb-item active" aria-current="page">pay roll allowances & deductions</li>
    <?php
        $a=0;
        $result = $db->prepare("SELECT* FROM employees WHERE status=:a");
        $result->bindParam(':a',$a);
        $result->execute();
        $no_activated=$result->rowcount();
      if ($no_activated>0) { 
               
      ?>
      <li style="float: right;">
      <a href="activate_pay.php?status=1">activate payslips</a></li><?php } ?> 
      <?php
      $b=1;
      $result = $db->prepare("SELECT* FROM employees WHERE active=:b");
        $result->bindParam(':b',$b);
        $result->execute();
        $no_of_employees=$result->rowcount();
        $c=2;
        $result = $db->prepare("SELECT* FROM employees WHERE status=:c");
        $result->bindParam(':c',$c);
        $result->execute();
        $no_activated=$result->rowcount();
      if ($no_activated==$no_of_employees) { 
               
      ?>
      <li style="float: right;">
        all salaries paid
      <a href="reset_pay.php?status=0">reset payroll</a></li><?php } ?>    
   </ol>  
   <ol class="breadcrumb primary">
   <li><a rel="facebox" href="add_employee.php">add employee</a></li> 
   <li><a rel="facebox" href="add_job_group.php"> add job group</a></li>
   <li><a rel="facebox" href="add_allowance.php">add allowance</a></li>
   <li><a href="bank.php">payroll bank copy</a></li>
   </ol>    
      <h4>employees</h4>
     <table class="resultstable" >
<thead>
<tr>
<th> name</th>
<th>deployment date</th>
<th>job group</th>.
<th>basic salary</th>
<th>action</th>
</tr>
</thead>
<?php
        $result = $db->prepare("SELECT*  FROM employees  JOIN job_groups ON employees.jg_id=job_groups.jg_id");
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $employee_id = $row['employee_id'];    
      $name = $row['employee_name'];
      $deployed_date=$row['date_deployed'];
      $jg = $row['jg_name'];
      $basic_salary = $row['basic_salary'];
         ?>
<tbody>
<tr>
<td><a href="payslip.php?employee_id=<?php echo $employee_id; ?>"><?php echo $name; ?></a></td>
<td><?php echo $deployed_date; ?></td>
<td><?php echo $jg; ?></td>
<td><?php echo $basic_salary; ?></td>
<td><a rel="facebox" href="editemployee.php?id=<?php echo $row['employee_id']; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit employee"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
<h4>job groups</h4>          
     <table class="resultstable" >
<thead>
<tr>
<th>job group</th>
<th>basic salary</th>
<th>action</th>
</tr>
</thead>
<?php
        $result = $db->prepare("SELECT*  FROM job_groups");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['jg_name'];
      $basic_salary = $row['basic_salary']; 
      $jg_id = $row['jg_id']; 
         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $basic_salary; ?></td>
<td><a rel="facebox" href="edit_jb.php?id=<?php echo $row['id']; ?>&name=<?php echo $name; ?>&amount=<?php echo $amount; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit job group"></button></a></td><?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>
 <h4>allowances</h4>
           
     <table class="resultstable" >
<thead>
<tr>
<th>allowance</th>
<th>amount</th>
<th>edit</th>
</tr>
</thead>
<?php
        $result = $db->prepare("SELECT*  FROM alowances");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $name = $row['name'];
      $amount = $row['amount'];
      $alowance_id = $row['all_id'];
         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $amount; ?></td>
<td><a rel="facebox" href="edit_allowance.php?id=<?php echo $alowance_id; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit allowance"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
</br>
 <h4>NHIF </h4><span>
     <table class="resultstable" >
<thead>
<tr>
<th>gross salary</th>
<th>amount NHIF payable</th>
</tr>
</thead>
<?php
        $result = $db->prepare("SELECT*  FROM nhif");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $salary = $row['net_salary'];
      $deduction = $row['deduction'];
      $id = $row['id'];
         ?>
<tbody>
<tr>
<td><?php echo $salary ; ?></td>
<td><?php echo $deduction ; ?></td>
<?php }?>
</tr>
<tr> 
</tbody>
</table>
</div>
</body>
</html>