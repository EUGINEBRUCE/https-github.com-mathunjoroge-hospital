<?php 
require_once('../main/auth.php');
include ('../connect.php');
$shownav=0; ?>
<!DOCTYPE html>
<html lang="en">
<head><title>add test parameters</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='../pharmacy/googleapis.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/normalize.css/normalize.css' rel='stylesheet'>
  <link href='../pharmacy/src/vendor/fontawesome/css/font-awesome.min.css' rel='stylesheet'>
  <link href="../pharmacy/dist/vertical-responsive-menu.min.css" rel="stylesheet">
  <link href="../pharmacy/demo.css" rel="stylesheet">        
 <link href="http://demos.codexworld.com/includes/css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->
 <link href="http://demos.codexworld.com/includes/css/style.css" rel="stylesheet">
</head>
<body>
    <body>
        <div class="navbar-header" style="margin-top: -6%;position: absolute;float: top;">
                        
  <?php include('../main/nav.php'); ?> 
  
        </div>  
 <?php include('side.php'); ?>
  <div class="content-wrapper"> 
<div class="jumbotron" style="background: #95CAFC;">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="container">
                <h4>add parameters for <?php echo $_GET['test']; ?></h4>
                <form name="codexworld_frm" action="save_params.php" method="POST">
                    <input type="hidden" name="test_id" value="<?php echo $_GET['id']; ?>">

                    <select class="form-control" name="sex" style="width: 37%;" title="select sex"  required/><option value=""></option>
                    <option value="1">male</option>
                <option value="2">female</option></select>
                  <p>&nbsp;</p>
            	<div class="field_wrapper">
                    <div>
                        <input type="hidden" name="para_names" value="" placeholder="add para_name" required/> <input type="hidden" name="normal_ranges" value="" placeholder="normal_ranges" required/>
						<a href="javascript:void(0);" class="add_button" title="Add field"><button class="btn-success"> add field</button></a><br>&nbsp;
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" style="width: 37%;" name="submit" value="SUBMIT"/>
                </form> 
            </div>
        </div>
    </div>

</div>
   	<!-- JavaScript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     	        <script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    	<script type="text/javascript">
$(document).ready(function(){
	var maxField = 20; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	var fieldHTML = '<div><input type="text" name="para_names[]" value="" placeholder="add para_name" required/> <input type="text" name="normal_ranges[]" value="" placeholder="normal_range" required/><a href="javascript:void(0);" class="remove_button"> <button class="btn-danger">remove</button></a><br>&nbsp;</div>'; //New input field html 
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
