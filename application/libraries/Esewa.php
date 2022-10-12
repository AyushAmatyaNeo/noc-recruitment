<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  KHALTI PAYMENT GATEWAY 
 * 
 *  Initializing process
 * 
 * */

class Esewa
{
	protected $CI; 

	public function __construct() { 

        // Set the super object to a local variable for use later
		$this->CI =& get_instance();
        // $this->CI->config->load('payment_config');

        // $test = $this->CI->config->item('test_public_key');

    }

    public static function initiate($amount,
                                    $taxAmount = 0,
                                    $serviceCharge = 0,
                                    $deliveryCharge = 0,
                                    $uniqueId
                                    )
    {	

        /**
         * URL
         * */
        $url = config_item('esewa_url');

        /**
         * MERCHANT CODE PROVIDED BY ESEWA
         * */
        $scd = config_item('esewa_merchant_id');

        /**
         * Success URL: a redirect URL of merchant application 
         * where customer will be redirected after SUCCESSFUL transaction
         * */
        $su = config_item('esewa_success_page_url');

        /**
         * Failure URL: a redirect URL of merchant application 
         * where customer will be redirected after FAILURE or PENDING transaction
         * */
        $fu = config_item('esewa_fail_page_url');


        $total =  $amount + $serviceCharge + $deliveryCharge + $taxAmount;       


        $request_data = [

            'amt' => $amount,
            'pdc' => $serviceCharge,
            'psc' => $deliveryCharge,
            'txAmt' => $taxAmount,
            'tAmt' => $total,
            'pid'  => $uniqueId,
            'scd'  => $scd,
            'su'  => $su,
            'fu'  => $fu

        ];


        try {

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $request_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

            $response = curl_exec($curl);
            curl_close($curl);

            echo $response;
          
                
                // redirect(config_item('base_url').'vacancy/khalti_return_success)';

              	redirect($url, 'refresh');



        } catch (\Exception $e) {

            throw $e;

        }


    }

    public static function lookup(string $pidx)
    {

        $private_key = config_item('live_secret_key');
        $debug = config_item('debug');

        $base_url = config_item('khalti_lookup_url');

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => $base_url,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => TRUE,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    'pidx' => $pidx
                ]),

                CURLOPT_HTTPHEADER => array(
                    "Authorization: Key ${private_key}",
                    'Content-type: application/json'
                ),

            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true); //convert in array

            return $response;
            
        } catch (Exception $e) {
         
            throw $e;

        }

    }

}
