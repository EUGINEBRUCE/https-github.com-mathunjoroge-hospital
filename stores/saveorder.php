<?php
session_start(); 
include('../connect.php');
//order id is receipt number
    $order_id=$_POST['order_id'];
    $drug_ids=$_POST['drug_id'];
    //dispense id is the specific id for the entry
    $dispense_id=$_POST['dispense_id'];
    $quanties=$_POST['qty'];
foreach (array_combine($drug_ids, $quanties) as $drug_id => $quantity){   

$sql = "UPDATE drugs
        SET  quantity=quantity-$quantity,
         pharm_qty=pharm_qty+$quantity
        WHERE drug_id=$drug_id";
        $q = $db->prepare($sql);
        $q->execute();

    //values to post order id, dispense id, and quantities
    $quantiess=implode(',', $quanties);
    $ids=implode(',', $dispense_id);
    header("location: resaveorder.php?qty=$quantiess&order_id=$order_id&dispense_id=$ids");
    
     } 
   
     
     ?>