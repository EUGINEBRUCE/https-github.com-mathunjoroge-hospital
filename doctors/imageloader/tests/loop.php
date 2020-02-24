<?php
    $files = glob('data/mygood/*', GLOB_BRACE);
foreach($files as $file) {
   $data='"'.$file.'"'.',';
   echo $data.'</br>'; 
}
echo $data = rtrim($data, ',').'</br>';
?>
