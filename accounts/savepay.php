<?php
session_start(); 
include('../connect.php');
$result = $db->prepare("SELECT * FROM receipts");
        $result->execute();
        $rowcountt = $result->rowcount();
        $rowcount = $rowcountt+1;
        $receipt=str_pad($rowcount, 6,'0',STR_PAD_LEFT);
       
       if (isset($_POST['mobile'])) {
          $mobile=$_POST['mobile'];
          # code...
        }
        else{
          $mobile="";
        }
        if (isset($_POST['insurance'])) {
          $insurance=$_POST['insurance'];
          # code...
        }
        else{
          $insurance="";
        }

    if ($_POST['payment_mode']==2) {
    $payer=$mobile;
} elseif($_POST['payment_mode']==3){
    $payer=$insurance;
} else {
    $payer=1;
} 

   #--------->
   if ($_POST['payment_mode']==3) {
    $result = $db->prepare("SELECT ins_mark_up AS mark_up FROM insurance_companies WHERE company_id=:a");
        $result->bindParam(':a',$_POST['insurance']);       
        $result->execute();
  for($i=0; $row = $result->fetch(); $i++){     
      $mark_up = $row['mark_up']; }
} else {
    $mark_up=1;
}
#------->

    $med_amount=$_POST['med_amount'];
    $clinic=$_POST['clinic'];
    $fees=$_POST['fees'];
    $lab=$_POST['lab'];
    $amount=$_POST['amount'];
    $id=$_POST['id'];
    $tender=$_POST['tendered'];
    $quantity=$_POST['quantity'];
    $quantity=$_POST['quantity'];
    $ward=$_POST['ward'];
    $token=$_POST['token'];
    $mode=$_POST['payment_mode'];
     $cashier=$_SESSION['SESS_FIRST_NAME'];
    $reset=1;
    $date=date('Y-m-d H:i:s');
    if ($med_amount>0) {
      $paid=0;
      # code...
      $reset=1;
      $sql = "UPDATE dispensed_drugs
        SET  paid=?,
             dispensed=?,
             updated_at=?,
             receipt_no=?,
             mark_up=?,
             cashed_by=?
		WHERE patient=? AND paid=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$reset,$date,$receipt,$cashier,$mark_up,$id,$paid));
$sql = "INSERT INTO cash (amount,cashtendered,tendered_by,patient,mode,confirmation,receipt_no,mark_up) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$med_amount,':b'=>$tender,':c'=> $cashier,':d'=> $id,':e'=> $mode,':f'=> $payer,':g'=> $receipt,':h'=> $mark_up));

	?>
	 <?php
  $g=$_POST['drug_id'];  
 $h=$_POST['quantity'];
foreach (array_combine($h, $g) as $v => $w){
  echo $w;
	 
 ?>
<p><?php
$sql = "UPDATE drugs
        SET  pharm_qty=pharm_qty-?
		WHERE drug_id=?";
		$q = $db->prepare($sql);
$q->execute(array($v,$w));
 ?>
</p> 
<?php 

}} ?>
<?php
if ($clinic>0) {
  $paid=0;
  $reset=1;
  $sql = "UPDATE clinic_fees
        SET  paid=?,
             receipt_no=?,
             mark_up=?
    WHERE patient=? AND paid=? ";
$q = $db->prepare($sql);
$q->execute(array($reset,$receipt,$mark_up,$id,$paid));

$sql = "INSERT INTO clinics_total (amount,cashtendered,tendered_by,paid_by,mode,confirmation,receipt_no,mark_up) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$clinic,':b'=>$tender,':c'=> $cashier,':d'=> $id,':e'=> $mode,':f'=> $payer,':g'=> $receipt,':h'=> $mark_up));

 } 
 if ($fees>0) {
  $paid=0;
  $sql = "UPDATE collection
        SET  paid=?,
             receipt_no=?,
             cashed_by=?,
             mark_up=?
     WHERE paid_by=? AND paid=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$receipt,$cashier,$mark_up,$id,$paid));


$sql = "INSERT INTO fees_total (amount,cashtendered,tendered_by,paid_by,mode,confirmation,receipt_no,mark_up) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$fees,':b'=>$tender,':c'=> $cashier,':d'=> $id,':e'=> $mode,':f'=> $payer,':g'=> $receipt,':h'=> $mark_up));
   # code...
 }
 if ($lab>0) {
  $paid=0;
  $reset=1;
  $sql = "UPDATE lab
        SET  paid=?,
             receipt_no=?,
             mark_up=?
    WHERE opn=? AND paid=?";
$q = $db->prepare($sql);
$q->execute(array($reset,$receipt,$mark_up,$id,$paid));


$sql = "INSERT INTO lab_cash (amount,cashtendered,tendered_by,patient,mode,confirmation,receipt_no,mark_up) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$lab,':b'=>$tender,':c'=> $cashier,':d'=> $id,':e'=> $mode,':f'=> $payer,':g'=> $receipt,':h'=> $mark_up));
   # code...
 }
  if ($ward>0) {
    $date=date("Y-m-d");
    $paid=0;
$sql = "INSERT INTO wards_income (ipno,amount,date,mode,confirmation,receipt_no,mark_up) VALUES (:a,:b,:c,:e,:f,:g,:h)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$id,':b'=>$ward,':c'=> $date,':e'=> $mode,':f'=> $payer,':g'=> $receipt,':h'=> $mark_up));
   
}
$j =1;
$sql = "INSERT INTO  receipts (receipt_no,patient,type,conf,total,mark_up,status) VALUES (:a,:b,:c,:d,:e,:h,:j)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$receipt,':b'=>$id,':c'=> $mode,':d'=> $payer,':e'=> $amount,':h'=> $mark_up,':j'=>$j));
if ($mode==3) {
  $insurance=$payer;
  # code...
}
else{
  $insurance=0;
}

header("location: receipt.php?search=$id&response=0&cash=$tender&ward=$ward&token=$token&receipt=$receipt&insurance=$insurance&mode=$mode"); 
 ?>
