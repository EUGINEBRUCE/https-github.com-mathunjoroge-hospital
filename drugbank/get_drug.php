<?php
   include('db_connect.php');
   if(isset($_POST['q'])){
	// Fetch records
	$search = $_POST['q'];
  
				$query = "SELECT active_moiety_name,struct_id FROM drugbank.public.active_ingredient WHERE active_moiety_name ILIKE '%$search%' LIMIT 10";
				$query = pg_query($db, $query);
                $drugs = pg_fetch_all($query); 
                $data = array();

// Read Data
             foreach($drugs as $drug){
	         $data[] = array(
		     "id" => $drug['struct_id'],
		     "text" => $drug['active_moiety_name']
	);
}
}
echo json_encode($data);
