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
        echo "prescription"." for ".$a;
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
            $.post("autosuggestdrug.php", {queryString: ""+inputString+""}, function(data){
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
  <body onLoad="document.getElementById('country').focus();">
  <header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>
    </button>
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">    
  <div class="jumbotron" style="background: #95CAFC;">
        	  <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">out patient</li>
    <li class="breadcrumb-item active" aria-current="page">new prescription</li>
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
   <?php }} ?>
  </ol>
</nav><div>
   <form action="savenew_inp.php" method="POST">
     <span><input type="text" size="25" value="" name="drug" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="search drug" style="width: 30%; height:30px;" required/>&nbsp;<input type="text" name="strength" placeholder="enter strength" required><select name="roa" placeholder="ROA"><option value="1">P.O</option><option value="2">IV</option><option value="3">IM</option><option value="4">SC</option><option value="5">topical</option></select><select name="freq" required/><option disabled>frequency</option><option value="0">stat</option><option value="1">od</option><option value="2">bd</option><option value="3">tds</option><option value="4">qid</option><option value="5">q5h</option><option value="6">q6h</option></select>&nbsp;<input type="number" name="duration" placeholder="enter duration" required>
      <input type="hidden" name="pn" value="<?php echo $search; ?>">
       <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
       <button class="btn btn-success">add</button>
       <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> </form>
         &nbsp; </div></div></div>
 </hr>
 <?php
  $code=$_GET['code'];
  $result = $db->prepare("SELECT* FROM prescribed_meds WHERE code=:o");
$result->BindParam(':o', $code);
        $result->execute(); 
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $trigger=$row['code'];
        if (isset($trigger)) {    # code...
        

        ?>
 <div class="container">
   <table class="table-bordered" style="width: 100%;">
     <tr>
       <th>drug</th>
       <th>dosage form</th>
       <th>strength</th>
       <th>frequency</th>
       <th>duration</th>
       <th>delete</th>
     </tr>
     <?php 
     $code=$_GET['code'];
     $result = $db->prepare("SELECT ActiveIngredient, DrugName,duration,frequency,code,prescribed_meds.id AS id,prescribed_meds.strength AS strength,roa FROM prescribed_meds RIGHT OUTER JOIN meds ON prescribed_meds.drug=meds.id  WHERE code=:o");
$result->BindParam(':o', $code);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $genericname=$row['ActiveIngredient'];
        $brandname=$row['DrugName'];
        $roa=$row['roa'];
        $strength=$row['strength'];
        $duration=$row['duration'];
        $frequency=$row['frequency'];
        $code=$row['code'];  
        $id=$row['id'];   
     ?>
     <tr>
       <td><?php echo $genericname; ?> (<?php echo $brandname; ?>)</td>
       <td><?php if ($roa==1) {echo "oral";
         # code...
       } 
       if ($roa==2) {echo "iv";
         # code...
       }
       if ($roa==3) {echo "IM";
         # code...
       }
       if ($roa==4) {echo "SC";
         # code...
       }
       if ($roa==5) {echo "topical";
         # code...
       }
       ?></td>
       <td><?php echo $strength; ?></td>
       <td><?php


if ($frequency==0) {
    echo "STAT";
} else {
    echo $frequency."&nbsp; times daily";
}
?></td>
       <td><?php echo $duration."&nbsp; days"; ?> </td>
       <td><a  href="delete.php?id=<?php echo $id; ?>&code=<?php echo $code; ?>&search=<?php echo $search; ?>"><button class="btn btn-danger">delete</button></a></td><?php } ?>
     </tr>
   </table>
   <p>&nbsp;</p>
   <a href="inpatient.php?search= &response=1"><button class="btn btn-success" style="width: 70%;">save</button></a>
</div>
<?php }} ?></div></div></div></div></div></div>
</body>
</html>