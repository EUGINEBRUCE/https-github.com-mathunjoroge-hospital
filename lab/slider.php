<?php
//path to directory to scan. i have included a wildcard for a subdirectory
$directory =$_REQUEST["id"];

//get all image files with a .jpg extension.
$images = glob("" . $directory . "*");

$imgs = '';
// create array
foreach($images as $image){

//shuffle array
shuffle($imgs);

//select first 20 images in randomized array
$imgs = array_slice($imgs, 0, 20);

//display images
foreach ($imgs as $img) {
    echo "<img src='$img' /> ";
}
?> 
<?php } ?>