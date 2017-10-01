<?php

# Required File Includes
include("../../../init.php");
include("../../../includes/functions.php");
include("../../../includes/gatewayfunctions.php");
include("../../../includes/invoicefunctions.php");

$gatewaymodule = "dotpay"; 

$GATEWAY = getGatewayVariables($gatewaymodule);

// sprawdza czy adres IP pochodzi z zakresu IP dotpay.pl
$ipx = $_SERVER['REMOTE_ADDR'];
if(!ip_in_range($ipx, '195.150.9.0/24') ) die("Incorrect sender IP ".$_SERVER['REMOTE_ADDR']);


if (!$GATEWAY["type"]) die("Module Not Activated"); 

# Get Returned Variables
$status = $_POST["operation_status"];
$operation_type = $_POST["operation_type"];
$invoiceid = $_POST["control"];
$transid = $_POST["operation_number"];
$amount = $_POST["operation_amount"];
$fee = $amount*0.039;

$invoiceid = checkCbInvoiceID($invoiceid,$GATEWAY["name"]); # sprawdzamy ID platnosci

checkCbTransID($transid); # sprawdzamy, czy numer transakcji jest juz w bazie

if ($status == "completed" && $operation_type == "payment") {
    # Successful
    addInvoicePayment($invoiceid,$transid,$amount,$fee,$gatewaymodule);
    logTransaction($GATEWAY["name"],$_POST,"Successful");
} else {
	# Unsuccessful
    logTransaction($GATEWAY["name"],$_POST,"Unsuccessful");
}

// dotpay.pl oczekuje w odpowiedzi 'OK'
echo "OK";


/**
 * Check if a given ip is in a network
 * @param  string $ip    IP to check in IPV4 format eg. 127.0.0.1
 * @param  string $range IP/CIDR netmask eg. 127.0.0.0/24, also 127.0.0.1 is accepted and /32 assumed
 * @return boolean true if the ip is in this range / false if not.
 */
function ip_in_range( $ip, $range ) {
    if ( strpos( $range, '/' ) == false ) {
        $range .= '/32';
    }
    // $range is in IP/CIDR format eg 127.0.0.1/24
    list( $range, $netmask ) = explode( '/', $range, 2 );
    $range_decimal = ip2long( $range );
    $ip_decimal = ip2long( $ip );
    $wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
    $netmask_decimal = ~ $wildcard_decimal;
    return ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );
}
?>