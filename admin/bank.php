<?php 
require_once('../main/auth.php');
include ('../connect.php'); ?>
 <!DOCTYPE html>
<html>
<title>bank copy</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../pharmacy/dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../pharmacy/dist/js/bootstrap-select.js"></script>
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
  <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
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
<div class="jumbotron" style="background: #95CAFC;">
   <ol class="breadcrumb primary">
    <li style="float:right;"><?php
        $result = $db->prepare("SELECT status  FROM employees WHERE active=1 LIMIT 1");
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
      $status = $row['status'];
      if ($status== 0) {
            # code...
             
      ?>
      <a href="activate_pay.php?status=1">activate payslips</a><?php } ?><?php
      if ($status==1) { ?>payslips activated<?php } ?><?php
      if ($status==2) { ?>salaries paid <a href="activate_pay.php?status=2">reset payslips</a><?php } ?><?php } ?></li>
   <li><a rel="facebox" href="add_employee.php">add employee</a></li> 
   <li><a rel="facebox" href="add_job_group.php"> add job group</a></li>
   <li><a rel="facebox" href="add_allowance.php">add allowance</a></li>
   <li><a href="bank.php">payroll bank copy</a></li>
   </ol>    
</nav>
<?php
if (isset($_GET['response'])) {
?>
<p class="alert alert-success">expense recorded</p>
<?php } ?>
<div class="container">
<label>generate payrol bank copy</label> 
<form action="bank.php" method="GET"><input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick date" required/><button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>

</form>
</hr> 
<p>&nbsp;</p>
<?php
if (isset($_GET['d1'])) {
     ?>
     <div class="container" id="content">
<table class="table">
  <tr>
    <th>date</th>
    <th>account name</th>
    <th>account number</th>
    <th>bank</th>
    <th>gross pay</th>
    <th>total deductions</th>
    <th> net pay</th>
  </tr>
  <tr>
 <?php
 $d1=$_GET['d1']; 
       $date1=date("Y-m-d", strtotime($d1));
 $result = $db->prepare("SELECT* FROM salaries_payments  RIGHT OUTER JOIN employees ON employees.employee_id=salaries_payments.employee_id WHERE date(date)=:a");
        $result->bindParam(':a',$date1);   
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){      
   ?>
   <td><?php echo $row['date']; ?></td>
   <td><?php echo $row['employee_name']; ?></td>
    <td><?php echo $row['account_number']; ?></td>
     <td><?php echo $row['bank']; ?></td>
      <td><?php echo $row['gross_pay']; ?></td>
     <td><?php echo ($row['gross_pay']-$row['amount']); ?></td>
    <td><?php echo $row['amount']; ?></td>
    </tr>
    <?php
    } ?>
   </table> 
   <table class="table">
     <tr>
       <th style="width:85.5%;"></th>
     </tr>
   <?php 
   $result = $db->prepare("SELECT sum(amount) AS total FROM salaries_payments  WHERE date(date)=:a");
        $result->bindParam(':a',$date1);     
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ 
  $total_expenses=$row['total']; 
   ?>   
     <tr>
       <td>total</td>
       <td><?php echo $total_expenses; ?></td>
     </tr><?php } ?>
   </table>
 <?php } ?>
 </div>
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
      <button class="btn btn-success btn-large" style="margin-left: 45%;" value="content" id="goback" onclick="javascript:printDiv('content')" >print copy</button>
 <script>
  $( function() {
    $( "#mydate" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

  </script>
  <script>
  $( function() {
    $( "#mydat" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  </script> 

</div>
</body>
</html>