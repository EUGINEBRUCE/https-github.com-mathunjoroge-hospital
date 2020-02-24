<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
<!DOCTYPE html>
<html>
<title>done surgeries</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
<script>
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
</head>
<body>

  <header class="header clearfix" style="background-color: #95CAFC;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>

    </button>
    <?php include('../main/nav.php'); 
    include('../connect.php');?>
   
  </header><?php
  include('side.php'); ?>  
      <div class="jumbotron" style="background: #95CAFC;">
         <body onLoad="document.getElementById('country').focus();">
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
      <?php
      if (isset($_GET['response']) && $_GET['response']==1) {
         # code...
       ?>
       <div class="alert-success" style="width: 16%;">patient entered to list!</div>
       <?php } ?>  
       <?php
      if (isset($_GET['response']) && $_GET['response']==2) {
         # code...
       ?>
       <div class="alert-success" style="width: 16%;">patient surgical notes saved!</div>
       <?php } ?>
       <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">surgical patients</li>
    <li class="breadcrumb-item active" aria-current="page">surgeries completed</li>
    <li class="breadcrumb-item" style="float: right;"><a href="theatre.php">pending surgeries</a></li>
  </ol>
</nav>      
      
      <div class="container" id="results" >
      
    <a rel="facebox" href="add.php"> <button class="btn-success" style="" >add patient to list</button></a></span></br><p></p> 
      <input type="text" id="search" onkeyup="myFunction()" placeholder="Search for patient.." title="Type in a patient number or name">
     <table class="resultstable" id="products_table" >
<thead>
<tr>
<th>patient name</th>
<th>IP Number</th>
<th>age</th>
<th>sex</th>
<th>operation</th>
<th>type</th>
<th>category</th>
<th>other details</th>
<th>surgical notes</th>
</tr>
</thead>
<?php  $done=1;
        $result = $db->prepare("SELECT*  FROM surgeries RIGHT OUTER JOIN patients ON surgeries.patient=patients.opno WHERE status=:a");
        $result->BindParam(':a',$done);
        $result->execute();
       for($i=0; $row = $result->fetch(); $i++){        
      $category = $row['speciality'];
      $surg_id = $row['surg_id'];
      $patient = $row['name'];
      $ip_no = $row['opno'];
      $b= $row['age'];
      $sex= $row['sex'];
      $operation= $row['operation'];
      $type= $row['type'];
      $status= $row['status'];
         ?>
<tbody>
<tr>
<td><?php echo $patient; ?></td>
<td><?php echo $ip_no; ?></td>
<td ><?php 
  $now = time('Y/m/d'); 
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age."Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?> </td>
<td ><?php echo $sex; ?></td>
<td ><?php  echo $operation; ?></td>
<td><?php  if ($category==1) {
  echo "general";
 
}
 ?></td>
<td><?php  if ($category==2) {
  echo "obstetrics";
 
} 
 if ($category==3) {
  echo "pediatric";
 
}
 if ($category==4) {
  echo "ENT";
 
}
 if ($category==5) {
  echo "gaenecology";
 
}
 if ($category==6) {
  echo "neurosurgery";
 
}
 if ($category==7) {
  echo "cardiothoracic";
 
}
 if ($category==8) {
  echo "orthorpedic";
 
} if ($category==9) {
  echo "opthamology";
 
}
 ?> </td>
<td><a  href="details.php?id=<?=$ip_no; ?>">details</a></td>
<td><a rel="facebox" href="surgical_notes.php?id=<?=$surg_id; ?>">surgical notes</a></td><?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>   

</div> </div>      
      
</div>
<script>
var $rows = $('#products_table tbody tr');
$('#search').keyup(function() {    
    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;
    
    $rows.show().filter(function() {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});
</script>

  <script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>