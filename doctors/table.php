<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <!-- Start your project here-->
  

  <header class="header clearfix" style="background-color: #95CAFC;">
    

    </button>
    <?php include('../main/nav.php'); 
    include('../connect.php');?>
   
  </header><?php
  include('side.php'); ?>  
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
      <script type="text/javascript">$(document).ready(function () {
  $('#products_table').DataTable();
  $('.dataTables_length').addClass('bs-select');
});</script>
<script type="text/javascript">
  $(document).ready(function () {
  $('#products_table').DataTable({
    "pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>
      
      
      <div class="container" id="results" >
      
        <h3>pharmacy stocks</h3><span>
          <?php if ($lowstock>0) {
        # code...
       ?><a rel="facebox" href="low.php"><button class="btn-danger">pharmacy stock runing low</button></a> <?php } ?> <?php if ($lowstore>0) {
        # code...
       ?><a rel="facebox" href="lowstore.php"><button class="btn-danger">store stock runing low</button></a> <?php } ?><a rel="facebox" href="add.php"> <button class="btn-success" style=""  >add product</button></a></span></br><p></p> 
      <input type="text" id="search" onkeyup="myFunction()" placeholder="Search for drugs.." title="Type in a drug">
     <table class="table table-striped table-bordered table-sm" id="products_table" >
<thead>
<tr>
<th>generic name</th>
<th>brand name</th>
<th>qty in store</th>
<th>qty in pharmacy</th>
<th>price</th>
<th>total</th>
<th>action</th>
</tr>
</thead>
<?php
        $result = $db->prepare("SELECT*  FROM drugs");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $price= $row['price'];
      $qty= $row['quantity'];
      $qtyp= $row['pharm_qty'];
         ?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<td ><?php echo $qtyp; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo $qty*$price; ?></td>
<td><a rel="facebox" href="editstock.php?id=<?php echo $row['drug_id']; ?>&qty=<?php echo $qty; ?>&gname=<?php echo $drug; ?>&bname=<?php echo $brand; ?>"><button class="btn btn-success" style="height: 5px;" title="Click to edit quantity"></button></a> <a href="delete_drug.php?id=<?php echo $row['drug_id']; ?>"><button onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button></a> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>   

</div> </div>      
      
</div>
<script>
var $rows = $('#products_table tbody tr');
$('#search').keyup(function() {
    
    var val = '^(?=.*\\b' + $.trim($(this).val()).split(/\s+/).join('\\b)(?=.*\\b') + ').*$',
        reg = RegExp(val, 'i'),
        text;
    
    $rows.show().filter(function() {
        text = $(this).text().replace(/\s+/g, ' ');
        return !reg.test(text);
    }).hide();
});
</script>

  
    </div>
  </div>
  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
