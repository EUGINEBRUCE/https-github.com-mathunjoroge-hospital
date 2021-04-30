<?php 
require_once('../main/auth.php');
include ('../connect.php');
?> 
<!DOCTYPE html>
<html>
<title>anticancer drugs reference</title>
<?php
  include "../header.php";
  ?>
</head>

<body>
 <header class="header clearfix" style="background-color:#3786d6;">
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
<span><input type="text" style="  border-radius: 5px;width:70%;" value="" name="search_query" placeholder="drug or regimen name" minlength="2" class="form-input"  />
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


<div class="container">

<table class="table table-bordered"> 
<thead class="bg-primary" >
<tr>

<th scope="col" class="sort-header" style="color:white">
<span id="drug-name-indicator"> </span><a class="data-sort" data-sort-key="name" data-sort-type="drug" href="#" tabindex="0" onclick="return false;" style="color:white"> Name</a>
</th>
<th scope="col" class="sort-header">
<span id="drug-do_not_code-indicator"> </span><a class="data-sort" data-sort-key="do_not_code" data-sort-type="drug" href="#" tabindex="0" onclick="return false;" style="color:white">category</a>
</th>
<th scope="col" class="category sort-header">
<span id="drug-category-indicator"> </span><a class="data-sort" data-sort-key="category" data-sort-type="drug" href="#" tabindex="0" onclick="return false;" style="color:white"> uses</a>
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