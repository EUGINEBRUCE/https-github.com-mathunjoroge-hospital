<?php
include '../connect.php';

// Number of records fetch
$numberofrecords = 20;

if(isset($_POST['q'])){

	// Fetch records
	$search = $_POST['q'];// Search text
	
	// Fetch records
	$result = $db->prepare("SELECT opno,name FROM patients WHERE opno LIKE :opno OR  name LIKE :name  LIMIT :limit");
	$result->bindValue(':name', $search.'%', PDO::PARAM_STR);
	$result->bindValue(':opno', $search.'%', PDO::PARAM_STR);
	$result->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
	$result->execute();
	$patientList = $result->fetchAll();

}
	
$data = array();

// Read Data
foreach($patientList as $patient){
	$data[] = array(
		"id" => $patient['opno'],
		"text" => $patient['name']."-".$patient['opno']
	);
}

echo json_encode($data);
exit();
