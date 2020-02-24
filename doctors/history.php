<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>patient history</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href='../pharmacy/googleapis.css' rel='stylesheet'>
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
<script>
function suggestPatientName(inputString){
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

    function fillPatientName(thisValue) {
        $('#patient').val(thisValue);
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
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?> 
</head>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">  
      <div class="jumbotron" style="background: #95CAFC;">
    <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">patient history</li>
    <?php
      $search=$_GET['search'];
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        $c=$row['sex'];

     
     ?>
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php } ?>
   </ol>
</nav>    
<form action="history.php" method="GET">
 <span><input type="text" size="25" value="" name="search" id="patient" onkeyup="suggestPatientName(this.value);" onblur="fillPatientName();" class="" autocomplete="off" placeholder="Enter patient Name" style="width: 40%; height:30px;" />
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>f</form></div>
        <p>&nbsp;</p>
        <?php
        if ($search!=0) {
          # code...
        
         ?>         
        <center>diagnosis and prescriptions</center>
        <div class="container" id="content">
        <table class="resultstable"  >
<thead>
<tr>
  <th>date</th>
<th>cc</th>
<th>hpi</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT * FROM prescriptions WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $cc=$row['cc'];
        $hpi=$row['hpi'];
        $datep=$row['date'];     
     ?>
<tbody>
<tr>
  <?php if (!empty($cc)) {
    # code...
  ?>
  <td><?php echo $datep;?></td>
  <td><?php echo $cc;?></td>
   <td><?php echo $hpi;?></td><?php } ?><?php }?>
</tr>
</tbody>
</table>
<hr>
<label>differential diagnosis</label>
 <table class="resultstable"  >
<thead>
<tr>
  <th>date</th>
<th>differential diagnosis</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT * FROM ddx JOIN icd_second_level_codes ON ddx.disease=icd_second_level_codes.code  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $ddx=$row['title'];
        $datep=$row['date'];     
     ?>
<tbody>
<tr>
  <?php if (!empty($ddx )) {
    # code...
  ?>
  <td><?php echo $datep;?></td>
  <td><?php echo $ddx;?></td>
  <?php }?>
  
<?php }?>
</tr>
</tbody>
</table>
<p></p>
 <center>lab requests</center>
<table class="resultstable"  >
<thead>
<tr>
<th>test</th>
<th>requested by</th>
<th>comments & results</th>
<th>view dails</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT  lab_tests.id AS id, lab_template,name, test,opn,reqby,comments FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE opn=:a");
        $result->BindParam(':a', $search);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $lab_id = $row['id'];
      $reqby = $row['reqby'];
      $comments= $row['comments']; 
      $template= $row['lab_template'];    
     ?>
<tbody>
<tr>
  <td><?php echo $name;?></td>
  <td><?php echo $reqby;?></td>
  <td><?php if (empty($comments)) {
    echo "test not yet done";
  }
  if (!empty($comments)) {
     echo $comments;
   } ?></td>
   <td><?php if (empty($template)){ ?>no details<?php } ?> 
  <?php if (!empty($template)) {
    # code...
   ?><a rel="facebox" href="template.php?lab_id=<?php echo $lab_id; ?>&patient=<?php echo $search; ?>&name=<?php echo $a; ?>&sex=<?php echo $c; ?>&test_done=<?php echo $name; ?>">view details</a><?php } ?>
   </td>
<?php } ?>
</tr>
</tbody>
</table>
<hr>
<label>diagnosis</label>
 <table class="resultstable"  >
<thead>
<tr>
  <th>date</th>
<th>diagnosis</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT * FROM dx JOIN icd_second_level_codes ON dx.disease=icd_second_level_codes.code  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $ddx=$row['title'];
        $datep=$row['date'];     
     ?>
<tbody>
<tr>
  <?php if (!empty($ddx )) {
    # code...
  ?>
  <td><?php echo $datep;?></td>
  <td><?php echo $ddx;?></td>
  <?php }?>
  
