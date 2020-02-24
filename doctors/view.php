<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>lab</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="dist/js/bootstrap-select.js"></script>
  <script src="js/office.js"></script>
  <link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />

<script src="../src/facebox.js" type="text/javascript"></script>


<body>

  <header class="header clearfix" style="background-color: blue;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper"> 
      <div class="jumbotron" style="background: #95CAFC;">
        <button onclick="goBack()">Go Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
         <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">lab patients</li>
    <li class="breadcrumb-item active" aria-current="page">viewing file</li>
  </ol>
</nav>
         <?php $image=$_GET['file'] ?>
         <img style="max-width:90%;
max-height:90%; margin-left: 3%;" src="../lab/<?php echo $image; ?>">
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>