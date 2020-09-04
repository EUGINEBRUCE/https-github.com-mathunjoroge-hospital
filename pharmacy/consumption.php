<?php 
require_once('../main/auth.php');
include('../connect.php');
 $result = $db->prepare("SELECT * FROM orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
 ?>
<!DOCTYPE html>
<html>
<title>consumption report</title>
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
   <script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>
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
  <table class="table">
    <tr>
      <th>brand name</th>
      <th>generic name</th>
      <th> total quantity</th>
    </tr>
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