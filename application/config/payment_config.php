<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Getting Configuration Data
|--------------------------------------------------------------------------
|
*/
$config = get_config();

/*
|--------------------------------------------------------------------------
| Esewa URL
|--------------------------------------------------------------------------
|
| URL to pay via Esewa. 
| 
| FOR DEVELOPMENT URL
| https://uat.esewa.com.np/epay/main
|
| FOR PRODUCTION URL
| https://esewa.com.np/epay/main
| 
|
*/
$config['esewa_url'] = 'https://uat.esewa.com.np/epay/main';


/*
|--------------------------------------------------------------------------
| Esewa Merchant Code
|--------------------------------------------------------------------------
|
| Merchant code provided by eSewa 
| 
| FOR DEVELOPMENT USE
| 'EPAYTEST'
|
| FOR PRODUCTION USE 
| 'registered merchant code here'
|
|
*/
$config['esewa_merchant_id'] = 'EPAYTEST';


/*
|--------------------------------------------------------------------------
| Esewa Payment Verification URL
|--------------------------------------------------------------------------
| 
| FOR DEVELOPMENT USE
| https://uat.esewa.com.np/epay/transrec
|
| FOR PRODUCTION USE 
| https://esewa.com.np/epay/transrec
|
|
*/
$config['esewa_verify_transaction'] = 'https://uat.esewa.com.np/epay/transrec';

/*
|--------------------------------------------------------------------------
| Esewa Payment Success URL
|--------------------------------------------------------------------------
| 
| CREATED ESEWA SUCCESS PAGE PATH FROM VIEW FOLDER
| [ base_url ] . [ controller_name ] . [ controller_method ]
|
|
*/
$config['esewa_success_page_url'] = $config['base_url'] . 'vacancy/payment_success';

/*
|--------------------------------------------------------------------------
| Esewa Payment Fail URL
|--------------------------------------------------------------------------
| 
| CREATED ESEWA FAIL PAGE PATH FROM VIEW FOLDER
| [ base_url ] . [ controller_name ] . [ controller_method ]
|
|
*/
$config['esewa_fail_page_url'] = $config['base_url'] . 'vacancy/payment_failed';




/*
|--------------------------------------------------------------------------
| ConnectIPS SETTING CONFIGURATION
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ConnectIPS URL
|--------------------------------------------------------------------------
|
| URL to pay via ConnectIPS. 
| 
| FOR DEVELOPMENT URL
| https://uat.connectips.com:7443/connectipswebgw/loginpage
|
| FOR PRODUCTION URL
| https://connectips.com:7443/connectipswebgw/loginpage
| 
|
*/
// $config['connectips_url'] = 'https://uat.connectips.com:7443/connectipswebgw/loginpage';
$config['connectips_url'] = 'https://login.connectips.com/connectipswebgw/loginpage';


/*
|--------------------------------------------------------------------------
| ConnectIPS Merchant ID
|--------------------------------------------------------------------------
|
| Merchant ID provided by ConnectIPS
| 
| # Merchant ID is and unique identifier to identify merchant in the system. 
| # Merchant ID will be provided by NCHL upon registering merchant for 
|   connectIPS Core Module on banks' request.
|
*/
// $config['connectips_merchant_id'] = 498;
$config['connectips_merchant_id'] = 212;


/*
|--------------------------------------------------------------------------
| ConnectIPS Application ID
|--------------------------------------------------------------------------
|
| Application ID provided by ConnectIPS
| 
| Unique identification, which will be used to identify the account details
| of the merchant's application. A merchant can have multiple applications 
| based on different banks account used for various shopping sites. 
| 
| Application ID will be provided by NCHL after registration.
|
*/
// $config['connectips_app_id'] = 'MER-498-APP-1';
$config['connectips_app_id'] = 'NOC-212-REC-2';

/*
|--------------------------------------------------------------------------
| ConnectIPS Application Name
|--------------------------------------------------------------------------
|
| Application name to identify merchant as well as originating application.
| 
|
*/
$config['connectips_appname'] = 'NOC Recruitment System';
// $config['connectips_appname'] = 'Neo software';

/*
|--------------------------------------------------------------------------
| ConnectIPS Transaction Currency
|--------------------------------------------------------------------------
|
| Currency of Transaction.
|
| [ NPR ] 
|
*/
$config['connectips_txncrncy'] = 'NPR';

/*
|--------------------------------------------------------------------------
| ConnectIPS Transaction ID
|--------------------------------------------------------------------------
|
| Transaction ID.
|
| Must Be unique for each app in each post request
|
*/
$config['connectips_txnId'] = rand(0, 10000000).time();

