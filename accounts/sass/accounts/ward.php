<?php 
include ('../connect.php');
include ('../main/auth.php');
include ('../main/nav.php');

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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../main/bootstrap.min.css">
  <script src="../main/jquery.min.js"></script>
  <script src="../main/bootstrap.min.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("livesearch.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>

<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	border: 1px solid #999;
	background: #EEEEEE;
	padding: 5px 10px;
	box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
	position: absolute;
	left: 10px;
	margin: 0;
	width: 268px;
	top: 40px;
	padding:0px;
	background-color: #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
.combopopup{
	padding:3px;
	width:268px;
	border:1px #CCC solid;
}

</style>
</head>
<body>        
<div class="container" style="width:18%;float: left;">
  <div class="span2">
  
  <ul class="nav nav-list">
      <li class="active"><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i>register patient</a></li>
      <li><a href="searchcustomer.php?name=&nbsp;"><i class="icon-search icon-2x"></i> search patient</a></li>
       <li><a href="products.php"><i class="icon-list-alt icon-2x"></i>patient details</a></li>
      <li><a href="antimalarials.php?d1=&nbsp;&d2=&nbsp;"><i class="icon-group icon-2x"></i> malaria report</a>
      <li><a href="antimalsummary.php?d1=&nbsp;&d2=&nbsp;"><i class="icon-bar-chart icon-2x"></i> malaria summary</a>
      <li><a href="reports.php?id=0&d1=&nbsp;&d2=&nbsp;&category=0"><i class="icon-bar-chart icon-2x"></i> other reports</a>                                     </li>
      <li><a href="consumptionlist.php?d1=&nbsp;&d2=&nbsp;"><i class="icon-bar-chart icon-2x"></i> Sales Report</a></li>
      <br><br><br><br><br><br>
      <li></div></div></div></div></div>
      <div class="container" >        
        <div id="content">         
        <div class="span10">
        	<h3>create ward</h3>
   
<div id="suggestionsList"><p>&nbsp;</p></div>
<div class="jumbotron" style="width: 50%;margin-left: 10%;background: #95CAFC;">

      <form action="ward.php" method="GET">
<input type="text" style="height: 30px;width: 100%;border: 1px solid black;" name="name" placeholder="enter  ward name" required></br>
&nbsp;</br> 
<select name="sex" style="height: 30px;width: 100%;border: 1px solid black;" required><option>select sex</option><option >male</option><option  >female</option><option >pediatric</option></select></br>&nbsp;</br> 
<input type="number" style="height: 30px;width: 100%;border: 1px solid black;" name="bed" placeholder="number of beds" required></br>
&nbsp;</br>  
<button class="btn btn-primary btn-large" style="margin-left:55%;">save</button></form>
      </div>
</div>

</div></div></div>                
</div></div></div>
<?php
$a=$_GET['bed'];
if ($a>0) {
  # code...

include('../connect.php');
$a=$_GET['bed'];
$b=$_GET['sex'];
$c=$_GET['name'];
$d=$_GET['name']."-".$b;

$result = $db->prepare("SELECT * FROM wards WHERE `name`=:a");
        $result->bindParam(':a', $d);
        $result->execute();
        $rowcountt = $result->rowcount();
        if ($rowcountt==0) {
        	# code...
        

$number = range(1,$a);
$values ="','NULL','$d'),('";
$value ="','NULL','$d')";

$commaList =  "('" .implode( $values,$number). $value;

$sql = "INSERT INTO `wards` (`beds`,`id`,`name`) VALUES ('$a','NULL','$d')";
$q = $db->prepare($sql);
$q->execute();
$sql = "INSERT INTO `beds` (`bed_no`,`id`,`ward`) VALUES $commaList";
$q = $db->prepare($sql);
$q->execute();

?>
<div class="container">
	<div class="alert alert-success" style="width: 50%;margin-left: 10%;margin-top: -30%;"><p><?php echo $d;  ?> has been created successifuly!</p></div></div>
<?php
}
if ($rowcountt>0) { ?>
<div class="container">
	<div class="alert alert-danger" style="width: 50%;margin-left: 10%;margin-top: -30%;"><p><?php echo $d;  ?> already exists. create a ward with a different name</p></div></div>

<?php }

?>
<?php } ?>
</body>
</html>