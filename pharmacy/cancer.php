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
<li class="breadcrumb-item active" aria-current="page">anticancers and anticancer regimens</li>

<?php if (isset($_GET['search_query'])) {
include ('../connect.php');
?>
<li class="breadcrumb-item active" aria-current="page"><?php print $_GET['search_query']; ?></li><?php } ?></ol>
</nav>
<form action="cancer.php?" method="GET">
<span><input type="text" size="25" value="" name="search_query" placeholder="drug or regimen name" class="form-control" style="width:50%;" />
<button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
</form>
<?php
if (isset($_GET['search_query'])) {
$search="%".$_REQUEST['search_query']."%";
//number of regimens with the drug
// if user searched drug get number regimens from regimens table from regimens table column drugs
$result = $db->prepare("SELECT * FROM regimens WHERE Drugs LIKE :search");
$result->BindParam(':search', $search);
$result->execute();
$regimen_count = $result->rowcount();
if ($regimen_count ==0) {
$result = $db->prepare("SELECT * FROM regimens WHERE Name LIKE :search");
$result->BindParam(':search', $search);
$result->execute();
$regimen_count = $result->rowcount();  
}
//---->
//get number of regimens when a drug is searched
// if user searched  get number drugs in the regimen from regimens table column drugs
//get an array and count array values
?>


<div class="table-responsive">

<table class="table table-dark"> 
<thead>
<tr>

<th scope="col" class="sort-header">
<span id="drug-name-indicator"> </span><a class="data-sort" data-sort-key="name" data-sort-type="drug" href="#" tabindex="0" onclick="return false;"> Name</a>
</th>
<th scope="col" class="sort-header">
<span id="drug-do_not_code-indicator"> </span><a class="data-sort" data-sort-key="do_not_code" data-sort-type="drug" href="#" tabindex="0" onclick="return false;">category</a>
</th>
<th scope="col" class="category sort-header">
<span id="drug-category-indicator"> </span><a class="data-sort" data-sort-key="category" data-sort-type="drug" href="#" tabindex="0" onclick="return false;"> uses</a>
</th>
</tr>
</thead>
<tbody>

<tr>
<?php
$result = $db->prepare("SELECT * FROM regimens WHERE Name LIKE :search");
$result->BindParam(':search', $search);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$regimen_name=$row['Name'];
$regimen_drug=str_replace(", ","|",$row['Drugs']);
$regimen_drugs=str_replace(' ','',$regimen_drug);
}

if (isset($regimen_drugs)) {
$regimen_drugs=$regimen_drugs;
$expression="REGEXP";
} else {
$regimen_drugs="%".$search."%";
$expression="LIKE";
}
$result = $db->prepare("SELECT id,Name,Category,Primary_Site,Do_not_code FROM cancer_drugs WHERE Name $expression :a");
$result->BindParam(':a',$regimen_drugs);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$drug_name=$row['Name'];
$category=$row['Category'];
$primary_site=$row['Primary_Site'];
$code=$row['Do_not_code'];
$id=$row['id'];
?>
<td><a href="drugs.php?id=<?php echo $id;  ?>&name=<?php echo $drug_name;  ?>&search_query=<?php echo $_GET['search_query'];  ?>"><?php echo $drug_name;  ?></a></td>
<td>
<?php echo $category;  ?>
</td>
<td>
<?php echo $primary_site;  ?></td>
<td>
</tr>
<?php }   ?>

</tbody>
</table>
<?php 
$result = $db->prepare("SELECT count(Name) AS total FROM cancer_drugs WHERE Name $expression '$regimen_drugs'");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$total=$row['total'];
?>
<div class="container">
<nav aria-label="breadcrumb" style="width: auto;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">drugs <?php echo $total;  ?></h1>

<script>
document.write(total);
</script></a></li>
<li class="breadcrumb-item"><a href="regimens.php?search_query=<?php echo $_GET["search_query"]; ?>">regimens <?php echo $regimen_count;  ?></a></li>
</ol>
</nav>
</div>
  <?php } ?>


</div> 
<?php } ?> 
</div>
</body>
</html>