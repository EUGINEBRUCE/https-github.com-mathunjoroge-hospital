<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>book clinic</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
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
<form action="booked.php" method="GET">
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
  
</head>
  <span><form action="booked.php?" method="GET">
    <input type="text" id="mydate" required="required" name="date" placeholder="pick date" autocomplete="off"><select id="clinic" name="clinic" class="selectpicker" data-live-search="true" title="select clinic..." required="required" >
<option value="" disabled>-- Select clinic--</option><?php 
 include ('../connect.php');
$result = $db->prepare("SELECT * FROM clinics");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['clinic_id'].">".$row['clinic_name']."</option>";
         }
        
        ?>      
</select>
</select> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button>
  </form>
   <?php
  include('../connect.php');
       $date=date("Y-m-d", strtotime($_GET['date']));
       $clinic= $_GET['clinic'];
  $result = $db->prepare("SELECT name,clinic_name,opno,bookings.date AS date FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id LEFT OUTER JOIN patients ON patients.opno=bookings.patient WHERE bookings.date='$date' AND bookings.clinic_id='$clinic'");
        $result->execute();
        $rowcount = $result->rowcount();
        
        
   ?>
   <?php 
   if ($rowcount<1) {
     
    ?>
    <script>
$(document).ready(function(){
    $("#hide").click(function(){
        $("button").hide();
    });
});
</script>
    <div class="alert-warning" style="width: 40%;" >no clinic booked </div><?php } ?>
     <?php 
   if ($rowcount>0) {
     
    ?>
  
   <table class="resultstable" >
<thead>
<tr>
      <th>patient name</th>
      <th>number</th>
      <th>clinic</th>
      <th>date</th>
    </tr>
</thead>
 <tbody>
  <?php
  include('../connect.php');
       $date=date("Y-m-d", strtotime($_GET['date']));
       $clinic= $_GET['clinic'];
  $result = $db->prepare("SELECT name,clinic_name,opno,bookings.date AS date FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id LEFT OUTER JOIN patients ON patients.opno=bookings.patient WHERE bookings.date='$date' AND bookings.clinic_id='$clinic'");
  $result->execute();
       for($i=0; $row = $result->fetch(); $i++){       
        
   ?>
<tr> <td><?php echo $row['name']; ?>:&nbsp;</td>
      <td> &nbsp;<?php echo $row['opno']; ?>
         <td> &nbsp;<?php echo $row['clinic_name']; ?>
           <td> &nbsp;<?php echo $row['date']; ?>
            </td><?php } } ?></tbody>
</table>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</body>
</html>