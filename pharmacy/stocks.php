<?php 
require_once('../main/auth.php');
include ('../connect.php');
//check how many pharmacy products are running low
$result = $db->prepare("SELECT * FROM drugs WHERE pharm_qty<=reorder_ph");
        $result->execute();
        $lowstock = $result->rowcount();
       
        //check how many store products are running low
$result = $db->prepare("SELECT * FROM drugs WHERE quantity<=reorder_st");
        $result->execute();
        $lowstore = $result->rowcount();
        $result = $db->prepare("SELECT * FROM orders");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;      
        
 ?>
 
 <!DOCTYPE html>
<html>
<title>pharmacy</title>
<?php
  include "../header.php";
  ?>
</head>
<body>

  <header class="header clearfix" style="background-color: #3786d6;">

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
      
      
      <div class="container" id="results" >
      
        <h3>pharmacy stocks</h3><span>
          <?php if ($lowstock>0) {
        # code...
       ?><a rel="facebox" href="low.php"><button class="btn-danger">pharmacy stock runing low</button></a> <?php } ?> <?php if ($lowstore>0) {
        # code...
       ?><a rel="facebox" href="lowstore.php"><button class="btn-danger">store stock runing low</button></a> <?php } ?><a rel="facebox" href="add.php"> <button class="btn-success" style=""  >add product</button></a></span></br><p></p> 
      <input type="text" id="search" onkeyup="myFunction()" placeholder="Search for drugs.." title="Type in a drug">
     <table class="table table-bordered" id="products_table" >
<thead class="bg-primary">
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
        $result = $db->prepare("SELECT drug_id, generic_name, brand_name,price*pharm_qty*mark_up AS value ,price*mark_up AS price, quantity,pharm_qty FROM drugs");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $drug = $row['generic_name'];
      $brand = $row['brand_name'];
      $value= $row['value'];
      $qty= $row['quantity'];
      $price= round($row['price']);
      $qtyp= $row['pharm_qty'];
         ?>
<tbody>
<tr>
<td><?php echo $drug; ?></td>
<td><?php echo $brand; ?></td>
<td ><?php echo $qty; ?></td>
<td ><?php echo $qtyp; ?></td>
<td><?php echo $price; ?></td>
<td ><?php  echo round($value); ?></td>
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

 
</div></div></div></div></div></div></div></div>

</body>
</html>