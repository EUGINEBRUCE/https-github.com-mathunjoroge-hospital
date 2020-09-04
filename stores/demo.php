<?php 

 ?>
 
 <!DOCTYPE html>
<html>
<title>pharmacy</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

  
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
  left: 10px;
  margin: 0;
  width: 3.5em;
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

  <header class="header clearfix">
    

    </button>
    <?php include('../main/nav.php'); ?>
   
  </header>


  <nav class="vertical_nav">

    <ul id="js-menu" class="menu">

      <li class="menu--item  menu--item__has_sub_menu">

        <label class="menu--link" title="Item 1">
          <i class="menu--icon  fa fa-fw fa-user"></i>
          <span class="menu--label">Item 1</span>
        </label>

        <ul class="sub_menu">
          <li class="sub_menu--item">
            <a href="http://google.com" target="_blank" class="sub_menu--link sub_menu--link__active">Submenu</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">Submenu</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">Submenu</a>
          </li>
        </ul>
      </li>

      <li class="menu--item">
        <a href="#" class="menu--link" title="Item 2">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">Item 2</span>
        </a>
      </li>

      <li class="menu--item">
        <a href="#" class="menu--link" title="Item 3">
          <i class="menu--icon  fa fa-fw fa-cog"></i>
          <span class="menu--label">Item 3</span>
        </a>
      </li>

      <li class="menu--item  menu--item__has_sub_menu">

        <label class="menu--link" title="Item 4">
          <i class="menu--icon  fa fa-fw fa-database"></i>
          <span class="menu--label">Item 4</span>
        </label>

        <ul class="sub_menu">
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">Submenu</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">Submenu</a>
          </li>
          <li class="sub_menu--item">
            <a href="#" class="sub_menu--link">Submenu</a>
          </li>
        </ul>
      </li>

      <li class="menu--item">
        <a href="#" class="menu--link" title="Item 5">
          <i class="menu--icon  fa fa-fw fa-globe"></i>
          <span class="menu--label">Item 5</span>
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
<form action="index.php?" method="GET">
  <span><input type="text" size="25" value="" name="search" id="country" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter patient Name or number" style="width: 268px; height:30px;" />
  <input type="hidden" name="response" value="0"> <button class="btn btn-success"><i class="icon icon-save icon-large"></i>submit</button></span>     
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>

</div></form>
    
    <?php
    $search=$_GET['search'];
    $nothing="";


    if ($search!=$nothing) {
       # code...
      ?><?php } ?>
      <?php 
      $search=$_GET['search'];
      $response=0;
      include ('../connect.php');
