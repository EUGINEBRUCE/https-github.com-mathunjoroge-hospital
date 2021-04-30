<?php 
include('../connect.php');
require_once('../main/auth.php');

$result = $db->prepare("SELECT * FROM purchases");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
 ?> 
 <!DOCTYPE html>
<html>
<title>stores</title>
<?php
include "../header.php";
?>
<body><header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">
        
      
      <div class="container" id="results" > 
      <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">pending orders</li>

    <?php
      $search=$_GET['search'];
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
     
     ?>
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php } ?>
   </ol><span></span></br> 
   <?php
   if($_GET['response']==1)
   {
     ?>
     <div class="alert alert-success" role="alert">
  order saved
  <button type='button' class='close' onclick='$(this).parent().hide();'>×</button>
</div>

   <?php } ?>
     <table class="table table-bordered" >
<thead class="bg-primary">
<tr>
<th>odered by</th>
<th>date and time</th>
<th>view</th>

</thead>
<?php
        $result = $db->prepare("SELECT* FROM orders WHERE cashed_by='' GROUP BY patient");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $a= $row['patient'];
      $b = $row['posted_by'];
      $c= $row['date'];
      
         ?>
<tbody>
<tr>
<td><?php echo $b; ?></td>
<td ><?php echo $c; ?></td>
<td><a href="vieworder.php?id=<?php echo $a; ?>"> view</a></td>
<?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>
</div> </div>
</div>  
<script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>