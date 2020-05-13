<?php
include 'config.php';

// Number of records fetch
$numberofrecords = 30;

if(isset($_POST['q'])){

	// Fetch records
	$search = "%".$_POST['q']."%";// Search text
	

	// Fetch records
	$result = $db->prepare("SELECT Name FROM cancer_drugs  WHERE Name LIKE :Name  LIMIT :limit");
	$result->bindValue(':Name', $search, PDO::PARAM_STR);
	$result->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
	$result->execute();
	$anticancerList = $result->fetchAll();

}
	
$data = array();

// Read Data
foreach($anticancerList as $anticancer){
	$data[] = array(
		"id" => $anticancer['Name'],
		"text" => $anticancer['Name']
	);
}

echo json_encode($data);
exit();
