<?php 
session_start();

require 'dbconfig.php';



$update = "UPDATE users SET accountduration='$newDuration' WHERE accountNumber='$userLogin';";

$updateRun=mysqli_query($con,$update);



date('Y-m-d H:i:s', strtotime('+'.$duration.'seconds', strtotime($startTime)));



$userid = $_SESSION['accountNumber'];

$query="SELECT * FROM users WHERE accountNumber='$userid'";

$result = mysqli_query($con,$query); 

$user = mysqli_fetch_array($result);

$userEmail = $user['email'];

$duration = $user['accountduration'];

$userAccountExpire = date("Y-m-d", strtotime(date("Y-m-d", strtotime($duration)). " + 40 day"));


$startTime = date("Y-m-d H:i:s");

$endTime=date('Y-m-d H:i:s', strtotime('+'.$duration.'minutes', strtotime($startTime)));



$from_time1=date('Y-m-d H:i:s');
$to_time=$endTime;

$timefirst=strtotime($from_time1);
$timesecond=strtotime($to_time);

$differencinseconds=$timesecond-$timefirst;

$newDuration = gmdate("H:i:s", $differencinseconds);

echo $newDuration;