<?php 
$pdo = new PDO("mysql:dbname=hospital;host=127.0.0.1", "root", "");
$statement = $pdo->prepare("SELECT fees_id, fees_name FROM fees");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
echo $json;
  
  
?> 