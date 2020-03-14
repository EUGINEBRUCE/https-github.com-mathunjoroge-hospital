<?php
   include('../config.php');
   ?>
   <?php
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {
				if ($useFdaDrugsList == 1) {
					$query = $db->query("SELECT* FROM meds WHERE ActiveIngredient LIKE '$queryString%' OR DrugName LIKE '$queryString%'  LIMIT 20");
				} else {
					$query = $db->query("SELECT drug_id as id, generic_name as ActiveIngredient, brand_name AS DrugName, '' AS Form, '' AS Strength  FROM drugs WHERE generic_name LIKE '$queryString%' OR brand_name LIKE '$queryString%'  LIMIT 20");					
				}
				if($query) {
				echo '<ul>';
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->id .'-'.$result->ActiveIngredient.'-'.$result->DrugName.'-'.$result->Form.'-'.$result->Strength).'\');">'.$result->DrugName.'-'.$result->ActiveIngredient.'</li>';

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