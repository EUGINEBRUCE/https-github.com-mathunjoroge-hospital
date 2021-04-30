<?php
session_start(); 
include('../connect.php');
function createRandomPassword() {
    $chars = "zxcvbnmqweryuiopasdfghjklzxcvbnmqwertyuiop";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 10) {

        $num = rand() % 33;

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }
    return $pass;
}
$finalcode=createRandomPassword();

if (isset($_POST["pn"])) {
    # code...           
mkdir($finalcode, 0755, true);
}

$count = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_FILES['files']['name'] as $i => $name) {
        if (strlen($_FILES['files']['name'][$i]) > 1) {
            if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $finalcode.'/'.$name)) {
                $count++;
            }
        }
    }
} 
$a = $_POST['pn'];
$d = $_POST['ftype'];
$b=$finalcode;
$c = $_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO images (patient,image_path,posted_by,type) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));

//remove request because its done   $image_id
$reset=5;
$image_id=$_POST["image_id"];
$sql = "UPDATE  req_images
        SET  served=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$image_id));

    header("location: ../../../details.php?search=$a&response=0&message=1"); 
?>