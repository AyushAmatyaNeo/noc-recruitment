<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *  KHALTI PAYMENT GATEWAY 
 * 
 *  Initializing process
 * 
 * */

class Khalti
{
	protected $CI; 

	public function __construct() { 

        // Set the super object to a local variable for use later
		$CI =& get_instance();
        date_default_timezone_set("Asia/Kathmandu");

    } 

    public static function initiate($post_data, string $return_url, string $purchase_order_id, string $purchase_order_name, int $amount, ?array $customer_info = null, ?array $amount_breakdown = null,  ?array $product_details = null)
    {	

        $CI =& get_instance();

        $private_key = config_item('live_secret_key');
        $debug = config_item('debug');
        $auto_redirect = config_item('auto_redirect');

        $request_data = [

            'return_url' => $return_url,
            'website_url' => config_item('website_url'),
            'amount' => $amount,
            'purchase_order_id' => $purchase_order_id,
            'purchase_order_name' => $purchase_order_name,

        ];


        if ($customer_info) {

            $request_data['customer_info'] = $customer_info;

        }

        if ($amount_breakdown) {
            
            $request_data['amount_breakdown'] = $amount_breakdown;

        }

        if ($product_details) {
            
            $request_data['product_details'] = $product_details;

        }

        $base_url = config_item('khalti_request_url');


        try {


            $curl = curl_init();

            curl_setopt_array($curl, array(

                CURLOPT_URL => $base_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($request_data),

                CURLOPT_HTTPHEADER => array(
                    "Authorization: Key ${private_key}",
                    "Content-Type: application/json",

                ),

                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,

            ));

        	$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $response = curl_exec($curl);
            curl_close($curl);


            $response = json_decode($response); // response in php object


            /**
             *  SUCCESS RESPONSE
             *  {
             *       "pidx": "S8QJg2VALZGTJRkKqVxjqB",
             *       "payment_url": "https://test-pay.khalti.com/?pidx=S8QJg2VALZGTJRkKqVxjqB/"
             *  }
             *
             *  pidx is PAYMENT_UNIQUE_ID IS COLUMN FIELD ->>> HRIS_REC_APPLICATION_PAYMENT 
             * */


            if ($auto_redirect && isset($response->payment_url)) {


                /**
                 *  INSERTING PAYMENT DATA IN HRIS_REC_APPLICATION_PAYMENT
                 * 
                 * */

                /*
                 * GETTING MAX ROW COUNT OF TABLE 
                 *
                 */

                $paymentId = $CI->db->query("SELECT MAX(PAYMENT_ID) AS MAXID FROM HRIS_REC_APPLICATION_PAYMENT")->row_array();

                $insert_data = [

                    'payment_id'         => $paymentId['MAXID'] + 1,
                    'application_id'     => $post_data['application_id'],
                    'user_id'            => $post_data['user_id'],
                    'vacancy_id'         => $post_data['vacancy_id'], 
                    'payment_gateway_id' => $post_data['payment_gateway_id'],
                    'payment_amount'     => $post_data['actual_amount'],
                    'payment_unique_id'  => $response->pidx,
                    'payment_order_id'   => $request_data['purchase_order_id'],
                    'payment_order_name' => $request_data['purchase_order_name'],
                    'payment_status'     => 'pending',
                    'created_date'       => date('Y-m-d H:i:s.v')
                    
                ];


                // CHECK IF SAME PIDX INSERTED
                $pidx = $insert_data['payment_unique_id'];

                $checkPidx = $CI->db->query("SELECT * FROM HRIS_REC_APPLICATION_PAYMENT WHERE PAYMENT_UNIQUE_ID = '$pidx'")->num_rows();

                
                if ($checkPidx == 0)
                {     

                    $columns = arrayKeyImplode($insert_data, 'c', 'key');
                    $values  = arrayKeyImplode($insert_data, 'qc', '');

                    /**
                     * INSERT TRANSACTION BUT NOT VERIFIED
                     * */
                    $CI->db->query("INSERT INTO HRIS_REC_APPLICATION_PAYMENT ($columns) VALUES ('$values')");

                    echo $response->payment_url;

                } else {

                    return false;

                }

            }

            return false;

        } catch (\Exception $e) {

            throw $e;

        }


    }

