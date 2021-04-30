<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>surgeries summary</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <?php 
  include "../header.php";
  ?>
</head>
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">         
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date_one" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

  </script>
  <script>
  $( function() {
    $( "#date_two" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

  </script>
  
</head>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">advanced filter</li>
  
    </ol>
  <span> 
    <form action="advanced.php?" method="GET">
    <select name="type" title="please type"/>
                    <option value=""></option>
      <option value="1">elective</option>
      <option value="2">emergency</option>
    </select>
    <select name="speciality" title="please specialty"/>
                    <option value=""></option>
      <option value="1">general</option>
      <option value="2">obstetric</option>
      <option value="3">pediatric</option>
      <option value="4">ENT</option>
      <option value="5">gaenecology</option>
      <option value="6">neurosurgery</option>
      <option value="7">cardiothoracic</option>
      <option value="8">orthorpedic</option>
      <option value="9">ophthamology</option>
    </select>
    <input type="text" id="date_one" required="required" name="date_one" placeholder="pick start date" autocomplete="off">
    <input type="text" id="date_two" required="required" name="date_two" placeholder="pick end date" autocomplete="off">    <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button>
  </form>
  <?php if (isset($_GET['date_one'])) {
    include('../connect.php');
  $a=date("Y-m-d", strtotime($_GET['date_one']));
  $b=date("Y-m-d", strtotime($_GET['date_two']));
  $c=1; 
    # code...
   ?>
   <div class="container">
   <div class="container" id="content">
   <div class="container">
    <p>&nbsp;</p>
   <center>summary for 
    <?php
  
    
    if (isset($_GET['speciality'])) {
      # code...
    
    $surg_specialty= $_GET['speciality'];
    if ($surg_specialty==1) {
      echo "general";
    }
    elseif ($surg_specialty==2) {
      echo "obstetric";
    }
     elseif ($surg_specialty==3) {
      echo "pediatric";
    }
     elseif ($surg_specialty==4) {
      echo "ENT";
    }
     elseif ($surg_specialty==5) {
      echo "gaenecology";
    }
    
     elseif ($surg_specialty==6) {
      echo "neurosurgery";
    }
    
     elseif ($surg_specialty==7) {
      echo "cardiothoracic";
    }
    
     elseif ($surg_specialty==8) {
      echo "orthorpedic";
    }
    elseif ($surg_specialty==9) {
      echo "ophthamology";
    }
    else{
      echo "all";

    }
    }
    if (isset($_GET['type'])) {
      $type=$_GET['type'];
    
    if ($type==1) {
    echo " elective ";
  }
  if ($type==2) {
    echo " emergency";
  }
  else{
    
  }
  }

     ?>
   surgeries</br>
    
    From: 
    <?php echo date("d-m-Y", strtotime($_GET['date_one']))  ?> to: <?php echo date("d-m-Y", strtotime($_GET['date_two']))  ?></center>
   <p>&nbsp;</p>
   </div>
    
   <?php 
   if (empty($_GET['type'])&&(empty($_GET['speciality']))) {
     # <--displayed if just a general search--->
   
   ?>
   
   <div class="container">
   
    <table class="table" >
<thead>
<tr>  <th>date</th>
      <th>patient name</th>
      <th>number</th>
      <th>age</th>
      <th>specialty</th>
       <th>procedure</th>
        <th>type</th>
       </tr>
</thead>
 <tbody>
  <?php
   
  $d=$_GET['type'];     
  $result = $db->prepare("SELECT name,opno,age,operation,type,speciality,status,surge_done_on AS date FROM surgeries RIGHT OUTER JOIN patients ON surgeries.patient=patients.opno  WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c ORDER BY type ASC");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo date("d-M, Y", strtotime($row['date'])); ?>&nbsp;</td>
  <td><?php echo $row['name']; ?>&nbsp;</td>
      <td> &nbsp;<?php echo $row['opno']; ?>
         <td> &nbsp;<?php
         $now = time('Y/m/d');
$dob = strtotime($row['age']);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?></td>
  <td>
    <?php
    $surg_specialty=$row['speciality'];
    if ($surg_specialty==1) {
      echo "general";
    }
    elseif ($surg_specialty==2) {
      echo "obstetric";
    }
     elseif ($surg_specialty==3) {
      echo "pediatric";
    }
     elseif ($surg_specialty==4) {
      echo "ENT";
    }
     elseif ($surg_specialty==5) {
      echo "gaenecology";
    }
    
     elseif ($surg_specialty==6) {
      echo "neurosurgery";
    }
    
     elseif ($surg_specialty==7) {
      echo "cardiothoracic";
    }
    
     elseif ($surg_specialty==8) {
      echo "orthorpedic";
    }
    else{
      echo "ophthamology";

    }
     ?>
  </td>
  <td><?php echo $row['operation']; ?></td>
  <td><?php if ($row['type']==1) {
    echo "elective";
  }
  else{
    echo "emergencey";
  }
  ?></td>
            </td><?php }  ?></tbody>
</table>
 <table class="table" >
<thead>
<tr>  <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
       </tr>
</thead>
 <tbody>
  <?php     
  $result = $db->prepare("SELECT count(patient) AS total FROM surgeries WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td>total</td>
  <td>&nbsp;</td>
      <td> &nbsp;</td>
         <td> &nbsp;<?php echo $row['total']; ?>
            </td><?php }  ?></tbody>
</table>
     
   </div>
 <?php } ?>
 
   <?php 
   if (!empty($_GET['type'])&&(empty($_GET['speciality']))) {
     # <--displayed if type is set but speciality is not--->
   
   ?>
   
   <div class="container">
   
    <table class="table" >
<thead>
<tr>  <th>date</th>
      <th>patient name</th>
      <th>number</th>
      <th>age</th>
      <th>specialty</th>
       <th>procedure</th>
        <th>type</th>
       </tr>
</thead>
 <tbody>
  <?php 
  $d=$_GET['type'];     
  $result = $db->prepare("SELECT name,opno,age,operation,type,speciality,status,surge_done_on AS date FROM surgeries RIGHT OUTER JOIN patients ON surgeries.patient=patients.opno  WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c AND type=:d ORDER BY speciality ASC");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->bindParam(':d',$d);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo date("d-M, Y", strtotime($row['date'])); ?>&nbsp;</td>
  <td><?php echo $row['name']; ?>&nbsp;</td>
      <td> &nbsp;<?php echo $row['opno']; ?>
         <td> &nbsp;<?php
         $now = time('Y/m/d');
$dob = strtotime($row['age']);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?></td>
  <td>
    <?php
    $surg_specialty=$row['speciality'];
    if ($surg_specialty==1) {
      echo "general";
    }
    elseif ($surg_specialty==2) {
      echo "obstetric";
    }
     elseif ($surg_specialty==3) {
      echo "pediatric";
    }
     elseif ($surg_specialty==4) {
      echo "ENT";
    }
     elseif ($surg_specialty==5) {
      echo "gaenecology";
    }
    
     elseif ($surg_specialty==6) {
      echo "neurosurgery";
    }
    
     elseif ($surg_specialty==7) {
      echo "cardiothoracic";
    }
    
     elseif ($surg_specialty==8) {
      echo "orthorpedic";
    }
    else{
      echo "ophthamology";

    }
     ?>
  </td>
  <td><?php echo $row['operation']; ?></td>
  <td><?php if ($row['type']==1) {
    echo "elective";
  }
  else{
    echo "emergencey";
  }
  ?></td>
            </td><?php }  ?></tbody>
</table>
 <table class="table" >
<thead>
<tr>  <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
       </tr>
</thead>
 <tbody>
  <?php     
  $result = $db->prepare("SELECT count(patient) AS total FROM surgeries WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c AND type=:d");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->bindParam(':d',$d);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td>total</td>
  <td>&nbsp;</td>
      <td> &nbsp;</td>
         <td> &nbsp;<?php echo $row['total']; ?>
            </td><?php }  ?></tbody>
</table>
     
   </div>
 <?php } ?>
 <?php 
   if (empty($_GET['type'])&&(!empty($_GET['speciality']))) {
     #  <--displayed if specialty is set but type is not--->
   
   ?>
  
   <div class="container">
   
    <table class="table" >
<thead>
<tr>  <th>date</th>
      <th>patient name</th>
      <th>number</th>
      <th>age</th>
      <th>specialty</th>
       <th>procedure</th>
        <th>type</th>
       </tr>
</thead>
 <tbody>
  <?php 
  $d=$_GET['speciality'];     
  $result = $db->prepare("SELECT name,opno,age,operation,type,speciality,status,surge_done_on AS date FROM surgeries RIGHT OUTER JOIN patients ON surgeries.patient=patients.opno  WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c AND speciality=:d ORDER BY type ASC");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->bindParam(':d',$d);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo date("d-M, Y", strtotime($row['date'])); ?>&nbsp;</td>
  <td><?php echo $row['name']; ?>&nbsp;</td>
      <td> &nbsp;<?php echo $row['opno']; ?>
         <td> &nbsp;<?php
         $now = time('Y/m/d');
$dob = strtotime($row['age']);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?></td>
  <td>
    <?php
    $surg_specialty=$row['speciality'];
    if ($surg_specialty==1) {
      echo "general";
    }
    elseif ($surg_specialty==2) {
      echo "obstetric";
    }
     elseif ($surg_specialty==3) {
      echo "pediatric";
    }
     elseif ($surg_specialty==4) {
      echo "ENT";
    }
     elseif ($surg_specialty==5) {
      echo "gaenecology";
    }
    
     elseif ($surg_specialty==6) {
      echo "neurosurgery";
    }
    
     elseif ($surg_specialty==7) {
      echo "cardiothoracic";
    }
    
     elseif ($surg_specialty==8) {
      echo "orthorpedic";
    }
    else{
      echo "ophthamology";

    }
     ?>
  </td>
  <td><?php echo $row['operation']; ?></td>
  <td><?php if ($row['type']==1) {
    echo "elective";
  }
  else{
    echo "emergencey";
  }
  ?></td>
            </td><?php }  ?></tbody>
</table>
 <table class="table" >
<thead>
<tr>  <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
       </tr>
</thead>
 <tbody>
  <?php     
  $result = $db->prepare("SELECT count(patient) AS total FROM surgeries WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c AND speciality=:d");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->bindParam(':d',$d);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td>total</td>
  <td>&nbsp;</td>
      <td> &nbsp;</td>
         <td> &nbsp;<?php echo $row['total']; ?>
            </td><?php }  ?></tbody>
