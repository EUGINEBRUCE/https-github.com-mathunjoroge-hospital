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
        $result = $db->prepare("SELECT * FROM purchases");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $code=$rowcount;
 ?>
 <!DOCTYPE html>
<html>
<title>stocks</title>
<?php
include "../header.php";
?>
</head>
<body><header class="header clearfix" style="background-color: #3786d6;">
    
    <?php include('../main/nav.php'); ?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper"> <div class="jumbotron" style="background: #95CAFC;">
 <div class="container" id="results" >
      
        <h3>stocks</h3><span>
           <?php if ($lowstore>0) {
        # code...
       ?><a rel="facebox" href="lowstore.php"><button class="btn-danger">store stock runing low</button></a> <?php } ?><a rel="facebox" href="add.php"> <button class="btn-success" style=""  >add product</button></a></span></br><p></p> 
     <table class="resultstable" >
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
<td><a rel="facebox" href="editstock.php?id=<?php echo $row['drug_id']; ?>&qty=<?php echo $qty; ?>&gname=<?php echo $drug; ?>&bname=<?php echo $brand; ?>"><button class="btn btn-success" style="height: 5px;" title="Click to edit quantity"></button></a> <button class="btn btn-danger" style="height: 5px;" title="Click to Delete"></button> </td><?php }?>
</tr>
<tr> 
</tbody>
</table>
 </br>
 
      

</div> </div>
      
      
</div>

      



  <script src="dist/vertical-responsive-menu.min.js"></script>
</div></div></div></div></div></div></div></div>

</body>
</html>