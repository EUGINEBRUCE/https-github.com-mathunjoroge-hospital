<<<<<<< HEAD
<?php
$position=$_SESSION['SESS_LAST_NAME'];
$_SESSION['view_as']=$position;
require_once('auth.php');

if($position=='cashier') { 
	header("location:../accounts/index.php?search= &response=0");
	}

else if($position=='doctor') { 
	header("location:../doctors/index.php?search= &response=0");
	}

else if($position=='pharmacist') { 
	$token=rand();
	header("location:../pharmacy/index.php?search= &response=0&token=$token");
	}

else if($position=='nurse') { 
	header("location:../nursing/index.php?search= &response=0");
	}

else if($position=='lab') { 
	header("location:../lab/index.php?search= &response=0");
	}

else if($position=='registration') { 
	header("location:../records/index.php?attempt=0");
	}

else if($position=='stores') { 
	header("location:../stores/index.php");
	}
	else if($position=='imaging') { 
	header("location:../imaging/index.php");
	}


else { 
	header("location:../admin/index.php?response=0");
	}
	
	?>
=======
<?php
$position=$_SESSION['SESS_LAST_NAME'];
require_once('auth.php');

if($position=='cashier') { 
	header("location:../accounts/index.php?search= &response=0");
	}

else if($position=='doctor') { 
	header("location:../doctors/index.php?search= &response=0");
	}

else if($position=='pharmacist') { 
	$token=rand();
	header("location:../pharmacy/index.php?search= &response=0&token=$token");
	}

else if($position=='nurse') { 
	header("location:../nursing/index.php?search= &response=0");
	}

else if($position=='lab') { 
	header("location:../lab/index.php?search= &response=0");
	}

else if($position=='registration') { 
	header("location:../records/index.php?attempt=0");
	}

else if($position=='stores') { 
	header("location:../stores/index.php");
	}

else { 
	header("location:../admin/index.php?response=0");
	}
	
	?>
>>>>>>> d6494f18a9c43fc885690af91712f2f1873da227
