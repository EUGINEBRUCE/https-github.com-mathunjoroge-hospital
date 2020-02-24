<?php
session_start(); 
include('connect.php');
$a=0;
$last=date('Y-m-d H:i:s');
$id=$_SESSION['SESS_MEMBER_ID'];
			$sql = "UPDATE user
            SET  logged_in=?,
                 last_seen=?
		    WHERE id=?";
            $q = $db->prepare($sql);
            $q->execute(array($a,$last,$id));
            header("location: index.php") ?>