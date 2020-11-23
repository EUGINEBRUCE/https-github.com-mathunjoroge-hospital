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
</head>
<body><header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">
       
      
      <div class="container" id="results" > 
        <h3>pending lab orders</h3><span></span></br> 
     <table class="table table-bordered" >
<thead>
<tr>
<th>odered by</th>
<th>date and time</th>
<th>view</th>

</thead>
<?php
        $result = $db->prepare("SELECT* FROM lab_orders WHERE cashed_by='' GROUP BY patient");
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
<td><a href="vieworder_lab.php?id=<?php echo $a; ?>"> view</a></td>
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