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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>admin dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href="facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'loading.gif',
      closeImage   : 'closelabel.png'
    })
  })
</script>
</head>
<body><?php include('side.php'); ?>
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-5">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <div  style="float: right;margin-right: -130%;">
                        <p>
                           <?php echo $_SESSION['SESS_FIRST_NAME']; ?>
                        
                        <a  href="../logout.php"> <i class="fa fa-power-off" style="color: red;"></i>&nbsp;Logout</a></p>                        
            </div>

        </header><!-- /header -->
        <!-- Header-->
        

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        
                    </div>
                </div>
            </div>
        </div>
         <?php
                if ($_GET['response']==0) {
                  
                 
                 ?>
             <?php } ?>
         <?php
                if ($_GET['response']==1) {
                  
                 
                 ?>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                   
                  <span class="badge badge-pill badge-success">Success</span> user registered
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php } ?>
        <?php
                if ($_GET['response']==2) {
                  
                 
                 ?>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                   
                  <span class="badge badge-pill badge-success">Success</span> user details updated!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php } ?>
        <?php
                if ($_GET['response']==3) {
                  
                 
                 ?>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                   
                  <span class="badge badge-pill badge-danger">deleted</span> user deleted!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php } ?>
        <?php
                if ($_GET['response']==4) {
                   ?>

        <div class="content mt-3">
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                   
                  <span class="badge badge-pill badge-success">created</span> user ward has been creted successifully!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php } ?>
        <?php
                if ($_GET['response']==5) {
                  
                 
                 ?>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                   
                  <span class="badge badge-pill badge-danger">exists</span> that ward already exists. use a different name!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php } ?>
        
        <?php
                if ($_GET['response']==6) {
                  
                 
                 ?>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                   
                  <span class="badge badge-pill badge-primary">edited</span>ward edited success!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php } ?>
           <div class="container">
                <div class="card text-white bg-flat-color-5">
                    <div class="card-body pb-success">

          <table border="1" cellpadding="1" cellspacing="1" class="table table-dark" id="notes" style="width:100%">
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
