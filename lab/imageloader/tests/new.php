<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    	<!-- iOS meta tags -->
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
    	<meta name="apple-mobile-web-app-capable" content="yes">
    	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    	<link rel="stylesheet" type="text/css" href="papaya.css?build=1449" />
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="papaya.js?build=1449"></script>
    
    	<title>Papaya Viewer</title>
    
    	<script type="text/javascript">
var params = [];


//will load array here
params["images"] = [[<?php
    $path=$_GET['id'];
    $files = glob('data/'.$path.'/*', GLOB_BRACE);
foreach($files as $file) {
   $data='"'.$file.'"'.',';
   echo $data; 
}
echo $data = rtrim($data, ',');
?>]];

</script>

	</head>

	<body>
		
		<div class="papaya" data-params="params"></div>
		
	</body>
</html>
