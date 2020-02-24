	<div class="container" style="width: 50em; overflow-y:scroll;stop-color: black;">
	<label>surgical safety checklist</label>
	<h4>Before anesthesia procedure</h4>
	<label>SIGN IN(to be read out loud)</label></br>
	<label>VERIFY:</label>
	<form action="save_sign_in.php" method="POST">
		<input type="hidden" name="id" value="<?=$_GET['id']; ?>">
		<input type="checkbox" name="" required/>all operation members have been mobilized <input type="checkbox" name=""> for CS includes newborn provider</br>
		level of urgency for surgery</br> <input type="checkbox" name="">emergency <input type="checkbox" name="">elective</br>
		<input type="checkbox" name="" required/> patient confirmed his/her identity, procedures and consent</br>
		<input type="checkbox" name="" required/> sterility of equipments and instruments </br>
		<input type="checkbox"  required/> Anesthesia machine and medication check complete </br>
		<input type="checkbox" required/> pulse oximeter on the patient and functioning</br>
		<label>patient has known allergies: yes <input type="checkbox"> No <input type="checkbox"></label></br>
		<input type="checkbox"> Antibiotick prophylaxis given 15-60 minutes before skin incision</br>
		<input type="checkbox"> antacid prophylaxis given <input type="checkbox"> N/A 
		Patient has difficulty airway or aspiration risk </br>
		<input type="checkbox" >No <input type="checkbox" > Yes and adequate assistance and/or equipment available</br>
		<label>Risk of more than 500mL blood loss (7mL/Kg in children)</label>
		<input type="checkbox"> No</br> <input type="checkbox"> Yes, adequate IV access and fluid planned</br>
		<input type="checkbox"> Blood available <input type="checkbox"> N/A</br>
		<input type="checkbox"> Haemoglobin results <input type="checkbox"> platelets results</br>
		<input type="checkbox"> critical lab results <input type="checkbox"> N/A</br>
		<input type="checkbox" > blood group/Rh <input type="checkbox"> N/A </br>
		<input type="checkbox"> for CS newborn rescurcitationequipment an assistance available</br></hr><p>&nbsp;</p>
		<label>before skin incision</label></br>
	<label>time out (to be read out loud)</label></br>
	<label>surgical team verifies:</label></br>
	<input type="checkbox"> All team members to state their name androle (if not done during sign in)</br>
	<input type="checkbox"> correct patient, correct site and correct procedure</br>
	<input type="checkbox"> written consent on the chart</br>
	<label>Nursing veries:</label></br>
	<input type="checkbox"> Avilability of all necessary equipment</br>
	<input type="checkbox"> skin prep with chlorhexine-alcohol or iodine based solution</br>
	<label>For C/S:</label></br>
	<input type="checkbox"> vaginal prep with povidone iodine(if raptured membranes and/or is in labour)</br>
	<label>surgeon verifies:</label></br>
	<input type="checkbox"> anticipated critical steps</br>
	<input type="checkbox"> anticipated procedure level of difficulty and duration</br>
	<input type="checkbox"> anticipated blood loss </br>
	<input type="checkbox"> essential imaging is displayed <input type="checkbox"> N/A </br> 
	<input type="checkbox"> any patient specific concerns </br>
	<label>anaesthetist  veries:</label></br>
	<input type="checkbox"> any patient specific concerns</br>
	<input type="checkbox"> ASA score</br>
	<label>For C/S:</label></br>
	<input type="checkbox"> Any new-born specific concerns</br>
		<p>&nbsp;</p>
		<quote> by submitting, you commit that you have gone through the checklist and verified all the details</quote>
		<p>&nbsp;</p>
		<button class="btn btn-success" style="width: 90%;"> submit</button></br>
		</form>
</div>