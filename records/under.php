<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>under 5 years </title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../pharmacy/dist/css/bootstrap-select.css">
<script type="text/javascript" src="../main/tcal.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../pharmacy/dist/js/bootstrap-select.js"></script>
  <style type="text/css">
    table.resultstable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.resultstable td, table.resultstable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.resultstable tbody td {
  font-size: 13px;
}
table.resultstable tr:nth-child(even) {
  background: #D0E4F5;
}
table.resultstable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.resultstable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.resultstable thead th:first-child {
  border-left: none;
}

table.resultstable tfoot td {
  font-size: 14px;
}
table.resultstable tfoot .links {
  text-align: right;
}
table.resultstable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
  </style>
  <style>
#result {
  height:0.50em;
  font-size:16px;
  font-family:Arial, Helvetica, sans-serif;
  color:#333;
  padding:5px;
  margin-bottom:10px;
  background-color:#FFFF99;
}
#country{
  border: 1px solid #999;
  background: #95CAFC;
  padding: 5px 10px;
  box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
  position: absolute;
  left: 19%;
  margin: 0;
  width: 3.5em;
  top: 24%;
  padding:0px;
  background-color: #000;
  color: #fff;
  width: 18em;
}
.suggestionList {
  margin: 0px;
  padding: 0px;
}
.suggestionList ul li {
  list-style:none;
  margin: 0px;
  padding: 6px;
  border-bottom:1px dotted #666;
  cursor: pointer;
}
.suggestionList ul li:hover {
  background-color: #FC3;
  color:#95CAFC;
}
ul {
  font-family:Arial, Helvetica, sans-serif;
  font-size:11px;
  color:#FFF;
  padding:0;
  margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
  position:relative;
}
.combopopup{
  padding:3px;
  width:268px;
  border:1px #CCC solid;
}

</style>
</head><body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>

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
    <li class="breadcrumb-item active" aria-current="page">under 5 years report</li>
    <li class="breadcrumb-item active" aria-current="page" style="float: right;"><a href="visits.php"> visits for period</a></li>
    <li class="breadcrumb-item active" aria-current="page" style="float: right;"><a href="patients.php"> patients for period</a></li>
    </ol>
  <span><form action="under.php?" method="GET">
    <input type="text" id="date_one" required="required" name="date_one" placeholder="pick start date" autocomplete="off">
    <input type="text" id="date_two" required="required" name="date_two" placeholder="pick end date" autocomplete="off">    <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button>
  </form>
  <?php if (isset($_GET['date_one'])) {
    # code...
   ?>
   <div class="container" id="content">
   <div class="container">
    <p>&nbsp;</p>
   <center>showing under 5yrs visits from: <?php echo date("d-m-Y", strtotime($_GET['date_one']))  ?> to <?php echo date("d-m-Y", strtotime($_GET['date_two']))  ?></center>
   <p>&nbsp;</p>
   </div>
   <table class="table" >
<thead>
<tr>  <th>date</th>
      <th>patient name</th>
      <th>number</th>
      <th>age</th>
       </tr>
</thead>
 <tbody>
  <?php
  include('../connect.php');
  $a=date("Y-m-d", strtotime($_GET['date_one']));
  $b=date("Y-m-d", strtotime($_GET['date_two']));
  $c=date('Y-m-d', strtotime('-5 years'));       
  $result = $db->prepare("SELECT name,opno,age,visits.date AS date FROM visits RIGHT OUTER JOIN patients ON visits.patient=patients.opno  WHERE date(visits.date)>=:a AND date(visits.date)<=:b AND age>=:c");
  $result->bindParam(':a',$a);
  $result->bindParam(':b',$b);
  $result->bindParam(':c',$c);
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo $row['date']; ?>:&nbsp;</td>
  <td><?php echo $row['name']; ?>:&nbsp;</td>
      <td> &nbsp;<?php echo $row['opno']; ?>
         <td> &nbsp;<?php
         $now = time('Y/m/d');
$dob = strtotime($row['age']);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age."years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?></td>
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
  $result = $db->prepare("SELECT count(patient) AS total FROM visits RIGHT OUTER JOIN patients ON visits.patient=patients.opno  WHERE date(visits.date)>=:a AND date(visits.date)<=:b AND age>=:c");
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
      <button class="btn btn-success btn-large" style="margin-left: 45%;" value="content" id="goback" onclick="javascript:printDiv('content')" >print report</button>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</body>
</html>