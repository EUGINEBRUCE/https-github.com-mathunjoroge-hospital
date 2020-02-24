<!DOCTYPE html>
<html>
<title>view image</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=true">
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="dist/js/bootstrap-select.js"></script>
  <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />

<script src="../src/facebox.js" type="text/javascript"></script><?php 
$path=$_REQUEST["img"];

 ?>
 <?php require_once('../main/auth.php');
 include('../main/nav.php');
  ?>
   
  </header>
  <div class="content-wrapper">
  
</hr> 
  	<div class="container">
  		<p>
	<script>
    document.write('<a href="' + document.referrer + '"><button class="btn btn-success" align="right">Back to all images</button></a>');
</script></p>
 	<img src="<?php echo $path; ?>">
 </div>