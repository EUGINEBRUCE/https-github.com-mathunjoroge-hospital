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
    <li class="breadcrumb-item active" aria-current="page">details for <?php echo $_GET['search_q']; ?></li>
    <li class="breadcrumb-item" style="float: right;"><a href="interractions.php"> check drug interractions</a></li> 
    <li class="breadcrumb-item" style="float: right;"><a href="diseases.php">drugs and diseases</a></li>   
  </ol>
</nav>   
 <div class="container">
 <?php 
 $search=strtok($_GET['search_q'], ' '); 
 $query = "SELECT * FROM drugbank.public.structures WHERE name ILIKE '%$search%'";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
 ?>  
 <div class="container">
  <?php if (isset($row->mrdef)) {
    ?>
  <label>mechanism of action</label></br>
  <?php echo $row->mrdef; ?></br><?php } ?>
  <?php if (isset($row->smiles)) {
    ?>
  <label>chemical formula</label></br>
  <?php echo $row->inchi; ?></br>
  <?php } ?>
  <?php 
  $query = "SELECT * FROM drugbank.public.active_ingredient WHERE active_moiety_name ILIKE '%$search%' LIMIT 1";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    $struct_type=$row->struct_id;
  }
  $query = "SELECT * FROM drugbank.public.structure_type WHERE struct_id=$struct_type";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    echo "<label>structure type</label> :".$row->type."</br>";
  }
  ?>
  <?php } ?>
  <?php  
 $query = "SELECT * FROM drugbank.public.active_ingredient WHERE active_moiety_name ILIKE '%$search%' LIMIT 1";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    $id =$row->struct_id;
  }
  if (isset($id)) {
    # code...
  
  $query = "SELECT * FROM drugbank.public.atc_ddd WHERE struct_id = '$id' LIMIT 1";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    echo '<label>adult maximum daily dose</label>'.'</br>';
    echo $row->ddd." ";  echo $row->unit_type;  
  

 ?>
 <hr style="border-color:black;">
 </br>
 <div class="container">
  <div class="row">
  <div class="col-sm-6">
  <label>pharmacological class</label>
  <?php 
  $query = "SELECT * FROM drugbank.public.pharma_class WHERE  struct_id ='$id'";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
 ?>
 
 <ul>
   <li style="color: black;"><?php echo $row->name ?></li>
 </ul>
<?php } ?></div>
  <div class="col-sm-6">
  <label> description and target proteins</label>
  <?php 
  $query = "SELECT * FROM drugbank.public.pdb WHERE  struct_id ='$id'";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) { $accession=$row->accession;
 ?>
 
 <ul>
   <li style="color: black;"><?php echo $row->title; ?></li>
 </ul>
<?php } ?>
<label>other proteins</label>
<?php 
if (!isset($accession)) {
  $accession='afgsfsg';
  # code...
}
  $query = "SELECT * FROM drugbank.public.act_table_full WHERE  struct_id ='$id'";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
    $source =$row->act_source_url;
    $protein =$row->target_name;
    if (isset($protein)) {
       # code...
      ?> 
 <ul>
   <li style="color: black;"><?php echo $row->target_name; ?> as: <?php echo $row->target_class; ?>, action type: <?php if (isset($row->action_type)) {
     # code...
    echo $row->action_type;} else{
      echo "unspecified";
    } ?> </li>
 </ul>
 <?php } ?>
<?php } ?>
 </div>
 </div>
 </div>
 <hr style="border-color:black;">
 <div class="container">
  <div class="row">
  <div class="col-sm-6">
 <label>indications</label></br>
 <?php 
  $query = "SELECT * FROM drugbank.public.omop_relationship WHERE relationship_name ='indication' AND struct_id ='$id'";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
 ?>
 
 <ul>
   <li style="color: black;"><?php echo $row->concept_name; ?></li>
 </ul>
<?php } ?>
</div>
</br>
<div class="container">
  <div class="row">
  <div class="col-sm-6">
 <label>contra-indications</label></br>
 <?php 
  $query = "SELECT * FROM drugbank.public.omop_relationship WHERE relationship_name ='contraindication' AND struct_id ='$id'";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {
 ?>

 <ul>
   <li style="color: black;"><?php echo $row->concept_name; ?></li>
 </ul>
 <?php } ?>
</div>
</div>
<div class="container">
<label>adverse events ever reported</label>
<?php 
  $query = "SELECT * FROM drugbank.public.faers WHERE struct_id ='$id'";
  $query = pg_query($db, $query);
  while ($row = pg_fetch_object($query)) {

    $adverses=explode(",", $row->meddra_name);
        
 ?> 
 <?php
$numOfCols = 4;
$rowCount = 0;
$bootstrapColWidth = 12 / $numOfCols;
?>
<div class="container">
<div class="row">
<?php
foreach ($adverses as $adverse){
?>  
        <div class="col-md-<?php echo $bootstrapColWidth; ?>">
            <div class="row">
                <?php echo $adverse; ?>
            </div>
        </div>
<?php
    $rowCount++;
    if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
}
?>

<?php  ?>
<?php } ?>
<p><a href="<?php echo $source;  ?>">external reference</a></p>
</div>
<?php }} ?></body>
</html>