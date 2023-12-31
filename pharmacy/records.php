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
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : '../src/loading.gif',
      closeImage   : '../src/closelabel.png'
    })
  })
</script>
<script>
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#country').addClass('load');
            $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
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

  <header class="header clearfix" style="background-color: blue;">
    

    </button>
    <?php include('../main/nav.php');
    $result = $db->prepare("SELECT * FROM orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
         ?>
   
  </header>


  <nav class="vertical_nav">

    <ul id="js-menu" class="menu">

      <li class="menu--item">
        <a href="index.php?attempt=0" class="menu--link" title="book clinic">
          <i class="menu--icon  fa fa-fw fa-home"></i>
          <span class="menu--label">home</span>
        </a>
      </li>

      <li class="menu--item">
        <a href="book.php?search=&response=0" class="menu--link" title="book clinic for patient">
          <i class="menu--icon  fa fa-fw fa-book"></i>
          <span class="menu--label">book clinic</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="pclinics.php?search= &response=0" class="menu--link" title="clinic patients">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">clinic patients</span>
        </a>
      </li>
      <li class="menu--item">
        <a href="booked.php?date=NULL&clinic=NULL" class="menu--link" title="see booked clinics">
          <i class="menu--icon  fa fa-fw fa-briefcase"></i>
          <span class="menu--label">booked clinics</span>
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
  
          <?php
          $a=$_GET['attempt'];
          if ($a==0) { echo "";
         ?>
           <?php } ?>
           <?php
          $a=$_GET['attempt']; 
          if ($a==2) {
             
            ?>
            <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> patient has been allocated a bed.</p></div><?php } ?>
             <?php
          $a=$_GET['attempt']; 
          if ($a==3) {
             
            ?>
            <div class="alert alert-success" style="width: 50%;margin-left: 10%;"><p> <?php echo $_GET['name']; ?> data has been saved.</p></div><?php } ?>
            
          
            
          <h3>register patient</h3>
        
      <style type="text/css">
        table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 60%;
  height: 250px;
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
table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
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
}
      </style>
      <form action="savepatient.php" method="post">
      <table class="blueTable">
<tbody>
<tr>
<td><input type="text" style="height: 30px;" name="name" placeholder="enter patient name" required> <select name="dept" style="height: 30px;" required><option>select dept</option><option value="1">out-patient</option><option value="2">in-patient</option></select></td>
<td><input type="text" style="height: 30px;" name="contact" placeholder="enter patient contact" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td><input type="date" style="height: 30px;" name="age" placeholder="date of birthh" required></td>
<td><input type="text" style="height: 30px;" name="nok" placeholder="next of kin" required></td>
</tr>
<tr>
<td><select name="sex" style="height: 30px;" required><option>select sex</option><option >male</option><option >female</option></select></td>
<td><input type="text" style="height: 30px;" name="nokc" placeholder="next of kin contact" required></td>
</tr>
<tr>
<td><input type="text" style="height: 30px;" name="address" placeholder="enter patient address" required></td>
<td><input type="text" style="height: 30px;" name="number" value="<?php echo $code; ?>" readonly>  <select id="fee" class="selectpicker"  title="select fees"  name="fees[]" multiple  required/>
    <option value="">-- Select payable fees--</option>
<script>
    window.onload = populateSelect();

function populateSelect() {

    // CREATE AN XMLHttpRequest OBJECT, WITH GET METHOD.
    var xhr = new XMLHttpRequest(), 
        method = 'GET',
        overrideMimeType = 'application/json',
        url = 'fees.php';        // ADD THE URL OF THE FILE.

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                
            // PARSE JSON DATA.
            var fees = JSON.parse(xhr.responseText);

            var ele = document.getElementById('fee');
            for (var i = 0; i < fees.length; i++) {
                // BIND DATA TO <select> ELEMENT.
                ele.innerHTML = ele.innerHTML +
                    '<option value="'+ fees[i].fees_id +'">'+fees[i].fees_name +'</option>';
            }
        }
    };
    xhr.open(method, url, true);
    xhr.send();
}
    
</script>
</select></td>
</tr>
</tbody>
</table>
<button class="btn btn-success btn-large" style="width: 60%;">save</button></form>
   
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

<td><a rel="facebox" href="editqty.php?id=<?php echo $row['dispense_id']; ?>&qty=<?php echo $qty; ?>&gname=<?php echo $drug; ?>&bname=<?php echo $brand; ?>&pn=<?php echo $pn; ?>"></a><a href="delete.php?id=<?php echo $row['dispense_id']; ?>&pn=<?php echo $pn; ?>"> </a> </td><?php }?>
</tr>
<tr> <?php $patient=$_GET['search'];
        $result = $db->prepare("SELECT sum(price*dispensed_drugs.quantity) as total FROM dispensed_drugs RIGHT OUTER JOIN drugs ON drugs.drug_id =dispensed_drugs.drug_id WHERE patient='$patient' AND cashed_by=''");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){ ?>
      
        
</tbody>
</table>
 </br>
 <?php } ?></a></div>
      

</div> </div>
      
      
</div>

      
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


  <script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>