<style type="text/css">
    body {
    text-transform: capitalize;
}
#top{ 
    position: fixed;
    width: 100%;
    

}
.jumbotron { 
    margin-left: -7%;
}
</style>
<style>
#result {
    height:20px;
    font-size:16px;
    font-family:Arial, Helvetica, sans-serif;
    color:#333;
    padding:5px;
    margin-bottom:10px;
    background-color:#FFFF99;
}
#country{
    border: 1px solid #999;
    background: #EEEEEE;
    padding: 5px 10px;
    box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
    position: absolute;
    left: 21.2%;
    margin: 0;
    width: 268px;
    top: 32%;
    padding:0px;
    background-color: blue;
    color: #fff;
}
@media (max-width: 480px) {
  .suggestionsBox {
    position: absolute;
    left: 0%;
    margin: 0;
    width: 60%;
    top: 37%;
    padding:0px;
    background-color: blue;
    color: #fff;
}
}
.suggestionList {
    margin: 0px;
    padding: 0px;
}
.suggestionList ul li {
    list-style:none;
    margin: 0px;
    padding: 6px;
    border-bottom:1px dotted #666;
    cursor: pointer;
}
.suggestionList ul li:hover {
    background-color: #FC3;
    color:#000;
}


.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
    position:relative;
}
#view_as {
    position: absolute;
    left: 73.2%;
}
.combopopup{
    padding:3px;
    width:268px;
    border:1px #CCC solid;    
}

</style> 
<style>
#result2 {
    height:20px;
    font-size:16px;
    font-family:Arial, Helvetica, sans-serif;
    color:#333;
    padding:5px;
    margin-bottom:10px;
    background-color:#FFFF99;
}
#country2{
    border: 1px solid #999;
    background: #EEEEEE;
    padding: 5px 10px;
    box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox2 {
    position: absolute;
    left: 21.2%;
    margin: 0;
    width: 268px;
    top: 32%;
    padding:0px;
    background-color: blue;
    color: #fff;
}
@media (max-width: 480px) {
  .suggestionsBox2 {
    position: absolute;
    left: 0%;
    margin: 0;
    width: 60%;
    top: 37%;
    padding:0px;
    background-color: blue;
    color: #fff;
}
}
.suggestionList2 {
    margin: 0px;
    padding: 0px;
}
.suggestionList2 ul li {
    list-style:none;
    margin: 0px;
    padding: 6px;
    border-bottom:1px dotted #666;
    cursor: pointer;
}
.suggestionList2 ul li:hover {
    background-color: #FC3;
    color:#000;
}
ul {
    font-family:Arial, Helvetica, sans-serif;
    font-size:11px;
  
    padding:0;
    margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest2 {
    position:relative;
}

.combopopup{
    padding:3px;
    width:268px;
    border:1px #CCC solid;    
}

</style> 
<style type="text/css">
    @media (max-width:629px) {
  img#logo {
    display: none;
   
  }
 #logo_mobile {display: block;}

}
  @media (min-width:629px) {
  img#logo_mobile {
    display: none;
   
  }

}
@media screen and (max-width: 600px) {
  #nav_lable {
    visibility: hidden;
    display: none;
  }
  #view_as{
    margin-top: 8%;

  }
}
</style>

    <div class="container" id="top" style="background-color: #3786d6;width: 100%;" ><img id="logo" src="../logo.png" style="height:auto;" alt="M&M Caresoft"><img id="logo_mobile" src="../mobile-min.JPG"  alt="M&M Caresoft"><strong style="color: white;float: right;" ><i class="fa fa-user">&nbsp;</i><?php echo $_SESSION['SESS_FIRST_NAME']; ?>&nbsp;<a href="../logout.php"><i style="color: red;" class="fa fa-power-off"></i><font  style="color: white;"> Log out</font></strong></a></li></div> 
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <?php
    $position=$_SESSION['SESS_LAST_NAME'];
    if (isset($_GET['page'])) {
       $_SESSION['view_as']=$_SESSION['SESS_LAST_NAME'];
    }
     ?>
    <?php
    
    if ($position=="doctor") {
        # code...
    
     ?>
    <style type="text/css">
            body {
  background-image: url('../images/doctor.jpg');
   background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center; 
 
}
        </style>
 <?php }?>
  <?php
    if ($position=="pharmacist") {
        # code...
    
     ?>
    <style type="text/css">
            body {
  background-image: url('../images/pharmacy.jpg');
   background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center; 
 
}
        </style>
 <?php }?>
   <?php
        if ($position=="lab") {
        # code...
    
     ?>
    <style type="text/css">
            body {
  background-image: url('../images/lab.jpg');
   background-repeat: repeat;
  background-attachment: fixed;
  background-position: center; 
 
}
        </style>
 <?php }?>
   