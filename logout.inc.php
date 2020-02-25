<?php
session_start();

require 'dbconfig.php';

$userLogin = $_SESSION['accountNumber'];

$dateFormat = date('Y-m-d H:i:s');

$update = "UPDATE users SET lastlogoff='$dateFormat', active=0 WHERE accountNumber='$userLogin';";

$updateRun=mysqli_query($con,$update);

if ($updateRun) {

  header("Location: logout");
  
}
