<?php 
require_once('../main/auth.php');
 ?>
 <!DOCTYPE html>
<html>
<title>Disease Sub-Categories</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href='../pharmacy/googleapis.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="dist/js/bootstrap-select.js"></script>
 
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
  <header class="header clearfix" style="background-color: #3786d6;">
    </button>
    <?php include('../main/nav.php'); ?>   
  </header><?php include('../connect.php'); ?>
  
  <div class="content-wrapper" style=" background-image: url('../images/doctor.jpg');">

    <p></p>
    
    <div class="container" style="background: white">
      <a href="index.php"><button class="btn btn-success">back</button></a>
<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left; width:60%;">
  <thead>
    <tr>
    <th width="13%">disease sub-categories</th>
       </tr>
  </thead>
  <tbody>    
      <?php
      $id=$_GET['id'];
       $result = $db->prepare("SELECT * FROM icd_blocks WHERE icd_chapter_id=:a");
        $result->BindParam(':a', $id);        
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
      ?>
      <tr class="record">
      <td><a href="icd_first_level_codes.php?id=<?php echo $row['id']; ?>&back=<?php echo $_GET['id']; ?>"> <?php echo $row['title']; ?></a></td>
      </td>
      
      </tr>
      <?php
        }
      ?>
    
  </tbody>
  
      
</table>
</div>

</html>