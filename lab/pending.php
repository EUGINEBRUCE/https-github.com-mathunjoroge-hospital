<?php 
include('../connect.php');
require_once('../main/auth.php');

$result = $db->prepare("SELECT * FROM purchases");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
 ?> 
 <!DOCTYPE html>
<html>
<title>stores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
  <link href='src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="dist/js/bootstrap-select.js"></script>
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
  <style>
#result {
  height:0.50em;
  font-size:16px;
  font-family:Arial, Helvetica, sans-serif;
  color:#333;
  padding:5px;
  margin-bottom:10px;
  background-color:#FFFF99;
}
#country{
  border: 1px solid #999;
  background: #95CAFC;
  padding: 5px 10px;
  box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
  position: absolute;
  left: 19%;
  margin: 0;
  width: 3.5em;
  top: 24%;
  padding:0px;
  background-color: #000;
  color: #fff;
  width: 18em;
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
  color:#95CAFC;
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

  <header class="header clearfix" style="background-color: #3786d6;">
    <button type="button" id="toggleMenu" class="toggle_menu">
      <i class="fa fa-bars"></i>

    </button>
    <?php include('../main/nav.php'); 
    ?>
   
  </header>


  <nav class="vertical_nav">

    <ul id="js-menu" class="menu">
      <li class="menu--link">
        <a href="index.php?search=%20&response=0" class="menu--link" title="stocks">
          <i class="menu--icon  fa fa-fw fa-home"></i>
          <span class="menu--label">home</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="stocks.php" class="menu--link" title="stocks">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">stocks</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="orders.php?req=<?php echo $code;  ?>" class="menu--link" title="order for drugs from stores">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">order drugs</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="bincard.php?d1=0&d2=0&drug=0" class="menu--link" title="bincard">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">bincard</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="paid.php" class="menu--link" title="paid prescriptions">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">paid receipts</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="unpaid.php" class="menu--link" title="unpaid prescriptions">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">unpaid receipts</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="served.php?d1=0&d2=0" class="menu--link" title="orders served from stores">
          <i class="menu--icon  fa fa-fw fa-shopping-cart"></i>
          <span class="menu--label">served orders</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="pending.php" class="active" title="orders yet to served">
          <i class="menu--icon  fa fa-fw fa-shopping-cart"></i>
          <span class="menu--label">pending orders</span>
        </a>
      </li>
    </ul>
   <button id="collapse_menu" class="collapse_menu">
      <i class="collapse_menu--icon  fa fa-fw"></i>
      <span class="collapse_menu--label">hide menu</span>
    </button>
  </nav>
  <div class="wrapper">   
      <div class="jumbotron" style="background: #95CAFC;">
         <body onLoad="document.getElementById('country').focus();">
<style type="text/css">
        table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 70%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 105%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}.column {
    float: left;
    width: 50%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
      </style>
      
      
      <div class="container" id="results" > 
        <h3>pending orders</h3><span></span></br> 
     <table class="resultstable" >
<thead>
<tr>
<th>odered by</th>
<th>date and time</th>
<th>view</th>

</thead>
<?php
        $result = $db->prepare("SELECT* FROM orders WHERE cashed_by='' GROUP BY patient");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $a= $row['patient'];
      $b = $row['posted_by'];
      $c= $row['date'];
      
         ?>
<tbody>
<tr>
<td><?php echo $b; ?></td>
<td ><?php echo $c; ?></td>
<td><a href="vieworder.php?id=<?php echo $a; ?>"> view</a></td>
<?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>
 
      

</div> </div>
      
      
</div><script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>