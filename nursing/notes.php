<?php 
require_once('../main/auth.php');
 ?>
 
 <!DOCTYPE html>
<html>
<title>patient notes</title>
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
            $.post("autosuggestnotes.php", {queryString: ""+inputString+""}, function(data){
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
  
   <style type="text/css">
    table.resultstable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.resultstable td, table.resultstable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.resultstable tbody td {
  font-size: 13px;
}
table.resultstable tr:nth-child(even) {
  background: #D0E4F5;
}
table.resultstable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.resultstable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.resultstable thead th:first-child {
  border-left: none;
}

table.resultstable tfoot td {
  font-size: 14px;
}
table.resultstable tfoot .links {
  text-align: right;
}
table.resultstable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
  </style>
  
</head>

<body><header class="header clearfix" style="background-color: #3786d6;;">
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
    <li class="breadcrumb-item active" aria-current="page">patient notes</li>
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
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?></li><?php } ?></ol>
</nav> 
         <body onLoad="document.getElementById('country').focus();">
<form action="notes.php?&response=0" method="GET">
  <span><input type="text" size="25" value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name or number" style="width: 35%; height:30px;" /><input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
    <p>&nbsp;</p>
    <?php
    $search=$_GET['search'];
    
    if (!empty($search)) {
       # code...
      ?>
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
  } ?>  </p><?php 
$patient=$search;
$result = $db->prepare("SELECT*  FROM patient_notes  WHERE  patient='$patient'");
        $result->execute();
        $served = $result->rowcount();  
  
    if($served>0) {
?>

<?php
if ($_GET['response']==1) {
   # code...
 
?>
<p class="alert alert-success"> patient notes added</p>
<?php } ?>
 <div class="container">
  <caption>clinical notes</caption>  
          <table border="1" cellpadding="1" cellspacing="1" class="table table-dark" id="notes" style="width:100%">
  <thead>
    <tr>
      <th>details</th>
    </tr>
  </thead>
  <?php $result = $db->prepare("SELECT* FROM patient_notes  WHERE patient=:o ORDER BY created_at DESC");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $date=$row['created_at'];
        $notes=$row['notes'];
        ?> 
  <tbody>
    <tr><td><?php echo $date; ?></br><?php echo $notes;  ?></td><?php }  ?>
    </tr>
  </tbody>
</table>
<?php }  ?><?php }  ?>
<?php if (!empty($_GET['search'])) {
  # code...
?>
<form action="savenotes.php" method="GET ">
        <input type="hidden" name="pn" value="<?php echo $_GET['search']; ?> ">      
      <label>add clinical notes</label></br> 
      <textarea name="notes" style="width: 50%;height:10em;"></textarea></br>
    </br>
<button class="btn btn-success btn-large" style="width: 65%;">save</button></form><?php }} ?>
</div>
</div>
</div>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>

</body>
</html>

