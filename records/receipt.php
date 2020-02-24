<?php 
require_once('../main/auth.php');
include('../connect.php');
?>
 <!DOCTYPE html>
<html>
<title>receipt</title>
<head>
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
  <link href="../pharmacy/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />

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

</head>
<body>
<div style="background-color: #3786d6;">
</div>
 <div align="center">
 <?php 


$a=$_GET['name'];
$b=$_GET['number'];

?>
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

    #goback {
         display: none;

         }
         </style>

<hr>
<button class="btn btn-success btn-large" style="margin-left: 45%;" value="content" id="goback" onclick="javascript:printDiv('content')" >print receipt</button>
<div class="jumbotron" >
<div id="content">  
  <?php $result = $db->prepare("SELECT * FROM settings");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $hospital=$row['name'];
        $address=$row['address'];
        $phone=$row['phone'];
        $email=$row['email'];
        $slogan=$row['slogan']; ?>
    <h6 ><?php echo $hospital; ?></h6>
    <h6 ><?php echo $address; ?></h6>
    <h6 ><?php echo $phone; ?></h6>
    <h6 ><?php echo $email; ?></h6>
<?php } ?>
	<p ><?php 
	echo $a;
	?></p>
	<p > Patient Number: <?php 
	echo $b;
?></p>
<hr>
  <table class="table table-dark" style="width: 100%;">
<thead>
<tr>
    <th>payment</th>
      <th>amount</th>
    </tr>
</thead>    
      <?php
      include('../connect.php'); 
      $b=$_GET['number'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE paid_by=:a AND paid=:b");
        $result->bindParam(':a', $b);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?>
      <tbody>
<tr> <td><?php echo $row['fees_name']; ?>:</td>
      <td> <?php echo $row['amount']; ?>

</td><?php } ?></tbody>
</table>
<hr>
<?php
 $result = $db->prepare("SELECT sum(amount) AS total FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE paid_by=:a AND paid=:b");
        $result->bindParam(':a', $b);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
 ?>
 <table class="table" >
<thead>
<tr>
<th>total</th>
      <th><?php echo $row['total'];  ?></th>
    </tr>
</thead> 
 </table><?php } ?>
</div>
</div>
</body>
<script type="text/javascript">
  document.getElementById('goback').click();
function Redirect() 
{  
window.location="index.php?search= &attempt=3&name=<?php echo $a ?>"; 
}  
setTimeout('Redirect()', 50000);   
</script>