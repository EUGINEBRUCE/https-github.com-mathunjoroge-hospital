<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
<!DOCTYPE html>
<html>
<title>lab</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=false">
<meta http-equiv="refresh" content="30"/>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="dist/js/bootstrap-select.js"></script>
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
#patient{
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
<script>
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#patient').addClass('load');
            $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#patient').removeClass('load');
                }
            });
        }
    }

    function fill(thisValue) {
        $('#patient').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }

</script>
</head>

<body>
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">
      <div class="jumbotron" style="background: #95CAFC;">
         <body onLoad="document.getElementById('patient').focus();">

 
      <style type="text/css">
        table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 70%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}.column {
    float: left;
    width: 50%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
      </style>
      <p>&nbsp;</p>
  
<div class="container" >   <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">lab patients</li>
    <li class="breadcrumb-item active" aria-current="page">waiting list</li>
    <li class="breadcrumb-item"><a href="edit.php?search= &response=0">edit results</a></li>
  </ol>
</nav> 
<?php if (isset($_REQUEST["failed"])) {
  # code...
 ?>
 <b class="alert-danger"> you did not tick all the comments. please repeat and post</b>
<?php } ?>
<?php if (isset($_REQUEST["success"])) {
  # code...
 ?>
 <b class="alert-success"> data posted successifully</b>
<?php } ?>
     <table class="resultstable" >
<thead>
<tr>
<th>patient name</th>
<th>sex</th>
<th>age</th>

</tr>
</thead>
<?php
$a =1;
$result = $db->prepare("SELECT DISTINCT(opno),age,sex,name FROM patients RIGHT OUTER JOIN lab ON lab.opn=patients.opno WHERE lab.served=:a");
$result->bindParam(':a',$a);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $b = $row['age'];
      $sex = $row['sex'];
      $number= $row['opno'];

         ?>
        
<tbody>
<tr>
<td><a  href="details.php?search=<?php echo $number ?>&response=<?php echo '0'; ?>&edit=1"><?php echo $name; ?></a></td>
<td><?php echo $sex; ?></td>
<td>  <?php 
  $now = time('Y/m/d');
$dob = strtotime($b);
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

<?php }?>
</tr>

</tbody>
</table>
<label>imagings requested for</label></br> 
      <table class="resultstable" >
<thead>
<tr>
<th>patient name</th>
<th>sex</th>
<th>age</th>

</tr>
</thead>
<?php  
$result = $db->prepare("SELECT DISTINCT(opno),name,age,sex FROM patients RIGHT OUTER JOIN  req_images ON  req_images.opn=patients.opno WHERE  req_images.served=:a");
$result->bindParam(':a',$a);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $b = $row['age'];
      $sex = $row['sex'];
      $number= $row['opno'];

         ?>
        
<tbody>
<tr>
<td><a  href="details.php?search=<?php echo $number ?>&response=<?php echo '0'; ?>"><?php echo $name; ?></a></td>
<td><?php echo $sex; ?></td>
<td>  <?php 
  $now = time('Y/m/d');
$dob = strtotime($b);
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

<?php }?>
</tr>

</tbody>
</table></div></div>
 </br>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>