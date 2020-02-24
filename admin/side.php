<aside id="left-panel" class="left-panel" style="width: 20%;">
        <nav class="navbar navbar-expand-sm navbar-default">
<div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                
                <a class="navbar-brand" href="index.php?response=0">admin</button></a>
            </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                	<li class="active"><a href="index.php?response=0"> <i class="menu-icon fa fa-dashboard" style="color:black;"></i> Dashboard </a></li>      
                    <li class="active"><button style="width: 80%;">
                        <a href="fees.php?response=0&page=charges"><i class="menu-icon fa fa-money"></i>charges</a></button></li></br>                    
                    <li class="active"><button style="width: 80%;">
                        <a href="insurance.php?response=0&page=nisurance"> <i class="menu-icon fa fa-money"></i>insurance</a>
                    </button></li></br>
                    <li class="active"><button style="width: 80%;">
                    <a href="payroll.php?response=0&page=payrol"> <i class="menu-icon fa fa-money"></i>payroll</a></button></li></br>              
                    <li class="">
                        <button data-toggle="modal" data-target="#exampleModal" style="width: 80%;"> <i class="menu-icon fa fa-plus"></i>add user</button></li>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div></li>
                    <li class="">
                          <button data-toggle="modal" data-target="#exampleModal2" style="width: 80%;"> <i class="menu-icon fa fa-edit"></i>edit user</button>
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">edit user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveediuser.php" method="POST">
    <div class="form-group row">
  
  <div class="col-10">
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
  <select id="maxOption2" class="selectpicker show-menu-arrow form-control" data-live-search="true" name="users" onchange="showUser(this.value)">
<option value="" disabled="">-- Select user--</option><?php 
$result = $db->prepare("SELECT * FROM user");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
         }
        
        ?>      
</select>
</form>
<br>
<form action="saveedituser.php" method="POST">
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
                    <li class="">
                          <button data-toggle="modal" data-target="#exampleModal3" style="width: 80%;"> <i class="menu-icon fa fa-trash"></i>delete user</button>
  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title" id="edit">delete user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="form-group row">
  
  <div class="col-10">
    <form action="deleteuser.php" method="POST">
  <select id="maxOption2" class="selectpicker show-menu-arrow form-control" data-live-search="true" name="user">
<option value="" disabled="">-- Select user--</option><?php 
$result = $db->prepare("SELECT * FROM user");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
         }
        
        ?>      
</select>

  </div>
</div>
<div class="form-group row">
  
  <div class="col-10">
    
  </div>
</div>
<div class="col-10">
<button class="btn btn-danger" style="width: 80%;" onclick="return confirm('Are you sure you want to delete this user');">delete</button>
</div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div></li>
                    <li class="">
                        <button data-toggle="modal" data-target="#exampleModal4" style="width: 80%;"> <i class="menu-icon fa fa-plus"></i>add ward</button>
  <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">add ward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveward.php" method="POST">
    <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="enter ward name" id="example-text-input" name="ward" style="width: 80%;" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter number of beds" id="example-text-input" name="beds" style="width: 80%;" autocomplete="false">
  </div>
  </div>
  <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter daily charges" id="example-text-input" name="charges" style="width: 80%;" autocomplete="false">
  </div>
  </div>
<div class="form-group row">
  <div class="col-10">
    <select placeholder="select" name="sex" style="width: 80%;"><option disabled>select sex</option>
        <option>male</option>
        <option>female</option>
        <option>pediatric</option>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>     
 </li>
   <li class="">
                          <button data-toggle="modal" data-target="#exampleModal5" style="width: 80%;"> <i class="menu-icon fa fa-edit"></i>edit ward</button>
  <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">edit ward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveeditward.php" method="POST">
    <div class="form-group row">
  
  <div class="col-10">
<script>
function showWard(str) {
    if (str == "") {
        document.getElementById("texxtHint").innerHTML = "";
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
                document.getElementById("texxtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getward.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<form>
  <select  class="selectpicker show-menu-arrow form-control" data-live-search="true" name="wards" onchange="showWard(this.value)">
<option value="" disabled="">-- Select user--</option><?php 
$result = $db->prepare("SELECT * FROM wards");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['id'].">".$row['name']."</option>";
         }
        
        ?>      
</select>
</form>
<br>
<form action="saveeditward.php" method="POST">
<div id="texxtHint"><b></b></div>


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
<li> <button data-toggle="modal" data-target="#exampleModal6" style="width: 80%;"> <i class="menu-icon fa fa-trash"></i>delete ward</button>
  <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">delete user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveediuser.php" method="POST">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
     </div>
    </div>
  
</li>
 <li class="">
            <button data-toggle="modal" data-target="#exampleModal7" style="width: 80%;"> <i class="menu-icon fa fa-plus"></i>add fee</button>
  <div class="modal fade" id="exampleModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">add fee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="savefee.php" method="POST">
    <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="enter fee name" id="example-text-input" name="fee" style="width: 80%;" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter fee amount" id="example-text-input" name="amount" style="width: 80%;" autocomplete="false">
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
</div> </li>
<li class="">
            <button data-toggle="modal" data-target="#exampleModal8" style="width: 80%;"> <i class="menu-icon fa fa-plus"></i>add clinic</button>
  <div class="modal fade" id="exampleModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">add clinic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveclinic.php" method="POST">
    <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="enter clinic name" id="example-text-input" name="clinic" style="width: 80%;" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter clinic fee amount" id="example-text-input" name="amount" style="width: 80%;" autocomplete="false">
  </div>
  </div>
  <div class="form-group row">
  <div class="col-10">
    <label>pay before or after service</label></div></br>
    <select name="payable" style="width: 60%;"><option disabled>select</option><option value="1">Before</option><option value="0">After</option></select>
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
 </li> 
<li>
            <button data-toggle="modal" data-target="#exampleModal9" style="width: 80%;"> <i class="menu-icon fa fa-plus">add imaging</button></i>
  <div class="modal fade" id="exampleModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">add imaging</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="saveimage.php" method="POST">
    <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="enter imaging name" id="example-text-input" name="image" style="width: 80%;" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter fee amount" id="example-text-input" name="amount" style="width: 80%;" autocomplete="false">
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
</div> </li>
<li class="">
            <button data-toggle="modal" data-target="#exampleModal10" style="width: 80%;"> <i class="menu-icon fa fa-plus"></i>add lab test</button>
  <div class="modal fade" id="exampleModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit">add test</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="savetest.php" method="POST">
    <div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="text" placeholder="enter test name" id="example-text-input" name="test" style="width: 80%;" autocomplete="false">
  </div>
</div>
<div class="form-group row">
  <div class="col-10">
    <input class="form-control" type="number" placeholder="enter test fee amount" id="example-text-input" name="amount" style="width: 80%;" autocomplete="false">
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
</div> </li>
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>