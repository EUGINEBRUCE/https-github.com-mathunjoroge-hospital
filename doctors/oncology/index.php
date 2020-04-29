<?php 
require_once('../../main/auth.php');
include ('../../connect.php');
$shownav=0; ?>
<!DOCTYPE html>
<html lang="en">
<head><title>add test parameters</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../dist/css/bootstrap-select.css">
<script src="../dist/js/bootstrap-select.js"></script>    
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<!-- Add custom CSS here -->
<link href="../../pharmacy/form/css/style.css" rel="stylesheet">
</head>
<body>
<body>
<div class="navbar-header" style="margin-top: -6%;position: fixed;z-index:1;">
    
<?php include('../../main/nav.php'); ?> 

</div>  
<?php include('../side.php'); ?>
<div class="content-wrapper"> 
<div class="jumbotron" style="background: #95CAFC;">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="container">
<form name="form-control" action="save_params.php" method="POST">
<p>&nbsp;</p>
<div class="field_wrapper">
<div>
    <input type="hidden" name="para_names" value="" placeholder="add para_name" required/> <input type="hidden" name="normal_ranges" value="" placeholder="normal_ranges" required/>
<a href="javascript:void(0);" class="add_button" title="Add field"><button class="btn-success"> add field</button></a><br>&nbsp;
</div>
</div>
<input type="submit" class="btn btn-primary" style="width: 37%;" name="submit" value="save"/>
</form> 
</div>
</div>
</div>

</div>
<!-- JavaScript -->
<select  class="selectpicker show-menu-arrow form-control" data-live-search="true" title="Please select drug" name="drug">
    <option value="" disabled="">-- Select drugs for patient--</option>
       <?php 
          $result = $db->prepare("SELECT * FROM meds");
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
                      $select="<option value=".$row['id'].">".$row['ActiveIngredient']."</option>";
                   
                  
                  ?> 
<script src="../../pharmacy/form/js/jquery.min.js"></script>
<script src="../pharmacy/form/js/bootstrap.js"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script src="../../pharmacy/form/js/platform.js" async defer></script>
<script type="text/javascript">
$(document).ready(function(){
var maxField = 20; //Input fields increment limitation
var addButton = $('.add_button'); //Add button selector
var wrapper = $('.field_wrapper'); //Input field wrapper
var select = '<?php echo $select; ?>';
var fieldHTML = '<div>'+select+'<input type="text" name="drug[]" value="" placeholder="select drug" required/> <select name="roa" placeholder="ROA"><option disabled/></option><option value="2">IV</option><option value="1">P.O</option><option value="3">IM</option><option value="4">SC</option><option value="5">topical</option></select> <input type="text" name="strength[]" value="" placeholder="strength" required/> <input type="text" name="frequency[]" value="" placeholder="frequency" required/> <input type="text" name="duration[]" value="" placeholder="duration" required/><a href="javascript:void(0);" class="remove_button"> <button class="btn-danger">remove</button></a><br>&nbsp;</div>'; //New input field html 
var x = 1; //Initial field counter is 1

//Once add button is clicked
$(addButton).click(function(){
//Check maximum number of input fields
if(x < maxField){ 
x++; //Increment field counter
$(wrapper).append(fieldHTML); //Add field html
}
});

//Once remove button is clicked
$(wrapper).on('click', '.remove_button', function(e){
e.preventDefault();
$(this).parent('div').remove(); //Remove field html
x--; //Decrement field counter
});
});
</script>
</body>
</html>
