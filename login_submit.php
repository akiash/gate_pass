<?php
	
	require('database.inc.php');
	require('function.inc.php');
	
	$msg = '';
	
	//print_r($_POST);
	if(isset($_REQUEST['email']) && $_REQUEST['password']){
		$email = get_safe_value($conn,$_REQUEST['email']);
		$password = get_safe_value($conn,$_REQUEST['password']);
		
		$check = "select * from admin where email='$email' and password='$password'";
		$res = mysqli_query($conn,$check);
		if(mysqli_num_rows($res)>0){
			$row = mysqli_fetch_assoc($res);
			$_SESSION['ADMIN_LOGIN'] = 'yes';
			$_SESSION['ADMIN_ID'] = $row['id'];
			$_SESSION['ADMIN_EMAIL'] = $email;
			//$_SESSION['USER_NAME'] = ''
			// echo '<pre>';
			// print_r($email);
			echo "done";
		}else{
			echo "not done";
		}
	}
	
?>