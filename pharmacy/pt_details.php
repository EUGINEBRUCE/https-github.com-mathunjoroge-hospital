 <?php $result = $db->prepare("SELECT * FROM vitals JOIN patients ON vitals.pno=patients.opno WHERE pno=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $e=$row['systolic'];
        $f=$row['diastolic'];
        $g=$row['rate'];
        $h=$row['height'];
        $j=$row['weight'];
        $k=$row['temperature'];
         $l=$row['breat_rate'];
        $pn=$search; 
        ?>         
<div class="container">
  <?php
        if (!empty($e) &&(!empty($f))) {
           # code...
         ?>
  <?php
  if (($e<90) || ($f<60)){
  
    $alert="the patient is hypotensive, rapid action is needed as this my lead to renal failure or even death!";
    }

  if ((90 <= $e) && ($e <= 119) || (60 <= $f) && ($f <= 80)) {
    $alert="blood pressure is normal";
  
  }
  if ((121 <= $e) && ($e <= 139) || (81 <= $f) && ($f <= 89)) { 
    $alert="the patient is prehypertensive";
  }
  if ((140 <= $e) && ($e <= 159) || (90 <= $f) && ($f <= 99)) { 
    $alert="patient in stage 1 hypertension, action needed";
  }
  if (($e>=160) || ($f>=100)) { 
    $alert="patient in stage 2 hypertension, action needed";
  }
  $haystack =$alert;
$needle="needed";

if( strpos( $haystack, $needle ) !== false ) {
    $myclass="alert alert-danger";
}
if( strpos( $haystack, $needle ) == false ) {
    $myclass="alert alert-success";
}
?><p class="<?php echo $myclass ?>" style="width:40%;font-size: 1em;" > <?php echo $alert; ?></p><?php } ?>
  <caption align="left"><?php echo $a; ?> &nbsp; age:  <?php 
$now = time('Y/m/d');
$dob = strtotime($b);
$datediff = $now - $dob;
$agee=round($datediff / (60 * 60 * 24))/365; 
$age = number_format($agee, 2, '.', '');

if ($age>=1) {
  echo $age."Years";
   # code...
 }
 if ($age<1) {
  echo $age*12; echo "&nbsp;"."Months";
    # code...
  } ?>  &nbsp; sex: <?php echo $c; ?> </caption>
  <p style="font-size: 1em;">bp:<?php echo $e; ?>/<?php echo $f; ?>, pulse: <?php echo $g; ?>, temp: <?php echo $k; ?> &#x2103;, weight: <?php echo $j; ?>, height: <?php echo $h; ?>, respiration: <?php echo $l; ?><?php } ?></p>
      </div>
      </hr>
      <?php
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
       <div class="container">
       <label>discharge prescription</label>
       <p><?php echo $discharge_plan ; ?></p>
       <a a rel="facebox" href="popup.php?search=<?php echo $search; ?>">
       <button id="myBtn" class="btn btn-success">see discaharge details</button></a>
       </div>
       <div class="container">
     <?php } ?>    
<?php 
$result = $db->prepare("SELECT* FROM return_pres  WHERE patient=:o");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $diagnosis=$row['dx'];
        $meds=$row['meds'];
        ?>
      <?php } ?>
      <?php $result = $db->prepare("SELECT cc,dx,ddx,plan,pmh,mh FROM prescriptions  WHERE opno=:o limit 1");
$result->BindParam(':o', $search);
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $cc=$row['cc'];
        $dx=$row['dx'];
        $ddx=$row['ddx'];
        $pmh=$row['pmh'];
        $mh=$row['mh'];
        $plan=$row['plan'];
        ?></hr>
        <div class="container" style="border-style: groove;border-color: pink;">
        <div class="col-sm-6" > <p style="font-size: 1em">chief complain: <?php echo $cc ;?>
          <p style="font-size: 1em">other conditions: <?php echo $pmh;?></p>
          <p style="font-size: 1em">differential diagnosis: <?php echo $ddx ;?></p></div></div>
          <div class="col-sm-6" ><p style="font-size: 1em"> <?php
          if (isset($diagnosis)) {
           echo "previous diagnosis:"."&nbsp;".$dx."</br>"
           ."diagnosis after lab".":&nbsp;".$diagnosis;
         }
         if (!isset($diagnosis)) {
            
           echo "diagnosis:"."&nbsp;".$dx

           ?><?php } ?></p>
           <p style="font-size: 1em"> other drugs: <?php echo $mh ;?></p>
           <p style="font-size: 1em"> plan: <?php
           if (isset($meds)) {
            
           echo "previous plan:"."&nbsp;".$plan."</br>"
           ."medicines after lab".":&nbsp;".$meds;
         }
         if (!isset($meds)) {
            
           echo "plan:"."&nbsp;".$plan; ?>
                         
           </p> 
           <?php } ?>   <?php } ?></div>       
         </hr>