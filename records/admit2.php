 <?php
 include('../connect.php');
    //update patient to have a bed 
    $bed=$_POST['bedno'];
    $number=$_POST['pt'];
    $sql = "UPDATE admissions
        SET  bed=?
        WHERE ipno=?";
$q = $db->prepare($sql);
$q->execute(array($bed,$number));
//update that bed is taken 
     $occ=1;
     $number=$_POST['pt'];
     $ward=$_POST['ward'];
     $bed=$_POST['bedno'];
$sql = "UPDATE beds
        SET  ocuppied=?,
             patient=?
       WHERE ward=? 
       AND bed_no=?";
$q = $db->prepare($sql);
$q->execute(array($occ,$number,$ward,$bed));
header("location: receiptt.php?id=$number&ward=$ward&bed=$bed");  
    ?>