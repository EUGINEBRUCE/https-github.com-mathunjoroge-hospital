<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Display month &amp; year menus</title>
  <link rel="stylesheet" href="../main/jquery-ui.css">
  <script src="../main/jquery-1.12.4.js"></script>
  <script src="../main/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#mydate" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
  } );
  $( ".selector" ).datepicker({
  altFormat: "yy-mm-dd"
});
  // Getter
var altFormat = $( ".selector" ).datepicker( "option", "altFormat" );
 
// Setter
$( ".selector" ).datepicker( "option", "altFormat", "yy-mm-dd" );
  </script>
</head>
<body>
 
<input type="text" id="mydate">
 
</body>
</html>