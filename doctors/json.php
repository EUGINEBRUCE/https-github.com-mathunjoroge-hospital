<?php
$pdo = new PDO("mysql:dbname=hospital;host=127.0.0.1", "root", "");
$statement = $pdo->prepare("SELECT * FROM icd_second_level_codes");
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
$statement->execute();
echo $json;
?>
