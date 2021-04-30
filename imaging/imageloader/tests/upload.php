<?php
session_start(); 
include('../connect.php');
if (isset($_POST["pn"])) {
    # code...
$foldername=$_POST["pn"].date('YmdHis');
$f_foldername=str_replace('/', '_', $foldername);              
mkdir($f_foldername, 0755, true);
}

$count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $f_foldername.'/'.$name)) {
                $count++;
            }
        }
    }
} 
$a = $_POST['pn'];
$b=$f_foldername;
$c = $_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO images (patient,image_path,posted_by) VALUES (:a,:b,:c)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c));

    
?>
<script type="text/javascript">
	window.history.back();
</script>