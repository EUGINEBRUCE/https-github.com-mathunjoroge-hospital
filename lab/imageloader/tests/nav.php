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
    top: 28%;
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
ul {
    font-family:Arial, Helvetica, sans-serif;
    font-size:11px;
    color:#FFF;
    padding:0;
    margin:0;
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
    left: 60.2%;
}
.combopopup{
    padding:3px;
    width:268px;
    border:1px #CCC solid;
}

</style> 


    <div class="container" id="top" style="background-color: #3786d6;" ><img src="logo.png" style="height:auto;"><strong style="color: white;float: right;"><i class="fa fa-user">&nbsp;</i><?php echo $_SESSION['SESS_FIRST_NAME']; ?>&nbsp;<a href="../logout.php"><i style="color: red;" class="fa fa-power-off"></i><font  style="color: white;"> Log out</font></strong></a></li></div> 
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <?php
    $position=$_SESSION['SESS_LAST_NAME'];
    if ($position=="admin") {
        # code...
    
     ?>
    <div id="view_as">
    <p>
    <form action="../redirect.php" method="POST">
                    <label> <?php echo $_SESSION["view_as"]; ?>'s view, change to: </label>
                    <select name="position" title="please select user" required/>
                    <option></option>
                        <option value="registration">records</option>
                        <option value="cashier">cashier</option>
                        <option value="nurse">nurse</option>
                        <option value="doctor">doctor</option>
                        <option value="pharmacist">pharmacist</option>
                        <option value="stores">store</option>
                        <option value="lab">lab</option>
                        <option value="admin">admin</option>                        
                    </select>
                    <button id="submitbtn">submit</button>
                </form></p></div>
            <?php } ?>

  