<?php 
require_once('../main/auth.php');
include('../connect.php');

$result = $db->prepare("SELECT * FROM user WHERE logged_in=1");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           
         }
        
        ?>
 <!doctype html>
 <html class="no-js" lang=""> <!--<![endif]-->
<head>
  <?php 
require_once('../main/auth.php');
include ('../connect.php');
$shownav=0; ?>
<!DOCTYPE html>
<html>
<title>users offline</title>
<?php
include "../header.php";
?>

</head>

<header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>   
</header><?php include('sidee.php'); ?>
<div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
<body ><div class="container">
<?php
if ($_GET['response']==3) {


?>


<div class="alert  alert-danger " >

 user deleted!

</div>
<?php } ?>
<?php
if ($_GET['response']==1) {


?>


<div class="alert  alert-primary " >

 user added!

</div>
<?php } ?>
<?php
if ($_GET['response']==2) {


?>


<div class="alert  alert-success " >

 user updated and priviledges adjusted!

</div>
<?php } ?>
<a rel="facebox" href="addusers.php"><button class="btn-primary">add user</button></a>
 <table  class="table table-bordered">
     <caption align="center"> users offline</caption>
  <thead class="bg-primary">
  <thead>
    <tr>
      <th scope="col">name</th>
      <th scope="col">position</th>
      <th scope="col">login status</th>
    </tr>
  </thead>
  <?php $result = $db->prepare("SELECT* FROM user WHERE logged_in=0");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $name=$row['name'];
        $position=$row['position'];
        ?>
  <tbody>
    <tr>

      <td><?php echo $name; ?></td>
      <td><?php echo $position;  ?></td>
      <td><?php if ($row['logged_in']==1) {
        echo "user logged_in";
        # code...
      } 
      if ($row['logged_in']==0) {
         echo "last logged in on &nbsp;".$row['last_seen'];
       } ?><?php } ?></td>
    </tr>
  </tbody>
</table>
                    
                        </div>
                </div>
            </div>
            
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

</body>
</html>
