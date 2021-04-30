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
<title>users</title>
<?php
include "../header.php";
?>

</head>
<<<<<<< HEAD

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
=======

<header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>   
</header><?php include('sidee.php'); ?>
<div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
<body ><div class="container">
<?php
if ($_GET['response']==3) {


?>

>>>>>>> d6494f18a9c43fc885690af91712f2f1873da227

<div class="alert  alert-danger " >

<<<<<<< HEAD
?>


<div class="alert  alert-primary " >

 user added!
=======
 user deleted!
>>>>>>> d6494f18a9c43fc885690af91712f2f1873da227

</div>
<?php } ?>
<?php
<<<<<<< HEAD
if ($_GET['response']==2) {


?>


<div class="alert  alert-success " >

 user updated and priviledges adjusted!

</div>
<?php } ?>
<?php
if ($_GET['response']==4) {
=======
if ($_GET['response']==1) {


?>


<div class="alert  alert-primary " >

 user added!

</div>
<?php } ?>
<?php
if ($_GET['response']==2) {
>>>>>>> d6494f18a9c43fc885690af91712f2f1873da227


?>


<<<<<<< HEAD
<div class="alert  alert-danger" >

 user exists, kindly use a different username!
=======
<div class="alert  alert-success " >

 user updated and priviledges adjusted!
>>>>>>> d6494f18a9c43fc885690af91712f2f1873da227

</div>
<?php } ?>
<a rel="facebox" href="addusers.php"><button class="btn-primary">add user</button></a>
 <table  class="table table-bordered">
     <caption align="center">active users</caption>
  <thead class="bg-primary">
    <tr>
      <th >name</th>
      <th >position</th>
       <th >action</th>
       <th >login status</th>
    </tr>
  </thead>
  <?php $result = $db->prepare("SELECT* FROM user ORDER BY logged_in DESC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $name=$row['name'];
        $position=$row['position'];
        $id=$row['id'];
        ?>
  <tbody>
    <tr>

      <td><?php echo $name; ?></td>
      <td><?php echo $position;  ?></td>
      
       <td><a rel="facebox" href="edituser.php?id=<?php echo $id; ?>"><button class="btn-success" id="delete_user">edit user</button></a><a  href="deleteuser.php?id=<?=$id; ?>"><button class="btn-danger" onclick="return confirm('Are you sure you want to Delete this user? there is no undo');" >delete user</button></a></td>
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
            
</body>
</html>
