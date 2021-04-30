<?php 
require_once('../main/auth.php');
include('../connect.php');

 ?>
<!DOCTYPE html>
<html>
<title>consumption report</title>
<?php
  include "../header.php";
  ?>
</head>
  <body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header>
  <?php include('side.php');  ?>
      <div class="jumbotron" style="background: #95CAFC;">         
<form action="consumption.php" method="GET">
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
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
</head>
  <span>
 from: <input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick date"> to: <input type="text" id="mydat"  name="d2" autocomplete="off" placeholder="pick date">
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
<p>&nbsp;</p>
<?php 
if (isset($_GET['d1'])) {
   $d1=$_GET['d1']." 00:00:00"; 
       $d2=$_GET['d2']." 23:59:59";
       $date1=date("Y-m-d H:i:s", strtotime($d1));
       $date2=date("Y-m-d H:i:s", strtotime($d2));
 ?>
  <center><b>consumption report</b></center>
     <p></p>
     <center><b>period: <?php echo date('d-m-Y',strtotime($d1)); ?> to <?php echo date('d-m-Y',strtotime($d2)); ?> </b></center>
     <p>&nbsp;</p>
</hr><div class="container" id="print">
  <table class="table table-bordered">
      <caption>consumption report</caption>
      <thead class="bg-primary">
    <tr>
      <th>brand name</th>
      <th>generic name</th>
      <th> total quantity</th>
    </tr>
    </thead>
<?php      
        $result = $db->prepare("SELECT generic_name,brand_name,sum(dispensed_drugs.quantity) AS qty FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE (updated_at >=:a AND updated_at <= :b)  GROUP BY brand_name");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);      
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['generic_name'];
      $brand_name = $row['brand_name'];
      $qty= $row['qty'];
         ?>
         <tbody>
          <tr>
<td ><?php echo $brand_name; ?></td>
<td><?php echo $name; ?></td>
<td><?php echo $qty; ?></td>
</tr><?php } ?>
</tbody>
</table>
<button class="btn btn-success btn-large" style="width: 100%;" id="print" onclick="printContent('print');">print</button>
</div>
<?php } ?>
<script src="../resources/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div>
</body>
</html>