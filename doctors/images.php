<?php 
$pdo = new PDO("mysql:dbname=hospital;host=127.0.0.1", "root", "");
$statement = $pdo->prepare("SELECT imaging_id, imaging_name FROM imaging");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
echo $json;
  
  
?> 