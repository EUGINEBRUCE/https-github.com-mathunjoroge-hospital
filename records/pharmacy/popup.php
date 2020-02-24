
<?php   include('../connect.php');
        $search=$_GET['search'];
        $result = $db->prepare("SELECT * FROM discharge_summary WHERE patient=:a");
        $result->BindParam(':a', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $discharge_plan=$row['prescription'];
        $doctor_notes=$row['doctor_notes'];
        $nurse_notes=$row['nursing_notes'];
      }
      if (isset($discharge_plan)) {      
       ?>
        <label>doctors notes</label> 
          <p> <?php echo $doctor_notes; ?></p>
          <label>nurse notes</label>
          <p> <?php echo $nurse_notes; ?></p>          
        
        <?php } ?>