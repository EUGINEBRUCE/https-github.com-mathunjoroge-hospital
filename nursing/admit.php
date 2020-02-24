<?php 
require_once('../main/auth.php');
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount.date("/Y");
 ?>
 <!DOCTYPE html>
<html>
<title>admit patient</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../pharmacy/dist/css/bootstrap-select.css">
<script type="text/javascript" src="../main/tcal.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../pharmacy/dist/js/bootstrap-select.js"></script>
</head>
  <body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>   
  </header>
  <?php include('side.php'); ?>
  <div class="content-wrapper"> 
       
    <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
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
<body onLoad="document.getElementById('country').focus();">   
      <div class="jumbotron" style="background: #95CAFC;">
        <div class="container">
          <?php if (!isset($_GET["wardtrigger"])) {
  # code...
 ?>
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
<form action="admit.php?&response=0" method="GET">
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
  } ?>  
        	<h3>admit patient</h3>
      <div class="container">  
      <form action="admitpt.php" method="post">
      <table class="table table-dark" style="width:50%;">
<tbody>
<tr> 
  <td><select name="ward" style="height: 30px;width: 100%;"><option>--select ward--</option>
  <?php 
        $result = $db->prepare("SELECT * FROM wards");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?><option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?><?php } ?>
</option></select></td>
</tr>

<tr>

<tr>
<td><input type="text" style="height: 30px;width: 100%;" name="dx" placeholder="enter patient diagnosis" required></td>
</tr>
<tr>
<td><input  name="officer" style="height: 30px;width: 100%;" placeholder="enter name of admitting doctor"></td>
</tr>
<tr>
<td><input type="text" style="height: 30px;width: 100%;" name="ins" placeholder="enter patient insurance" required></td>
</tr>
<tr>
<td><input type="text" style="height: 30px;width: 100%;" name="nurse" placeholder="receiving nurse" required></td>
<td><input type="hidden" style="height: 30px;width: 100%;" name="ipd" value="<?php echo $_GET['search']; ?>"></td>
<tr>
<td><button class="btn btn-primary btn-large" style="width:100%;">save</button></td></form><?php } ?>
<?php } ?>
</tr>
</tbody>
</table>
<?php if (isset($_GET["wardtrigger"])) {
  # code...
 ?>
       <div class="container">
        <?php $d1=$_GET['ward'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM wards  WHERE id=:a ");
        $result->bindParam(':a', $d1);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $ward=$row['name']; 
                    
      ?>
  <div class="alert alert-success" style="width: 85%;margin-left: 10%;"><p> patient has been admited to ward <?php echo $ward; ?>. allocate bed now</p></div>
  <div class="jumbotron" style="width: 50%;margin-left: 10%;">
    <form action="admit2.php" method="POST">
      <tr>
      <td><select name="bedno" class="select" style="height: 30px;width: 70%;"><option>--select bed number--</option>
  
      <?php 
        $d2=0;
        $result = $db->prepare("SELECT* FROM beds  WHERE ward=:a AND ocuppied=:b");
        $result->bindParam(':a', $ward);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?><option value="<?php echo $row['bed_no']; ?>"><?php echo $row['bed_no']; ?> 
</option><?php } ?></select></td>
</tr>
<input type="hidden" name="pt" value="<?php echo $_GET['pt'] ?>">
<input type="hidden" name="ward" value="<?php echo $ward; ?>">
<p>&nbsp;</p>
    <button class="btn btn-primary btn-large" style="margin-left:2%;width: 65%;">save</button></form>
   
    
  </div>
      </div>
       <?php } ?>
       <?php } ?>

</div>
</div></div></div>                
</div>
 
  
</body>
</html>
