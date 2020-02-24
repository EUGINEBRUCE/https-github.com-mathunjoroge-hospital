<?php 
include('connect.php');

  //Start session
  session_start();
  
  //Unset the variables stored in session
  unset($_SESSION['SESS_MEMBER_ID']);
  unset($_SESSION['SESS_FIRST_NAME']);
  unset($_SESSION['SESS_LAST_NAME']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	
</head>
<div>
<?php include ('nav.php');
 ?></div>

<body>
	
	
	<div class="limiter" >
		<div class="container-login100">
			<div class="wrap-login100" ;>
				<?php if (isset($_GET['response'])) {
	# code...
 ?>
 <style type="text/css">
 	.blink_me {
  animation: blinker 2s linear infinite;
}

@keyframes blinker {  
  60% { opacity: 0.2; }
}
 </style>
 <span class="login100-form-title" class="blink_me" style="color: red;font-weight: bold;font-size: 1rem;">Please use the correct login credentials</span>
 <?php } ?>

				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">

				</div>
				 

				<form action="login.php" method="post">
					<form class="login100-form validate-form" >
					<span class="login100-form-title">

						user Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="username cannot be empty">
						<input class="input100" type="text" name="username" placeholder="username" autocomplete="off" required/>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" autocomplete="off" required/>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							&nbsp;
						</span>
						&nbsp;
					</div>
				
			</div>
		</div>
	</div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="js/main.js"></script>

</body>
</html>