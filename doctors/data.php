 <caption align="left"><?php echo $a; ?> &nbsp; age: <?php echo $b; ?> &nbsp; sex: <?php echo $c; ?> </caption></br>
<?php $result = $db->prepare("SELECT cc,dx,ddx,plan,pmh,mh FROM prescriptions  WHERE opno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $cc=$row['cc'];
        $dx=$row['dx'];
        $ddx=$row['ddx'];
        $pmh=$row['pmh'];
        $mh=$row['mh'];
        $plan=$row['plan'];
        ?>
<!-- Trigger/Open The Modal -->

    <span class="close" style="font-weight: 3em;color: red;">&times;</span>
    <div class="container" >
        <div class="col-sm-6" > <p style="font-size: 1em">chief complain: <?php echo $cc ;?>
          <p style="font-size: 1em">other conditions: <?php echo $pmh;?>
        </p>
          <p style="font-size: 1em">differential diagnosis: <?php echo $ddx ;?></p></div>
          <div class="col-sm-6" ><p style="font-size: 1em"> diagnosis: <?php echo $dx ;?></p>
           <p style="font-size: 1em"> other drugs: <?php echo $mh ;?></p>
          <p style="font-size: 1em"> plan: <?php echo $plan ;?></p>
        </div> <?php } ?>
        <?php 
$patient=$search;
$result = $db->prepare("SELECT*  FROM patient_notes  WHERE  patient='$patient'");
        $result->execute();
        $served = $result->rowcount();  
  
    if($served>0) {
?>

      
        <div>
          <table border="1" cellpadding="1" cellspacing="1" class="table table-dark" id="notes" style="width:100%">
  <caption>clinical notes</caption>
  <thead>
    <tr>
      <th scope="col" style="width:30%">date</th>
      <th scope="col">details</th>
    </tr>
  </thead>
  <?php $result = $db->prepare("SELECT* FROM patient_notes  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $date=$row['created_at'];
        $notes=$row['notes'];
        ?>
  <tbody>
    <tr>

      <td><?php echo $date; ?></td>
      <td><?php echo $notes;  ?></td>
    </tr>
  </tbody>
</table>
        </div></div></div>    
    </div>
 <?php } ?>
