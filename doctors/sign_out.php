	<div class="container" style="width: 50em; overflow-y:scroll;stop-color: black;">
		<form action="save_sign_out.php" method="POST">
		<input type="hidden" name="id" value="<?=$_GET['id']; ?>">	
	<label>before any team member leaves room</label></br>
	<label> SURGICAL TEAM MEMBERS VERIFY:</label>
	</br>
		<input type="checkbox" name="" >name of the procedure(s)</br>
		<input type="checkbox" name=""> instrument, sponge and needle counts are correct
		<input type="checkbox" name="" > all specimen are labeled and forms completed as per rotocol <input type="checkbox" name="" > N/A</br>
		<input type="checkbox" name="" > sterility of equipments and instruments </br>
		<input type="checkbox" /> equipment/instrument problems to be addressed </br>
		<input type="checkbox" > where patient will be immediately recovered followed by ward for post-op care</br>
		<label>SURGEON ANESTHESIA AND NURSE REVIEW</label>
		<input type="checkbox"> any key concerns for recoveryand management of patient</br>
		<input type="checkbox"> for C/S reviewing team includes new-born provider</br>
		<p>&nbsp;</p>
		<quote> by submitting, you commit that you have gone through the checklist and verified all the details</quote>
		<p>&nbsp;</p>
		<button class="btn btn-success" style="width: 90%;"> submit</button></br>
		</form>
</div>