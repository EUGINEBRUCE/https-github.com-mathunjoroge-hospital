<?php
session_start(); 
include('../connect.php');
$test_id = $_POST['test_id'];
$patient = $_POST['patient'];
$ref_ids= $_POST['ref_id'];
$lab_results= $_POST['result'];
$request_id = $_POST['request_id'];
foreach (array_combine($ref_ids, $lab_results) as $ref_id => $lab_result){
$sql = "INSERT INTO lab_results (patient,refs_id,results,test_id,request_id) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$patient,':b'=>$ref_id,':c'=>$lab_result,':d'=>$test_id,':e'=>$request_id));


    header("location: index.php"); 
}
?>