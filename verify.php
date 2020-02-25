<?php
session_start();
if (isset($_GET['token'])) {

    // proceed to verification

	$token = $_GET['token'];
	require 'dbconfig.php';

	$sql = "SELECT verified, token FROM users WHERE verified=0 AND token='$token' LIMIT 1";

	$result=mysqli_query($con,$sql);

	$num = mysqli_num_rows($result);

	  if($num ==1){

	  	$update = "UPDATE users SET verified= 1 WHERE token='$token' LIMIT 1";

	  	$updateRun=mysqli_query($con,$update);

	  	if ($updateRun) {
	  		
	  		$_SESSION['message'] = "Account Verified Successfully";
            $_SESSION['msgtype'] = "success";
            header("Location: login");
            
	  	} else {

	  		$_SESSION['message'] = "There was an Error Verifying your account";
            $_SESSION['msgtype'] = "danger";
            header("Location: forgot-password");

	  	}

	    
	  }

	  else {

	  	$_SESSION['message']= "Invalid Account or This Account has already been verified!";
	    $_SESSION['msgtype']= "warning";

	    header("Location:login");

		
	     }

	
} else {

	$_SESSION['message']= "Please Verify Your E-mail";
    $_SESSION['msgtype'] = "danger";

	header('Location: confirm-email');
}












