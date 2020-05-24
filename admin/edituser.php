<h3><i class="menu-icon fa fa-edit"></i>edit user</h3>
<form action="saveediuser.php" method="POST">
<script>
function showUser(str) {
if (str == "") {
document.getElementById("txtHint").innerHTML = "";
return;
} else { 
if (window.XMLHttpRequest) {
// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
} else {
// code for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
document.getElementById("txtHint").innerHTML = this.responseText;
}
};
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
}
}
</script>
<form>
<select class="selectpicker show-menu-arrow form-control" data-live-search="true" name="users" onchange="showUser(this.value)">
<option value="" disabled="">-- Select user--</option><?php
include("../connect.php"); 
$result = $db->prepare("SELECT * FROM user");
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
echo "<option value=".$row['id'].">".$row['name']."</option>";
}

?>      
</select>
</form>
<br>
<div id="txtHint"><b></b></div>
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
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div></li>