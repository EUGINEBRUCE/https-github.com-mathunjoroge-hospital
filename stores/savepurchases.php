<?php
session_start(); 
include('../connect.php');
$a = $_POST['pnumber'];
$b = $_POST['med'];
$c = $_POST['qty'];
$price=$_POST['cost']/$_POST['qty'];
$d = $_SESSION['SESS_FIRST_NAME'];
$sql = "INSERT INTO purchases (inv,drug_id,qty,recorded_by,price) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$price));
//get the drug posted
$result = $db->prepare("SELECT * FROM drugs WHERE drug_id='$b'");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){     
      $qty = $row['quantity'];
      $oprice = $row['price'];
      $o_value = $qty*$oprice;
      $t_qty=$qty+$c;
      $t_value=$o_value+$_POST['cost'];
      $new_price=$t_value/$t_qty;      
  }
$sql = "UPDATE drugs
        SET  quantity=quantity+?,
             price=?
		WHERE drug_id=?";
$q = $db->prepare($sql);
$q->execute(array($c,$new_price,$b));

    header("location: purchases.php?req=$a"); 
?>

    