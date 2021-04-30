<?php
session_start();
include('../connect.php');
$a = $_POST['username'];
$x = md5($_POST['password']);
$b=md5($x);
$c= $_POST['other'];
$d = $_POST['usertype'];
// check whether user exists
$result = $db->prepare("SELECT * FROM user WHERE username=:name");
				$result->bindParam(':name', $a);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
				    if(isset ($row['username'])){
				        header("location:total.php?response=4");
				        exit();
				        
				    }
				}

$sql = "INSERT INTO user (username,password,name,position) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));
header("location:total.php?response=1"); 
?>

