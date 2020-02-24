<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Title Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/multi-select.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <script src="../js/bootstrap.min.js"></script>
</head>
<body>
  <!-- start -->
  <h1>select</h1>
  <?php include('../../connect.php') ?>
  <select id='pre-selected-options' multiple='multiple' data-live-search="true" style="width: 50%;">
    <?php 
           
          $result = $db->prepare("SELECT * FROM icd_second_level_codes ORDER BY title ASC ");
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          echo "<option value=".'"'.$row['code'].'"'.">".$row['title']."</option>";
                   }
                  
                  ?>      
          </select>
  </select>
  <!-- ends -->
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
  <script src="../js/jquery.multi-select.js"></script>
  <script type="text/javascript">
  // run pre selected options
  $('#pre-selected-options').multiSelect();
  </script>
</body>

</html>
