<?php 
require_once('../main/auth.php');
include('db_connect.php');
 ?>
 <!DOCTYPE html>
<html>
<title>drug interactions</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <link href='../doctors/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
        <!-- select2 script -->
        <script src='../doctors/select2/dist/js/select2.min.js'></script>
</head>
 <header class="header clearfix" style="background-color: #3786d6;">
    </button>
    <?php include('../main/nav.php'); ?>   
  </header>
 <div class="container">
    <div class="jumbotron" style="">
    <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">drugs interractions</li>
    <li class="breadcrumb-item" style="float: right;"><a href="diseases.php">drugs and diseases</a></li>
    <li class="breadcrumb-item" style="float: right;"><a href="interractions.php"> check drug interractions</a></li>    
  </ol>
</nav>
<form action="interractions.php?" method="GET">
  <span><select id='first' style='width: 40%;' name="drug_a" data-live-search="true"  required/>
            <option value='0' ></option>
        </select>
        &nbsp;<select id='second' style='width: 40%;' name="drug_b" data-live-search="true" required/>
            <option value='0' ></option>
        </select>
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
    </form>
<hr style="border-color:black;"> 
<?php
  //select drug_a
$a=$_GET['drug_a'];
 $query = "SELECT * FROM drugbank.public.struct2drgclass WHERE struct_id = $a LIMIT 1";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    $drug_a= $row->drug_class_id;
    
  }
//select drug_b
  $b=$_GET['drug_b'];
    $query = "SELECT * FROM drugbank.public.struct2drgclass WHERE struct_id =$b LIMIT 1";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    $drug_b= $row->drug_class_id;

  }

  //select drug_a
  $query = "SELECT * FROM drugbank.public.drug_class WHERE id = $drug_a LIMIT 1";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
  $medicine_1= $row->name;
   
    echo $medicine_1;
  }
//select drug_b
  
  $query = "SELECT * FROM drugbank.public.drug_class WHERE id =$drug_b LIMIT 1";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
  $medicine_2= $row->name;

  }
  $query = "SELECT * FROM drugbank.public.ddi WHERE (drug_class1='$medicine_1' AND drug_class2='$medicine_2' )  OR (drug_class2='$medicine_1' AND drug_class1='$medicine_2' )";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    $ddi_risk= $row->ddi_risk;
    $description= $row->description;
 ?> 
 <?php } ?> 
 <div class="container">

 <h5> <?php echo $medicine_1." and ". $medicine_2; ?></h5>
 <h5>drug interraction risk</h5>
 <p><?php echo $ddi_risk;  ?></p> 
 <h5>description</h5>
 <p> <?php echo $description;  ?></p> 
 
  
     <script>            
        $(document).ready(function(){
            $("#first").select2({
                placeholder:"enter first drug",
                minimuminputLength:3,
                theme: "classic",
                ajax: {
                    url: "get_drug.php?",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });
        </script>
         <script>            
        $(document).ready(function(){
            $("#second").select2({
                placeholder:"enter second drug",
                minimuminputLength:3,
                ajax: {
                    url: "get_drug.php",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });
        </script>  
        </div></div></div>
</body>
</html>