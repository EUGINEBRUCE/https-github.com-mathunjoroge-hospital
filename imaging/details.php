<?php
  require_once('../main/auth.php');
  include('../connect.php');
  $result = $db->prepare("SELECT * FROM lab_orders");
  $result->execute();
  $rowcountt = $result->rowcount();
  $rowcount  = $rowcountt + 1;
  $code      = $rowcount;
  ?>
  <!DOCTYPE html>
  <html>
  <title>request details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <?php 
include "../header.php";
?>
  </head><body >
  <header class="header clearfix" style="background-color: #3786d6;;">
  <button type="button" id="toggleMenu" class="toggle_menu">
  <i class="fa fa-bars"></i>

  </button>
  <?php
  include('../main/nav.php');
  ?>

  </header><?php
  include('side.php');
  ?>
  <div class="content-wrapper">  
  <div class="jumbotron" style="background: #95CAFC;">
  <div class="container"> 
  <div class="container"> 
  <div>
  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">patient</li>
  <li class="breadcrumb-item active" aria-current="page">search patient</li>
  <?php
  $search = $_GET['search'];
  include('../connect.php');
  $result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
  $result->BindParam(':o', $search);
  $result->execute();
  for ($i = 0; $row = $result->fetch(); $i++) {
  $a = $row['name'];
  $b = $row['age'];
  $c = $row['sex'];
  $d = $row['opno'];
  ?>
  <li class="breadcrumb-item active" aria-current="page"><?php
  echo $a;
  ?> age: <?php
  $now      = time('Y/m/d');
  $dob      = strtotime($b);
  $datediff = $now - $dob;
  $agee     = round($datediff / (60 * 60 * 24)) / 365;
  $age      = number_format($agee, 2, '.', '');
  if ($age >= 1) {
                echo $age . " Years";
                # code...
  }
  if ($age < 1) {
                echo $age * 12;
                echo "&nbsp;" . " Months";
                # code...
  }
  ?> &nbsp; sex: <?php
  echo $c;
  ?> </caption></li><?php
  }
  ?>
  <?php
  if (isset($_GET['edit'])) {
  ?>
  <li>editing lab details</li>
  <?php
  }
  ?>
  </nav>  
  </div>
  <form action="details.php?" method="GET"><?php include "../pharmacy/patient_search.php"; ?>
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>    
  <div class="suggestionsBox" id="suggestions" style="display: none;">
  <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>

  </form>
  <?php
  if ($_GET["response"] == 1) {
  # code...
  ?>
  <p>&nbsp;</p>
  <div class="container alert-success" style="width: 20%;"><h4>patient data saved!</h4></div>
  <?php
  }
  ?>    
  <?php
  $search = $_GET['search'];
  if (empty($search)) {
  ?><?php
  }
  ?>
  <?php
  if (isset($search)) {
  # code...
  $search   = $_GET['search'];
  $response = 0;
  include('../connect.php');
  $result = $db->prepare("SELECT * FROM patients WHERE opno=:o LIMIT 1");
  $result->BindParam(':o', $search);
  $result->execute();
  for ($i = 0; $row = $result->fetch(); $i++) {
                $a = $row['name'];
                $b = $row['age'];
                $c = $row['sex'];
                $d = $row['opno'];
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
  <?php
  }
  ?>
  <?php
  if (isset($_GET['edit'])) {
                $served = 1;
  } else {
                $served = 0;
  }
  $patient = $_GET['search'];
  $result  = $db->prepare("SELECT name, template, test,opn,reqby,lab_tests.cost FROM lab RIGHT OUTER JOIN lab_tests ON lab.test=lab_tests.id WHERE opn=:a AND lab.served=:b");
  $result->bindParam(':a', $patient);
  $result->bindParam(':b', $served);
  $result->execute();
  $rowcountt = $result->rowcount();
  //Check whether the query was successful or not
  if ($rowcountt >= 1) {
  ?>

  <?php
  }
  ?> 
  <div class="container" > <label>imagings requested for</label></br> 
  <table class="table table-bordered" >
  <thead class="bg-primary">
  <tr>
  <th>test</th>
  <th>requested by</th>
  <th>choose files</th>
  <th>files type</th>
  <th>upload</th>
  </tr>
  </thead>
  <?php
  $patient = $_GET['search'];
  $result  = $db->prepare("SELECT  imaging.imaging_id AS id,req_images.id AS req_id, imaging_name, test,opn,reqby,imaging.cost FROM imaging RIGHT OUTER JOIN req_images ON imaging.imaging_id=req_images.test WHERE opn='$patient' AND served=0");
  $result->execute();
  for ($i = 0; $row = $result->fetch(); $i++) {
      $name     = $row['imaging_name'];
      $lab_id   = $row['id'];
      $reqby    = $row['reqby'];
      $cost     = $row['cost'];
      $image_id = $row['req_id'];
  ?>
  <tbody>
  <tr>
  <td><?php
                echo $name;
  ?></td>
  <td><?php
                echo $reqby;
  ?></td>

  <td>
  <form method="POST" enctype="multipart/form-data" action="imageloader/tests/data/upload.php">
  <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory=""></td>
  <input type="hidden" name="pn" value="<?php
                echo $patient;
  ?>">
  <td><select name="ftype" required/><option disabled="">--select--</option><option value="1">dicom</option><option value="2">image</option></select></td>
  <input type="hidden" name="image_id" value="<?php
                echo $image_id;
  ?>">
  <td><input class="button" type="submit" value="Upload" /></td></form>
  </tr>
  <?php
  }
  ?>
  </tbody>
  </table>

  </br>
  </form></div>


  <div class="container" >
  <h4>imagings and other files</h4>
  <table class="table table-bordered" >
  <thead class="bg-primary">
  <tr>
  <th>file</th>
  <th>posted by</th>
  <th>date</th>
  </tr>
  </thead>
  <?php
  $patient = $_GET['search'];
  $result  = $db->prepare("SELECT* FROM images  WHERE  patient='$patient'");
  $result->execute();
  for ($i = 0; $row = $result->fetch(); $i++) {
                $path   = $row['image_path'];
                $posted = $row['posted_by'];
                $date   = $row['date'];
                $type   = $row['type'];
                $req    = $row['id'];
                $path   = $row['image_path'];
  ?>
  <tbody>
  <tr>
  <td><?php
                if ($type == 1) {
  ?><a href="imageloader/tests/index.php?id=<?php
  echo $path;
  ?>&search=<?php
  echo $search;
  ?>&req=<?php
  echo $req;
  ?>"><?php
  echo '../scans/' . $path . '- is dicom';
  ?></a><?php
                }
  ?><?php
                if ($type == 2) {
  ?><a href="../doctors/view_image.php?id=../lab/imageloader/tests/data/<?php
  echo $path;
  ?>&pn=<?php
  echo $search;
  ?>&ub=1&req=<?php
  echo $req;
  ?>&imagepath=<?php
  echo $path;
  ?>"><?php
  echo '../scans/' . $path . '- is image';
  ?></a><?php
                }
  ?></td>
  <td><?php
                echo $posted;
  ?></td>
  <td><?php
                echo $date;
  ?></td>

  <?php
  }
  ?>

  </tr>

  </tbody>
  </table>
  </div>



  <?php
  $respose = $_GET['response'];
  if ($respose == 1) {
  ?>
  <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> patient data saved successifully</p></div>        
  <?php
  }
  ?><?php
  }
  ?>
  </div></div></div></div>
  </div></div>

  </body>
  </html>