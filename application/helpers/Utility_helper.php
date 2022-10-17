<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$CI =& get_instance();

/*
|--------------------------------------------------------------------------
| Temporary Session Generator
|--------------------------------------------------------------------------
|
*/

if ( ! function_exists('sessionGenerator')) {


    function sessionGenerator($session_key, $session_value) {

        // code

    }

}


/*
|--------------------------------------------------------------------------
| CHECK SESSION 
|--------------------------------------------------------------------------
|
*/

if ( ! function_exists('sessionCheck')) {


    function sessionCheck() {

        $CI =& get_instance();
        $CI->load->library('session');


        if (($CI->session->userdata('isUserLoggedIn') == NULL) AND ($CI->session->userdata('userId') == NULL))
        {
            redirect('users/login');
        }


    }
}


/*
|--------------------------------------------------------------------------
| Email Regular Expression Validation
|--------------------------------------------------------------------------
|
*/

if ( ! function_exists('emailCheckValid')) {


    function emailCheckValid($email) {

        // EXPRESSION
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

        if (preg_match($regex, $email)) 
        {
        
            return true;

        }

        return false;


    }

}

/*
|--------------------------------------------------------------------------
| ConnectIPS Hash Generator
|--------------------------------------------------------------------------
|
*/

if ( ! function_exists('connectipsHashGenerator')) {


    function connectipsHashGenerator(array $data) {

    	// $CI =& get_instance();

     //  	$CI->load->library('session');

   	    $string  = "MERCHANTID=".$data['merchant_id'].",APPID=".$data['app_id'].",APPNAME=".$data['app_name'].",TXNID=".$data['txn_id'].",TXNDATE=".$data['txn_date'].",TXNCRNCY=".$data['txn_cur'].",TXNAMT=".$data['txn_amt'].",REFERENCEID=".$data['referenceId'].",REMARKS=".$data['remarks'].",PARTICULARS=".$data['particulars'].",TOKEN=".$data['token'];

        $hash = hash('sha256', $string);

        if (!$cert_store = file_get_contents("CREDITOR\CREDITOR.pfx")) {
            echo "Error: Unable to read the cert file\n";
            exit;
        }

        if (openssl_pkcs12_read($cert_store, $cert_info, "123")) {
            if($private_key = openssl_pkey_get_private($cert_info['pkey'])){
                $array = openssl_pkey_get_details($private_key);
                // print_r($array);
            }

        } else {
            echo "Error: Unable to read the cert store.\n";
            exit;
        }
        $hash = "";
        if(openssl_sign($string, $signature , $private_key, "sha256WithRSAEncryption")){
            $hash = base64_encode($signature);
            openssl_free_key($private_key);

        } else {
            
            echo "Error: Unable openssl_sign";
            exit;
        } 

        return $hash;

    }

}


/*
|--------------------------------------------------------------------------
| ConnectIPS Transaction ID Generator
|--------------------------------------------------------------------------
|
*/

if ( ! function_exists('connectipsTxnIdGenerator')) {


    function connectipsTxnIdGenerator() {

        $txn_id = rand(0, 10000000).time();

        return $txn_id;

    }

}


/*
|--------------------------------------------------------------------------
| GETTING ARRAY VALUE ONLY
|--------------------------------------------------------------------------
|
*/

if ( ! function_exists('assocArrayToArray')) {


    function assocArrayToArray($data) {

        if (is_array($data)) {

            $assign = [];

            for ($i=0; $i < count($data); $i++) { 

                $assoc_key = implode('',array_keys($data[$i]));

                $assign[] .= $data[$i][$assoc_key];

            }


            return $assign;

        }

        return false;

    }

}

/*
|--------------------------------------------------------------------------
| GETTING ARRAY KEY AND IMPLODE ARRAY DATA
|--------------------------------------------------------------------------
|
*/

if ( ! function_exists('arrayKeyImplode')) {


    function arrayKeyImplode($data, $delimiter_value, $array_key_value) {

        /**
         *  c => comma
         *  qc=> quote comma
         * 
         * */
        
        $delimiter = [
                "c" => ",",
                "qc" => "','"
            ];

        if (is_array($data)) {

            $delimiter_value = ($delimiter_value) ? $delimiter_value : 'c' ;

            if ($array_key_value == 'key')
            {

                $assign = implode($delimiter[$delimiter_value], array_keys($data));

            } else {

                $assign = implode($delimiter[$delimiter_value], array_values($data));

            }

            return $assign;

        }

        return false;

    }

}