    /**
     *  KHALTI PAYMENT VERIFICATION CHECK
     * 
     * */
    public static function lookup($data)
    {

        $CI =& get_instance();

        $CI->load->helper('utility');

        /* SETTING */
        $private_key = config_item('live_secret_key');
        $debug       = config_item('debug');
        $base_url    = config_item('khalti_lookup_url');
        /* SETTING */

       
        /**
         * GET DATA FROM HRIS_REC_APPLICATION_PAYMENT WHERE pidx  [COLUMN:  PAYMENT_UNIQUE_ID]
         * */
        $pidx = $data['pidx'];
        $checkPIDXAvailable = $CI->db->query("SELECT * FROM HRIS_REC_APPLICATION_PAYMENT WHERE PAYMENT_UNIQUE_ID = '$pidx'")->row_array();


        
        if ($checkPIDXAvailable)
        // if (true)
        {

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

                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,

                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($response, true); //convert in array


                /**
                     *   VERIFIED TRANSACTION RESPONSE
                     * 
                     *   (fee charged by KHALTI of our payment)
                     *   
                     *       (
                     *           [pidx] => thi3PeT4AzAwr7hkwx9tvG
                     *           [total_amount] => 40000
                     *           [status] => 'Completed'
                     *           [transaction_id] => gYvaTVHHLVCYagwdZ8mGJ7
                     *           [fee] => 1200
                     *           [refunded] => ''
                     *       )
                     * 
                     * */

                $fee = ($response['fee'] !== 0) ? ($response['fee'] / 100) : 0;

                $update_data = [
                    'payment_status' => strtolower($response['status']),
                    'fee' => $fee,
                    'payment_verified' => '',
                    'payment_verified_date'  => date('Y-m-d H:i:s.v')
                ];


                if ($response['status'] == 'Completed') 
                {
                    /**
                     *  for status == completed
                     * 
                     *  status = 1, payment_paid = Y, payment_verified = Y
                     * 
                     * */
                    $update_data['payment_verified'] = 'Y';

                    $column = arrayKeyImplode($update_data, 'c', 'key');
                    $value  = arrayKeyImplode($update_data, 'qc', '');

                    // UPDATING HRIS_REC_APPLICATION_PAYMENT
                    $update_statement = "UPDATE HRIS_REC_APPLICATION_PAYMENT SET ($column) = ('$value') WHERE PAYMENT_UNIQUE_ID = '$pidx'";

                    $CI->db->query($update_statement);

                    if ($CI->db->affected_rows() > 0)
                    { 

                        // UPDATE HRIS_REC_VACANCY_APPLICATION  ->> PAYMENT_STATUS
                        
                        $payment_verified = $update_data['payment_verified'];
                        $application_id   = $checkPIDXAvailable['APPLICATION_ID'];
                        $vacancy_id       = $checkPIDXAvailable['VACANCY_ID'];
                        $payment_id       = $checkPIDXAvailable['PAYMENT_ID'];

                        $update_statement = "UPDATE HRIS_REC_VACANCY_APPLICATION 
                                             SET (PAYMENT_VERIFIED) = ('$payment_verified') 
                                             WHERE APPLICATION_ID = '$application_id' AND AD_NO = '$vacancy_id'";

                        $CI->db->query($update_statement);

                        return true;
                        
                    } else {

                        return false;

                    }

                } else {

                    /**
                     *  for status !== completed
                     * 
                     *  payment_verified = N
                     * 
                     * */
                    $update_data['payment_verified'] = 'N';

                    $column = arrayKeyImplode($update_data, 'c', 'key');
                    $value  = arrayKeyImplode($update_data, 'qc', '');

                    // UPDATING HRIS_REC_APPLICATION_PAYMENT
                    $update_statement = "UPDATE HRIS_REC_APPLICATION_PAYMENT SET ($column) = ('$value') WHERE PAYMENT_UNIQUE_ID = '$pidx'";

                    $CI->db->query($update_statement);

                    return false;
                }

                
            } catch (Exception $e) {
             
                throw $e;

            }

        } else {

            // echo "unverified"; die;

            return false;

        }

    }

}
