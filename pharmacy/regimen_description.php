<?php 
require_once('../main/auth.php');
include ('../connect.php');
?> 
<!DOCTYPE html>
<html>
<title>pharmacy</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
</head>

<body>

<header class="header clearfix" style="background-color: #95CAFC;">
<button type="button" id="toggleMenu" class="toggle_menu">
<i class="fa fa-bars"></i>
</button>
<?php include('../main/nav.php');
?>   
</header>
<?php include('side.php'); ?>
<div class="content-wrapper">   
<div class="jumbotron" style="background: #95CAFC;">
<div class="container" style="background: white;">
<nav aria-label="breadcrumb" style="width: 90%;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="cancer.php">Home</a></li>
<li class="breadcrumb-item"><script>
    document.write('<a href="' + document.referrer + '">Back to results</a>');
</script></li>
<li class="breadcrumb-item active" aria-current="page">anticancers and anticancer regimens</li><?php
$id=$_GET['regimen_id'];
$result = $db->prepare("SELECT* FROM regimens WHERE id=:id");
$result->BindParam(':id',$id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$name=$row['Name'];
$primary_site=$row['Primary_Site'];
$Alternate_Name=$row['Alternate_Names'];
$Histology=$row['Histology'];
$EVS_ID=$row['EVS_ID'];
$drugs=$row['Drugs'];
$remarks=$row['Remarks'];
?>
<?php }   ?>
<div class="container" style="width: 100%;">
  <style type="text/css">
    @media (min-width: 768px){
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1  {
    width: 100%;
    *width: 100%;
  }
}

@media (min-width: 992px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: auto;
    *width: auto;
  }
}

/**
 *  The following is not really needed in this case
 *  Only to demonstrate the usage of @media for large screens
 */    
@media (min-width: 1200px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: auto;
    *width: auto;
  }
}
  </style>
  <div class="row seven-cols">
    <div class="col-md-1">
      <?php if (!empty($name)) {
        echo "<h4>Regimen name: ".$name."</h4>";
       
        # code...
      } 
      
        ?>
    <div class="col-md-1">
      <?php if (!empty($drugs)) {
        echo "<h4>drugs in the regimen</h4>";
        echo $drugs;
        # code...
      } 
      
        ?>
    </div>
    <div class="col-md-1">
    	<?php if (!empty($Alternate_Name)) {
    		echo "<h4>Alternate_Name</h4>";
    		echo $Alternate_Name;
    		# code...
    	} 
    	
    		?>
    </div>
    <div class="col-md-1">
    	<?php if (!empty($Abbreviation)) {
    		echo "<h4>abbreviation</h4>";
    		echo $Abbreviation;
    		# code...
    	} 
    	
    		?></div>
    <div class="col-md-1">
    	<?php if (!empty($primary_site)) {
    		echo "<h4>Primary Use</h4>";
    		echo $primary_site;
    		# code...
    	?></div>
    <div class="col-md-1">
    	<?php if (!empty($histology)) {
    		echo "<h4>histology</h4>";
    		echo $histology;
    		# code...
    	} 
    	
    		?></div>
  </div>
  <div class="container" style="font-size: 1.1em;">  	
  	<?php if (!empty($remarks)) {
  		?>
  		<h4>remarks</h4>
    		<p style="font-size: 1.1em;"><?php echo $remarks;  ?></p>
    		<?php }   	
    	
    		?>
<?php }  ?>
  	
  </div>
 
</div>
</body>
</html/>