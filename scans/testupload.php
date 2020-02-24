<form method="POST" enctype="multipart/form-data" action="testupload.php">
    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
    <input type="text" name="ipno">
    <input class="button" type="submit" value="Upload" />
</form>
<?php if (isset($_POST["ipno"])) {
	# code...
$foldername=$_POST["ipno"]; 
mkdir($foldername, 0755, true);
}

$count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $foldername.'/'.$name)) {
                $count++;
            }
        }
    }
} ?>