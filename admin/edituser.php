<?php
include "../connect.php";
$id=$_GET['id'];
$result = $db->prepare("SELECT* FROM user WHERE id=:id");
$result->BindParam(':id', $id);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$id=$row['id'];
$name=$row['name'];
$position=$row['position'];
$username=$row['username'];
}

?><div class="container" style="width:50%;"> 
<h5 >edit user</h5>
<form action="saveedituser.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>" >
 
user-name:<input class="form-control" type="text" placeholder="user name" id="example-text-input" name="username" autocomplete="false" value="<?php echo $username; ?>">
</br>
password:<input class="form-control" type="password" placeholder="password" id="example-search-input" name="password" autocomplete="false">
</br>
name:<input class="form-control" type="text" placeholder="other names" id="example-email-input" name="other" value="<?php echo $name; ?>" autocomplete="false">
</br>
user-type:<select placeholder="select" name="usertype"><option disabled>select user type</option>
<option><?php echo $position; ?></option>
<option>admin</option>
<option>cashier</option>
<option>doctor</option>
<option>lab</option>
<option>nurse</option>
<option>pharmacist</option>        
<option>registration</option>
<option>stores</option>
</select>
</br>
<button class="btn btn-success" style="width: 80%;">save</button>

</form>
</div>
