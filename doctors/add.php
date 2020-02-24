<div class="container" style="width: 70%;">
	<h4>add patient to list</h4>
	<form action="savetheatre.php" method="POST">
		<input type="text" size="25" value="" name="ip_no" id="patient" onkeyup="suggestPatientName(this.value);" onblur="fillPatientName();" class="" autocomplete="off" placeholder="Enter patient Name/number to select" style="width: 100%; height:30px;" required/></br><p></p>
		<input type="text" name="operation" placeholder="operation"> 
		<p></p> 
		<label>surgery type</label></br>
		<select name="type" >
			<option value="1">elective</option>
			<option value="2">emergency</option>
		</select></br>
		<label>speciality</label></br>
		<select name="speciality">
			<option value="1">general</option>
			<option value="2">obstetric</option>
			<option value="3">pediatric</option>
			<option value="4">ENT</option>
			<option value="5">gaenecology</option>
			<option value="6">neurosurgery</option>
			<option value="7">cardiothoracic</option>
			<option value="8">orthorpedic</option>
			<option value="9">ophthamology</option>
		</select></br> 
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"><p>&nbsp;</p>
</div></div>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 80%;">submit</button>
	</form>
</div>