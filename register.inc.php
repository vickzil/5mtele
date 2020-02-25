<?php

session_start();

require 'dbconfig.php';

$date =  date("Y-m-d");

$fullname= '';
$email= '';
$username= '';
$phone= '';
$password= '';
$cpassword= '';


$errors= array();


// Sign Up or Register
if(isset($_POST['registerUser'])){

  $fullname= validInput($_POST['fullname']);
  $username= validInput($_POST['username']);
  $email= validInput($_POST['email']);
  $phone= validInput($_POST['phone']);
  $password= validInput($_POST['password']);
  $cpassword= validInput($_POST['cpassword']);

  $fullname= mysqli_real_escape_string($con, $fullname);
  $username= mysqli_real_escape_string($con, $username);
  $email= mysqli_real_escape_string($con, $email);
  $phone= mysqli_real_escape_string($con, $phone);
  $password= mysqli_real_escape_string($con, $password);
  $cpassword= mysqli_real_escape_string($con, $cpassword);


  if (empty($fullname)) {

      $_SESSION['message'] = "Fullname is required";
      $_SESSION['msgtype'] = "danger";
       header("Location: register");

     }


    else if (empty($username)) {
          $_SESSION['message'] = "Username is required";
          $_SESSION['msgtype'] = "danger";
          header("Location: register");

     }


 else if (empty($email)) {
      $_SESSION['message'] = "Email is required";
      $_SESSION['msgtype'] = "danger";
      header("Location: register");

 }

 else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  
      $_SESSION['message'] = "Invalid email address";
      $_SESSION['msgtype'] = "danger";
      header("Location: register");

 }

 else if (empty($phone)) {

      $_SESSION['message'] = "Phone Field is required";
      $_SESSION['msgtype'] = "danger";
      header("Location: register");

    }

 else if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $phone)) {

      $_SESSION['message'] = "Invalid Phone Number";
      $_SESSION['msgtype'] = "danger";
      header("Location: register");
        }

 else if (empty($password)) {

      $_SESSION['message'] = "Password Field is required";
      $_SESSION['msgtype'] = "danger";
      header("Location: register");

    }

    else if (empty($cpassword)) {

      $_SESSION['message'] = "Please confirm password";
      $_SESSION['msgtype'] = "danger";
      header("Location: register");

    }

    else if ($cpassword !== $password) {

      $_SESSION['message']= "Password do not match";
      $_SESSION['msgtype']= "danger";
      header("Location: register");

    } else {

        $md5 = strtoupper(md5($fullname. $username. $email .$password));

        $code[] = substr($md5, 0, 5);
        $code[] = substr($md5, 5, 5);

        $accountNumber = implode("5", $code);

        $dateFormat = date('Y-m-d H:i:s');
        $key = bin2hex(md5($username. $email));
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = md5($key. $dateFormat. $password);
        $verified = false;
        $status = false;
        $balance = 0;
        $accountduration = '00:00:00';
        $accountexpire = '00:00:00';

        // $sql="insert into users(fullname,email,password) values ('$fullname','$email','$password');";

       $sql = "insert into users (password,email,fullname,username,phone,token,datecreated,verified,status,balance,accountduration,accountexpire,accountNumber) values ('$password', '$email', '$fullname','$username','$phone', '$token', '$dateFormat','$verified','$status','$balance','$accountduration' ,'$accountexpire','$accountNumber')";

       $result = mysqli_query($con, $sql);


       if ($result) {
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
                    $_SESSION['message']= "Registration Successfully!!";
                    $_SESSION['msgtype']= "success";

                    header("Location:thank-you");

                } else {

                  $_SESSION['message']= "There was an Error";
                  $_SESSION['msgtype'] = "danger";
                  header("Location: register");

                }
            
            } else {

              $_SESSION['message']= "E-mail Not Sent";
              $_SESSION['msgtype'] = "danger";
              header("Location: register");

            }
        } else {

          $_SESSION['message']= "E-mail/Username Already Taken";
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


