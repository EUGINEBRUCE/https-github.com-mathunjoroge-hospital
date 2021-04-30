<div class="col"> 
<h5 >edit user</h5>
<form action="saveuser.php" method="POST">
<div class="form-group row">  
<div class="col-10">
<input class="form-control" type="text" placeholder="user name" id="example-text-input" name="username" autocomplete="false">
</div>
</div>
<div class="form-group row">
<div class="col-10">
<input class="form-control" type="password" placeholder="password" id="example-search-input" name="password" autocomplete="false">
</div>
</div>
<div class="form-group row">
<div class="col-10">
<input class="form-control" type="text" placeholder="other names" id="example-email-input" name="other" autocomplete="false">
</div>
</div>
<div class="form-group row">
<div class="col-10">
<select placeholder="select" name="usertype"><option disabled>select user type</option>
<option>admin</option>
<option>cashier</option>
<option>doctor</option>
<option>lab</option>
<option>nurse</option>
<option>pharmacist</option>        
<option>registration</option>
<option>stores</option>

</select>
</div>
</div>
<div class="form-group row">

<div class="col-10">

</div>
</div>
<div class="col-10">
<button class="btn btn-success" style="width: 80%;">save</button>
</div>
</form>
</div>
</div>