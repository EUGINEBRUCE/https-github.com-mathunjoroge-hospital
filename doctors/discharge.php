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
<?php
include "../header.php";
?>
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
    <li class="breadcrumb-item active" aria-current="page">discharge patient</li>
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
  echo $age." Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?>  &nbsp; sex: <?php echo $c; ?></li>
   <?php } ?> <?php }  ?>
  </ol>
</nav>
         <body onLoad="document.getElementById('country').focus();">
<form action="discharge.php" method="GET">
  <span><?php
include "../pharmacy/patient_search.php";
?>
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form> 
    <?php
    $search=$_GET['search'];
    if ($search==0) {
      //do nothing
      }
    if ($search!=0) { 
    $patient=$search;    
      ?>
      <p></p>
      <div class="container">        
        <div class="col-sm-4" >      
      <form action="savedischarge.php" method="POST">
        <label>write discharge notes</label>
        <input type="hidden" name="pn" value="<?php echo $patient; ?>">
        <textarea style="width: 100%;" name="notes"></textarea></br>
      </div>
       </div>
        <div class="container">
          <button class="btn btn-success" style="width: 50%;margin-left: 5%;">submit </button>
      </form>
        </div>
      </div>
         </hr>
       <?php }  ?> 
<?php
    $respose=$_GET['response'];

    if ($respose==1) {
       
      ?>
      <div class="alert alert-success" style="width: 50%;margin-left: 20%;"><p> patient has been discharged</p></div>
        
      </div><?php } ?>

<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div>

</body>
</html>