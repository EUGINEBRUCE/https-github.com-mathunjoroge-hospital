<?php 
require_once('../main/auth.php');
include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount.date("/Y");
        include "../header.php";
 ?>
 <!DOCTYPE html>
<html>
<title>register patient</title>
<head>
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

</head>
 
  <header class="header clearfix" style="background-color: #3786d6;;">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper">      
      <div class="jumbotron" style="background: #95CAFC;">
        <link rel="stylesheet" href="../main/jquery-ui.css">

  <script>
  $( function() {
    $( "#mydate" ).datepicker({
    	yearRange: "-100:+0",
      changeMonth: true,
      changeYear: true
    });
  } );

  </script>

  <div class="wrapper">  
          <?php
          $a=$_GET['attempt'];
          if ($a==0) { echo "";
         ?>
           <?php
           $end = date('Y-m-d', strtotime('-5 years'));
           } ?>
          <h3>register patient</h3>
          <style type="text/css">
            #register{
              border-style: inset;  background-image: url('../images/bg.jpg');
              margin-left: -30%;

            }
            @media only screen and (max-width: 600px) {
    #register {
         margin-left: 0%;
    }
}
          </style>
          <div class="container" id="register" >
    <form action="savepatient.php" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">patient name</label>
      <input type="text" class="form-control" name="name"  placeholder="patient name" required="true" />
    </div>
    <div class="form-group col-md-6">
      <label for="inputtext4">date of birth</label>
      <input type="text" id="mydate" class="form-control" name="age" placeholder="date of birth in dd-mm-yyyy" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">
      
      <label for="inputtext4">sex</label>
      <select name="sex" class="form-control" required><option>select sex</option><option >male</option><option >female</option></select>
    </div>    
    <div class="form-group col-md-6">
      <label for="inputPassword4">patient address</label>
      <input type="text" class="form-control" name="address" placeholder="enter patient address" required/>
    </div>
    <div class="form-group col-md-6">
      <label for="contact">patient contact</label>
      <input type="text" class="form-control" name="contact"  placeholder="patient contact" required="true">
    </div>
    
    <div class="form-group col-md-6">
      <label for="inputPassword4">select inpatient or outpatient</label>
      <select name="dept" class="form-control" required/><option disabled>select dept</option><option value="1">out-patient</option><option value="2">in-patient</option></select>
    </div>
    <div class="form-group col-md-6">
      <label for="nexofkin">next of kin</label>
      <input type="text" class="form-control" name="nok"  placeholder="next of kin">
    </div>
    
    <div class="form-group col-md-6">
      <label for="inputPassword4">select fees to be paid</label>
      <select id="fee" class="selectpicker"  title="select fees"  name="fees[]" class="form-control" multiple  required/>
    <option value="">-- Select payable fees--</option><?php 
 include ('../connect.php');
$result = $db->prepare("SELECT * FROM fees");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['fees_id'].">".$row['fees_name']."</option>";
         }
        
        ?>      
</select>
    </div>
    <div class="form-group col-md-6">
      <label>next of kin contact</label>
      <input type="text" class="form-control" name="nokc"   placeholder="next of kin contact">
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Patient number(autogenerated)</label>
      <input type="text" class="form-control" name="number" value="<?php echo $code; ?>" readonly>
    </div>
  </div>
  <button class="btn btn-success btn-large" style="width: 80%; margin-left:10%;">save</button></form>
  <?php
          $a=$_GET['attempt']; 
          if ($a==2) {
             
            ?>
            <p class="alert alert-success"> <?php echo $_GET['name']; ?> has been allocated a bed.</p></div><?php } ?>
             <?php
          $a=$_GET['attempt']; 
          if ($a==3) {
             
            ?>
            <p class="alert alert-success"> <?php echo $_GET['name']; ?> data has been saved.</p><?php } ?>
  
</div>
</div>
 

            
          
            

</body>
</html>