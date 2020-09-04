<?php 
require_once('../main/auth.php');
 ?>
 <!DOCTYPE html>
<html>
<title>nursing fees</title>
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
</head>
<body>
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">  
  <div class="jumbotron" style="width:auto;background: #95CAFC;">
  <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">patient</li>
    <li class="breadcrumb-item active" aria-current="page">nursing fees</li>
    <?php
    if (isset($_GET['search'])) {
      # code...
      $search=$_GET['search'];
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
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?>:  &nbsp;<?php  echo $c; ?>, <?php 
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
  } ?></li><?php }} ?>
</nav>  
   <body onLoad="document.getElementById('country').focus();">
<form action="nursing.php?&response=0" method="GET">
  <input  type="text"  value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name" style="width: 40%; height:30px;" /><input class="form-control" type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
    <p>&nbsp;</p>
      <?php 
      if (isset($_GET['search'])) {
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
  <div class="container-fluid">
       
      <h3>add nursing charges</h3>
      <form action="save_nursing_charge.php" method="POST">        
     <table class="table">
        <tr>
          <th>service</th>
          <th>amount</th>
          <th>add</th>
        </tr>
        <tr>
          <?php
        $result = $db->prepare("SELECT*  FROM  fees WHERE is_nursing=1");
        $result->execute();
       for($i=0; $row = $result->fetch(); $i++){
      $id = $row['fees_id'];
      $fee = $row['fees_name']; 
      $amount =$row['amount'];  
     
  
         ?>
         <td><?php echo $fee; ?></td>
         <td><?php echo $amount; ?></td>
         <input type="hidden" name="patient" value="<?php echo $_GET['search']; ?>">
         <td><input type="checkbox" name="charge[]" value="<?php echo $id; ?>"></td>
        </tr>
        <?php } ?>
</table>
<button class="btn btn-success btn-large" style="width: 70%;">save charge</button></form><?php }   ?> </form><?php }   ?>
</div>

        
      </div>
      </div></div></div>
    <?php
if (($_GET['response']=1)) {
     
      ?>
      </div><?php } ?></div></div>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>

</body>
</html>