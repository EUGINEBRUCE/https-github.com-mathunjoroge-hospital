<?php 
require_once('../main/auth.php');
include ('../connect.php'); ?>
 <!DOCTYPE html>
<html>
<title>payroll</title>
<?php
include "../header.php";
?>
</head>
<body><header class="header clearfix" style="background-color: #3786d6;">
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
     <table class="table table-bordered" >
<thead class="bg-primary">
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
      <table class="table table-bordered" >
<thead class="bg-primary">
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
           
      <table class="table table-bordered" >
<thead class="bg-primary">
<tr>
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
     <table class="table table-bordered" >
<thead class="bg-primary">
<tr>
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