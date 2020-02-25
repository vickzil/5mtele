<?php

session_start();

require 'dbconfig.php';

if (isset($_SESSION['username']) && isset($_SESSION['accountNumber']) && isset($_SESSION['id'])) {
$userid = $_SESSION['accountNumber'];
// upload Profile Picture
if(isset($_POST['uploadProfileImage'])){

    
	$profileImgName = time() . '_' . $_FILES['Profilefile']['name'];

	$target = 'uploads/' .$profileImgName;

	if (move_uploaded_file($_FILES['Profilefile']['tmp_name'], $target)) {

		$update = "UPDATE users SET profileimage='$profileImgName' WHERE accountNumber='$userid' LIMIT 1";

        $resultRun = mysqli_query($con, $update);

        if ($resultRun) {
        	$_SESSION['message']= "Profile Image uploaded";
            $_SESSION['msgtype'] = "success";
            header("Location: profile");
        } else {

        	$_SESSION['message']= "Image Not Inserted to database";
            $_SESSION['msgtype'] = "danger";
            header("Location: profile");


        }


	} else {


		$_SESSION['message']= "Image Notuploaded";
        $_SESSION['msgtype'] = "danger";
        header("Location: profile");




	}


}



 // Update Doctors Details

if(isset($_POST['update_profile']))

{

  $userFullname = validInput($_POST['user_fullname']);
  $userUsername = validInput($_POST['user_username']);
  $userEmail = validInput($_POST['user_email']);
  $userPhone = validInput($_POST['user_phone']);
  $userBio = mysqli_real_escape_string($con,$_POST['user_bio']);

  if (empty($userFullname)) {

      $_SESSION['message']= "Your fullname cannot be empty";
      $_SESSION['msgtype']= "danger";

      header("Location: edit-user-profile");

  }
  elseif (empty($userUsername)) {

      $_SESSION['message']= "Your Username cannot be empty";
      $_SESSION['msgtype']= "danger";

      header("Location: edit-user-profile");

  }

  elseif (empty($userEmail)) {

      $_SESSION['message']= "Your E-mail cannot be empty";
      $_SESSION['msgtype']= "danger";

      header("Location: edit-user-profile");

  }

  elseif (filter_var($userEmail, FILTER_VALIDATE_EMAIL) === false) {
    
        $_SESSION['message'] = "Invalid email address";
        $_SESSION['msgtype'] = "danger";
        header("Location: edit-user-profile");

   }

   elseif (empty($userPhone)) {

      $_SESSION['message']= "Your Phone Number cannot be empty";
      $_SESSION['msgtype']= "danger";

      header("Location: edit-user-profile");

  }

  else if (!preg_match("/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i", $userPhone)) {

      $_SESSION['message'] = "Invalid Phone Number";
      $_SESSION['msgtype'] = "danger";
      header("Location: edit-user-profile");
        }

  else {

    $query="UPDATE users SET fullname='$userFullname', username='$userUsername',email='$userEmail',phone='$userPhone',bio='$userBio' WHERE accountNumber='$userid'";

  $result = mysqli_query($con,$query);

  if($result) {

       $_SESSION['message']= "Profile Updated successfully!";
       $_SESSION['msgtype']= "success"; 
       header("Location: profile");
     
      } else {

       $_SESSION['message']= "Profile Not Updated";
       $_SESSION['msgtype']= "danger"; 
       header("Location: edit-user-profile");

      }


    }
  

     
  }









}


 function validInput($data) {

  $data = htmlspecialchars($data);
  $data = stripcslashes($data);
  $data = trim($data);

  return $data;

}