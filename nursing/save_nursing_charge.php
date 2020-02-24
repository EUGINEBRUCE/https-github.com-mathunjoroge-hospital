<?php
      session_start();
      $a= implode(',',$_POST['charge']);
      $b = date('Y-m-d');
      $c = $_POST['patient'];
      $d="";
      $e=$_SESSION['SESS_FIRST_NAME'];
      include('../connect.php');
      $sql = "INSERT INTO `collection` (`fees_id`, `date`, `paid_by`,`paid`,`cashed_by`) VALUES(:a,:b,:c,:d,:e)";
      $q = $db->prepare($sql);
      $q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e)); 
      header("location:nursing.php?response=1")
?>
      