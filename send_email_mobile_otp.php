<?php
	require('database.inc.php');
	require('function.inc.php');
	
	$type=get_safe_value($conn,$_POST['type']);
	
	if($type=='mobile'){
		$mobile = get_safe_value($conn,$_REQUEST['mobile']);
		$check_mobile = mysqli_num_rows(mysqli_query($conn,"select * from visitors where mobile='$mobile'"));
		if($check_mobile>0){
			echo "mobile present";
			die();
		}
		$otp = rand(111111,999999);
		$_SESSION['MOBILE_OTP'] = $otp;
		echo $message = "$otp is your OTP";
		
		$mobile='91'.$mobile;
		//prx($mobile);
		$apiKey = urlencode('x/bcFqhwSRM-f9204XwsvpPLCocgiIB0GmhhQpQVC2');
		$numbers = array($mobile);
		$sender = urlencode('TXTLCL');
		$message = rawurlencode($message);
		$numbers = implode(',', $numbers);
		$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
		$ch = curl_init('https://api.textlocal.in/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		echo "done";
	}
?>