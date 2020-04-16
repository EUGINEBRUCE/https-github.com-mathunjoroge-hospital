<?php
session_start(); 
include('../connect.php');
$date=date('Y-m-d H:i:s');
    $reset=0;
    $served=1;
    $token=rand();
    $labs = $_POST['lab_id'];
    $comments = array_filter($_POST['comment']);

    if (count($comments)!=count($labs)) {
        header("location:index.php?response=0&search= &failed=1");
        exit();
    }
foreach (array_combine($labs, $comments) as $lab => $comment){
   
    
    $sql ="UPDATE lab
        SET  served=?,
        updated_at=?,
        comments=?,
        token=?
        WHERE id=?";
        $q = $db->prepare($sql);
        $q->execute(array($served,$date,$comment,$token,$lab));
        } 
       header("location:index.php?response=1&search=0&success=1");
         ?>

    