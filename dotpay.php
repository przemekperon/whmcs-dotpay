<?php

function dotpay_config() {
    $configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"DotPay.pl"),
     "username" => array("FriendlyName" => "Login ID", "Type" => "text", "Size" => "20", ),
    );
	return $configarray;
}

function dotpay_link($params) {

	# Gateway Specific Variables
	$gatewayusername = $params['username'];
	$gatewaytestmode = $params['testmode'];

	# Invoice Variables
	$invoiceid = $params['invoiceid'];
	$description = $params["description"];
    $amount = $params['amount']; # Format: ##.##
    $currency = $params['currency']; # Currency Code

	# Client Variables
	$firstname = $params['clientdetails']['firstname'];
	$lastname = $params['clientdetails']['lastname'];
	$email = $params['clientdetails']['email'];
	$address1 = $params['clientdetails']['address1'];
	$address2 = $params['clientdetails']['address2'];
	$city = $params['clientdetails']['city'];
	$state = $params['clientdetails']['state'];
	$postcode = $params['clientdetails']['postcode'];
	$country = $params['clientdetails']['country'];
	$phone = $params['clientdetails']['phone'];

	# System Variables
	$companyname = $params['companyname'];
	$systemurl = $params['systemurl'];
	$currency = $params['currency'];

	# Enter your code submit to the gateway...
    $gateway_address = 'https://ssl.dotpay.pl'; //real payments
    //$gateway_address = 'https://ssl.dotpay.pl/test_payment/'; //test payments
	$code = '<form method="POST" action="'.$gateway_address.'">
<input type="hidden" name="id" value="'.$gatewayusername.'" />
<input type="hidden" name="firstname" value="'.$firstname.'" />
<input type="hidden" name="lastname" value="'.$lastname.'" />
<input type="hidden" name="street" value="'.$address1.'" />
<input type="hidden" name="email" value="'.$email.'" />
<input type="hidden" name="city" value="'.$city.'" />
<input type="hidden" name="postcode" value="'.$postcode.'" />
<input type="hidden" name="phone" value="'.$phone.'" />
<input type="hidden" name="control" value="'.$invoiceid.'" />
<input type="hidden" name="description" value="'.$invoiceid.' '.$description.'" />
<input type="hidden" name="amount" value="'.$amount.'" />
<input type="hidden" name="URL" value="'.$params['systemurl'].'/viewinvoice.php?id='.$invoiceid.'">
<input type="hidden" name="URLC" value="'.$params['systemurl'].'/modules/gateways/callback/dotpay.php">
<input type="submit" value="Zaplac teraz" />
</form>';

	return $code;
}



?>