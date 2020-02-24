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
<title>register patient</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
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
  <nav class="vertical_nav">
    <ul id="js-menu" class="menu">
     
    </ul>
    <button id="collapse_menu" class="collapse_menu">
      <i class="collapse_menu--icon  fa fa-fw"></i>
      <span class="collapse_menu--label">hide menu</span>
    </button>
  </nav>
   <div class="wrapper">      
      <div class="jumbotron" style="background: #95CAFC;">         

  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#mydate" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );

  </script>

  <div class="wrapper">
    
      <div class="jumbotron" style="background: #95CAFC;">
          <?php $a=$_GET['name'];
      if ($a==0) {
         # code...
       ?>
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
<td><input type="hidden" style="height: 30px;width: 100%;" name="ipd" value="<?php echo $_GET['pt']; ?>"></td>
<tr>
<td><button class="btn btn-primary btn-large" style="width:100%;">save</button></td></form><?php } ?>
</tr>
</tbody>
</table>
<?php $a=$_GET['name'];
      if ($a==1) { 
      
         # code...
       ?>
       <div class="container">
        <h3>allocate bed</h3>
  <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> patient has been admited. allocate bed now</p></div>
  <div class="jumbotron" style="width: 50%;margin-left: 10%;">
    <form action="admit2.php" method="POST">
      <tr>
      <td><select name="bedno" style="height: 30px;width: 70%;"><option>--select bed number--</option>
  <?php $d1=$_GET['ward'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM wards  WHERE id=:a ");
        $result->bindParam(':a', $d1);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
          $ward=$row['name']; 
          echo $ward;
                
      ?>
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
<input type="hidden" name="ward" value="<?php echo $_GET['ward'] ?>">
    <button class="btn btn-primary btn-large" style="margin-left:2%;width: 65%;">save</button></form>
   
    
  </div>
      </div>
       <?php } ?>
        <?php } ?>
</div>
</div></div></div>                
</div></div></div>
 
  
</body>
</html>
