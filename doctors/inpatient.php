<?php 
require_once('../main/auth.php');
 ?>
<!DOCTYPE html>
<html>
<title>inpatient</title>
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
<script type="text/javascript">
  $(document).bind('beforeReveal.facebox', function() {
    var height = $(window).height() - 100;
    $('#facebox .content').css('height', height + '1000px');
    $('#facebox').css('top', ($(window).scrollTop() + 10) + 'px');
});

</script>
<style type="text/css">
 #facebox .content {
    overflow-y: scroll;
}

</style>
<script>
function suggestPatientName(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#patient').addClass('load');
            $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#patient').removeClass('load');
                }
            });
        }
    }

    function fillPatientName(thisValue) {
        $('#patient').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }

</script>
<script>
function showDisease(str) {
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
        xmlhttp.open("GET","get_disease.php?q="+str,true);
        xmlhttp.send();
    }
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
<body>
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
    <li class="breadcrumb-item active" aria-current="page">in patient</li>
    <li class="breadcrumb-item active" aria-current="page">search patient</li>

    <?php
      $search=$_GET['search'];
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
         $b=$row['age'];
        $c=$row['sex'];
     
     ?>
     <li class="breadcrumb-item active" aria-current="page"><?php echo $a; echo "&nbsp;"; $now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age." Years";
   # code...
 }
 //get if age is less than one year show months
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?>, &nbsp;  <?php echo $c; ?></li><?php } ?> </ol>
</nav>	<h3>search patient</h3>
         <body onLoad="document.getElementById('patient').focus();">
<form action="inpatient.php?" method="GET">
  <span><input type="text" size="25" value="" name="search" id="patient" onkeyup="suggestPatientName(this.value);" onblur="fillPatientName();" class="" autocomplete="off" placeholder="Enter patient Name" style="width: 40%; height:30px;" />
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 81%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    margin-left: 17%;
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
</head>
<body>    
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
 
      <style type="text/css">
      	table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 70%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}.column {
    float: left;
    width: 50%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
      </style>
      <h3 align="center">patient medical information</h3>
       <div class="container-fluid">
    <?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $e=$row['systolic'];
        $f=$row['diastolic'];
        $g=$row['rate'];
        $h=$row['height'];
        $j=$row['weight'];
        $k=$row['temperature'];
         $l=$row['breat_rate'];
        $pn=$row['pno']; 
        $rbs=$row['rbs'];

        ?>
<?php $result = $db->prepare("SELECT cc,dx,ddx,plan,pmh,mh FROM prescriptions  WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $cc=$row['cc'];
        $ddx=$row['ddx'];
        $pmh=$row['pmh'];
        $mh=$row['mh'];
        $plan=$row['plan'];
        ?>
<!-- Trigger/Open The Modal -->
<button id="myBtn" class="btn btn-success">clinical information</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" style="font-weight: 3em;color: red;">&times;</span>
    <div class="container" style="border-style: groove;
    border-color: pink;">
        <div class="col-sm-6" > <p style="font-size: 1em">chief complain: <?php echo $cc ;?>
          <p style="font-size: 1em">other conditions: <?php echo $pmh;?>
        </p>
          <p style="font-size: 1em">differential diagnosis: <?php echo $ddx ;?></p></div>
          <div class="col-sm-6" ><p style="font-size: 1em"> diagnosis: <?php echo $dx ;?></p>
           <p style="font-size: 1em"> other drugs: <?php echo $mh ;?></p>
          <p style="font-size: 1em"> plan: <?php echo $plan ;?></p>
        </div>
         <?php 
$patient=$search;
$result = $db->prepare("SELECT*  FROM patient_notes  WHERE  patient='$patient'");
        $result->execute();
        $served = $result->rowcount();  
  
    if($served>0) {
?>
 <div>
 <table border="1" cellpadding="1" cellspacing="1" class="table table-dark" id="notes" style="width:100%">
  <caption>clinical notes</caption>
  <thead>
    <tr>
      <th scope="col" style="width:30%">date</th>
      <th scope="col">details</th>
    </tr>
  </thead>
  <?php $result = $db->prepare("SELECT* FROM patient_notes  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $date=$row['created_at'];
        $notes=$row['notes'];
        ?>
  <tbody>
    <tr>

      <td><?php echo $date; ?></td>
      <td><?php echo $notes;  ?><?php }} ?></td>
    </tr>
  </tbody>
</table>       
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
        </div></div></hr>
    
  </div>

</div>


        
      <?php } ?><?php } ?>
      <form action="savenotes.php" method="POST">
        <input type="hidden" name="pn" value="<?php echo $pn; ?> ">      
      <label>add clinical notes</label></br> 
      <textarea name="notes" style="width: 70%;height:15em;"></textarea></br>
    <p>&nbsp;</p>      
       <label>request lab tests</label></br>
        <select id="maxOption2" class="selectpicker show-menu-arrow" name="lab[]" multiple ">
    <option value="" disabled="">-- Select test--</option><?php 
    include('../connect.php');
$result = $db->prepare("SELECT * FROM lab_tests");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
         }
        
        ?>      
</select></br>

<label>request imagings</label></br>
        <select id="maxOption3" style="width: 50%;" class="selectpicker"  name="image[]" multiple ">
    <option value="" disabled="">-- Select imaging--</option><?php 
$result = $db->prepare("SELECT * FROM imaging");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['imaging_id'].">".$row['imaging_name']."</option>";
         }
        
        ?>      
</select></br><p>&nbsp;</p>
<button class="btn btn-success btn-large" style="width: 65%;">save</button></br></form> 

<p>&nbsp;</p>
<a href="prescribe_inp.php?search=<?=$search; ?>&code=<?=rand(); ?>&response=0"><button class="btn btn-success"> prescribe drugs</button></a><?php } ?>
</div> 
<div></div> 
</div> 
</div>  
<?php
    $respose=$_GET['response'];

    if ($respose==1) {
       
      ?>
      <div class="alert alert-success" style="width: 22%;margin-left: 20%;"><p> patient data saved successifully</p></div>
        
      </div><?php } ?>
      </div>
</div>

</div></div></div>                
</div></div></div>


<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
</div></div></div></div></div></div></div></div>

</body>
</html>