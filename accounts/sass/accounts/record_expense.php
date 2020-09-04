  <div>
  	<center><label>record expense</label></center>
  	<form action="save_expense.php" method="POST">  	
  	<select  title="Please select expense" name="expense" required>
    <option value="" disabled="">-- Select expense--</option><?php
    include('../connect.php'); 
        $result = $db->prepare("SELECT * FROM expenses");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
           echo "<option value=".$row['expense_id'].">".$row['expense_name']."</option>";

         }
        
        ?>      
</select> <input type="number" name="amount" placeholder="enter amount"></br>
<p>&nbsp;</p>
<button class="btn btn-success" style="width: 90%;">submit</button>
  	</form>

  </div>