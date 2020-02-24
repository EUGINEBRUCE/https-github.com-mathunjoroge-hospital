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
    <div class="container-login100" ">
      <div class="wrap-login100" ;>
        <div class="login100-pic js-tilt" data-tilt>
          <img src="images/img-01.png" alt="IMG">
        </div>
        <form action="localview.php" method="">
          <form class="login100-form validate-form" >
          <span class="login100-form-title">

          </span>

          <div class="wrap-input100 validate-input" data-validate = "username cannot be empty">
            <h2>you cannot login. application expired.</h2></br>
            <h2>contact Dr Mathu on mathunjoroge@gmail.com for help</h2>
          </div>
          
          <div class="container-login100-form-btn">
            
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