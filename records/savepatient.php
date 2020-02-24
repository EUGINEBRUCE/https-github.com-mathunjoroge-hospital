<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$b = $_POST['contact'];
$c= $_POST['age'];
$d = $_POST['nok'];
$e= $_POST['sex']; 
$f = $_POST['nokc']; 
$g= $_POST['address'];   
$h = $_POST['number'];
$dept = $_POST['dept'];
$sql = "INSERT INTO patients (name,contact,age,next_of_kin,sex,nokcontact,address,opno) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$g,':h'=>$h)); 
?>

<P><?php
$fees = $_POST['fees'];
$j = $_POST['number'];
$doctor =$_SESSION['SESS_FIRST_NAME'];
$tags=$fees;
$date=date('Y-m-d');
foreach ($tags as $mytag) {
	$inserts="(NULL".","." '$mytag'".","."'$date'".","."'$j'".","." ''".","." ''".")"; 

	   $sql = "INSERT INTO `collection` (`collection_id`, `fees_id`, `date`, `paid_by`,`paid`,`cashed_by`) VALUES $inserts";
	  $q = $db->prepare($sql);
    $q->execute();
      ?></P> 
<?php
if ($dept==2) {
	header("location: admit.php?pt=$h&name=0");
}

if($dept==1) {
	header("location: receipt.php?name=$a&number=$h");
?>
<?php } } ?>