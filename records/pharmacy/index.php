<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>pharmacy</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <script>
function showDrug(str) {
    if (str == "") {
        document.getElementById("texxtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("texxtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","get_drug.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
  <link href='../pharmacy/googleapis.css' rel='stylesheet'>
  <link href='src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
   <script src="../main/sticky.js"></script>
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
 
</head>

<body>

  <header class="header clearfix" style="background-color: #95CAFC;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php');
    $result = $db->prepare("SELECT * FROM orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
         ?>   
  </header>
  <?php include('side.php'); ?>
  <div class="content-wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">
        <div>
         <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">patient</li>
    <li class="breadcrumb-item active" aria-current="page">search patient</li>
    <?php
      $search=$_GET['search'];
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
     
     ?>
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php } ?></ol>
         <body onLoad="document.getElementById('country').focus();">
<form action="index.php?" method="GET">
  <input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
  <span><input type="text" size="25" value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name or number" style="width: 40%; height:30px;" />
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
    
    <?php
    $search=$_GET['search'];
    if (isset($search) &&empty($a)) {        
      ?>
      <p class="alert alert-danger" style="width: 50%;font-size: 1em;"> no information available  </p>
    <?php } ?>
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
        $pn=$search;

 ?> 
        <?php 
        $reset=0;
    $result = $db->prepare("SELECT * FROM admissions WHERE ipno=:o AND discharged=:a");
    $result->BindParam(':o', $search);
     $result->BindParam(':a', $reset);
        $result->execute();
        $check = $result->rowcount();
        if ($check==0) {
          $admitted=0;
        }
        if ($check>0) {
          $admitted=1;
        }
         ?>
    <?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $e=$row['systolic'];
        $f=$row['diastolic'];
        $g=$row['rate'];
        $h=$row['height'];
        $j=$row['weight'];
        $k=$row['temperature'];
         $l=$row['breat_rate'];
        $pn=$search; 
        ?>         
<div class="container">
  <?php
        if (!empty($e) &&(!empty($f))) {
           # code...
         ?>
  <?php
  if (($e<90) || ($f<60)){
  
    $alert="the patient is hypotensive, rapid action is needed as this my lead to renal failure or even death!";
    }

  if ((90 <= $e) && ($e <= 119) || (60 <= $f) && ($f <= 80)) {
    $alert="blood pressure is normal";
  
  }
  if ((121 <= $e) && ($e <= 139) || (81 <= $f) && ($f <= 89)) { 
    $alert="the patient is prehypertensive";
  }
  if ((140 <= $e) && ($e <= 159) || (90 <= $f) && ($f <= 99)) { 
    $alert="patient in stage 1 hypertension, action needed";
  }
  if (($e>=160) || ($f>=100)) { 
    $alert="patient in stage 2 hypertension, action needed";
  }
  $haystack =$alert;
$needle="needed";

if( strpos( $haystack, $needle ) !== false ) {
    $myclass="alert alert-danger";
}
if( strpos( $haystack, $needle ) == false ) {
    $myclass="alert alert-success";
}
?><p class="<?php echo $myclass ?>" style="width:40%;font-size: 1em;" > <?php echo $alert; ?></p><?php } ?>
  <caption align="left"><?php echo $a; ?> &nbsp; age:  <?php 
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
  } ?>  &nbsp; sex: <?php echo $c; ?> </caption>
  <p style="font-size: 1em;">bp:<?php echo $e; ?>/<?php echo $f; ?>, pulse: <?php echo $g; ?>, temp: <?php echo $k; ?> &#x2103;, weight: <?php echo $j; ?>, height: <?php echo $h; ?>, respiration: <?php echo $l; ?><?php } ?></p>
      </div>
      </hr>
      <?php
        $search=$_GET['search'];
        $result = $db->prepare("SELECT * FROM discharge_summary WHERE patient=:a");
        $result->BindParam(':a', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $discharge_plan=$row['prescription'];
        $doctor_notes=$row['doctor_notes'];
        $nurse_notes=$row['nursing_notes'];
      }
      if (isset($discharge_plan)) {
      
       ?>
       <div class="container">
       <label>discharge prescription</label>
       <p><?php echo $discharge_plan ; ?></p>
       <a a rel="facebox" href="popup.php?search=<?php echo $search; ?>">
       <button id="myBtn" class="btn btn-success">see discaharge details</button></a>
       </div>
       <div class="container">
     <?php } ?>    
<?php 
$result = $db->prepare("SELECT* FROM return_pres  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $diagnosis=$row['dx'];
        $meds=$row['meds'];
        ?>
      <?php } ?>
      <?php $result = $db->prepare("SELECT cc,dx,ddx,plan,pmh,mh FROM prescriptions  WHERE opno=:o limit 1");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $cc=$row['cc'];
        $dx=$row['dx'];
        $ddx=$row['ddx'];
        $pmh=$row['pmh'];
        $mh=$row['mh'];
        $plan=$row['plan'];
        ?></hr>
        <div class="container" style="border-style: groove;border-color: pink;">
        <div class="col-sm-6" > <p style="font-size: 1em">chief complain: <?php echo $cc ;?>
          <p style="font-size: 1em">other conditions: <?php echo $pmh;?></p>
          <p style="font-size: 1em">differential diagnosis: <?php echo $ddx ;?></p></div></div>
          <div class="col-sm-6" ><p style="font-size: 1em"> <?php
          if (isset($diagnosis)) {
           echo "previous diagnosis:"."&nbsp;".$dx."</br>"
           ."diagnosis after lab".":&nbsp;".$diagnosis;
         }
         if (!isset($diagnosis)) {
            
           echo "diagnosis:"."&nbsp;".$dx

           ?><?php } ?></p>
           <p style="font-size: 1em"> other drugs: <?php echo $mh ;?></p>
           <p style="font-size: 1em"> plan: <?php
           if (isset($meds)) {
            
           echo "previous plan:"."&nbsp;".$plan."</br>"
           ."medicines after lab".":&nbsp;".$meds;
         }
         if (!isset($meds)) {
            
           echo "plan:"."&nbsp;".$plan; ?>
                         
           </p> 
           <?php } ?>   <?php } ?></div>       
         </hr>
        <label>select medicines for patient</label></br>
        <table class="table dark-table" style="width: 70%;">
          <thead>
            <tr>
<th style="width: 32%;">name</th>
<th>price</th>
<th>qty avl</th>
<th>qty</th>
</tr>
</thead> </table>     
      <span><form action="savepatient.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_GET["token"]; ?>">
        <input type="hidden" name="pn" value="<?php echo $pn; ?>">
        <input type="hidden" name="adm" value="<?php echo $admitted; ?>">       
          <select id="medicine" name="med" class="selectpicker" data-live-search="true" title="Please select a medicine..." onchange="showDrug(this.value)" required="true">

          <?php 
           include ('../connect.php');
          $result = $db->prepare("SELECT * FROM drugs");
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
                     echo "<option value=".$row['drug_id'].">".$row['generic_name']."-".$row['brand_name']."</option>";
                   }
                  
                  ?>      
          </select>
          <b><span id="texxtHint"></b><button class="btn btn-success btn-large">add</button></form></span></div>      
      <div class="container" id="results" > <label>selected meds</label></br> 
        <?php
        $patient=$_GET['search'];
        $token=$_GET['token'];
        $result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by='' AND token='$token'");
         $result->execute();
        $rowcount = $result->rowcount();
        if ($rowcount>0) {
          # code...
        
         ?>
     <table class="resultstable" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>quantity</th>
<th>price</th>
<th>total</th>
<th>action</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
       $token=$_GET['token'];
        $result = $db->prepare("SELECT drugs.drug_id AS drug,generic_name,brand_name,price*mark_up AS price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by='' AND token='$token'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
      $drug_id= $row['drug'];
         ?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<td><a rel="facebox" href="editqty.php?id=<?php echo $row['dispense_id']; ?>&qty=<?php echo $qty; ?>&gname=<?php echo $drug; ?>&bname=<?php echo $brand; ?>&admitted=<?php echo $admitted; ?>&pn=<?php echo $pn; ?>&did=<?php echo $drug_id; ?>&token=<?php echo $_GET["token"]; ?>"><button class="btn btn-success" style="height: 5px;" title="Click to edit quantity"></button></a><a href="delete.php?id=<?php echo $row['dispense_id']; ?>&pn=<?php echo $pn; ?>&admitted=<?php echo $admitted; ?>&did=<?php echo $drug_id; ?>&qty=<?php echo $qty; ?>&token=<?php echo $_GET["token"]; ?>"> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button></a> </td><?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
        $result = $db->prepare("SELECT sum(price*dispensed_drugs.quantity*mark_up) as total FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id =dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by='' AND token='$token'");
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
        <td colspan="1" id="myvalue"><strong style="font-size: 12px; color: #222222;"> <?php echo $row['total']; ?> </td><?php } ?>
</tbody>
</table>
 </br>
 <a href="index.php?search=&response=0">
 <button class="btn btn-success btn-large" style="width: 100%;">save</button></a></div>
</div>      
</div>
</div> 
<?php } ?>
<?php } ?>
<?php if ($_GET['response']==1) {
  # code...
?>
<p></p>
<div class="alert alert-success" style="width: 35%;">drugs returned and stock adjusted appropriately</div><?php } ?></div></div>
</body>
</html>