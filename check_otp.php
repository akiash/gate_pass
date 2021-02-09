<?php 
	require('database.inc.php');
	require('function.inc.php');
	
	$type = get_safe_value($conn,$_REQUEST['type']);
	$otp = get_safe_value($conn,$_REQUEST['otp']);
	
	if($type == 'mobile'){
		if($otp == $_SESSION['MOBILE_OTP']){
			echo "done";
		}else{
			echo "no";
		}
	}
?>