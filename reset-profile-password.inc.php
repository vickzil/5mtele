<?php
session_start();

require 'dbconfig.php';

$email= '';

$password= '';

$loadinBtn = false;

$userid = $_SESSION['accountNumber'];

// login
if(isset($_POST['resetProfilePwd'])){

  $_SESSION['message']= "";
  $_SESSION['msgtype']= "";
  $loadinBtn = true;

  $password= validInput($_POST['password']);
  $npassword= validInput($_POST['npassword']);
  $cpassword= validInput($_POST['cpassword']);

  $password = mysqli_real_escape_string($con, $password);
  $npassword = mysqli_real_escape_string($con, $npassword);
  $cpassword = mysqli_real_escape_string($con, $cpassword);

   if (empty($password)) {
     $_SESSION['message'] = "Please type your old Password!";
     $_SESSION['msgtype'] = "danger";
     header("Location: reset-profile-password");
   }


   elseif (empty($npassword)) {

     $_SESSION['message'] = "Please type your new Password!";
     $_SESSION['msgtype'] = "danger";
     header("Location: reset-profile-password");
   }


  elseif (empty($cpassword)) {

     $_SESSION['message'] = "Please confirm your new Password!";
     $_SESSION['msgtype'] = "danger";
     header("Location: reset-profile-password");
   }

  else if ($npassword !== $cpassword) {

      $_SESSION['message']= "your new password do not match with confirm password";
      $_SESSION['msgtype']= "danger";
      header("Location: reset-profile-password");

    }


    else {


      $sql = "SELECT * FROM users WHERE accountNumber='$userid' LIMIT 1";

      $result = mysqli_query($con,$sql);

      $user = mysqli_fetch_array($result);

      $dbPassword = $user['password'];

      $userLogin = $user['accountNumber'];

      $passwordVerified = password_verify($password, $dbPassword);

     if ($passwordVerified) {

          $npassword = password_hash($npassword, PASSWORD_DEFAULT);

          $update = "UPDATE users SET password='$npassword' WHERE accountNumber='$userLogin';";

          $updateRun=mysqli_query($con,$update);

            if ($updateRun) {

              $postTo = 'Victor Nwakwue';
                $postedby =  'Victor Nwakwue';
                $date = date('Y-m-d H:i:s');
                $dateFormat = date('M d Y H:ia', strtotime($date));
                $commentStatus = 0;
                $commentSubject = 'New user registration ';
                $commentText = 'A new visitor just registered!
                Name: '.$fullname.' 
                Email: '.$email.'
                Date: '.$dateFormat.'
                Please contact this new user as soon as possible. 

                Thank You for your Time, we really appreciate it.

                From: '.$postedby;

                $queryS = "insert into comments(user_id,user_sent_id,comment_subject,comment_text,comment_status,comment_date) values ('$postTo','$postedby','$commentSubject','$commentText',$commentStatus,'$date');";

                $resultS=mysqli_query($con,$queryS);

                if ($resultS) {
                    $_SESSION['message'] = "Password Changed Successfull";
                    $_SESSION['msgtype'] = "success";

                    header("Location: reset-profile-password");

                } else {

                  $_SESSION['message']= "There was an Error";
                  $_SESSION['msgtype'] = "danger";
                  header("Location: register");

                }

            } else {
              
              $_SESSION['message'] = "Error restting Your Password";
              $_SESSION['msgtype'] = "danger";

              header("Location: reset-profile-password");

            }

      
       

     } else {
     
         $_SESSION['message'] = "Old Password is Incorrect!";
         $_SESSION['msgtype'] = "danger";
         header("Location: reset-profile-password");


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