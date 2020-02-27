	<div class="container">
		<?php
	include('../connect.php');
	$test_id=$_GET["test_id"];
	//lab id is unique id on lab table and will be used to update the template
	$lab_id=$_GET["lab_id"];
	$result = $db->prepare("SELECT template FROM lab_tests WHERE id='$test_id'");
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
     
      $data= $row['template'];

	 ?>	
	 <form action="submit.php" method="POST" id="my_form">
	<textarea id="articleContent" name="mydata">		
		<?php echo $data; ?></textarea>
		<script type="text/javascript">CKEDITOR.replace( 'articleContent', {
    toolbar: [
    
    { name: 'insert', items: ['Table'] },
    
]
});
      </script>
		<input type="hidden" name="lab_id" value="<?php echo $lab_id; ?>">	
		<input type="submit" value="submit" class="btn-success" style="width: 90%;" name="submit" />
	</form>
	<?php } ?>
</div>

