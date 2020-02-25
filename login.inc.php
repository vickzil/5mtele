<?php
session_start();

require 'dbconfig.php';

$email= '';

$password= '';

$loadinBtn = false;


// login
if(isset($_POST['loginBtn'])){

  $_SESSION['message']= "";
  $_SESSION['msgtype']= "";
  $loadinBtn = true;

  $email= validInput($_POST['email']);
  $password= validInput($_POST['password']);

  $email = mysqli_real_escape_string($con, $email);
  $password = mysqli_real_escape_string($con, $password);

   if (empty($email)) {
     $_SESSION['message'] = "E-mail is required!";
     $_SESSION['msgtype'] = "danger";
     header("Location: login");
   }

    elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    
        $_SESSION['message'] = "Invalid email address";
        $_SESSION['msgtype'] = "danger";
        header("Location: login");

   }

   elseif (empty($password)) {
     $_SESSION['message'] = "Password is required!";
     $_SESSION['msgtype'] = "danger";
     header("Location: login");
   }


    else {


      $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";

      $result = mysqli_query($con,$sql);

      $num = mysqli_num_rows($result);

        if($num ==1) {

            $user = mysqli_fetch_array($result);

           if (password_verify($password, $user['password'])) {

            if ($user['verified'] == 1) {

              $dateFormat = date('Y-m-d H:i:s');

               $_SESSION['id'] = $user['id'];
              $_SESSION['fullname'] = $user['fullname'];
              $_SESSION['email'] = $user['email'];
              $_SESSION['token'] = $user['token'];
              $_SESSION['balance'] = $user['balance'];
              $_SESSION['status'] = $user['status'];
              $_SESSION['accountduration'] = $user['accountduration'];
              $_SESSION['accountexpire'] = $user['accountexpire'];
              $_SESSION['accountNumber'] = $user['accountNumber'];
              $_SESSION['username'] = $user['username'];
              $_SESSION['verified'] = $user['verified'];
              $_SESSION['profileimage'] = $user['profileimage'];
              $_SESSION['timeout']= time();

              $userLogin = $user['accountNumber'];

              $update = "UPDATE users SET lastlogin='$dateFormat', active=1 WHERE accountNumber='$userLogin';";

              $updateRun=mysqli_query($con,$update);

              if ($updateRun) {

                $_SESSION['message'] = "Welcome ".$_SESSION['fullname'];
                $_SESSION['msgtype'] = "success";

                header("Location: ./");
              }


            } else {

              $token = $user['token'];

              $to = $email;
              $subject = "E-mail Verification From Saturn Tech";
              $message = '<p>Thank you for registering with us at Saturn Tech. But before we continue your registration, you need to verify your email!';
              $message .= '<p>Here is the link to verify your email ';
              $message .= "<a href='http://comment.vickblog.com/verify?token=$token'>Verify Your E-mail</a>";
              $message .= '<p>The Management</p> ';
              $headers = "From: Saturn Tech <info@saturntech.com>\r\n";
              $headers .= "MIME-Version: 1.0". "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
                if (mail($to, $subject, $message, $headers)) {
                     
                     $_SESSION['message'] = "Please verify your account First";
                     $_SESSION['msgtype'] = "danger";
                     header("Location: confirm-email");
                
                }


              

            }
             

           } else {
           
               $_SESSION['message'] = "Incorrect Username/Password!";
               $_SESSION['msgtype'] = "danger";
               header("Location: login");


           }




      } else {

               $_SESSION['message'] = "Not a registered E-mail";
               $_SESSION['msgtype'] = "danger";
               header("Location: register");

      }
 


   }




}


function validInput($data) {

  $data = htmlspecialchars($data);
  $data = stripcslashes($data);
  $data = trim($data);

  return $data;

}




 ?>