<?php

// Confirm that reference has not already gotten value
// This would have happened most times if you handle the charge.success event.
// If it has already gotten value by your records, you may call 
// perform_success()

require 'vendor/autoload.php';

$paystack = new Yabacon\Paystack('sk_test_6e618e981cd81972adc46c2dad0fd319ff7f16f4');
// the code below throws an exception if there was a problem completing the request, 
// else returns an object created from the json response
$trx = $paystack->transaction->verify(
	[
	 'reference'=>$_GET['reference']
	]
);

// status should be true if there was a successful call
if(!$trx->status){
    exit($trx->message);
}
// full sample verify response is here: https://developers.paystack.co/docs/verifying-transactions
if('success' == $trx->data->status){
	// use trx info including metadata and session info to confirm that cartid
  // matches the one for which we accepted payment
  give_value($reference, $trx);
  perform_success();
}

// provide value to the customer
function give_value($reference, $trx){
  // Be sure to log the reference as having gotten value
  // write code to give value
}

function perform_success(){
  // popup
  echo json_encode(['verified'=>true]);
  // standard
  header('Location: /success.php');
	exit();
}


?>