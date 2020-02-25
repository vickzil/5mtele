<?php  
session_start();

require 'dbconfig.php';

$userid = $_SESSION['accountNumber'];

if (isset($_GET['ref'])) {

$result = array();

$generated_ref = $_GET["ref"];

$url = 'https://api.paystack.co/transaction/verify/'.$generated_ref;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer pk_test_18f4e3dec75530f3ce059ff055ae8556bfead856']
);

$request = curl_exec($ch);
if(curl_error($ch)){
 echo 'error:' . curl_error($ch);
 }
curl_close($ch);

if ($request) {
  $result = json_decode($request, true);
}


if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {

	
	$trans_id = $result['data']['id'];
	$trans_amount = $result['data']['amount']/100;
	$trans_date = $result['data']['transaction_date'];
	$trans_reference = $result['data']['reference'];

	$customer_country = $result['data']['metadata']['custom_fields'][0]['display_country'];
	$customer_city = $result['data']['metadata']['custom_fields'][0]['display_city'];
	$customer_id = $result['data']['metadata']['custom_fields'][0]['display_id'];

	$payment_channel = $result['data']['channel'];
	$payee_ip = $result['data']['ip_address'];
	$payee_time = $result['data']['log']['time_spent'];
	$payee_attempts = $result['data']['log']['attempts'];
	$payee_attempts = $result['data']['log']['attempts'];
	$customer_id = $result['data']['customer']['id'];
	$customer_email = $result['data']['customer']['email'];
	$trans_status = $result['data']['status'];


	$sql = "UPDATE users SET balance='$trans_amount', transactionid='$trans_id' WHERE accountNumber='$userid' LIMIT 1";
	$sqlQuery = mysqli_query($con, $sql);

	if ($sqlQuery) {
		
		$query = "INSERT INTO transactions (transactionid,transactionref,transactiondate,transactionamount) VALUES ('$userid','$trans_reference','$trans_date','$trans_amount')";

		$queryRun = mysqli_query($con, $query);

		if ($queryRun) {
			
			$_SESSION['message']= "Registration Successfully!!";
            $_SESSION['msgtype']= "success";

            header("Location:recharge");

		} else {

			$_SESSION['message']= "Cannot Insert payment";
	        $_SESSION['msgtype']= "danger";

	        header("Location:recharge");

		}

	} else {

		$_SESSION['message']= "Cannot update payment";
        $_SESSION['msgtype']= "danger";

        header("Location:recharge");

	}

}

} else {

	header('Location: recharge');
}

