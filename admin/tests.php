<?php include('../connect.php'); ?>
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
</head>
<body>

<form>
  <select id="maxOption2" class="selectpicker show-menu-arrow form-control" name="users" onchange="showUser(this.value)">
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
<div id="txtHint"><b>Person info will be listed here...</b></div>

