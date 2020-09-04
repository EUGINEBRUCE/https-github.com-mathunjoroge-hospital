<?php 
require_once('../main/auth.php');
include ('../connect.php'); ?>
<!DOCTYPE html>
<html>
<title>insurance</title><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
<link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
<link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
<link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
<link href="../pharmacy/demo.css" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../pharmacy/dist/js/bootstrap-select.js"></script>
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
<body><header class="header clearfix" style="background-color: #3786d6;">
<?php include('../main/nav.php'); ?>   
</header><?php include('sidee.php'); ?>
<div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
<body >
<div class="container">
<?php if ($_GET['response']==8) {
# code...
?>
<p class="alert alert-warning"> insurance company by that name exists</p>
<?php } ?>
<?php if ($_GET['response']==9) {
# code...
?>
<p class="alert alert-success"><?php echo $_GET['name']; ?> insurance company created</p>
<?php } ?>

<h3>insurance companies</h3><span>
<a rel="facebox" href="add_insurance.php"> <button class="btn-success" style=""  >add insurance company</button></a></span></br><p></p> 
<table class="table table-bordered table-striped"  style="width:auto;">
<thead>
<tr>
<th>insuarce comapany name</th>
<th>mark up</th>
<th>action</th>
</tr>
</thead>
<?php
$result = $db->prepare("SELECT*  FROM insurance_companies");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){     
$name = $row['name'];
$mark_up = $row['ins_mark_up'];
?>
<tbody> 
<tr>
<td style="width:auto;"><?php echo $name; ?></td>
<td><?php echo (($mark_up-1)*100)."%"; ?></td>
<td width="10%"><a rel="facebox" href="editcompany.php?id=<?php echo $row['company_id']; ?>&name=<?php echo $name; ?>&mark_up=<?php echo $mark_up; ?>"><button class="btn btn-success" style="height: 5px;" title="click to edit"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>

</div>
</body>
</html>