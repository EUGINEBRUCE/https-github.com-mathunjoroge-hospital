<!--this is my code -->
<?php
    $files = glob('data/mygood/*', GLOB_BRACE);
   // echo sizeof($files);
    $x = sizeof($files);
    $z= $x-1;
    $output ='';
    for($y=0;$y<$x-1;$y++){

    	if($y==$z){
		$output = $output.$files[$y];

    	}
    	else{
       $output = $output.$files[$y].'" , " ';
    	}
    	//echo $output;
    	//echo substr($output, 0, -1);

    //	$data = substr($output,0,-1).'"';
    //	echo $data;
//
    	//$datas = $files[$y];
    	//echo $datas;
    }
   // echo $output;
    $data = '"'.substr($output,0,-6).'"';
    echo $data;
 /*   echo 'End of Rugute Query';
foreach($files as $file) {
   $data='"'.$file.'"'.',';
    
echo $data; */

//"data/mygood/20190509085252046000003", "data/mygood/20190509085251670000001"
// <?php } 
?>


