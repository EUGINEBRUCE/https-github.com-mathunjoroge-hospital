<?php 
require_once('../main/auth.php');
include ('../main/nav.php');
 ?>
 <?php

$DS = DIRECTORY_SEPARATOR;
file_exists(__DIR__ . $DS . 'core' . $DS . 'Handler.php') ? require_once __DIR__ . $DS . 'core' . $DS . 'Handler.php' : die('Handler.php not found');
file_exists(__DIR__ . $DS . 'core' . $DS . 'Config.php') ? require_once __DIR__ . $DS . 'core' . $DS . 'Config.php' : die('Config.php not found');

use AjaxLiveSearch\core\Config;
use AjaxLiveSearch\core\Handler;

if (session_id() == '') {
    session_start();
}

    $handler = new Handler();
    $handler->getJavascriptAntiBot();
?>
 <!DOCTYPE html>
<html>
<title>search patient</title>
<head>
   <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.min.css">
  <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="description"
          content="AJAX Live Search is a PHP search form that similar to Google Autocomplete feature displays the result as you type">
    <meta name="keywords"
          content="Ajax Live Search, Autocomplete, Auto Suggest, PHP, HTML, CSS, jQuery, JavaScript, search form, MySQL, web component, responsive">
    <meta name="author" content="Ehsan Abbasi">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../main/bootstrap.min.css">
  <script src="../main/jquery.min.js"></script>
  <script src="../main/bootstrap.min.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>


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
  background: #95CAFC;
  padding: 5px 10px;
  box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
  position: absolute;
  left: 10px;
  margin: 0;
  width: 268px;
  top: 40px;
  padding:0px;
  background-color: #000;
  color: #fff;
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
  color:#95CAFC;
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
.combopopup{
  padding:3px;
  width:268px;
  border:1px #CCC solid;
}

</style>
</head>
<body>        
<div class="container" style="width:18%;float: left;">
  <div class="span2">

  
  <ul class="nav nav-list">

      <li class="active"><a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i>register patient</a></li>
      <li><a href="searchcustomer.php?name=&nbsp;"><i class="icon-search icon-2x"></i> search patient</a></li>
       <li><a href="products.php"><i class="icon-list-alt icon-2x"></i>patient details</a></li>
      <li><a href="antimalarials.php?d1=&nbsp;&d2=&nbsp;"><i class="icon-group icon-2x"></i> malaria report</a>
      <li><a href="antimalsummary.php?d1=&nbsp;&d2=&nbsp;"><i class="icon-bar-chart icon-2x"></i> malaria summary</a>
      <li><a href="reports.php?id=0&d1=&nbsp;&d2=&nbsp;&category=0"><i class="icon-bar-chart icon-2x"></i> other reports</a>                                     </li>
      <li><a href="consumptionlist.php?d1=&nbsp;&d2=&nbsp;"><i class="icon-bar-chart icon-2x"></i> Sales Report</a></li>
      <br><br><br><br><br><br>
      <li></div></div></div></div></div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
function suggest(inputString){
        if(inputString.length == 0) {
            $('#suggestions').fadeOut();
        } else {
        $('#country').addClass('load');
            $.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
                if(data.length >0) {
                    $('#suggestions').fadeIn();
                    $('#suggestionsList').html(data);
                    $('#country').removeClass('load');
                }
            });
        }
    }

    function fill(thisValue) {
        $('#country').val(thisValue);
        setTimeout("$('#suggestions').fadeOut();", 600);
    }

</script>

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
    left: 21.8%;
    margin: 0;
    width: 268px;
    top: 29%;
    padding:0px;
    background-color: blue;
    color: #fff;
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
.combopopup{
    padding:3px;
    width:268px;
    border:1px #CCC solid;
}

</style>
<body onLoad="document.getElementById('country').focus();">
      <div class="container" >        
        <div id="content">         
        <div class="span10">
          <script type="text/javascript">
             $("#firstNameChange").click(function(){ 


                //check if there are any existing input elements
                if ($(this).children('input').length == 0){

                    $("#saveFirstName").css("display", "inline");

                    //variable that contains input HTML to replace
                    var inputbox = "<input type='text' class='inputbox' value=\""+$(this).text()+"\">";    
                    //insert the HTML intp the div
                    $(this).html(inputbox);         

                    //automatically give focus to the input box     
                    $(".inputbox").focus();

                    //maintain the input when it changes back to a div
                  $(".inputbox").blur(function(){
                        var value = $(this).val();
                        $("#firstName").val(value);
                        $("#firstNameChange").text(value);

                    });
                }               
        });

          </script>
          <div class="jumbotron" style="width: 70%;margin-left: 10%;background: #95CAFC;" id="firstNameChange" ><style type="text/css" >
      	table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 70%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
      </style>
      <h3>blood presure</h3>
      <form action="savepatient.php" method="post">        
      <table class="blueTable" style="height: 63px;" width="165">
<thead>
<tr>
<th>systolic</th>
<th>diastolic</th>
<th>pulse rate</th>
</tr>
</thead>
<tbody>
<tr>
<td>input1</td>
<td>cell2_1</td>
<td>cell3_1</td>
</tr>
</tbody>
</table>
<h3>Physical</h3>
  <table class="blueTable" style="height: 63px;" width="165">
<thead>
<tr>
<th>heigh</th>
<th>weight</th>
<th>temperature</th>
</tr>
</thead>
<tbody>
<tr>
<td>input1</td>
<td>cell2_1</td>
<td>cell3_1</td>
</tr>
</tbody>
</table>
<iframe src=""> <table class="blueTable" style="height: 63px;" width="165">
<thead>
<tr>
<th>heigh</th>
<th>weight</th>
<th>temperature</th>
</tr>
</thead>
<tbody>
<tr>
<td>input1</td>
<td>cell2_1</td>
<td>cell3_1</td>
</tr>
</tbody>
</table></iframe>
<button class="btn btn-primary btn-large" style="margin-left:55%;">save</button></form>
      </div>
</div>

</div></div></div>                
</div></div></div>
<script src="js/jquery-1.11.1.min.js"></script>

<!-- Live Search Script -->
<script type="text/javascript" src="js/ajaxlivesearch.min.js"></script>

<script>
jQuery(document).ready(function(){
    jQuery(".mySearch").ajaxlivesearch({
        loaded_at: <?php echo time(); ?>,
        token: <?php echo "'" . $handler->getToken() . "'"; ?>,
        max_input: <?php echo Config::getConfig('maxInputLength'); ?>,
        onResultClick: function(e, data) {
            // get the index 0 (first column) value
            var selectedOne = jQuery(data.selected).find('td').eq('0').text();

            // set the input value
            jQuery('#ls_query').val(selectedOne);

            // hide the result
            jQuery("#ls_query").trigger('ajaxlivesearch:hide_result');
        },
        onResultEnter: function(e, data) {
            // do whatever you want
            // jQuery("#ls_query").trigger('ajaxlivesearch:search', {query: 'test'});
        },
        onAjaxComplete: function(e, data) {

        }
    });
})
</script>
<script type="text/javascript">
document.getElementById('')
</script>

</body>
</html>