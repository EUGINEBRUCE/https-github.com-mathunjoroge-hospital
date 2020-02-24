<div><div class="container" style="width:15em;" align="center">
	<label>write surgeons notes</label>
	<form action="savesurg_notes.php" method="POST">
		<input type="hidden" name="search" value="<?=$_GET['search']; ?>">
		<textarea name="notes" style="width: 200%;margin-left: -6.5em;height: 30em;"></textarea>
		<input type="hidden" name="id" value="<?=$_GET['id']; ?>">
		<button class="btn btn-success" style="width: 80%;">submit</button>
	</form>	
</div>
</div>