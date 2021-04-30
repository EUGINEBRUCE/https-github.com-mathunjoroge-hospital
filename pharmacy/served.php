<?php 
include('../connect.php');
require_once('../main/auth.php');

         ?>
 <!DOCTYPE html>
<html>
<title>stores, served orders</title>
<?php
  include "../header.php";
  ?>
</head>
<body>

<header class="header clearfix" style="background-color: #3786d6;">
    

    </button>
    <?php include('../main/nav.php'); 
    include('../connect.php');?>
   
  </header><?php
  include('side.php'); ?> 
      <div class="jumbotron" style="background: #95CAFC;">
        
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
        from: <input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick date"> to: <input type="text" id="mydat"  name="d2" autocomplete="off" placeholder="pick date">
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
<p>&nbsp;</p>
<?php
$d1=$_GET['d1']." 00:00:00"; 
       $d2=$_GET['d2']." 23:59:59";
       $date1=date("Y-m-d H:i:s", strtotime($d1));
       $date2=date("Y-m-d H:i:s", strtotime($d2)); 
if ($_GET['d1']==0) {
  # code...
}
 ?>
 <?php
if ($_GET['d2']!=0) {
  

 ?> 
     <table class="table table-bordered" >
<thead>
<tr>
<th>odered by</th>
<th>date and time</th>
<th>view</th>

</thead>
<?php   $status=1;
        $result = $db->prepare("SELECT* FROM orders WHERE (date >= :a AND date <= :b) AND dispensed=:c GROUP BY patient");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2); 
        $result->bindParam(':c',$status);        
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
<td><a href="details.php?id=<?php echo $a; ?>"> view Details</a></td>
<?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>
</div> 
</div>      
</div>      
<?php }?>
</body>
</html>