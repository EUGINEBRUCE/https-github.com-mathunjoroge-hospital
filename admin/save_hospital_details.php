<?php include('../connect.php');
$a=$_POST['name'];
$b=$_POST['address'];
$c=$_POST['phone'];
$d=$_POST['slogan'];
$e=$_POST['email'];
$f=$_POST['p_from'];
$sql = "INSERT INTO settings (name,address,phone,slogan,email,fda_user) VALUES (:a,:b,:c,:d,:e,:f)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f));


header("location: index.php");


?>