<?php
$server = "localhost";
$username = "healthte";
$password = "5#5)xMY1Y2Myyi";
$dbname = "healthte_hospital";

// Create connection
try{
   $db = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
   $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
   die('Unable to connect with the database');
}
 