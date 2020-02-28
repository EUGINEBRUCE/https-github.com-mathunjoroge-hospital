<div align="center">
	<center>enter employee other allowances</center>
	<form action="save_other_allowance.php" method="POST">
		<input type="hidden" name="employee_id" value="<?php echo $_GET['employee_id']; ?>">
		<input type="text" name="allowance" placeholder="enter allowance name" class="form-control">
		&nbsp;
		<input type="number" name="amount" placeholder="enter amount" class="form-control" autocomplete="off">
		&nbsp;
		<button class="btn-success form-control">post</button>
		
	</form>
	
</div>