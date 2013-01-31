<?php

# Required File Includes
include("../../../dbconnect.php");
include("../../../includes/functions.php");
include("../../../includes/gatewayfunctions.php");
include("../../../includes/invoicefunctions.php");

$gatewaymodule = "dotpay"; 

$GATEWAY = getGatewayVariables($gatewaymodule);

// sprawdzamy ip, czy nalezy do dotpay.pl
if($_SERVER['REMOTE_ADDR']!='217.17.41.5' && $_SERVER['REMOTE_ADDR']!='195.150.9.37') die("Incorrect sender IP ".$_SERVER['REMOTE_ADDR']);


if (!$GATEWAY["type"]) die("Module Not Activated"); 

# Get Returned Variables
$status = $_POST["status"];
$t_status = $_POST["t_status"];
$invoiceid = $_POST["control"];
$transid = $_POST["t_id"];
$amount = $_POST["amount"];
$fee = $amount*0.039;

$invoiceid = checkCbInvoiceID($invoiceid,$GATEWAY["name"]); # sprawdzamy ID platnosci

checkCbTransID($transid); # sprawdzamy, czy numer transakcji jest juz w bazie

if ($status=="OK" && $t_status == 2) {
    # Successful
    addInvoicePayment($invoiceid,$transid,$amount,$fee,$gatewaymodule);
    logTransaction($GATEWAY["name"],$_POST,"Successful");
} else {
	# Unsuccessful
    logTransaction($GATEWAY["name"],$_POST,"Unsuccessful");
}

// dotpay.pl oczekuje w odpowiedzi 'OK'
echo "OK";
?>