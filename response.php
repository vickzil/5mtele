<?php
session_start();

require 'dbconfig.php';

$userid = $_SESSION['accountNumber'];

$query="SELECT * FROM users WHERE accountNumber='$userid'";

$result = mysqli_query($con,$query); 

$user = mysqli_fetch_array($result);

$userEmail = $user['email'];

$duration = $user['accountduration'];

$userAccountExpire = date("Y-m-d", strtotime(date("Y-m-d", strtotime($duration)). " + 40 day"));

$_SESSION['duration'] = $duration;
$_SESSION['start_time'] = date("Y-m-d H:i:s");

$endTime=date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'seconds', strtotime($_SESSION["start_time"])));

$_SESSION['end_time']= $endTime;








$userLogin = $_SESSION['accountNumber'];

$from_time1=date('Y-m-d H:i:s');
$to_time=$_SESSION['end_time'];

$timefirst=strtotime($from_time1);
$timesecond=strtotime($to_time);

$differencinseconds=$timesecond-$timefirst;

$newDuration = gmdate("H:i:s", $differencinseconds);

echo $newDuration;


