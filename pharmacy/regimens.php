<?php 
require_once('../main/auth.php');
include ('../connect.php');
?> 
<!DOCTYPE html>
<html>
<title>pharmacy</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
<link href='src/vendor/normalize.css/normalize.css' rel='stylesheet'>
<link href='src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
<link href="dist/vertical-responsive-menu.min.css" rel="stylesheet">
<link href="demo.css" rel="stylesheet">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="../js/jquery.min.js"></script>
<script src="../main/sticky.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="dist/js/bootstrap-select.js"></script>
<link href="../src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../src/facebox.js" type="text/javascript"></script>
</head>

<body>

<header class="header clearfix" style="background-color: #95CAFC;">
<button type="button" id="toggleMenu" class="toggle_menu">
<i class="fa fa-bars"></i>
</button>
<?php include('../main/nav.php');
?>   
</header>
<?php include('side.php'); ?>
<div class="content-wrapper">   
<div class="jumbotron" style="background: #95CAFC;">
<div class="container" style="background: white;">
<nav aria-label="breadcrumb" style="width: 90%;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="cancer.php">Home</a></li>
<li class="breadcrumb-item"><script>
    document.write('<a href="' + document.referrer + '">Back to results</a>');
</script></li>
<li class="breadcrumb-item active" aria-current="page">anticancers and anticancer regimens</li>

<?php if (isset($_GET['search_query'])) {
include ('../connect.php');
?>
<div class="table-responsive">
<table class="table table-dark"> 
<thead>
<tr>

<th scope="col" class="sort-header">
<span id="drug-name-indicator"> </span><a class="data-sort" data-sort-key="name" data-sort-type="drug" href="#" tabindex="0" onclick="return false;">regimen</a>
</th>
<th scope="col" class="sort-header">
<span id="drug-do_not_code-indicator"> </span><a class="data-sort" data-sort-key="do_not_code" data-sort-type="drug" href="#" tabindex="0" onclick="return false;">drugs</a>
</th>
</tr>
</thead>
<tbody>
<tr>
<?php
$search="%".$_GET['search_query']."%";
$result = $db->prepare("SELECT * FROM regimens WHERE Name LIKE :search");
$result->BindParam(':search', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$drugs=str_replace(",","+",$row['Drugs']);	
$name=$row['Name'];
$id=$row['id'];
$regimen_drugs=str_replace(",","|",$row['Drugs']);
?>

<td><a href="regimen_description.php?regimen_id=<?php echo $id;  ?>&name=<?php echo $name;  ?>"><?php echo $name;  ?></a></td>
<td>
<?php echo $drugs  ?>
</td>
</tr>
<?php }   ?>

</tbody>
</table>

</div>
</div> 
<?php } ?> 
</div>
</body>
</html>