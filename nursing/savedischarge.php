<?php
session_start(); 
include('../connect.php');

?>

 <?php
$a = $_POST['pn'];
$b = $_POST['notes']; 
$d =$_SESSION['SESS_FIRST_NAME'];
// check whether patient discharge has been initited by doctor
$result = $db->prepare("SELECT * FROM discharge_summary WHERE patient=:a");
$result->BindParam(':a', $a);
        $result->execute();
        $rowcount = $result->rowcount();
        //if there is a result insert nursing notes
        if ($rowcount>=1) {

        $sql = "UPDATE discharge_summary
               SET  nursing_notes=?,
                    nurse=?
		       WHERE patient=?";
$q = $db->prepare($sql);
$q->execute(array($b,$d,$a));

header("location: discharge.php?search=0&response=1");
        	# code...
        }
        if ($rowcount<1) {
        	// redirect with a response
        	header("location: discharge.php?search=0&response=6");
        }
?>