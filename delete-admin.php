<?php 
require 'dbconfig.php';
require 'controller/settings.php';

$userfullname = $_SESSION['fullname'];

if (isset($_GET['deleteadmin'])) {

  $id = $_GET['deleteadmin'];

  $deleteUser = "DELETE FROM users WHERE id='$id'";

  $executedelete = mysqli_query($con, $deleteUser);

      if ($executedelete) {

        $_SESSION['message']= "Admin Deleted";
        $_SESSION['msgtype']= "success";

         header("Location:". $_SERVER['HTTP_REFERER']);
         exit();

      } else {

        $_SESSION['message']= "Admin Not deleted";
        $_SESSION['msgtype']= "danger";

         header("Location:". $_SERVER['HTTP_REFERER']);
         exit();

      }

} else {

    header("Location: ./");
}