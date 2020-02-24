
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>jQuery.Print</title>
        <meta name="description" content="jQuery.print is a plugin for printing specific parts of a page">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link href='https://fonts.googleapis.com/css?family=Chivo:900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../stylesheets/stylesheet.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../stylesheets/pygment_trac.css" media="screen" />
        <style type='text/css'>
        .a {
            background: black;
            color: white;
        }
        .b {
            color: #aaa;
        }
        </style>
        <!--[if lt IE 9]>
        <script src="js/vendor/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->
    </head>
    <body>
        
            <div id="ele4" class="b">
                <div style="background-color: #3786d6;">
<?php 
 include('../main/nav.php'); 
 ?></div>
 <div align="center">
 <?php 


$a=$_GET['name'];
$b=$_GET['number'];

?>

<hr>
<div class="container"><div  style="width: 90%;height: 70%;">
  <div class="jumbotron" style="
background-color: transparent;
background-image: url(bamboo.JPEG);
font-size: 2em;.h3,.h4{font-size: 2em}">
  <h6 style="font-size: 1em;">test hospital</h6>
  <h6 style="font-size: 1em;">p.o box 1234,</h6>
  <h6 style="font-size: 1em;">kenya.</h6>
  <h6 style="font-size: 1em;">tel: 1234</h6>
    <p style="font-size: 1em;"><?php 
    echo $a;
    ?></p>
    <p style="font-size: 1em;"> Patient Number: <?php 
    echo $b;
?></p>
<hr>
  <table class="table" >
<thead>
<tr>
    <th>payment</th>
      <th>amount</th>
    </tr>
</thead>    
      <?php
      include('../connect.php'); 
      $b=$_GET['number'];
        $d2=0;
        $result = $db->prepare("SELECT* FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE paid_by=:a AND paid=:b");
        $result->bindParam(':a', $b);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
                
      ?>
      <tbody>
<tr> <td><?php echo $row['fees_name']; ?>:&nbsp;</td>
      <td> &nbsp;<?php echo $row['amount']; ?>

</td><?php } ?></tbody>
</table>
<hr>
<?php
 $result = $db->prepare("SELECT sum(amount) AS total FROM collection RIGHT OUTER JOIN fees ON fees.fees_id=collection.fees_id  WHERE paid_by=:a AND paid=:b");
        $result->bindParam(':a', $b);
        $result->bindParam(':b', $d2);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
 ?>
 <table class="table" >
<thead>
<tr>
    <th>total</th>
    <th>&nbsp;</th>
      <th><?php echo $row['total'];  ?></th>
    </tr>
</thead> 
 </table><?php } ?>
</div>
</div>
</div>
</div>
<button class="btn btn-success btn-large" style="margin-left: 45%;"  id="printme" onclick="print('print');" >print receipt</button>
</body>
<script type="text/javascript">
function Redirect() 
{  
window.location="index.php?search= &attempt=3&name=<?php echo $a ?>"; 
}  
setTimeout('Redirect()', 50000);   
</script>
                    <button class="print-link avoid-this">
                    Print this in a new window, without this button and the title
                    </button>
                </div>
                <br/>
            </div>
        </div></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
        <script src="../main/print.js"></script>
        <script type='text/javascript'>
        //<![CDATA[
        jQuery(function($) { 'use strict';
            $("#ele2").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#ele2");
            });
            $("#ele4").find('button').on('click', function() {
                //Print ele4 with custom options
                $("#ele4").print({
                    //Use Global styles
                    globalStyles : false,
                    //Add link with attrbute media=print
                    mediaPrint : false,
                    //Custom stylesheet
                    stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
                    //Print in a hidden iframe
                    iframe : false,
                    //Don't print this
                    noPrintSelector : ".avoid-this",
                    //Add this at top
                    prepend : "Hello World!!!<br/>",
                    //Add this on bottom
                    append : "<br/>Buh Bye!",
                    //Log to console when printing is done via a deffered callback
                    deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
                });
            });
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });
        //]]>
        </script>
    </body>
</html>