<?php }?>
</tr>
</tbody>
</table>
<p></p>
<center>prescribed medications</center>
 <div class="container">
          <label>prescription</label>
          <table class="table-bordered" style="width: 100%;">
     <tr>
       <th>drug</th>
       <th>dosage form</th>
       <th>stregth</th>
       <th>frequency</th>
       <th>duration</th>
       <th>status</th>
     </tr><?php $result = $db->prepare("SELECT ActiveIngredient, DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.dispensed AS dispensed,prescribed_meds.strength AS strength,roa FROM prescribed_meds RIGHT OUTER JOIN meds ON prescribed_meds.drug=meds.id  WHERE patient=:b");
      $result->BindParam(':b', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $genericname=$row['ActiveIngredient'];
        $brandname=$row['DrugName'];
        $roa=$row['roa'];
        $strength=$row['strength'];
        $duration=$row['duration'];
        $frequency=$row['frequency'];
        $status=$row['dispensed'];  
        $id=$row['id'];   
     ?>
     <tr>
       <td><?php echo $genericname; ?> (<?php echo $brandname; ?>)</td>
       <td><?php if ($roa==1) {echo "oral";
         # code...
       } 
       if ($roa==2) {echo "iv";
         # code...
       }
       if ($roa==3) {echo "IM";
         # code...
       }
       if ($roa==4) {echo "SC";
         # code...
       }
       if ($roa==5) {echo "topical";
         # code...
       }
       ?></td>
       <td><?php echo $strength; ?></td>
       <td><?php


if ($frequency==0) {
    echo "STAT";
} else {
    echo $frequency."&nbsp; times daily";
}
?></td>
       <td><?php echo $duration."&nbsp; days"; ?> </td><td>
       <?php
if ($status==0) {
    echo "not yet dispensed";
} else {
    echo "dispensed";
}
?></td>
       <?php } ?>
     </tr>
   </table>
  
 <center>patient notes</center>
<table class="resultstable"  >
<thead>
<tr>
<th>date</th>
<th>details</th>
</tr>
</thead>
</thead>
  <?php $result = $db->prepare("SELECT* FROM patient_notes  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $date=$row['created_at'];
        $notes=$row['notes'];
        ?>
  <tbody>
    <tr>

      <td><?php echo $date; ?></td>
      <td><?php echo $notes;  ?><?php } ?></td>
    </tr>
  </tbody>
</table> 
</tr>
</tbody>
</table>
 <h4>imagings and other files</h4>
 <table class="resultstable" >
<thead>
<tr>
<th>file</th>
<th>posted by</th>
<th>date</th>
<th>report</th>
<th>posted by</th>
<th>posted on</th>
<th>zip and download</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT* FROM images  WHERE  patient='$patient'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $path = $row['image_path'];
      $posted = $row['posted_by'];
      $date = $row['date'];
      $type = $row['type'];
      $report = $row['report'];
      $posted_by = $row['reported_by'];
       $posted_date = $row['report_date'];
     

         ?>
<tbody>
<tr><td><?php if ($type==1) {
  
?><a href="../lab/imageloader/tests/index.php?id=<?php echo $path; ?>&pn=<?php echo $search; ?>&reload=2"><?php echo 'dicom_data'.$path.'- is dicom'; ?></a><?php } ?><?php if ($type==2) {  
?><a href="view_image.php?id=<?php echo '../lab/'.'imageloader/'.'tests/'.'data/'.$path; ?>&pn=<?php echo $search; ?>&reload=2"><?php echo 'image'.$path.'- is image'; ?></a><?php } ?></td>
<td><?php echo $posted; ?></td>
<td><?php echo $date; ?></td>
<td><?php if (!empty($report)) {
 ?><a rel="facebox" href="report.php?search=<?php echo $_GET['search']; ?>&path=<?php echo $path; ?>">     
        <button class="btn btn-primary">view report</button><?php } ?></a>
        <?php
        if (empty($report)) {
          echo "No Report Yet";
        
         } ?>
      </td>
<td><?php echo $posted_by; ?></td>
<td><?php echo $posted_date; ?></td>
<td><?php
$filename = $path.'.zip'; 

if (file_exists($filename)) {

  ?>
  <a href="<?php echo $filename; ?>">
  <button class="btn-success">download</button></a>
<?php } ?>
<?php 
if (!file_exists($filename)) {
   # code...

    
?>
<a href="zip.php?zip=<?php echo $path; ?>&name=<?php echo $search; ?>"><button class="btn-primary">make zip</button></a>

<?php } ?></td><?php } ?>

</tr>

</tbody>
</table>
</div>

</div><?php } ?></div></div>



    