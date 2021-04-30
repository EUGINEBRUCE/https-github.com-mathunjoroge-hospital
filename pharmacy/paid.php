<?php 
include('../connect.php');
require_once('../main/auth.php');

 ?> 
 <!DOCTYPE html>
<html>
<title>paid up receipts</title>
<?php
  include "../header.php";
  ?>
</head>
<body>
 <header class="header clearfix" style="background-color: #3786d6;">
    
</button>
    <?php include('../main/nav.php'); 
    ?>
  </header><?php include('side.php'); ?>
      <div class="jumbotron" style="background: #95CAFC;">
         
      <div class="container" id="results" > 
        <h3>paid up prescriptions</h3><span></span></br> 
     <table class="table table-bordered" >
<thead class="bg-primary">
<tr>
<th>name</th>
<th>age</th>
<th>sex</th>

</thead>
<?php   $date1=date('Y-m-d')." 00:00:00";
        $date2=date('Y-m-d H:i:s');
        $cashier='';
        $result = $db->prepare("SELECT* FROM dispensed_drugs JOIN patients ON dispensed_drugs.patient=patients.opno  WHERE date BETWEEN :a AND :b AND cashed_by<>:c GROUP BY patient");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$cashier);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
     
        $a= $row['name'];
        $b = $row['age'];
        $c= $row['sex'];
        $d= $row['opno'];
         ?>
<tbody>
<tr>
<td><a rel="facebox" href="view.php?search=<?php echo $d; ?>"><?php echo $a; ?></a></td>
<td ><?php $now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?></td>
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