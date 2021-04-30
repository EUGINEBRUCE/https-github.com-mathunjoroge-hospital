<?php 
require_once('../main/auth.php');
include('../connect.php');
 ?> 
 <!DOCTYPE html>
<html>
<title>expenses</title>
<?php include "../header.php"; ?>
</head>
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); 
    ?>   
  </header>
  <?php include('side.php'); ?>
  <div class="content-wrapper">
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
<div class="jumbotron" style="background: #95CAFC;">
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="expenses.php">Home</a></li>
    <li class="breadcrumb-item" aria-current="page"> <a rel="facebox" href="record_mis_expense.php"> record miscellaneous expense</a></li>    <li class="breadcrumb-item" aria-current="page"> <a rel="facebox" href="record_expense.php"> record expense</a></li>
    <li class="breadcrumb-item" aria-current="page"> <a href="">expenses summary</a></li>
  </ol>
</nav>
<?php
if (isset($_GET['response'])) {
?>
<p class="alert alert-success">expense recorded</p>
<?php } ?>
<div class="container">
<label>expenses summary</label> 
<form action="expenses.php" method="GET">
  
  from: <input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick start date" required="true"/> to: <input type="text" id="mydat"  name="d2" autocomplete="off" placeholder="pick end date" required="true"/>
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>

</form>
</hr> 
<p>&nbsp;</p>
<?php
if (isset($_GET['d1'])) {
     ?>
<table class="table">
  <tr>
    <th>date</th>
    <th>expense</th>
    <th>amount</th>
    <th>paid in by</th>
  </tr>
  <tr>
 <?php
 $d1=$_GET['d1']." 00:00:00"; 
       $d2=$_GET['d2']." 23:59:59";
       $date1=date("Y-m-d H:i:s", strtotime($d1));
       $date2=date("Y-m-d H:i:s", strtotime($d2));
 $result = $db->prepare("SELECT* FROM overheads  RIGHT OUTER JOIN expenses ON expenses.expense_id=overheads.expense_id WHERE payment_date>=:a AND payment_date<=:b ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);     
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){      
   ?>
   <td><?php echo $row['payment_date']; ?></td>
   <td><?php echo $row['expense_name']; ?></td>
   <td><?php echo $row['amount']; ?></td>
   <td><?php echo $row['paid_by']; ?></td>
    </tr>
    <?php
    } ?>
   </table> 
   <table class="table">
     <tr>
       <th style="width:90%;"></th>
       <th></th>
     </tr>
   <?php 
   $result = $db->prepare("SELECT sum(amount) AS total FROM overheads WHERE payment_date>=:a AND payment_date<=:b ");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);     
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
</body>
</html>