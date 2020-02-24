<?php 
require_once('../main/auth.php');
include('db_connect.php');
 ?>
 <!DOCTYPE html>
<html>
<title>diseases and drugs</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    </button>
    <?php include('../main/nav.php'); ?>   
  </header>
 <div class="container">
    <div class="jumbotron" style="">
    <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">drugs reference</li>
    <?php
    if (isset($_GET['search'])) {
    	# code...
     ?> <li class="breadcrumb-item active" aria-current="page">search results for <?php echo $_GET['search']; ?></li><?php } ?>
    <li class="breadcrumb-item" style="float: right;"><a href="interractions.php"> check drug interractions</a></li> 
    <li class="breadcrumb-item" style="float: right;"><a href="diseases.php">drugs and diseases</a></li>    
  </ol>
</nav>
<form action="diseases.php?" method="GET">
  <span><input type="text" size="25" value="" name="search"  autocomplete="off" placeholder="disease name" style="width: 80%; height:30px;" />
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
    </form>
    <hr style="border-color:black;">    
    <?php
    if (isset($_GET['search'])) {
    $search=$_GET['search'];
      
 ?>
 <div class="container">
  <div class="row">
  <div class="col-sm-6">drugs that can be used for <?php echo $_GET['search']; ?> </div>
  <div class="col-sm-6">indication</div>
</div>
</div>
<hr style="border-color:black;"> 
 <?php 
 $search = trim(preg_replace('/\s+/',' ', $_GET['search']));
 $search_query = implode(" |", explode(" ", $search));
 $search_q= rtrim($search_query , '|') ;
 echo $search_q;
 $query = "SELECT DISTINCT ON(active_moiety_name)active_moiety_name,concept_name,active_ingredient.struct_id FROM public.omop_relationship  JOIN public.active_ingredient ON active_ingredient.struct_id=omop_relationship.struct_id    WHERE to_tsvector(omop_relationship.concept_name) @@ to_tsquery('$search_q')  and relationship_name='indication' ";
 $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
 ?>  
 <div class="container">
  <div class="row">
  <div class="col-sm-6"><?php 
  $generics = str_replace("and",",",$row->active_moiety_name);
  $myArray = explode(',', $generics);
  foreach ($myArray as $generic) { 
  ?>
  	<a href="details.php?search_q=<?php echo trim($generic); ?>"><?php echo $generic; ?><?php } ?></a>
  </div>
  <div class="col-sm-6"><?php echo $row->concept_name;  ?></div>

<?php } ?>
</div>
</div></div>
<hr style="border-color:black;"> 
<div class="container">
  <center><label>contraindicated drugs</label></center>
  <div class="row">
  <div class="col-sm-6">drugs contraindicted in <?php echo $_GET['search']; ?> </div>
  <div class="col-sm-6">contraindication</div>
</div>
</div><hr style="border-color:black;">
 <?php 
 $search = trim(preg_replace('/\s+/',' ', $_GET['search']));
 $search_query = implode(" |", explode(" ", $search));
 $search_q= rtrim($search_query , '|') ;
 $query = "SELECT DISTINCT ON(active_moiety_name)active_moiety_name, concept_name,active_ingredient.struct_id FROM public.omop_relationship  JOIN public.active_ingredient ON active_ingredient.struct_id=omop_relationship.struct_id    WHERE to_tsvector(omop_relationship.concept_name) @@ to_tsquery('$search_q')  and relationship_name='contraindication';";
 $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
 ?>  
 <div class="container">
  <div class="row">
  <div class="col-sm-6"><?php 
  $generics = str_replace("and",",",$row->active_moiety_name);
  $myArray = explode(',', $generics);
  foreach ($myArray as $generic) { 
  ?>
    <a href="details.php?search_q=<?php echo trim($generic); ?>"><?php echo $generic; ?><?php } ?></a>
  </div>
  <div class="col-sm-6"><?php echo $row->concept_name;  ?></div>

<?php } ?>
</div>
</div>

<?php } ?>
</body>
</html>