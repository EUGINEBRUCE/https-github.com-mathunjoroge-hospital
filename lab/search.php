<?php 
require_once('../main/auth.php');
 include('../connect.php');
    $result = $db->prepare("SELECT * FROM lab_orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
 ?>
 <!DOCTYPE html>
<html>
<title>search patient</title>
<?php
include "../header.php";
?>
</head>
<body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">
         <body onLoad="document.getElementById('country').focus();">
          <div>
<form action="search.php?" method="GET">
  <span><?php
include "../pharmacy/patient_search.php";
?>
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span> 
</form>
<?php if ($_GET["response"]==1) {
  # code...

 ?>
 <p>&nbsp;</p>
 <div class="container alert-success" style="width: 20%;"><h4>patient data saved!</h4></div>
<?php }?>    
    <?php
    $search=$_GET['search'];
    if (empty($search)) {
      ?><?php } ?>
      <?php 
      if (isset($search)) {
        # code...
      $search=$_GET['search'];
      $response=0;
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        $b=$row['age'];
        $c=$row['sex'];
        $d=$row['opno'];

 ?>
 
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
  <caption align="left"> <?php echo $a; ?> &nbsp; age: <?php 
  $now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"." Months";
    # code...
  } ?> &nbsp; sex: <?php echo $c; ?> </caption> <?php } ?>
 <?php 
$patient=$_GET['search'];
$result = $db->prepare("SELECT name, template, test,opn,reqby,lab_tests.cost FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE opn='$patient' AND served=0");
        $result->execute();
        $rowcountt = $result->rowcount();
  
  //Check whether the query was successful or not
    if($rowcountt>=1) {
?>
<div class="container" > <label>lab tests requested for</label></br> 
     <table class="resultstable" >
<thead>
<tr>
<th>test</th>
<th>requested by</th>
<th>cost</th>
<th>done</th>
<th>comments</th>
<th>template</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT  lab_tests.id AS id,name, test,opn,reqby,template,lab_tests.cost FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE opn='$patient' AND served=0");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['name'];
      $lab_id = $row['id'];
      $reqby = $row['reqby'];
      $cost= $row['cost'];
      $template= $row['template'];

         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $reqby; ?></td>
<td><?php echo $cost; ?></td>
<td><form action="save.php" method="POST"><input type="checkbox"  name="lab_id[]" value="<?php echo $lab_id; ?>"></td>
  <td><input type="text"  name="comment[]" ></td>
  <td><?php if (empty($template)){ ?>no template<?php } ?>
  <?php if (!empty($template)) {
    # code...
   ?><a rel="facebox" href="template.php?lab_id=<?php echo $lab_id; ?>&patient=<?php echo $search; ?>">view template</a><?php } ?>
   </td>

<?php }?>
</tr>

</tbody>
</table>
 </br>
 <input type="hidden" name="id" value="<?php echo $_GET['search']; ?>"> 
 <button class="btn btn-success btn-large" style="width: 100%;">save</button></a> <?php }  ?></form></div>
 <?php
  if($rowcountt<1) { 
  ?>
<h6 class="alert alert-warning" style="width: 43%;">no lab tests requested</h6>
<?php } ?> 
 <div class="container" > <label>imagings requested for</label></br> 
     <table class="resultstable" >
<thead>
<tr>
<th>test</th>
<th>requested by</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT  imaging.imaging_id AS id,imaging_name, test,opn,reqby,imaging.cost FROM imaging RIGHT OUTER JOIN req_images ON imaging.imaging_id=req_images.test WHERE opn='$patient' AND served=0");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $name = $row['imaging_name'];
      $lab_id = $row['id'];
      $reqby = $row['reqby'];
      $cost= $row['cost'];

         ?>
<tbody>
<tr>
<td><?php echo $name; ?></td>
<td><?php echo $reqby; ?></td>
<?php }?>
</tr>

</tbody>
</table>
 </br>
 </form></div>

 <form method="POST" enctype="multipart/form-data" action="../scans/upload.php">
  <div class="container" > <label>images/files</label></br> 
     <table class="resultstable" >
<thead>
<tr>
  <tbody>
<th>select folder with images</th>
<th>upload</th>
</tr>
</thead>
<tr>
<td>
    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory=""></td>
     <input type="hidden" name="pn" value="<?php echo $patient; ?>">
    <td><input class="button" type="submit" value="Upload" /></td></tr>
</tbody>
</table>
</form>
</div>
  <div class="container" >
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
<tr>
<td><?php if ($type==1) {
  
?><a href="imageloader/tests/index.php?id=<?php echo $path; ?>&pn=<?php echo $search; ?>"><?php echo '/DICOMS/'.$path.'- is dicom'; ?></a><?php } ?><?php if ($type==2) {  
?><a href="../doctors/view_image.php?id=../lab/imageloader/tests/data/<?php echo $path; ?>&pn=<?php echo $search; ?>&path=<?php echo $path; ?>&ub=1"><?php echo '../scans/'.$path.'- is image'; ?></a><?php } ?></td>

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
<td><?php echo $date; ?></td>
<td><?php echo $date; ?></td>


<?php } ?>

</tr>

</tbody>
</table>
</div>
  
 

<?php
    $respose=$_GET['response'];

    if ($respose==1) {
       
      ?>
      <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> patient data saved successifully</p></div>        
      <?php } ?><?php } ?>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div>

</body>
</html>