/*
|--------------------------------------------------------------------------
| SETTING DATE TIME ZONE
|--------------------------------------------------------------------------
|
| FOR TRANSACTION DATE .
|
| Setting default date time zone as 'ASIA / KATHMANDU'
|
|
*/
$datetime = new DateTime();
$timezone = new DateTimeZone('Asia/Kathmandu');
$datetime->setTimezone($timezone);


/*
|--------------------------------------------------------------------------
| ConnectIPS Transaction Date
|--------------------------------------------------------------------------
|
| Transaction Date.
|
| Transaction Date is the transaction origination date.
|
| CONNECTIPS Date must be in DD-MM-YYYY format. 
| example: 29-09-2022
|
| SAP HANA DATABASE Date must be in ('Y-m-d H:i:s.v') 
| example: 2022-09-29 03:16:00.106
|
|
*/
$config['connectips_txn_date'] = date('d-m-Y');

$config['connectips_txn_date_for_system'] = $datetime->format('Y-m-d H:i:s.v');


/*
|--------------------------------------------------------------------------
| ConnectIPS PAYMENT VALIDATION URL
|--------------------------------------------------------------------------
|
| REST based API provided to validate the status of a transaction.
| 
| BASIC AUTHENTICATION process required
| [USERNAME] >>>> USE PROVIDED APP ID
| [PASSWORD] >>>> 
|
| JSON request must contain [merchant id, app id, reference id, transaction amount and token]
|
| REFERENCE ID is the TXDID field valued supplied during the payment request.
| 
| TOKEN is hash value signed with the digital certificate of the creditor.
|
| FOR DEVELOPMENT URL
| https://uat.connectips.com:7443/connectipswebgw/api/creditor/validatetxn
|
| FOR PRODUCTION URL
| https://connectips.com:7443/connectipswebgw/loginpage
| 
|
*/
// $config['connectips_payment_validation_url'] = 'https://uat.connectips.com:7443/connectipswebgw/api/creditor/validatetxn';
$config['connectips_payment_validation_url'] = 'https://login.connectips.com:5443/connectipswebws/api/creditor/validatetxn';



/*
|--------------------------------------------------------------------------
| ConnectIPS BASIC AUTHENTICATION PAYMENT VALIDATION 
|--------------------------------------------------------------------------
|
| 
| BASIC AUTHENTICATION required
| [USERNAME] >>>> USE PROVIDED APP ID
| [PASSWORD] >>>> 
| 
|
*/
$config['ips_username'] = $config['connectips_app_id'];
$config['ips_password'] = 'Abcd@123';
// $config['ips_password'] = '1234';


/*
|--------------------------------------------------------------------------
| KHALTI CONFIGURATION SETTING
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| KHALTI
|--------------------------------------------------------------------------
|
| SET true OR false
| true  ->>>>>> live khalti url
| false ->>>>>> testing khalti url
|	
*/
$config['debug'] = false; 

$config['auto_redirect'] = true; // set false if you don't want khalti to auto redirect
// your website url
$config['website_url'] = $config['base_url'] . 'vacancy/payment_success_khalti';

/* LOCAL */
// $config['live_public_key'] = 'live_public_key_0f21d5e35209416b86a475714384f77c';
// $config['live_secret_key'] = 'live_secret_key_b8a9a4dc476c41eebc47ade40c52b3e1';
// $config['test_public_key'] = 'test_public_key_01695a8fde494dd9bf6e673852e3679e'; 
// $config['test_secret_key'] = 'test_secret_key_305e9938019a42f3a6602579099fda1a';

// $config['khalti_request_url'] = 'https://a.khalti.com/api/v2/epayment/initiate/';
// $config['khalti_lookup_url']  = 'https://a.khalti.com/api/v2/epayment/lookup/';
/* LOCAL */


/* LIVE KHALTI*/
$config['live_public_key'] = 'live_public_key_0c0ba6a6dc0147f8b214efe6911bbed8';
$config['live_secret_key'] = 'live_secret_key_a7071610f28b47448abb9731884db925';
$config['test_public_key'] = 'test_public_key_54083761793447c485754dec6a316504'; 
$config['test_secret_key'] = 'test_secret_key_fb3a181c95444b6498b61e577db72fe6';


$config['khalti_request_url'] = 'https://khalti.com/api/v2/epayment/initiate/';
$config['khalti_lookup_url']  = 'https://khalti.com/api/v2/epayment/lookup/';
/* LIVE KHALTI*/


$config['khalti_return_url'] = $config['base_url'] . 'vacancy/khalti_return_success';

