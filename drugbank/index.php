<?php 
require_once('../main/auth.php');
include('db_connect.php');
 ?>
 <!DOCTYPE html>
<html>
<title>drugs reference</title>
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
<form action="index.php?" method="GET">
  <span><input type="text" size="25" value="" name="search"  autocomplete="off" placeholder="search generic name, brand, or category" style="width: 80%; height:30px;" />
   <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
    </form>
    <hr style="border-color:black;">    
    <?php
    if (isset($_GET['search'])) {
    $search=$_GET['search'];
      
 ?>
 <div class="container">
  <div class="row">
  <div class="col-sm-4">active ingredients</div>
  <div class="col-sm-4">brand name</div>
  <div class="col-sm-4">dosage form</div>
</div>
</div>
<hr style="border-color:black;"> 
 <?php 
 $search=$_GET['search'];
 $query = "SELECT * FROM drugbank.public.product WHERE generic_name ILIKE '%$search%' OR product_name ILIKE '%$search%'";
 $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
 ?>  
 <div class="container">
  <div class="row">
  <div class="col-sm-4"><?php 
  $generics = str_replace("and",",",$row->generic_name);
  $myArray = explode(',', $generics);
  foreach ($myArray as $generic) { 
  ?>
  	<a href="details.php?search_q=<?php echo trim($generic); ?>"><?php echo $generic; ?><?php } ?></a>
  </div>
  <div class="col-sm-4"><?php echo $row->product_name;  ?></div>
  <div class="col-sm-4"><?php echo $row->form;  ?></div>
<?php } ?>
</div>
</div>
<?php } ?>
</body>
</html>