</table>
     
   </div>
 <?php } ?>
 <?php 
   if (!empty($_GET['type'])&&(!empty($_GET['speciality']))) {
     # <--displayed if all isset--->
   
   ?>
   
   <div class="container">
   
    <table class="table" >
<thead>
<tr>  <th>date</th>
      <th>patient name</th>
      <th>number</th>
      <th>age</th>
      <th>specialty</th>
       <th>procedure</th>
        <th>type</th>
       </tr>
</thead>
 <tbody>
  <?php 
  $e=$_GET['type'];
  $d=$_GET['speciality'];      
  $result = $db->prepare("SELECT name,opno,age,operation,type,speciality,status,surge_done_on AS date FROM surgeries RIGHT OUTER JOIN patients ON surgeries.patient=patients.opno  WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c AND speciality=:d AND type=:e");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->bindParam(':d',$d);
  $result->bindParam(':e',$e);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo date("d-M, Y", strtotime($row['date'])); ?>&nbsp;</td>
  <td><?php echo $row['name']; ?>&nbsp;</td>
      <td> &nbsp;<?php echo $row['opno']; ?>
         <td> &nbsp;<?php
         $now = time('Y/m/d');
$dob = strtotime($row['age']);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?></td>
  <td>
    <?php
    $surg_specialty=$row['speciality'];
    if ($surg_specialty==1) {
      echo "general";
    }
    elseif ($surg_specialty==2) {
      echo "obstetric";
    }
     elseif ($surg_specialty==3) {
      echo "pediatric";
    }
     elseif ($surg_specialty==4) {
      echo "ENT";
    }
     elseif ($surg_specialty==5) {
      echo "gaenecology";
    }
    
     elseif ($surg_specialty==6) {
      echo "neurosurgery";
    }
    
     elseif ($surg_specialty==7) {
      echo "cardiothoracic";
    }
    
     elseif ($surg_specialty==8) {
      echo "orthorpedic";
    }
    else{
      echo "ophthamology";

    }
     ?>
  </td>
  <td><?php echo $row['operation']; ?></td>
  <td><?php if ($row['type']==1) {
    echo "elective";
  }
  else{
    echo "emergencey";
  }
  ?></td>
            </td><?php }  ?></tbody>
</table>
 <table class="table" >
<thead>
<tr>  <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
       </tr>
</thead>
 <tbody>
  <?php     
  $result = $db->prepare("SELECT count(patient) AS total FROM surgeries WHERE date(surgeries.surge_done_on)>=:a AND date(surgeries.surge_done_on)<=:b AND status=:c AND speciality=:d AND type=:e");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->bindParam(':d',$d);
  $result->bindParam(':e',$e);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td>total</td>
  <td>&nbsp;</td>
      <td> &nbsp;</td>
         <td> &nbsp;<?php echo $row['total']; ?>
            </td><?php }  ?></tbody>
</table>
     
   </div>
 <?php } ?>
 
</div>
 <button class="btn btn-success btn-large" style="margin-left: 45%;" value="content" id="goback" onclick="javascript:printDiv('content')" >print report</button>
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
     
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</body>
</html>