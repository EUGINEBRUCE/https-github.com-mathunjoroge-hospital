<?php
   include('db_connect.php');
   $queryString=$_POST['queryString'];
	if(strlen($queryString) >0) {
				$query = "SELECT active_moiety_name,struct_id FROM drugbank.public.active_ingredient WHERE active_moiety_name LIKE '$queryString' LIMIT 10";
				$query = pg_query($db, $query);
                while ($row = pg_fetch_object($query)) {
				echo '<ul>';
	         			echo '<li onClick="fill(\''.addslashes($row->struct_id.'-'.$row->active_moiety_name).'\');">'.$row->active_moiety_name.'</li>';

	         		}
				echo '</ul>';
				
					
				} 
	
?>