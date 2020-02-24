<?php
    $files = glob('mygood/*', GLOB_BRACE);
foreach($files as $file) {
   $data='"'.$file.'"'.',';
   echo substr($data, 0, -1);
}

?>
