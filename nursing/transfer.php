<?php 
require_once('../main/auth.php');
 ?>
 <!DOCTYPE html>
<html>
<title>search patient</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
 <script>
function showWard(str) {
    if (str == "") {
        document.getElementById("texxtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("texxtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","get_ward.php?q="+str,true);
        xmlhttp.send();
    }
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
    <li class="breadcrumb-item active" aria-current="page">transfer patient from current ward</li>
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
     <li class="breadcrumb-item active" aria-current="page"><?php if (isset($a)) {
       # code...
     echo $a; ?></li><?php } } ?>
</nav>  
   <body onLoad="document.getElementById('country').focus();">
<form action="transfer.php?&response=0" method="GET">
  <input  type="text"  value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name" style="width: 40%; height:30px;" /><input class="form-control" type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> </div>

</div></form>
<p></p>
   
    <?php
    $search=$_GET['search'];
    $nothing="";
    if ($search!=$nothing) {
      ?>
    <?php } ?>
      
      <?php
      $search=$_GET['search'];
      $response=0;
     // check if patient is admitted
      $reset=0;
    $result = $db->prepare("SELECT * FROM admissions WHERE ipno=:o AND discharged=:a");
    $result->BindParam(':o', $search);
     $result->BindParam(':a', $reset);
        $result->execute();
        $check = $result->rowcount();
        
         ?>
         <?php 
         if ($check==0) {
          
         ?>
         <p class="alert alert-danger" style="width: 50%;font-size: 1em;"> patient not admitted or has been discharged </p>
         <?php } 
         ?>
         <?php 
         if ($check>0) {
          
         ?>
         <?php
$result = $db->prepare("SELECT * FROM beds WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $ward=$row['ward'];
        $bed=$row['bed_no'];
          }
 ?>
 <?php if (isset($ward)) {
   # code...
  ?>
 <table class="table table-black" style="width: 50%;">
   <thead>
     <tr>
       <th>ward</th>
       <th>bed number</th>
     </tr>
   </thead>
   <body>
   <tr>
     <td><?php echo $ward; ?></td>
 <td><?php echo $bed; ?></td>
   </tr>
 </table>

 <div>
  <div class="container">
  <h4></h4>  
      <form action="admitpt.php" method="POST">
        <input type="hidden" name="patient" value="<?php echo $_GET['search']; ?>">
        <input type="hidden" name="oward" value="<?php echo $ward; ?>">
     <select name="ward" style="height: 30px;width: 20%;"><option>--select ward--</option>
  <?php 
        $result = $db->prepare("SELECT * FROM wards");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?><option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?><?php } ?>
</option></select>
<td></td></form>
</tr>
</tbody>
</table>
<?php } } ?>
<?php
if (isset($_GET['ward'])&&$_GET['ward']>0) {
  # code...

 ?>

       <div class="container">
  <div class="alert alert-success" style="width: 50%;"><p>ward changed. allocate bed now</p></div>
  <div  style="width: 50%;margin-left: 10%;">
    <form action="admit2.php" method="POST">
    
      <select name="bedno" style="height: 30px;width: 40%;"><option>--select bed number--</option>
  <?php $d1=$_GET['ward'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM wards  WHERE id=:a ");
        $result->bindParam(':a', $d1);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $wardn=$row['name']; 
          echo $ward;
                
      ?>
      <?php 
        $d2=0;
        $result = $db->prepare("SELECT* FROM beds  WHERE ward=:a AND ocuppied=:b");
        $result->bindParam(':a', $wardn);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?><option value="<?php echo $row['bed_no']; ?>"><?php echo $row['bed_no']; ?> 
</option><?php } ?></select></td>

<input type="hidden" name="pt" value="<?php echo $_GET['search']; ?>">
<input type="hidden" name="ward" value="<?php echo $wardn; ?>">
    <button class="btn btn-primary btn-large">save</button></form><?php } } ?> 
     
  </div>
      </div>
      <?php
    if ($_GET['response']==3) {
      # code...
    
     ?> 
     <div class="alert alert-success" style="width: 50%;"><p>ward transfer success!</p></div>
     <?php } ?> 

 