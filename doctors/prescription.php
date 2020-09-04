<?php
require_once('../main/auth.php');
require_once('../connect.php');
?>
 
 <!DOCTYPE html>
<html>
<title>prescription</title>
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
  <!-- select2 css -->
        <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
        <!-- select2 script -->
        <script src='select2/dist/js/select2.min.js'></script>
</head>
<body>
  <header class="header clearfix" style="background-color: blue;">
    
    <?php
include('../main/nav.php');?>   
  </header><?php include('side.php'); ?>
  <div class="content-wrapper"> 
    <div class="jumbotron" style="background: #95CAFC;">
            <nav aria-label="breadcrumb" style="width: 90%;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?search= &response=0">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">out patient</li>
    <li class="breadcrumb-item active" aria-current="page">prescription and further investications</li>
  </ol>
</nav><form action="saveprescription.php" method="post">
<center><h4><i class="icon-edit icon-large"></i> plan medications and other investigations</h4></center>
<div class="col-sm-6" >
<input type="hidden" name="pn" value="<?php echo $_GET['patient']; ?>">      
      <label>diagnosis</label></br>

      <select id='disease' style='width: 50%;' name="dx[]" data-live-search="true"  multiple>
            <option value='0' ></option>
        </select>

        <script>
            
        $(document).ready(function(){

            $("#disease").select2({
                placeholder:"find disease",
                minimuminputLength:3,
                theme: "classic",
                ajax: {
                    url: "diseases.php?q=term",
                    dataType: 'json',
                    type: "POST",
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });

        </script>     
       </div>
       <div class="col-sm-6">
      <select  name="lab[]" style="width: 100%;" class="selectpicker" title="select lab tests"  multiple>
<option value="" disabled>-- Select lab tests--</option><?php
include('../connect.php');
$result = $db->prepare("SELECT * FROM lab_tests");
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {
    
?>
        <?php
    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
}
?>

</select></br>
<select  name="image[]" style="width: 100%;" class="selectpicker" title="select imaging"  multiple>
<option value="" disabled>-- Select imaging--</option>
<?php
$result = $db->prepare("SELECT * FROM imaging");
$result->execute();
for ($i = 0; $row = $result->fetch(); $i++) {    
?>
        <?php
    echo "<option value=" . $row['imaging_id'] . ">" . $row['imaging_name'] . "</option>";
}
?>

</select></div>

<button class="btn btn-success btn-block btn-large" style="width:100%;"><i class="icon icon-save icon-large"></i> save</button>
</form>
<p>&nbsp;</p>
<a href="prescribe_inp.php?search=<?=$_GET['patient']; ?>&code=<?= rand(); ?>"><button class="btn btn-success"> prescribe drugs </button></a>
</div>
<hr>
<script src="../pharmacy/dist/vertical-responsive-menu.min.js"></script>



