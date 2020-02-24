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

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800' rel='stylesheet' type='text/css'>
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
<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">


            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./?response=0">admin</a>
                <a class="navbar-brand hidden" href="./?response=0">admin</a>
            </div>


            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.php?response=0"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
              
                    <li class="">
                        <button data-toggle="modal" data-target="#exampleModal" style="width: 80%;"> <i class="menu-icon fa fa-plus"></i>add user</button>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveuser.php" method="POST">
    <div class="form-group row">
  
  <div class="col-10">
    <input class="form-control" type="text" placeholder="user name" id="example-text-input" name="username" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="password" placeholder="password" id="example-search-input" name="password" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="other names" id="example-email-input" name="other" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <select placeholder="select" name="usertype"><option disabled>select user type</option>
        <option>admin</option>
        <option>cashier</option>
        <option>doctor</option>
        <option>lab</option>
        <option>nurse</option>
        <option>pharmacist</option>        
        <option>registration</option>
        <option>stores</option>

    </select>
  </div>
</div>
<div class="form-group row">
  
  <div class="col-10">
    
  </div>
</div>
<div class="col-10">
<button class="btn btn-success" style="width: 80%;">save</button>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><p></p>
                       
                    </li>
                    <li class="">
                          <button data-toggle="modal" data-target="#exampleModal2" style="width: 80%;"> <i class="menu-icon fa fa-edit"></i>edit user</button>
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">edit user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveediuser.php" method="POST">
    <div class="form-group row">
  
  <div class="col-10">
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
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
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<form>
  <select id="maxOption2" class="selectpicker show-menu-arrow form-control" data-live-search="true" name="users" onchange="showUser(this.value)">
<option value="" disabled="">-- Select user--</option><?php 
$result = $db->prepare("SELECT * FROM user");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
         }
        
        ?>      
</select>
</form>
<br>
<form action="saveedituser.php" method="POST">
<div id="txtHint"><b></b></div>
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
  </div>
</div>
<div class="col-10">
<button class="btn btn-success" style="width: 80%;">save</button>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><p></p></li>
                    <li class="">
                          <button data-toggle="modal" data-target="#exampleModal3" style="width: 80%;"> <i class="menu-icon fa fa-trash"></i>delete user</button>
  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="edit">delete user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="form-group row">
  
  <div class="col-10">
    <form action="deleteuser.php" method="POST">
  <select id="maxOption2" class="selectpicker show-menu-arrow form-control" data-live-search="true" name="user">
<option value="" disabled="">-- Select user--</option><?php 
$result = $db->prepare("SELECT * FROM user");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
         }
        
        ?>      
</select>

  </div>
</div>
<div class="form-group row">
  
  <div class="col-10">
    
  </div>
</div>
<div class="col-10">
<button class="btn btn-danger" style="width: 80%;" onclick="return confirm('Are you sure you want to delete this user');">delete</button>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><p></p></li>
                    <li class="">
                        <button data-toggle="modal" data-target="#exampleModal4" style="width: 80%;"> <i class="menu-icon fa fa-plus"></i>add ward</button>
  <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">add ward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveward.php" method="POST">
    <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="enter ward name" id="example-text-input" name="ward" style="width: 80%;" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter number of beds" id="example-text-input" name="beds" style="width: 80%;" autocomplete="false">
  </div>
  </div>
<div class="form-group row">
  <div class="col-10">
    <select placeholder="select" name="sex" style="width: 80%;"><option disabled>select sex</option>
        <option>male</option>
        <option>female</option>
        <option>pediatric</option>
        </select>
  </div>
</div>
<div class="form-group row">
  
  <div class="col-10">
    
  </div>
</div>
<div class="col-10">
<button class="btn btn-success" style="width: 80%;">save</button>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><p></p>     
                    </li>
                    <li class="">
                          <button data-toggle="modal" data-target="#exampleModal5" style="width: 80%;"> <i class="menu-icon fa fa-edit"></i>edit ward</button>
  <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">edit ward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveeditward.php" method="POST">
    <div class="form-group row">
  
  <div class="col-10">
<script>
function showWard(str) {
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
        xmlhttp.open("GET","getward.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<form>
  <select  class="selectpicker show-menu-arrow form-control" data-live-search="true" name="wards" onchange="showWard(this.value)">
<option value="" disabled="">-- Select user--</option><?php 
$result = $db->prepare("SELECT * FROM wards");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
         }
        
        ?>      
</select>
</form>
<br>
<form action="saveeditward.php" method="POST">
<div id="texxtHint"><b></b></div>


  </div>
</div>
<div class="form-group row">
  
  <div class="col-10">
    
  </div>
</div>
<div class="col-10">
<button class="btn btn-success" style="width: 80%;">save</button>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div><p></p>
<li> <button data-toggle="modal" data-target="#exampleModal6" style="width: 80%;"> <i class="menu-icon fa fa-trash"></i>delete ward</button>
  <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">delete user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveediuser.php" method="POST">
    <div class="form-group row">
  
  <div class="col-10">
    <input class="form-control" type="text" placeholder="user name" id="example-text-input" name="username" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="password" placeholder="password" id="example-search-input" name="password" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="other names" id="example-email-input" name="other" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <select placeholder="select" name="usertype"><option disabled>select user type</option>
        <option>admin</option>
        <option>cashier</option>
        <option>doctor</option>
        <option>lab</option>
        <option>nurse</option>
        <option>pharmacist</option>        
        <option>registration</option>
        <option>stores</option>

    </select>
  </div>
</div>
<div class="form-group row">
  
  <div class="col-10">
    
  </div>
</div>
<div class="col-10">
<button class="btn btn-success" style="width: 80%;">save</button>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div></li>
</ul>
            </div>
        </nav>
    </aside>

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
  <?php $result = $db->prepare("SELECT* FROM user ORDER BY logged_in DESC");
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
