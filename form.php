<?php

session_start();

require 'dbconfig.php';

$userid = $_SESSION['accountNumber'];
    
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