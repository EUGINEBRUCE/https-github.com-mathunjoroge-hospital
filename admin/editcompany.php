<h5 align="left">edit insurance company</h5>
<form action="saveeditcompany.php" method="POST">
	<table class="table" >
<thead>
<tr>
<th>name</th>
<th>mark_up</th>
</tr>
</thead>
<tbody>
<tr>
<td ><input style="outline: none;width: 7em;" type="text" name="name" value="<?php echo $_GET['name']; ?>"required/></td>
<td><input type="text" name="mark_up" pattern="{0-9%}" value="<?php echo (($_GET['mark_up']-1)*100)."%"; ?>" ></td>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
</tr>
</tbody>
</table>&nbsp;</br>
<button class="btn btn-success" style="width:78%;">save</button>
	
</form>
