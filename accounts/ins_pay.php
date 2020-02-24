<?php 
require_once('../main/auth.php');
include('../connect.php');
 ?> 
 <!DOCTYPE html>
<html>
<title>insurance reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
  <?php include('side.php'); ?>
  <div class="content-wrapper"> 
  <script type="text/javascript">
  function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
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
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">post insurance company payment</li>
    <li class="breadcrumb-item active" aria-current="page" style="float: right;"><a href="ins_pay.php"> insurance payments</a></li>
   </ol>
   <?php
   if (isset($_GET["status"])) {
     # code...
    ?>
    <b class="alert-success">data post success</b>
 <?php } ?>
      <div class="container" align="center">         
<form action="ins_pay.php" method="GET">
  <select  name="insurance" class="selectpicker" data-live-search="true" title="select company..." style="width: 268px; height:30px;" required="required"  >
  <option value="" disabled="">-- Select company--</option><?php 
$result = $db->prepare("SELECT * FROM insurance_companies  ");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['company_id'].">".$row['name']."</option>";
         }
        
        ?>
      </select>
  from: <input type="text" id="mydate"  name="d1" autocomplete="off" placeholder="pick start date" required="true"/> to: <input type="text" id="mydat"  name="d2" autocomplete="off" placeholder="pick end date" required="true"/>
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      </div> 
</form>
<?php 
if (isset($_GET["d1"])) {

  $company=$_GET['insurance'];
$d1=$_GET['d1']." 00:00:00"; 
       $d2=$_GET['d2']." 23:59:59";
       $date1=date("Y-m-d H:i:s", strtotime($d1));
       $date2=date("Y-m-d H:i:s", strtotime($d2));
       $d=0;
       $e=3;

?>
  <center><b>summary fom <?php 
$result = $db->prepare("SELECT * FROM insurance_companies WHERE company_id=:d  ");
        $result->bindParam(':d',$company);
        $result->execute(); 
        for($i=0; $row = $result->fetch(); $i++){
           echo $row['name'];
         }
        
        ?> </b></center>
     <center><b>period: <?php echo date("d-m-Y", strtotime($d1)); ?> - <?php echo date("d-m-Y", strtotime($d2)); ?> </b></center>
     <p></p>
     <p></p>
     <div class="container" id="print">

<?php
//end of pharmacy table
 } ?>
    <input type="checkbox" id="checkAll" style="float: right;margin-right: 7.5%;"><b style="float: right;margin-right: 0.5%;">Check All</b>
<hr />
        
<table class="table">
  <tr>
    <th>patient name </th>
    <th>ip number</th>
    <th>receipt number </th>
    <th>date</th>
    <th>amount</th>
    <th>select</th>
  </tr>
  <tbody>
  <tr>

<?php 
$result = $db->prepare("SELECT * FROM receipts RIGHT OUTER JOIN patients ON receipts.patient=patients.opno  WHERE (date>=:a AND date<=:b) AND conf=:c AND status=:d  AND type=:e");
        $result->bindParam(':a',$date1);
        $result->bindParam(':b',$date2);
        $result->bindParam(':c',$company);
        $result->bindParam(':d',$d);
        $result->bindParam(':e',$e);
        $result->execute(); 
        for($i=0; $row = $result->fetch(); $i++){
           $name=$row['name'];
           $ip_no=$row['opno'];
           $receipt_number=$row['receipt_no'];
           $date=$row['date'];
           $amount=$row['total'];        
        ?>
        <td><?php echo $name; ?></td>
        <td><?php echo $ip_no; ?></td>
        <td><a href="view_receipt.php?receipt=<?php echo $receipt_number; ?>&insurance=<?php echo $company; ?>&search=<?php echo $ip_no; ?>"><?php echo $receipt_number; ?></a></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $amount; ?></td>
         <script type="text/javascript">
  $('#checkAll').click(function () {    
     $('input:checkbox').prop('checked', this.checked);    
 });
</script>
        <td><form action="save_ins_pay.php" method="POST">
          <input type="checkbox" id="checkItem" name="receipt[]" value="<?php echo $receipt_number; ?>">

        </td>
        </tr>
      <?php } ?>
        </tbody>
        </table>
        <script>
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
               $("#post").show();
            }
            else if($(this).prop("checked") == false){
                $("#post").hide();
            }
        });
    });
</script>
        
        <button id="post">POST TICKED</button>
        </form>

<div class="container" id="print">
     <p></p>
   
<button class="btn btn-success btn-large" style="width: 46%;margin-left: 27%;" id="print" align="center" onclick="printContent('print');">print report</button>

</body>
</html>