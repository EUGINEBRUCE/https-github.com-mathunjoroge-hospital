<?php 
require_once('../main/auth.php');
include ('../connect.php');
 ?> 
 <!DOCTYPE html>
<html>
<title>
   <?php
    if (!empty($_GET["search"])) {
      $search=$_GET['search'];
      
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        echo "prescription"."for ".$a;
      }
      if (empty($_GET["search"])) {
        echo "revise prescription";
      }
     
     ?><?php } ?>
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href='../pharmacy/googleapis.css' rel='stylesheet'>
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

<body>
  <header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">    
      <div class="jumbotron" style="background: #95CAFC;">
        	  <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">out patient</li>
    <li class="breadcrumb-item active" aria-current="page">edit prescription</li>
    <?php
    if (!empty($_GET["search"])) {
      $search=$_GET['search'];
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        $b=$row['age'];
        $c=$row['sex'];
        $d=$row['opno'];
     
     ?>
     
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; ?> &nbsp; age:  <?php 
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
  } ?>  &nbsp; sex: <?php echo $c; ?></li>
   <?php } ?>
  </ol>
</nav>
         <body onLoad="document.getElementById('country').focus();">
<form action="revise.php?" method="GET">
  <span><input type="text" size="25" value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name" style="width: 40%; height:30px;" />
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form> 
    <?php
    $search=$_GET['search'];
    $nothing="";


    if ($search!=$nothing) {
       # code...
      ?><?php } ?>
      <?php 
      $result = $db->prepare("SELECT* FROM return_pres  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $diagnosis=$row['dx'];
        $meds=$row['meds'];
?>
<?php } ?>
      <?php $result = $db->prepare("SELECT opno, id,cc,dx,ddx,plan,pmh,mh FROM prescriptions  WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $prescription_id=$row['id'];
        $patient=$row['opno'];
        $cc=$row['cc'];
        $dx=$row['dx'];
        $ddx=$row['ddx'];
        $pmh=$row['pmh'];
        $mh=$row['mh'];
        $plan=$row['plan'];
        ?></hr>
        <p></p>
        <div class="container">
        <div class="col-sm-6" > <p style="font-size: 1em">chief complain: <?php echo $cc ;?>
          <p style="font-size: 1em">other conditions: <?php echo $pmh;?>
        </p>
          <p style="font-size: 1em">differential diagnosis: <?php echo $ddx ;?></p></div>
          <div class="col-sm-6" ><p style="font-size: 1em"> <?php
         if (isset($diagnosis)) {
            # code...
          
            
           echo "previous diagnosis:"."&nbsp;".$dx."</br>"
           ."diagnosis after lab".":&nbsp;".$diagnosis;
         }
         if (!isset($diagnosis)) {
            
           echo "diagnosis:"."&nbsp;".$dx

           ?><?php } ?>
           
           </p>
           <p style="font-size: 1em"> other drugs: <?php echo $mh ;?></p>
          <p style="font-size: 1em"> plan: <?php
           if (isset($meds)) {
            
           echo "previous plan:"."&nbsp;".$plan."</br>"
           ."medicines after lab".":&nbsp;".$meds;
         }
         if (!isset($meds)) {            
           echo "plan:"."&nbsp;".$plan; ?>
             
           </p><?php } ?></div></div>
           <div class="container">
      <label>revise prescription</label>
      <form action="saverevision.php" method="POST">
        <input type="hidden" name="pn" value="<?php echo $patient; ?>">
        <input type="hidden" name="id" value="<?php echo $prescription_id; ?>">
        <input type="hidden" name="previous" value="<?php echo $plan; ?>">
        <textarea style="width: 30%;" name="plan"></textarea></br>
        <button class="btn btn-success">submit changes</button>
      </form><?php } ?></div>
         </hr>
    <?php } ?>
    
    </div>
<?php
    $respose=$_GET['response'];

    if ($respose==1) {
       
      ?>
      <div class="alert alert-success" style="width: 50%;margin-left: 20%;"><p> prescription has been edited successifully</p></div>
        
      </div><?php } ?>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div>

</body>
</html>