, age: <?php 
$now = date('Y-m-d');
$dob = date("Y-m-d", strtotime($b));  
$date1=date_create($dob);
$date2=date_create($now);
$diff=date_diff($date1,$date2);
$days=(float)$diff->format("%R%a");
if ($days<30) {
echo $days." days";
}
else if((30 <= $days) && ($days <=365)) {
    
echo number_format((float)($days/30), 2, '.', '')." months"; 
}
else{
    echo number_format((float)($days/365), 2, '.', '')." years";
}
?> &nbsp; sex: <?php echo $c; ?>

</li>
