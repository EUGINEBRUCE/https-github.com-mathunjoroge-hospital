<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>clinic</title> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../pharmacy/dist/css/bootstrap-select.css">
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
<script>
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#country').addClass('load');
            $.post("autosuggestpatient.php", {queryString: ""+inputString+""}, function(data){
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
</head>
  <body onLoad="document.getElementById('patient').focus();">
  <header class="header clearfix" style="background-color: blue;">
    
    <?php include('../main/nav.php'); ?>   
  </header>
  <nav class="vertical_nav">
    <ul id="js-menu" class="menu">
      <li class="menu--item">
        <a href="index.php?attempt=0" class="menu--link" title="book clinic">
          <i class="menu--icon  fa fa-fw fa-home"></i>
          <span class="menu--label">home</span>
        </a>
      </li>

      <li class="menu--item">
        <a href="book.php?search=&response=0" class="menu--link" title="book clinic for patient">
          <i class="menu--icon  fa fa-fw fa-book"></i>
          <span class="menu--label">book clinic</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="pclinics.php?search= &response=0" class="active" title="clinic patients">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">clinic patients</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="booked.php?date=NULL&clinic=NULL" class="menu--link" title="see booked clinics">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">booked clinics</span>
        </a>
      </li>
    </ul>
    <button id="collapse_menu" class="collapse_menu">
      <i class="collapse_menu--icon  fa fa-fw"></i>
      <span class="collapse_menu--label">hide menu</span>
    </button>
  </nav>
  <div class="wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">         
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
  
</head>
  <span><form action="clinic.php?" method="GET">
  <span><input type="text" size="25" value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name or number" style="width: 268px; height:30px;" />
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
    
    <?php
    $search=$_GET['search'];
    $nothing="";


    if ($search!=$nothing) {
       # code...
      ?><?php } ?>
      <?php 
      $search=$_GET['search'];
      $response=0;
      
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        $b=$row['age'];
        $c=$row['sex'];
        $d=$row['opno'];

 ?>
  <?php
  $patient=$_GET['search'];
       $date=date('Y-m-d');
  $result = $db->prepare("SELECT* FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date='$date'");
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
    <div class="alert-success" style="width: 40%;" >no clinic booked for patient today. check <a href="pclinics.php?search=<?php echo $patient; ?>&response=0&others=6"><button class="btn btn-success" id="hide">later dates</button></a></div><?php } ?>
     <?php 
   if ($rowcount>0) {
     
    ?>

 <table class="resultstable" >
<thead>
<tr>
<th>patient name</th>
<th>age</th>
<th>sex</th>
<th>clinic</th>
<th>date</th>
<th>cost</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
       $date=date('Y-m-d');
        $result = $db->prepare("SELECT* FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date='$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $clinic_id = $row['clinic_id'];     
      $clinic = $row['clinic_name'];
      $cost= $row['cost'];
      $pt= $row['patient'];
      $date= date("d-m-Y", strtotime($row['date']));    
         ?>
         
<tbody>
<tr>
<td><?php echo $a; ?></td>
<td><?php echo $b; ?> </td>
<td ><?php  echo $c; ?></td>
<td><?php echo $clinic; ?></td>
<td><?php echo $date; ?></td>
<td ><?php echo $cost; ?></td>


<?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
$date=date('Y-m-d');
        $result = $db->prepare("SELECT sum(cost) AS total FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date='$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      <th>  </th>
      <th>  </th>
      <th>  </th>
      <td> Total Amount: </td>
      
    </tr>
      <tr>
        <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1" id="myvalue"><strong style="font-size: 12px; color: #222222;"> <?php $total=$row['total']; echo $row['total']; ?> </td><?php } ?>

</tbody>
</table>
 </br>
 <?php $patient=$_GET['search'];
       $date=date('Y-m-d');
        $result = $db->prepare("SELECT GROUP_CONCAT(bookings.clinic_id) AS clinic_id FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND bookings.date='$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
    $clinic_id = $row['clinic_id'];           
         ?>
 <form action="savefee.php" method="POST" >
  <input type="hidden" name="clinic" value="<?php echo $clinic_id; ?>">
  <input type="hidden" name="patient" value="<?php echo $pt; ?>">
  <input type="hidden" name="total" value="<?php echo $total; ?>">
  <button class="btn btn-success" style="width: 100%;">submit patient</button>   
 </form>
 <?php } ?>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>
<?php
if ($_GET['response']==1) {
  # code...


 ?>
<div class="alert alert-success"  style="width: 21%;margin-left: 20%;"> patient clinic booked successifuly</div>
<?php } ?>
<?php 
if ($_GET['response']==0) {
  
}
 ?><?php }?>
 <?php 
 if (isset($_GET['others'])) {
   

 ?>
 <h6>bookings for later dates</h6>
 <table class="resultstable" >
<thead>
<tr>
<th>patient name</th>
<th>age</th>
<th>sex</th>
<th>clinic</th>
<th>date</th>
<th>cost</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
       $date=date('Y-m-d');
        $result = $db->prepare("SELECT* FROM bookings RIGHT OUTER JOIN clinics ON bookings.clinic_id=clinics.clinic_id WHERE patient='$patient' AND date>'$date'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $clinic = $row['clinic_name'];
      $cost= $row['cost'];
      $date= date("d-m-Y", strtotime($row['date']));
    
         ?>
<tbody>
<tr>
<td><?php echo $a; ?></td>
<td><?php echo $b; ?> </td>
<td ><?php  echo $c; ?></td>
<td><?php echo $clinic; ?></td>
<td><?php echo $date; ?></td>
<td ><?php echo $cost; ?></td>



</tr><?php } ?>
<?php } ?><?php }?>
</tbody>
</table>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>

</body>
</html>