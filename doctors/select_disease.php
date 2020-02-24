<?php
   include('../config.php');
   ?>
   <?php
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['querystring'])) {
			$queryString = $db->real_escape_string($_POST['querystring']);
			$control = $_POST['control'];
			
			if(strlen($queryString) >0) {

				$query = $db->query("SELECT* FROM icd_second_level_codes WHERE title LIKE '$queryString%' OR code LIKE '$queryString%'  LIMIT 20");
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         		//	echo '<li onClick="fill(\''.addslashes($result->id .'-'.$result->code.'-'.$result->title.','.$control.'\');">'.$result->title.'</li>';
						echo '<li onClick="fill(\''.$result->id .'-'.$result->code.'-'.$result->title.'\',\''.$control.'\')">'.$result->title.'</li>';

	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>