$result = $db->prepare("SELECT * FROM patients WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $a=$row['name'];
        $b=$row['age'];
        $c=$row['sex'];
        $d=$row['opno'];

 ?>
 
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
      <h4 align="center">patient medical information</h4>
       <div class="container-fluid">
    <?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $e=$row['systolic'];
        $f=$row['diastolic'];
        $g=$row['rate'];
        $h=$row['height'];
        $j=$row['weight'];
        $k=$row['temperature'];
         $l=$row['breat_rate'];
        $pn=$row['pno']; 
        ?>
         
<div class="container-fluid">
  <?php
  if (($e<90) || ($f<60)){
  
    $alert="the patient is hypotensive, rapid action is needed as this my lead to renal failure or even death!";
    }

  if ((90 <= $e) && ($e <= 119) || (60 <= $f) && ($f <= 80)) {
    $alert="blood pressure is normal";
  
  }
  if ((121 <= $e) && ($e <= 139) || (81 <= $f) && ($f <= 89)) { 
    $alert="the patient is prehypertensive";
  }
  if ((140 <= $e) && ($e <= 159) || (90 <= $f) && ($f <= 99)) { 
    $alert="patient in stage 1 hypertension, action needed";
  }
  if (($e>=160) || ($f>=100)) { 
    $alert="patient in stage 2 hypertension,action needed";
  }
  $haystack =$alert;
$needle   = "needed";

if( strpos( $haystack, $needle ) !== false ) {
    $myclass="alert alert-danger";
}
if( strpos( $haystack, $needle ) == false ) {
    $myclass="alert alert-success";
}

   ?>

   <p class="<?php echo $myclass ?>" style="width:40%;font-size: 1em;" > <?php echo $alert; ?></p>
  <caption align="left"><?php echo $a; ?> &nbsp; age: <?php echo $b; ?> &nbsp; sex: <?php echo $c; ?> </caption>
  <p style="font-style: normal;">bp:<?php echo $e; ?>/<?php echo $f; ?>, pulse: <?php echo $g; ?>, temp: <?php echo $k; ?> &#x2103;, weight: <?php echo $j; ?>, height: <?php echo $h; ?>, respiration: <?php echo $l; ?></p>
      </div><?php } ?>
      <?php $result = $db->prepare("SELECT cc,dx,ddx,plan,pmh,mh FROM prescriptions  WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $cc=$row['cc'];
        $dx=$row['dx'];
        $ddx=$row['ddx'];
        $pmh=$row['pmh'];
        $mh=$row['mh'];
        $plan=$row['plan'];
        ?></hr>
        <div class="container" style="border-style: groove;
    border-color: pink;">
        <div class="col-sm-6" > <p style="font-size: 1em">chief complain: <?php echo $cc ;?>
          <p style="font-size: 1em">other conditions: <?php echo $pmh;?>
        </p>
          <p style="font-size: 1em">differential diagnosis: <?php echo $ddx ;?></p></div>
          <div class="col-sm-6" ><p style="font-size: 1em"> diagnosis: <?php echo $dx ;?></p>
           <p style="font-size: 1em"> other drugs: <?php echo $mh ;?></p>
          <p style="font-size: 1em"> plan: <?php echo $plan ;?></p></div></div></hr>
      <form action="savepatient.php" method="POST">
        <input type="hidden" name="pn" value="<?php echo $pn; ?>">
        <p>&nbsp;</p>
      <div class="container" ><label>select medicines for patient</label></br>

      
      <span><select id="medicine" name="med" class="selectpicker" data-live-search="true" title="Please select a medicine..." >


<script>
    window.onload = populateSelect();

function populateSelect() {

    // CREATE AN XMLHttpRequest OBJECT, WITH GET METHOD.
    var xhr = new XMLHttpRequest(), 
        method = 'GET',
        overrideMimeType = 'application/json',
        url = 'json.php';        // ADD THE URL OF THE FILE.

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                
            // PARSE JSON DATA.
            var drugs = JSON.parse(xhr.responseText);

            var ele = document.getElementById('medicine');
            for (var i = 0; i < drugs.length; i++) {
                // BIND DATA TO <select> ELEMENT.
                ele.innerHTML = ele.innerHTML +
                    '<option value="' + drugs[i].drug_id + '">' + drugs[i].generic_name +'-' + drugs[i].brand_name+ '</option>';                   
                    
            }
        }
    };
    xhr.open(method, url, true);
    xhr.send();
}
    
</script>
</select>
       
      <input name="qty" style="height: 2em;width:3em;" type="number" min="1" placeholder="qty"><button class="btn btn-success btn-large">add</button></form></span></div>
      
      <div class="container" id="results" > <label>selected meds</label></br> 
     <table class="resultstable" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>quantity</th>
<th>price</th>
<th>total</th>
<th>action</th>
</tr>
</thead>
<?php
       $patient=$_GET['search'];
        $result = $db->prepare("SELECT drugs.drug_id,generic_name,brand_name,price,dispense_id,dispensed_drugs.quantity FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id=dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by=''");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
         ?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<td><a rel="facebox" href="editqty.php?id=<?php echo $row['dispense_id']; ?>&qty=<?php echo $qty; ?>&gname=<?php echo $drug; ?>&bname=<?php echo $brand; ?>&pn=<?php echo $pn; ?>"><button class="btn btn-success" style="height: 5px;" title="Click to edit quantity"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
        $result = $db->prepare("SELECT sum(price*dispensed_drugs.quantity) as total FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id =dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by=''");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      <th> </th>
      <th>  </th>
      <th>  </th>
      <th>  </th>
      <td> Total Amount: </td>
      
    </tr>
      <tr>
        <th colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
        <td colspan="1" id="myvalue"><strong style="font-size: 12px; color: #222222;"> <?php echo $row['total']; ?> </td><?php } ?>
</tbody>
</table>
 </br>
 <a href="savepharm.php?pn=<?php echo $pn; ?>">
 <button class="btn btn-success btn-large" style="width: 100%;">save</button></a>
      

</div> </div>
      
      
</div>
<?php } ?>
      
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<?php } ?>

  <script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>