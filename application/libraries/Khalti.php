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
                    'payment_id'     => $paymentId['MAXID'] + 1,
                    'application_id' => $post_data['application_id'],
                    'user_id'        => $post_data['user_id'],
                    'vacancy_id'     => $post_data['vacancy_id'], 
                    // 'payment_type'   => $post_data['payment_gateway'],
                    'payment_gateway_id' => $post_data['payment_gateway_id'],
                    'payment_amount' => $post_data['actual_amount'],
                    'payment_unique_id' => $response->pidx,
                    // 'payment_transaction_id' => '',
                    'payment_order_id' => $request_data['purchase_order_id'],
                    'payment_order_name' => $request_data['purchase_order_name'],
                    // 'payment_reference_id'   => $_GET['refId'],
                    // 'status'         => '1',
                    // 'payment_paid'   => 'Y',
                    'payment_status' => 'pending',
                    'created_date'   => date('Y-m-d H:i:s.v')
                ];


                // CHECK IF SAME PIDX INSERTED
                $pidx = $insert_data['payment_unique_id'];

                $checkPidx = $CI->db->query("SELECT * FROM HRIS_REC_APPLICATION_PAYMENT WHERE PAYMENT_UNIQUE_ID = '$pidx'")->num_rows();

                
                // if (false)
                if ($checkPidx == 0)
                {     

                    $columns = arrayKeyImplode($insert_data, 'c', 'key');
                    $values  = arrayKeyImplode($insert_data, 'qc', '');

                    /**
                     * INSERT TRANSACTION BUT NOT VERIFIED
                     * */
                    $CI->db->query("INSERT INTO HRIS_REC_APPLICATION_PAYMENT ($columns) VALUES ('$values')");

                    // if ($CI->db->affected_rows()) {

                    //     $CI->db->query("UPDATE HRIS_REC_VACANCY_APPLICATION 
                    //                     SET PAYMENT_STATUS = 'Y' 
                    //                     WHERE APPLICATION_ID = '" . $insert_data['application_id'] . "' AND AD_NO = '" . $insert_data['vacancy_id'] ."'");



                    // }
                    echo $response->payment_url;

                } else {

                    return false;

                }



                // header( 'Access-Control-Allow-Origin: ' . $response->payment_url, true );

                // redirect($response->payment_url);

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

       
        /**
         * GET DATA FROM HRIS_REC_APPLICATION_PAYMENT WHERE pidx  [COLUMN:  PAYMENT_UNIQUE_ID]
         * */
        $pidx = $data['pidx'];
        $checkPIDXAvailable = $CI->db->query("SELECT * FROM HRIS_REC_APPLICATION_PAYMENT WHERE PAYMENT_UNIQUE_ID = '$pidx'")->row_array();

        
        // echo "<pre>";

        // print_r($checkPIDXAvailable);

        // die;

        $private_key = config_item('live_secret_key');
        $debug       = config_item('debug');

        $base_url    = config_item('khalti_lookup_url');


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
                    'status' => 0,
                    'payment_paid' => '',
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
                    $update_data['status'] = 1;
                    $update_data['payment_paid'] = 'Y';
                    $update_data['payment_verified'] = 'Y';

                    $column = arrayKeyImplode($update_data, 'c', 'key');
                    $value  = arrayKeyImplode($update_data, 'qc', '');

                    // UPDATING HRIS_REC_APPLICATION_PAYMENT
                    $update_statement = "UPDATE HRIS_REC_APPLICATION_PAYMENT SET ($column) = ('$value') WHERE PAYMENT_UNIQUE_ID = '$pidx'";

                    $CI->db->query($update_statement);

                    if ($CI->db->affected_rows() > 0)
                    { 

                        $fetch_statement = "SELECT * FROM HRIS_REC_APPLICATION_PAYMENT WHERE PAYMENT_UNIQUE_ID = '$pidx'";
                        $result = $CI->db->query($fetch_statement)->row_array();

                        // UPDATE HRIS_REC_VACANCY_APPLICATION  ->> PAYMENT_STATUS
                        $application_id = $result['APPLICATION_ID'];
                        $vacancy_id     = $result['VACANCY_ID'];
                        $payment_id     = $result['PAYMENT_ID'];

                        $update_statement = "UPDATE HRIS_REC_VACANCY_APPLICATION 
                                             SET PAYMENT_ID = '$payment_id' 
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
                     *  status = 0, payment_paid = N, payment_verified = N
                     * 
                     * */
                    $update_data['status'] = 0;
                    $update_data['payment_paid'] = 'N';
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
