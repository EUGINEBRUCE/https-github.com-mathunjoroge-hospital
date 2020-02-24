<?php 
require_once('../main/auth.php');


 ?>
 
 
 <!DOCTYPE html>
<html>
<title>receipt</title>
<head>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="dist/js/bootstrap-select.js"></script>
  <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
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
<div style="background-color: blue;">
</div>
 <div align="center">
 <?php 


$a=$_GET['id'];
$b=$_GET['ward'];
$c=$_GET['bed'];
 include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $a);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $name=$row['name'];
        

?></div><h3>
<button class="btn btn-success" onclick="printDiv('content')" id="print" >print</button>
  <script>
$(document).ready(function() {
   $("#print").trigger('click');
});

</script>
<style type="text/css">
            #content{
              border-style: inset;
             width: 50%;

            }
        
            @media only screen and (max-width: 600px) {
    #content {
         margin-left: 0%;

         }
    }

    #print {
         display: none;

         }
         </style>
<div id="content">
  <h3>test hospital</h3>
  <h4>p.o box 1234,</h4>
  <h4>kenya.</h4>
  <h4>tel: 1234</h4>
	<p><?php 
	echo $name;
	
	?></p>
	<p><?php 
	echo $a;
  $result = $db->prepare("SELECT * FROM wards WHERE id=:o");
$result->BindParam(':o', $b);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $wardname=$row['name'];

	
	?></p>
  <p>patient admitted:</p>
  <p>ward: <?php echo $wardname; ?> bed Number: <?php echo $c; ?></p>
  <?php } ?>
   <h4>payments</h4>
  <table class="table table-black" >
<thead>
<tr>
      <th>payment</th>
      <th>amount</th>
    </tr>
</thead>
    
      <?php
      $b=$_GET['id'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE paid_by=:a AND paid=:b");
        $result->bindParam(':a', $b);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?>
      <tbody>
<tr> <td><?php echo $row['fees_name']; ?>:&nbsp;</td>
      <td> &nbsp;<?php echo $row['amount']; ?>

</td><?php } ?></tbody>
</div></div>

</div>

</body>
  
<script type="text/javascript">   
function Redirect() 
{  
window.location="index.php?search= &attempt=2&name=<?php echo $name ?>"; 
}  
setTimeout('Redirect()', 5000);   
</script>
 <?php } ?>