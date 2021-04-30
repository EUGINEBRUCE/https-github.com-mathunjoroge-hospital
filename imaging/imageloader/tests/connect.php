<?php
include('sys_config.php');

/* Database config */
$db_host		= 'localhost';
$db_user		= 'healthte';
$db_pass		= '5#5)xMY1Y2Myyi';
$db_database	= 'healthte_hospital'; 

/* End config */

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>