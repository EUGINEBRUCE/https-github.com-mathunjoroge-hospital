<?php
session_start(); 
include('../connect.php');
$test_id = $_POST['test_id'];
$sex = $_POST['sex'];
$para_names= $_POST['para_names'];
echo implode(",", $para_names);
$normal_ranges= $_POST['normal_ranges'];
foreach (array_combine($para_names, $normal_ranges) as $para_name => $normal_range){
$sql = "INSERT INTO refs_table (test_id,parameter_name,normal_range,sex) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$test_id,':b'=>$para_name,':c'=>$normal_range,':d'=>$sex));
//make fillable when adding results
$a=1;
$sql = "UPDATE lab_tests
        SET  template=?
		WHERE id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$test_id));

    header("location: list.php?response=1"); 
}
?>