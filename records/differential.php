<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>diseases</title>
  <?php 
include('../header.php');
?>
</head><body onLoad="document.getElementById('country').focus();">
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
    <li class="breadcrumb-item active" aria-current="page">diseases report</li>
    <li class="breadcrumb-item active" aria-current="page" style="float: right;"><a href="diseases.php"> diagnoses for period</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="float: right;"><a href="differential.php"> differential diagnoses for period</a></li>
    </ol>
  <span><form action="differential.php" method="GET">
    <input type="text" id="date_one" required="required" name="date_one" placeholder="pick start date" autocomplete="off">
    <input type="text" id="date_two" required="required" name="date_two" placeholder="pick end date" autocomplete="off">    <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button>
  </form>
  <?php if (isset($_GET['date_one'])) {
    # code...
   ?><div class="container">
   <div class="container" id="content">
   <div class="container">
    <p>&nbsp;</p>
   <center>showing differential diagnoses made from: <?php echo date("d-m-Y", strtotime($_GET['date_one']))  ?> to <?php echo date("d-m-Y", strtotime($_GET['date_two']))  ?></center>
   <p>&nbsp;</p>
   </div>
   <table class="table" >
<thead>
<tr>  <th>disease code</th>
      <th>disease name</th>
      <th> number of ddx</th>
       </tr>
</thead>
 <tbody>
  <?php
  include('../connect.php');
  $a=date("Y-m-d", strtotime($_GET['date_one']));
  $b=date("Y-m-d", strtotime($_GET['date_two']));      
  $result = $db->prepare("SELECT disease,title,count(disease) AS total FROM ddx RIGHT OUTER JOIN  icd_second_level_codes ON ddx.disease=icd_second_level_codes.code  WHERE date(date)>=:a AND date(date)<=:b GROUP BY disease");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo $row['disease']; ?>&nbsp;</td>
  <td><?php echo $row['title']; ?>&nbsp;</td>
      <td> &nbsp;<?php echo $row['total']; ?></td><?php }  ?>
    </tbody>
</table>
</div>
<button class="btn btn-success btn-large" style="margin-left: 45%;" value="content" id="goback" onclick="javascript:printDiv('content')" >print report</button>
<?php } ?>
 
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
      
      </div>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>

</body>
</html>