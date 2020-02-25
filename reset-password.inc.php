<?php
session_start();


require 'dbconfig.php';

// Reset password
if(isset($_POST['resetPwdBtn'])){ 

	$selector = $_POST['selector'];
	$validator = $_POST['validator'];

	$password= validInput($_POST['password']);
	$cpassword= validInput($_POST['cpassword']);

	$password = mysqli_real_escape_string($con, $password);
	$cpassword = mysqli_real_escape_string($con, $cpassword);

	 if (empty($password) || empty($cpassword) ) {
	   $_SESSION['message'] = "Please Type your New Password";
	   $_SESSION['msgtype'] = "danger";
	   header("Location: forgot-password");
	 }


	 elseif ($password !== $cpassword) {
  
      $_SESSION['message'] = "The two Password Do not Match!";
      $_SESSION['msgtype'] = "danger";
      header("Location: forgot-password");

	 }

	 else {

	 	$currentDate = date("U");

	 	$sql = "SELECT * FROM pwdrest WHERE pwdResetSelector='{$selector}' AND pwdResetExpires >= '{$currentDate}'";

	 	$result = mysqli_query($con,$sql);

	 	if (!$row = mysqli_fetch_assoc($result)) {

          	$_SESSION['message'] = "Link Expired, Please re-submit your reset request";
            $_SESSION['msgtype'] = "danger";
            header("Location: forgot-password");

          } else {

          	$tokenBin = hex2bin($validator);
          	$tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

          	if ($tokenCheck === false) {

          		$_SESSION['message'] = "You need to re-submit your reset request";
                $_SESSION['msgtype'] = "danger";
                header("Location: forgot-password");

          	} elseif($tokenCheck === true) {

          		$tokenEmail = $row['pwsRestEmail'];

          		$sql = "SELECT * FROM users WHERE email='$tokenEmail'";

          		$result = mysqli_query($con,$sql);

          		if (!$row = mysqli_fetch_assoc($result)) {

		          	$_SESSION['message'] = "There was an error proccessing request";
		            $_SESSION['msgtype'] = "danger";
		            header("Location: forgot-password");

		          } else {

                    $newPassword =password_hash($password, PASSWORD_DEFAULT); 
		          	$sql = "UPDATE users SET password='$newPassword' WHERE email='$tokenEmail'";

		          	$resultRun = mysqli_query($con,$sql);

		          	if (!$resultRun) {

			            $_SESSION['message'] = "There was an Error!";
			            $_SESSION['msgtype'] = "danger";
			            header("Location: forgot-password");
				         
				    } else {

				    	$sql = "DELETE FROM pwdrest WHERE pwsRestEmail='$tokenEmail'";
				    	$sqlRun = mysqli_query($con,$sql);

				    	if ($sqlRun) {

				    		$_SESSION['message'] = "Password Reset Successful";
				            $_SESSION['msgtype'] = "success";
				            header("Location: login");

				    	} else {

				    		$_SESSION['message'] = "There was an Error!";
					        $_SESSION['msgtype'] = "danger";
					        header("Location: forgot-password");
				    	}



				    }



		          }


		         
		     } else {

		     	$_SESSION['message'] = "You need to re-submit your reset request";
                $_SESSION['msgtype'] = "danger";
                header("Location: forgot-password");

		     }




          }

	 	 



	 }



} 



else {
 	header('Location: logout.php');
 }




 function validInput($data) {

  $data = htmlspecialchars($data);
  $data = stripcslashes($data);
  $data = trim($data);

  return $data;

}