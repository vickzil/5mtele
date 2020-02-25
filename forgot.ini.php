<?php
session_start();


require 'dbconfig.php';
// forgot password
if(isset($_POST['forgotPasswordBtn'])){ 

    $email= validInput($_POST['email']);

	 if (empty($email)) {
	   $_SESSION['message'] = "E-mail is required!";
	   $_SESSION['msgtype'] = "danger";
	   header("Location: forgot-password");
	 }

	 elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  
      $_SESSION['message'] = "Invalid email address";
      $_SESSION['msgtype'] = "danger";
      header("Location: forgot-password");

	 }

	 else {

    $query="SELECT * FROM users WHERE email='$email' LIMIT 1";

    $result=mysqli_query($con,$query);

    $num = mysqli_num_rows($result);

    if($num ==1) {

        $dateFormat = date('Y-m-d H:i:s');
        $key = bin2hex(md5($username. $email));
	 	    $selector = bin2hex(md5($dateFormat. $key. $username. $email));
        $token = md5($username.$dateFormat. $email. $key);

        $url = "http://comment.vickblog.com/reset-password?selector=" . $selector . "&validator=" .bin2hex($token);

        $expires = date("U") + 1800;

        $sql = "DELETE FROM pwdrest WHERE pwsRestEmail=?";

        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

          $_SESSION['message'] = "There was an Error!";
          $_SESSION['msgtype'] = "danger";
          header("Location: forgot-password");
          exit();
         
        } else {

          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
        }

        $sql = "INSERT INTO pwdrest (pwsRestEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";

        $stmt = mysqli_stmt_init($con);
        if (!mysqli_stmt_prepare($stmt, $sql)) {

          $_SESSION['message'] = "There was an Error!";
          $_SESSION['msgtype'] = "danger";
          header("Location: forgot-password");
          exit();
          
         
        } else {

          $hashedToken = password_hash($token, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "ssss", $email,$selector,$hashedToken,$expires);
          mysqli_stmt_execute($stmt);

          $to = $email;
          $subject = 'Reset Your Saturntech Account Password';
          $message = '<p>We recieved a password Reset Request. The link to reset your password make this request is below. You can ignore this message if you did not make this request';
          $message .= '<p>Here is your password request link ';
          $message .= '<a href="'. $url .'">'. $url .' </a></p>';

          $headers = "From: Saturntech <info@saturntech.com>\r\n"; 
          $headers .= "Reply-To: info@saturntech.com\r\n"; 
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8\r\n";

          if (mail($to, $subject, $message, $headers)) {
                       
               $_SESSION['message']= "Email sent Successfully!!";
               $_SESSION['msgtype']= "success";

               header("Location:password-message?reset=success");
              
          } else {

                $_SESSION['message'] = "E-mail Address not sent";
                $_SESSION['msgtype'] = "danger";
                header("Location: forgot-password");

              }


        }


        mysqli_stmt_close($stmt);

    } else {

      $_SESSION['message'] = "This E-mail Is not registered";
      $_SESSION['msgtype'] = "danger";
      header("Location: forgot-password");


    }




	 }


   mysqli_close($con);




}
 else {
 	header('Location: logout');
 }




 function validInput($data) {

  $data = htmlspecialchars($data);
  $data = stripcslashes($data);
  $data = trim($data);

  return $data;

}
