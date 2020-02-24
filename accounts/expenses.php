<?php 
require_once('../main/auth.php');
include('../connect.php');
 ?> 
 <!DOCTYPE html>
<html>
<title>expenses</title>
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
<script src="../src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : '../src/loading.gif',
      closeImage   : '../src/closelabel.png'
    })
  })
</script>
</head>
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); 
    ?>   
  </header>
  <?php include('side.php'); ?>
  <div class="content-wrapper"><script>
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#country').addClass('load');
            $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#country').removeClass('load');
                }
            });
        }
    }

    function fill(thisValue) {
        $('#country').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }
</script>
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