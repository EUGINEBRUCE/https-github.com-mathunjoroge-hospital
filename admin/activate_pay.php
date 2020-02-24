<?php
session_start();
include('../connect.php');
$status=$_REQUEST['status'];
$sql = "UPDATE employees
        SET  status=?";
$q = $db->prepare($sql);
$q->execute(array($status));
header("location: payroll.php");

?>