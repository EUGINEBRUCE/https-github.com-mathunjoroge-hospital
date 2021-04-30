<?php
include '../connect.php';

// Number of records fetch
$numberofrecords = 20;

if(isset($_POST['q'])){

	// Fetch records
	$search = $_POST['q'];// Search text
	
	// Fetch records
	$result = $db->prepare("SELECT code,title FROM icd_second_level_codes WHERE title LIKE :title  LIMIT :limit");
	$result->bindValue(':title', $search.'%', PDO::PARAM_STR);
	$result->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
	$result->execute();
	$diseasesList = $result->fetchAll();

}
	
$data = array();

// Read Data
foreach($diseasesList as $disease){
	$data[] = array(
		"id" => $disease['code'],
		"text" => $disease['title']
	);
}

echo json_encode($data);
exit();
