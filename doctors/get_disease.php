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
  <?php
$q = intval($_GET['q']);

include('../db_connect.php');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
?>
<script type="text/javascript">
        $('#ddx').selectpicker('refresh');
    </script>
<select name="ddx" id="ddx" data-live-search="true" multiple>
    
<?php
mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM icd_second_level_codes WHERE icd_first_level_code_id = '".$q."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    echo "<option value=".$row['id'].">".$row['title']."</option>";
}
echo "</select>";

mysqli_close($con);
?>