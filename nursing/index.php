<?php 
require_once('../main/auth.php');
 ?>
 <!DOCTYPE html>
<html>
<title>search patient</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#country').addClass('load');
            $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#country').removeClass('load');
                }
            });
        }
    }

    function fill(thisValue) {
        $('#country').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }

</script>
</head>
<body>
  <header class="header clearfix" style="background-color: #3786d6;;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">  
  <div class="jumbotron" style="width:auto;background: #95CAFC;">
  <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">patient</li>
    <li class="breadcrumb-item active" aria-current="page">search patient</li>
    <?php
      $search=$_GET['search'];
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
     
     ?>
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php } ?>
</nav>  
   <body onLoad="document.getElementById('country').focus();">
<form action="index.php?&response=0" method="GET">
  <input  type="text"  value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name" style="width: 40%; height:30px;" /><input class="form-control" type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
    <p>&nbsp;</p>
    <?php
    $search=$_GET['search'];
    $nothing="";
    if ($search!=$nothing) {
       # code...
      ?><?php } ?>
      <?php 
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
 <p><?php echo $a; ?>:  &nbsp;<?php  echo $c; ?>, <?php 
  $now = time('Y/m/d'); 
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age."Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?>  </p>
  <div class="container-fluid">
       
      <h3>blood presure</h3>
      <form action="savepatient.php" method="POST">        
    <div class="container">
  
          <table class="table-bordered" id="notes" >
  <thead>
    <tr>
      <th>systolic</th>
      <th>diastolic</th>
      <th>pulse rate</th>
    </tr>
  </thead>
  
  <tbody>
    <tr><td><input class="form-control" type="number"  name="sys"></td>
<td><input class="form-control" type="number"   name="dys"></td>
<td><input class="form-control" type="number"   name="rate"></td>
    </tr>
  </tbody>
</table>
</div>
<div class="container">
  <h3>physical</h3>
  
          <table class="table-bordered">
           <thead>
    <tr>
      <th>height</th>
      <th>weight</th>
      <th>temperature</th>
    </tr>
  </thead>  
  <tbody>
    <tr>
   <td>
        <input class="form-control" type="number" class="form-control" step="0.001"   placeholder="cm" name="height">
      </td>
      <td>
        <input class="form-control" type="number" step="0.001"  placeholder="kgs"   name="weight">
      </td>
      <td>
        <input class="form-control" type="number" step="0.001"  placeholder="degrees c" name="temp">
      </td>
    </tr>
  </tbody>
</table>
</div>
<div class="container">
  
          <table class="table-bordered">
  <thead>
    <tr>
      <th>breath rate</th>
      <th>rbs</th>
      <th>MUAC</th>
    </tr>
  </thead>
  
  <tbody>
    <tr>
    <td>
        <input class="form-control" type="number" step="0.001"  placeholder="bpm" name="br">
      </td>
      <td>
        <input class="form-control" type="number" step="0.001"  placeholder="mm/L" name="rbs">
<input class="form-control" type="hidden"  placeholder="bpm" name="opno" value="<?php echo $d ?>">
      </td>
      <td><input class="form-control" type="number" step="0.001"  placeholder="mm" name="muac"></td>
    </tr>
  </tbody>
</table>
<button class="btn btn-success btn-large" style="margin-left:55%;">save</button></form><?php }  ?> </form>
</div>
<?php
    $respose=$_GET['response'];

    if ($respose==1) {
       
      ?>
      <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> patient data saved successifully</p></div>
        
      </div><?php } ?>
      </div></div></div></div></div>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>

</body>
</html>