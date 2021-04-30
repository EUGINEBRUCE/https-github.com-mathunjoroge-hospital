<?php
	//Start session
	session_start();
	include('connect.php');
	
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return ($str);
	}
	
	//Sanitize the POST values
	$login = strip_tags($_POST['username']);
	$passworda =md5($_POST['password']);
	$password =md5($passworda);
	//Input Validations
	if($login == '') {
		echo "Username missing";
		
	}
	if($password == '') {
		echo "password missing";
	}
	
	//If there are input validations, redirect back to the login form
	if($password == ''|| $login == '') {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}
	
	//Create query
	$result = $db->prepare("SELECT * FROM user WHERE username='$login' AND password='$password'");
				$result->execute();
				$rowcount = $result->rowcount();
	
	//Check whether the query was successful or not
		if($rowcount>0) {
	$result = $db->prepare("SELECT * FROM user WHERE username='$login' AND password='$password'");
	$result->execute();
	for($i=0; $member = $result->fetch(); $i++){
			//Login Successful
			session_regenerate_id();			
			$_SESSION['SESS_MEMBER_ID'] = $member['id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['name'];
			$_SESSION['SESS_LAST_NAME'] = $member['position'];
			$_SESSION['view_as']=$member['position'];
			//$_SESSION['SESS_PRO_PIC'] = $member['profImage'];
			session_write_close();
			$a=1;
			$id=$_SESSION['SESS_MEMBER_ID'];
			$sql = "UPDATE user
            SET  logged_in=?
		    WHERE id=?";
            $q = $db->prepare($sql);
            $q->execute(array($a,$id));
			header("location: main/index.php");
			exit();
		}
		if($rowcount=0){
			//Login failed
			header("location: index.php");
			exit();
		}
	}else {
		echo "<font>please use the correct login credentials</font></br>";
		session_write_close();
		header("location:index.php?response=login_failed");
		
	}
?>