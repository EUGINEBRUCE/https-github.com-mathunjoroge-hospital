<script>
function showDisease(str) {
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
        xmlhttp.open("GET","get_disease.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<span>
<select  name="q" class="selectpicker" data-live-search="true" title="Please select a disease cat..." onchange="showDisease(this.value)" required="true">

          <?php 
           include ('../connect.php');
          $result = $db->prepare("SELECT * FROM icd_first_level_codes ORDER BY title ASC");
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
                     echo "<option value=".$row['id'].">".$row['title']."</option>";
                     echo $row['id'];
                   }
                  
                  ?>      
          </select>
          <span id="texxtHint">