<?php
use Mpdf\Tag\Em;
defined('BASEPATH') or exit('No direct script access allowed');
class Vacancy extends CI_Controller
{
    public $userId;

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('UserModel');
        $this->load->model('VacancyModel');
        $this->load->helper(array('form', 'url','file','string'));
        $this->load->library('khalti');
        $this->load->library('esewa');
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
        $this->userId = $this->session->userdata('userId');

        date_default_timezone_set("Asia/Kathmandu");
    }

    public function index()
    {
        if ($this->isUserLoggedIn) 
        {
            
            redirect('vacancy/vacancylist');

        } else {
            
            redirect('users/login');
        
        }
    
    }

    /**
     *  LIST OF ALL VACANCIES
     * 
     *  SHOWING APPLYING VACANCY LIST
     * 
     * */
    public function vacancylist()
    { 
        sessionCheck();

        $con = ['id' => $this->session->userdata('userId')];

        $data['vacancylists'] = $this->VacancyModel->fetchvacancy();
        $data['payment_gateways'] = $this->VacancyModel->fetchAll('HRIS_REC_PAYMENT_GATEWAY');


        if ($data['vacancylists'] != '')
        {            
            
            for ($i=0; $i < count($data['vacancylists']); $i++)
            {
                
                $IncName = array();
                
                if ($data['vacancylists'][$i]['INCLUSION_ID'] != null) 
                {
                    
                    $data['vacancylists'][$i]['INCLUSION_ID'] = explode(',' , $data['vacancylists'][$i]['INCLUSION_ID']);
                    $incNumbers = $data['vacancylists'][$i]['INCLUSION_ID'];
                        
                        foreach($incNumbers as $incNumber)
                        {
                            // echo '<pre>'; print_r($incNumber); die;
                            $IncName[] = $this->VacancyModel->fetchinclusions($incNumber);
                        }
                
                }

                $data['vacancylists'][$i]['INCLUSION_ID'] = implode(',', array_map(function ($el) {return $el['OPTION_EDESC']; }, $IncName));
               
            };

        };
        
        $data['user'] = $this->UserModel->getRows($con);

        
        $data['register'] = $this->UserModel->checkattribute('HRIS_REC_USERS_REGISTRATION', 'in_service,gender_id,disability,dob',$con['id']);

        $data['meta'] = array(
            'title' => 'Vacancy List',
            'Description' => 'View and Apply for vacancy'
        );
        $random =  random_string('alnum', 16);
        $data['applications'] = $this->VacancyModel->applicationDetails($con);

        
        $data['esewa'] = [
            'invoice'   => $random,
        ];   
        
        $data['connectips'] = [
            'merchant_id' => $this->config->item('connectips_merchant_id'),
            'app_id'      => $this->config->item('connectips_app_id'),  
            'app_name'    => $this->config->item('connectips_appname'),  
            'txn_id'      => $this->config->item('connectips_txnId'),  
            'txn_date'    => $this->config->item('connectips_txn_date'),
            'txn_cur'     => $this->config->item('connectips_txncrncy'),
            'txn_amt'     => '',
            'referenceId' => 'REF'.rand(0, 10000000),
            // 'referenceId' => 'VID1REF'.rand(0, 10000000),
            'remarks'     => 'RMKS-00',
            'particulars' => 'PART-001',
            'token'       => 'TOKEN'
        ];


        // $this->load->library('session');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/vacancylist', $data);
        $this->load->view('templates/footer');

    }

    /**
     * METHOD CALLED VIA AJAX TO PROCESS PAYMENT
     * 
     * */
    public function paymentProcess()
    {
        sessionCheck();
        // POST DATA VIA AJAX
        $data = [

            'application_id'        => base64_decode($_POST['application_id']),
            'vacancy_id'            => base64_decode($_POST['vacancy_id']),
            'payment_gateway'       => str_replace(base64_decode($_POST['application_id']), '', $_POST['payment_gateway']),
            'payment_gateway_id'    => base64_decode($_POST['payment_gateway_id']),
            'recruitment_post'      => $_POST['recruitmentPost'],
            'recruitment_post_level'=> $_POST['recruitmentPostLevel'],
            'user_id'               => $this->userId,

        ];


        // GET ALL DATA RELATED TO APPLICATION ID AND VACANCY ID
        $getDetailOfApplicant = $this->VacancyModel->fetchVacancyAndApplicationById($data['application_id'], $data['vacancy_id']);

        // GET ALL PAYMENT GATEWAY
        $availablePaymentGateway = assocArrayToArray($this->VacancyModel->fetchAllBySelect('HRIS_REC_PAYMENT_GATEWAY', 'GATEWAY_COMPANY'));

        // PROCEEDING AS PAYMENT GATEWAY
        if (in_array($data['payment_gateway'], $availablePaymentGateway, true)) {


            if ($data['payment_gateway'] == 'khalti')
            {

                $return_url          = $this->config->item('khalti_return_url');
                $purchase_order_id   = 'NOC'.rand(0, 10000).time().'aid'.$data['application_id'].'vid'.$data['vacancy_id']; // example 123567;
                $purchase_order_name = $data['recruitment_post'].' level:'.$data['recruitment_post_level']; // example Transaction: 1234,
                $amount_in_paisa = $getDetailOfApplicant['APPLICATION_AMOUNT'] * 100; // Your total amount in paisa Rs 1 = 100 paisa

                $data['actual_amount'] = $getDetailOfApplicant['APPLICATION_AMOUNT'];

                return $this->khalti::initiate($data, $return_url, $purchase_order_id, $purchase_order_name,  $amount_in_paisa);

            } elseif ($data['payment_gateway'] == 'connectips') {
                

                // print_r($data);

                $this->_connectips($data);

            }



        } else {

            redirect('vacancy/vacancylist');

        }

    }

    private function _connectips($data)
    {

        /**
         *  GET APPLICATION DETAILS
         * */

        $application = $this->VacancyModel->fetchVacancyAndApplicationById($data['application_id'], $data['vacancy_id']);

        // print_r(array($data, $application));

        /**
         * application id
         * user_id
         * application_amount
         * 
         * 
         * */

        /**
         * ASSIGN REQUIRED DATA FOR CONNECTIPS
         * */
        $connectips_data = [
            
            'merchant_id' => $this->config->item('connectips_merchant_id'),
            'app_id'      => $this->config->item('connectips_app_id'),
            'app_name'    => $this->config->item('connectips_appname'),
            'txn_id'      => $this->config->item('connectips_txnId'),
            'txn_date'    => $this->config->item('connectips_txn_date'),
            'txn_currency'=> $this->config->item('connectips_txncrncy'),
            'txn_amount'  => $application['APPLICATION_AMOUNT'] * 100, // converting into PAISA
            'txn_actual_amount' => $application['APPLICATION_AMOUNT'],
            'reference_id'=> 'REF'.rand(0, 10000000).'aid'.$application['APPLICATION_ID'].'vid'.$application['AD_NO'],
            'remarks'     => 'for payment registration no '. $application['REGISTRATION_NO'],
            'particulars' => 'PART-001',
            'token'       => ''

        ];

        /**
         * GENERATING HASH TOKEN
         * 
         * */
        $connectips_data['token'] = $this->_generateTokenConnectIPS($connectips_data);

        /*
         * GETTING MAX ROW COUNT OF TABLE 
         *
         */
        $paymentId = $this->VacancyModel->getMaxIds('PAYMENT_ID','HRIS_REC_APPLICATION_PAYMENT');

        // GET PAYMENT GATEWAY ID
        $gatewayId = $this->VacancyModel->fetchAllOrRowSelectWhere('HRIS_REC_PAYMENT_GATEWAY', 'ID', 'GATEWAY_COMPANY', $data['payment_gateway'], 'row_array');

        /**
         * INSERT CONNECTIPS DATA AS INITIAL PROCESS
         * */


        $insert_data = [

            'payment_id'     => $paymentId['MAXID'] + 1,
            'application_id' => $application['APPLICATION_ID'],
            'user_id'        => $this->userId,
            'vacancy_id'     => $application['AD_NO'],
            'payment_gateway_id' => $gatewayId['ID'],
            'payment_amount'=> $connectips_data['txn_actual_amount'],
            'payment_transaction_id' => $connectips_data['txn_id'],
            'payment_reference_id'=>  $connectips_data['reference_id'],
            'payment_status' => 'pending',
            'remarks'        => $connectips_data['remarks'],
            'particulars'    => $connectips_data['particulars'],
            'token'          => $connectips_data['token'],
            'created_date'   => date('Y-m-d H:i:s.v')
        ];

        /**
         * INSERT ESEWA PAYMENT TRANSACTION BUT NOT VERIFIED YET
         * 
         * */
        $payment_status = $this->VacancyModel->paymentInsertWithKey($insert_data);


        if ($payment_status)
        {

            echo json_encode($connectips_data);

        } else {

             return false;

        }
        
        
    }

    private function _generateTokenConnectIPS($data) {

        $string  = "MERCHANTID=".$data['merchant_id'].",APPID=".$data['app_id'].",APPNAME=".$data['app_name'].",TXNID=".$data['txn_id'].",TXNDATE=".$data['txn_date'].",TXNCRNCY=".$data['txn_currency'].",TXNAMT=".$data['txn_amount'].",REFERENCEID=".$data['reference_id'].",REMARKS=".$data['remarks'].",PARTICULARS=".$data['particulars'].",TOKEN=TOKEN";


        $hash = hash('sha256', $string);


        if (!$cert_store = file_get_contents("CREDITOR.pfx")) {
            echo "Error: Unable to read the cert file\n";
            exit;
        }


        if (openssl_pkcs12_read($cert_store, $cert_info, "123")) 
        {
           
            if($private_key = openssl_pkey_get_private($cert_info['pkey']))
            {
                $array = openssl_pkey_get_details($private_key);
                // print_r($array);
            }

        } else {

            echo "Error: Unable to read the cert store.\n";
            exit;

        }

        $hash = "";

        if (openssl_sign($string, $signature , $private_key, "sha256WithRSAEncryption"))
        {
           
            $hash = base64_encode($signature);
            openssl_free_key($private_key);

        } else {
            
            echo "Error: Unable openssl_sign";
            exit;

        } 

        return $hash;

    }

    /**
     * CONNECTIPS PAYMENT FAILED
     * 
     * */
    public function connectIpsFail()
    {
        sessionCheck();

        $userId       = ['id' => $this->userId];

        $data['user'] = $this->UserModel->getRows($userId);

        $txd_id       = $_GET['TXNID'];

        $data['meta'] = [
                            'title' => 'Vacancy Applied',
                            'Description' => 'vacancy Application has been submitted!'
                        ];

        $application  = $this->VacancyModel->applicationDetailsRow($userId);

        // echo "<pre>";

        // print_r($txd_id); die;

        /**
         *  FAILED DATA
         *  
         * 
         * */

        $update_data = [
                'payment_status' => 'failed',
            ];
        
        $this->VacancyModel->paymentUpdateWithKey('HRIS_REC_APPLICATION_PAYMENT', $update_data, 'PAYMENT_TRANSACTION_ID', $txd_id);

        // $payment_status = $this->VacancyModel->payment_insert($esewa);
        $this->load->view('templates/header', $data);
        $this->load->view('pages/payment/failed');
        $this->load->view('templates/footer');

        
    }


    public function saveTempPayment()
    {

        $application_id = $this->input->post('application_id');
        $token = $this->input->post('token');
        $txnID = $this->input->post('txnID');
        $connectIPSData = $this->input->post('details');

        $decodedConnectIPSData = json_decode(base64_decode($connectIPSData));

        // echo date('Y-m-d H:i:s.v', strtotime($decodedConnectIPSData->txn_date));

        // echo "<pre>";
        // echo 'Application_id :'. ' ' .$application_id. '\n';
        // echo print_r($token). '\n';
        // echo 'txn id :'. ' '.$txnID. '\n';
        // echo print_r($decodedConnectIPSData);
        // echo "</pre>";
        // die;

        // $data    = $this->input->post('id');
        // $amount  = $this->VacancyModel->getApplicationAmountpayment($data);

        // $m_id    = $this->config->item('connectips_merchant_id');
        // $appId   = $this->config->item('connectips_app_id');
        // $txn     = $this->config->item('connectips_txnId');
        // $txda    = $this->config->item('connectips_txn_date');
        // $txc     = $this->config->item('connectips_txncrncy');
        // $txa     = $amount;
        // $ref     = 'REF'.rand(0, 10000000);
        // $remarks = 'RMKS-00';
        // $par     = 'PART-001';
        
        // $string  = "MERCHANTID=$m_id,APPID=$appId,APPNAME=NOC Recruitment,TXNID=$txn,TXNDATE=$txda,TXNCRNCY=$txc,TXNAMT=$txa,REFERENCEID=$ref,REMARKS=$remarks,PARTICULARS=$par,TOKEN=TOKEN";

            // $hash = hash('sha256', $string);

            // if (!$cert_store = file_get_contents("CREDITOR.pfx")) {
            //     echo "Error: Unable to read the cert file\n";
            //     exit;
            // }

            // if (openssl_pkcs12_read($cert_store, $cert_info, "123")) {
            //     if($private_key = openssl_pkey_get_private($cert_info['pkey'])){
            //         $array = openssl_pkey_get_details($private_key);
            //         // print_r($array);
            //     }
            // } else {
            //     echo "Error: Unable to read the cert store.\n";
            //     exit;
            // }
            // $hash = "";
            // if(openssl_sign($string, $signature , $private_key, "sha256WithRSAEncryption")){
            //     $hash = base64_encode($signature);
            //     openssl_free_key($private_key);
            // } else {
            //     echo "Error: Unable openssl_sign";
            //     exit;
        // } 

        // $ips= [
        //     'm_id' => $m_id,
        //     'a_id' => $appId,
        //     'txn' => $txn,
        //     'txa' => $txa,
        //     'txda' => $txda,
        //     'txc' => $txc,
        //     'ref' => $ref,
        //     'remarks' => $remarks,
        //     'par' => $par,
        //     'token' => $hash,
        // ];

        $paymentId   = $this->VacancyModel->getMaxIds('Id','HRIS_REC_TEMP_PAYMENT');

        // insertTempPayment
        $payment['details'] = array(                     
            'ID'    => (isset($paymentId)) ? $paymentId['MAXID'] + 1 : 1,
            'APPLICATION_ID' => $application_id,
            'MERCHANT_ID' => $decodedConnectIPSData->merchant_id,
            'APP_ID' => $decodedConnectIPSData->app_id,
            'APP_NAME' => $decodedConnectIPSData->app_name,
            'TXN_ID' => $txnID,
            'TXN_DATE' => date('Y-m-d', strtotime($decodedConnectIPSData->txn_date)),
            'TXN_CUR'=> $decodedConnectIPSData->txn_cur,
            'AMOUNT'=> $decodedConnectIPSData->txn_amt,
            'REFERENCE_ID'=> $decodedConnectIPSData->referenceId,
            'REMARKS'=> $decodedConnectIPSData->remarks,
            'PARTICULARS'=> $decodedConnectIPSData->particulars,
            'TOKEN'=> $token,
            'STATUS' => 'processing',
            'STATUSDESC'=> '',
            'CREATED_DT'=> $decodedConnectIPSData->created_datetime,
            'MODIFIED_DT'=> '',
        );
        
        $this->VacancyModel->insertTempPayment($payment);

        // echo json_encode($ips);
        return true;
    }


    /**
     *  ESEWA PAYMENT SUCCESS
     * 
     *  url:
     *  /vacancy/payment_success?q=su&oid=wDglrG6KRcZvifM9aid5vid3&amt=900.0&refId=0001VBM
     * 
     * */

    public function payment_success()
    {
        sessionCheck();
        /*
         * CHECKING QUERY STRING AFTER RETURNING PAYMENT SUCCESS
         *
         */
        if (($this->isUserLoggedIn) && ($_GET['refId'] != '') && ($_GET['amt'] != '') && ($_GET['oid'] != '')) 
        {

            $userId       = ['id' => $this->session->userdata('userId')];

            /*
             * GETTING APPLICANT USER DETAIL 
             * 
             */
            $data['user'] = $this->UserModel->getRows($userId);

            $data['meta'] = [
                                'title' => 'Vacancy Applied',
                                'Description' => 'vacancy Application has been submitted!'
                            ];

            if(isset($_GET['oid']))
            {
                /*
                 * GETTING MAX ROW COUNT OF TABLE 
                 *
                 */
                $paymentId = $this->VacancyModel->getMaxIds('PAYMENT_ID','HRIS_REC_APPLICATION_PAYMENT');

                // GET PAYMENT GATEWAY ID
                $gatewayId = $this->VacancyModel->fetchAllOrRowSelectWhere('HRIS_REC_PAYMENT_GATEWAY', 'ID', 'GATEWAY_COMPANY', 'esewa', 'row_array');

                
                /*
                 * GETTING OID QUERY STRING VALUE 
                 * [invoice_id / payment_id + application id + vacancy id]
                 *
                 */
                $oid = urldecode($_GET['oid']);
                $aid = preg_replace( "/vid.?.?.?./", "", $oid );
        
                $application_id = preg_replace( "#^[^:/.]*[:aid]+#i", "", $aid );  //UXzlaP5uCe6LKpBgaid1vid1
                $vacancy_id     = preg_replace( "#^[^:/.]*[:vid]+#i", "", $oid);

                
                $esewa = [
                    'payment_id'     => $paymentId['MAXID'] + 1,
                    'application_id' => $application_id,
                    'user_id'        => $this->session->userdata('userId'),
                    'vacancy_id'     => $vacancy_id, 
                    // 'payment_type' => 'esewa',
                    'payment_gateway_id' => $gatewayId['ID'],
                    'payment_amount' => $_GET['amt'],
                    'payment_transaction_id' => $_GET['oid'],
                    'payment_reference_id'   => $_GET['refId'],
                    'status'         => '1',
                    'payment_paid'   => 'Y',
                    // 'payment_status' => 'Completed',
                    'created_date'   => date('Y-m-d H:i:s.v')
                ];

                /**
                 * INSERT ESEWA PAYMENT TRANSACTION BUT NOT VERIFIED YET
                 * 
                 * */
                $payment_status = $this->VacancyModel->paymentInsertWithKey($esewa);

                /**
                 * UPDATING APPLICATION PAYMENT TRANSACTION PAID BUT NOT VERIFIED YET
                 * */
                $update_unverify = $this->VacancyModel->paymentUpdateWithKey('HRIS_REC_VACANCY_APPLICATION', 
                                                                            ['PAYMENT_ID' => $esewa['payment_id'], 'PAYMENT_PAID' => 'Y'], 
                                                                            'APPLICATION_ID', $application_id);


                if ($update_unverify)
                {

                    /**
                     *  VERIFYING TRANSACTION VIA ESEWA
                     * 
                     * */
                    $verifyTransactionUrl = $this->config->item('esewa_verify_transaction');
                    
                    $verifyData =[
                        'amt'=> $_GET['amt'],
                        'rid'=> $_GET['refId'],
                        'pid'=> $_GET['oid'],
                        'scd'=> $this->config->item('esewa_merchant_id')
                    ];


                    /**
                     *  REQUESTIN VIA CURL PROCESS
                     * 
                     * */
                    $curl = curl_init($verifyTransactionUrl);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $verifyData);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    // ----- THIS BELOW LINE IS FOR LOCALHOST ONLY ----
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    // ----- THIS ABOVE LINE IS FOR LOCALHOST ONLY ----
                    $response = curl_exec($curl);
                    curl_close($curl);

                    $response_code = $this->get_xml_node_value('response_code', $response);

                    if ($response_code == 'Success')
                    {
                        $update_data  = [
                                    'payment_status' => $response_code,
                                    'payment_verified' => 'Y',
                                    'payment_verified_date' => date('Y-m-d H:i:s.v')
                                ];

                        // $payment_status = $this->VacancyModel->paymentInsertWithKey($esewa);

                        $update = $this->VacancyModel->paymentUpdateWithKey('HRIS_REC_APPLICATION_PAYMENT', $update_data, 'PAYMENT_TRANSACTION_ID', $_GET['oid']);

                        if ($update)
                        {
                            // UPDATING APPLICANT PAYMENT_STATUS IN HRIS_REC_VACANCY_APPLICATION
                            $updata = ['payment_verified' => 'Y'];

                            $this->VacancyModel->paymentUpdateWithKey('HRIS_REC_VACANCY_APPLICATION', $updata, 'APPLICATION_ID', $application_id);
                            

                            $this->load->view('templates/header', $data);
                            $this->load->view('pages/payment/success', $esewa);
                            $this->load->view('templates/footer');

                        } else {

                            $this->load->view('templates/header', $data);
                            $this->load->view('pages/payment/success_unverify', $esewa);
                            $this->load->view('templates/footer');

                        }


                    } else {

                        $this->load->view('templates/header', $data);
                        $this->load->view('pages/payment/success_unverify', $esewa);
                        $this->load->view('templates/footer');

                    }

                }

                // $this->session->set_flashdata('error_msg',"Please pay the amount first.");
                // redirect('vacancy/vacancylist');

            } else {

                $this->session->set_flashdata('error_msg',"Please pay the amount first.");
                redirect('vacancy/vacancylist');
            }

        } else {

            redirect('users/login');

        }
    }

    /**
     * REMOVING XML TAG RETURN AFTER CURL PROCESS AND RETURNING ONLY STRING VALUE
     * */

    private function get_xml_node_value($node, $xml) {
    
        if ($xml == false) {
            return false;
        }
        
        $found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.'</'.$node.'>#s', $xml, $matches);
        if($found != false) {
            return trim($matches[1]);
        }
        return false;
        
    }

    /**
     *  ESEWA PAYMENT FAILED / CANCELLED
     * 
     *  url:
     *  
     *  /vacancy/payment_failed?q=fu
     * 
     * */

    public function payment_failed()
    {
        sessionCheck();

        $userId       = ['id' => $this->session->userdata('userId')];

        $data['user'] = $this->UserModel->getRows($userId);

        $paymentId    = $this->VacancyModel->getMaxIds('PAYMENT_ID','HRIS_REC_APPLICATION_PAYMENT');
        $application  = $this->VacancyModel->applicationDetailsRow($userId);
        // GET PAYMENT GATEWAY ID
        $gatewayId = $this->VacancyModel->fetchAllOrRowSelectWhere('HRIS_REC_PAYMENT_GATEWAY', 'ID', 'GATEWAY_COMPANY', 'esewa', 'row_array');


        /**
         *  fu refer as failed payment return
         *  
         *  failed payment will not return PAYMENT_OID and PAYMENT_REFID so use 'fu' as value
         * 
         *  status [0 - failed   1 - success] check HRIS_REC_APPLICATION_PAYMENT
         * 
         * */
        $esewa = [
            'payment_id'     => $paymentId['MAXID'] + 1,
            'application_id' => $application['APPLICATION_ID'],
            'user_id'        => $this->session->userdata('userId'),
            'vacancy_id'     => $application['VACANCY_ID'], 
            'payment_type'   => 'esewa',
            'payment_gateway_id' => $gatewayId['ID'],
            'payment_amount' => $application['APPLICATION_AMOUNT'],
            'payment_status' => 'cancelled',
            'created_date'   => date('Y-m-d H:i:s.v')
        ];

        $payment_status = $this->VacancyModel->paymentInsertWithKey($esewa);
        $this->load->view('templates/header', $data);
        $this->load->view('pages/payment/failed');
        $this->load->view('templates/footer');

    }   


    /**
     *  KHALTI PAYMENT RETURNS AFTER SUCCESS
     *  
     *  vacancy/khalti_return_success?pidx=iYavUyGWcRqKqjajEGfAND&txnId=JYZrxypPWVzqpGpGcDw6wL&amount=1100&mobile=98XXXXX000&purchase_order_id=32021664523936&purchase_order_name=Neo%20Software&transaction_id=JYZrxypPWVzqpGpGcDw6wL
     *  
     * */
    public function khalti_return_success()
    {

        if ($this->isUserLoggedIn) 
        {

            $userId = ['id' => $this->session->userdata('userId')];
            
            /**
             *  RESPONSE QUERY VIA KHALTI
             * */
            $data = [
                'pidx' => $_GET['pidx'],
                'txnId' => $_GET['txnId'],
                'amount' => $_GET['amount'],
                'user_mobile' => $_GET['mobile'],
                'purchase_order_id' => $_GET['purchase_order_id'],
                'purchase_order_name' => $_GET['purchase_order_name'],
                'transaction_id' => $_GET['transaction_id'],
            ];


            // GET PIDX RELATED ROW
            $transaction_detail = $this->VacancyModel->fetchAllOrRowSelectWhere('HRIS_REC_APPLICATION_PAYMENT', '', 'PAYMENT_UNIQUE_ID', $data['pidx'], 'row_array');

            /** ---INSERT DATA PAYMENT MADE BUT NOT VERIFIED YET ---- */

            $this->VacancyModel->paymentUpdateWithKey('HRIS_REC_APPLICATION_PAYMENT', 
                                                     ['STATUS' => 1, 'PAYMENT_PAID' => 'Y'], 
                                                     'PAYMENT_UNIQUE_ID', $transaction_detail['pidx']);

            $this->VacancyModel->paymentUpdateWithKey('HRIS_REC_VACANCY_APPLICATION', 
                                                      ['PAYMENT_ID' => $transaction_detail['PAYMENT_ID'], 'PAYMENT_PAID' => 'Y' ], 
                                                      'APPLICATION_ID', $transaction_detail['APPLICATION_ID']);

            /** ---INSERT DATA PAYMENT MADE BUT NOT VERIFIED YET ---- */
            

            if ($this->khalti::lookup($data)) 
            {
                
                $data['message'] = 'Payment Verified';

            } else {
                
                $data['message'] = 'Payment Unverified';

            }


            $data = [
                'user' => $this->UserModel->getRows($userId),
                'meta' =>  [
                            'title' => 'Vacancy Applied',
                            'Description' => 'vacancy Application has been submitted!'
                           ],
                'payment_amount' => ($_GET['amount'] / 100),
                'payment_transaction_id' => $_GET['transaction_id'],
                'payment_reference_id' => $_GET['pidx'],

            ];

            $this->load->view('templates/header', $data);
            $this->load->view('pages/payment/success', $data);
            $this->load->view('templates/footer');
            // {"pidx":"n94AqvwFm9TcFSxunyjTLM","payment_url":"https://test-pay.khalti.com/?pidx=n94AqvwFm9TcFSxunyjTLM"}

        } else {

            redirect('users/login');

        }
    }







    public function apply()
    {
        $vid = base64_decode($this->uri->segment('3'));

        $userRegistred = $this->UserModel->userRegistred($this->session->userdata('userId'));
        // $userApplied = $this->UserModel->userApplied($this->session->userdata('userId'));
        if($userRegistred == false)
        {
            $this->session->set_flashdata('msg', 'You have not registred yet! Please register to apply.');
            redirect('users/registration');
        }
        if ($this->isUserLoggedIn) {

            $con = array(
                'id' => $this->session->userdata('userId')
            );

            // Check if already applied to this vacancy.
            if ($this->VacancyModel->checkapplied($vid, $this->session->userdata('userId')) == true) 
            {
                $this->session->set_flashdata('msg', 'You have already Applied to this vacancy! Please edit to update.');
                redirect('vacancy/vacancylist');
            }
            
            if ($this->input->post('applySubmit')) {
                // echo '<pre>'; print_r($_FILES); 
                // echo '<pre>'; print_r($_POST); die;
                $vid     = base64_decode($this->uri->segment('3'));
                $appId   = $this->VacancyModel->getMaxIds('APPLICATION_ID','HRIS_REC_VACANCY_APPLICATION');
                $perId   = $this->VacancyModel->getMaxIds('PERSONAL_ID','HRIS_REC_APPLICATION_PERSONAL');
                $eduId   = $this->VacancyModel->getMaxIds('EDUCATION_ID','HRIS_REC_APPLICATION_EDUCATION');
                $expId   = $this->VacancyModel->getMaxIds('EXPERIENCE_ID','HRIS_REC_APPLICATION_EXPERIENCES');
                $trngId  = $this->VacancyModel->getMaxIds('TRAINING_ID','HRIS_REC_APPLICATION_TRAININGS');
                // A. Detail regarding the application
                $application['details'] = array(                     
                    'APPLICATION_ID'    => $appId['MAXID'] + 1,
                    'USER_ID'           => $this->session->userdata('userId'),
                    'AD_NO'             => $this->input->post('vacancy_id'),
                    'REGISTRATION_NO'   => $this->input->post('registration_no'),
                    'STAGE_ID'          => '2', // 2 = Pending
                    'APPLICATION_AMOUNT' => strip_tags($this->input->post('inclusion_amount')),
                    'STATUS'            => 'D',
                    'CREATED_DATE'        => date('Y-m-d'),
                    'MODIFIED_DATE'       => '',
                    'REMARKS'           => '',
                    'APPLICATION_TYPE' => 'OPEN'
                );
                $Appskills = $this->input->post('skills');
                $inclusionIds = $this->input->post('inclusion');
                if(!empty($Appskills)){
                    foreach($Appskills as $skills){
                        $appSkill[] =  ($skills);                        
                    }
                }else{
                    $appSkill[] = '';
                }
                $appSkill = implode(',',$appSkill);
                if(!empty($inclusionIds)){
                    foreach($inclusionIds as $inclusionId){
                        $appInclusionIds[] =  ($inclusionId);                        
                    }
                }else{
                    $appInclusionIds[] = '';
                }
                $appInclusionIds = implode(',',$appInclusionIds);
                // echo '<pre>'; print_r($appInclusionIds); die;
                $application['personal'] = array(
                    'PERSONAL_ID'       => $perId['MAXID'] + 1,
                    'APPLICATION_ID'    => $appId['MAXID'] + 1,
                    'USER_ID'           => $this->session->userdata('userId'),                  
                    'SKILL_ID'          => $appSkill,
                    'INCLUSION_ID'      => $appInclusionIds,
                    'MAX_QUALIFICATION_ID' => $this->input->post('max_education'),
                    'STATUS'            => 'E',
                    'CREATED_DATE'        => date('Y-m-d'),
                    'MODIFIED_DATE'       => NULL,       
                    'ROLL_NO'             => Null,          
                );
                // echo '<pre>'; print_r($application['personal']); die;
                    $data['edu_institute']  = $this->input->post('edu_institute');
                    $data['level_id']       = $this->input->post('level_id');
                    $data['facalty']        = $this->input->post('facalty');
                    $data['rank_type']      = $this->input->post('rank_type');
                    $data['rank_value']     = $this->input->post('rank_value');
                    $data['major_subject']  = $this->input->post('major_subject');
                    $data['passed_year']    = $this->input->post('passed_year');
                    $data['university_board'] = $this->input->post('university_board');

                $application['education'] = [];
                for ($i = 0; $i < count($data['edu_institute']); $i++) {
                    $application['education'][$i]['EDUCATION_ID']          = $eduId['MAXID'] + 1 + $i;
                    $application['education'][$i]['APPLICATION_ID']        = $appId['MAXID'] + 1;
                    $application['education'][$i]['USER_ID']               = $this->session->userdata('userId');
                    $application['education'][$i]['AD_NO']                 = $this->input->post('vacancy_id');
                    $application['education'][$i]['EDUCATION_INSTITUTE']   = $data['edu_institute'][$i];
                    $application['education'][$i]['LEVEL_ID']              = $data['level_id'][$i];
                    $application['education'][$i]['FACALTY']               = $data['facalty'][$i];
                    $application['education'][$i]['RANK_TYPE']             = $data['rank_type'][$i];
                    $application['education'][$i]['RANK_VALUE']            = $data['rank_value'][$i];
                    $application['education'][$i]['MAJOR_SUBJECT']         = $data['major_subject'][$i];
                    $application['education'][$i]['PASSED_YEAR']           = $data['passed_year'][$i];
                    $application['education'][$i]['STATUS']                = 'E';
                    $application['education'][$i]['CREATED_DATE']            = date('Y-m-d');
                    $application['education'][$i]['MODIFIED_DATE']           = NULL;
                    $application['education'][$i]['UNIVERSITY_BOARD']      = $data['university_board'][$i];
                    
                };
                $application['experience'] = [];
                    $data['org_name'] = $this->input->post('org_name');
                    $data['post_name'] = $this->input->post('post_name');
                    $data['service_name'] = $this->input->post('service_name');
                    $data['org_level'] = $this->input->post('org_level');
                    $data['employee_type'] = $this->input->post('employee_type');
                    $data['from_date'] = $this->input->post('from_date');
                    $data['to_date'] = $this->input->post('to_date');
                    if(!empty($data['org_name'])){
                        for ($i = 0; $i < count($data['org_name']); $i++) {
                            if(isset($data['org_name'])){
                                $application['experience'][$i]['EXPERIENCE_ID']        = $expId['MAXID'] + 1 + $i;
                                $application['experience'][$i]['APPLICATION_ID']       = $appId['MAXID'] + 1;
                                $application['experience'][$i]['USER_ID']              = $this->session->userdata('userId');
                                $application['experience'][$i]['ORGANISATION_NAME']    = $data['org_name'][$i];
                                $application['experience'][$i]['POST_NAME']            = $data['post_name'][$i];
                                $application['experience'][$i]['SERVICE_NAME']         = $data['service_name'][$i];
                                $application['experience'][$i]['LEVEL_ID']             = $data['org_level'][$i];
                                $application['experience'][$i]['EMPLOYEE_TYPE_ID']     = $data['employee_type'][$i];
                                $application['experience'][$i]['FROM_DATE']            = $data['from_date'][$i];
                                $application['experience'][$i]['TO_DATE']              = $data['to_date'][$i];
                                $application['experience'][$i]['STATUS']                = 'E';
                                $application['experience'][$i]['CREATED_DATE']            = date('Y-m-d');
                                $application['experience'][$i]['MODIFIED_DATE']           = NULL;
                            }                    
                        }
                    }                   
                    $application['training'] = [];
                    $data['training_name'] = $this->input->post('training_name');
                    $data['certificate'] = $this->input->post('certificate');
                    $data['tr_from_date'] = $this->input->post('tr_from_date');
                    $data['tr_to_date'] = $this->input->post('tr_to_date');

                    $data['employee_type'] = $this->input->post('employee_type');
                    $data['description'] = $this->input->post('description');
                    // $time = strtotime($data['tr_from_date']);
                    // $date = DateTime::createFromFormat('d/m/Y', "24/04/2012");    
                    // echo '<pre>'; var_dump($data); die;    +       
                    if(!empty($data['training_name'])){
                        for ($i = 0; $i < count($data['training_name']); $i++) {
                            if(isset($data['training_name'])){
                                $application['training'][$i]['TRAINING_ID']             = $trngId['MAXID'] + 1 + $i;
                                $application['training'][$i]['APPLICATION_ID']          = $appId['MAXID'] + 1;
                                $application['training'][$i]['USER_ID']                 = $this->session->userdata('userId');
                                $application['training'][$i]['TRAINING_NAME']           = $data['training_name'][$i];
                                $application['training'][$i]['CERTIFICATE']             = $data['certificate'][$i];
                                $application['training'][$i]['FROM_DATE']               = date("Y-m-d", strtotime($data['tr_from_date'][$i]));
                                $application['training'][$i]['TO_DATE']                 = date("Y-m-d", strtotime($data['tr_to_date'][$i]));
                                $application['training'][$i]['TOTAL_DAYS']              = ((strtotime($data['tr_to_date'][$i]) - strtotime($data['tr_from_date'][$i])) / 60 / 60 / 24);
                                $application['training'][$i]['DESCRIPTION']             = $data['description'][$i];
                                $application['training'][$i]['STATUS']                  = 'E';
                                $application['training'][$i]['CREATED_DATE']            = date('Y-m-d');
                                $application['training'][$i]['MODIFIED_DATE']             = NULL;
                            }                   
                        }
                    }
                    
                // echo '<pre>'; print_r($application); die;
                // Inserting Folder Names                
                if ($this->form_validation->run('noc_apply_form') == true) {



                    $insert_info = $this->VacancyModel->insert($application);


                    $insert_info = true;
                    if ($insert_info)
                    {
                        // Inserting Folder Names
                        $_FILES['nagrita_front']['folders'] = 'nagrita_front';
                        $_FILES['nagrita_back']['folders'] = 'nagrita_back';
                        $_FILES['recent_photo']['folders'] = 'photograph';
                        $_FILES['signature']['folders'] = 'signature';
                        $_FILES['right_finger_scan']['folders'] = 'fingerright';
                        $_FILES['left_finger_scan']['folders'] = 'fingerleft';
                        // Inserting input Names - for indivisual function upload:
                        $_FILES['nagrita_front']['input_names'] = 'nagrita_front';
                        $_FILES['nagrita_back']['input_names'] = 'nagrita_back';
                        $_FILES['recent_photo']['input_names'] = 'recent_photo';
                        $_FILES['signature']['input_names'] = 'signature';
                        $_FILES['right_finger_scan']['input_names'] = 'right_finger_scan';
                        $_FILES['left_finger_scan']['input_names'] = 'left_finger_scan';
                        $list = $_FILES;
                        $nagF = array_search('nagrita_front', array_keys($list));
                        $nagL = array_search('left_finger_scan', array_keys($list));
                        $fileCount = count($_FILES);                       
                        if($nagF != 0){
                            for($i=0; $i < $nagF; $i++){
                                $_FILES[array_keys($_FILES)[$i]]['folders'] = 'skills';
                                $_FILES[array_keys($_FILES)[$i]]['input_names'] = array_keys($_FILES)[$i];
                            }                            
                        }
                        for($i= $nagL+1; $i < $fileCount; $i++){
                            $_FILES[array_keys($_FILES)[$i]]['folders'] = 'certificates';
                            $_FILES[array_keys($_FILES)[$i]]['input_names'] = array_keys($_FILES)[$i];
                        }   
                        $files = array_chunk($_FILES,1);
                        // $imageCerts = [];
                        // echo '<pre>'; print_r($files); die;
                        if(!empty($files))
                        {              
                            foreach($files as $key=>$uploadfile){
                                    
                                $folderName = $uploadfile[0]['folders'];
                                
                                    if(is_array($folderName)){
                                        $folder_name    = $uploadfile[0]['folders'][0]; 
                                    }else{
                                        $folder_name    = $uploadfile[0]['folders']; 
                                    }
                                    $InputName = $uploadfile[0]['input_names'];
                                    if(is_array($InputName)){
                                        $input_name    = $uploadfile[0]['input_names'][0]; 
                                    }else{
                                        $input_name    = $uploadfile[0]['input_names']; 
                                    }                                                                                             
                                    $upload_fun = $this->file_upload($input_name,$folder_name,$appId,$vid);
                               
                            }
                        } 
                    }
                    redirect('vacancy/apply_success');
                } else {
                    echo 'validation error';
                    $data['error_msg'] = 'Please fill all the mandatory fields.';
                    redirect('vacancy/vacancylist');
                }
            }
            $uid = $this->session->userdata('userId');
            $maxRegId = $this->VacancyModel->getMaxIdapplication($vid);
            $RegId = $this->VacancyModel->registerId($uid);
            $data['vacancylists'] = $this->VacancyModel->fetchVacancyById($vid);
            $data['vacancylists'][0]['maxregId'] = $maxRegId['MAXID'];
            $data['options'] = $this->VacancyModel->options($vid);
            $data['proviences'] = $this->VacancyModel->fetch_provience();
            $data['districts'] = $this->VacancyModel->districts();
            $data['degrees'] = $this->VacancyModel->degree();
            $data['faculties'] =$this->VacancyModel->faculty();
            // echo '<pre>'; print_r($data); 
            $data['majors'] = $this->VacancyModel->major();
            $data['univs'] = $this->VacancyModel->universities();

            $data['divisions'] = $this->VacancyModel->division();
            $data['user_details'] = $this->UserModel->user($uid);
            $data['certificates'] = $this->VacancyModel->academicDegree($data['vacancylists'][0]['ACADEMIC_DEGREE_CODE']);
            $incData = array(); 
            $data['inclusions'] = [];
            // var_dump($data['vacancylists'][0]['INCLUSION_ID']); die;
            if ($data['vacancylists'][0]['INCLUSION_ID'] != NUll) {
                $inclusions = $data['vacancylists'][0]['INCLUSION_ID'];
                $inclusions = explode(',' , $inclusions);
                foreach($inclusions as $inclusion){
                    $incData[] = $this->VacancyModel->fetchinclusions($inclusion);
                }
                $data['inclusions'] = $incData;
            }       
            
            $data['registration_no']  = ($this->VacancyModel->fetchvacancyByAdNo('HRIS_REC_VACANCY_APPLICATION',$vid)) + 1;
            if (isset($RegId['MAXID'])) {
                $data['details'] = $this->VacancyModel->registerdata($vid, $RegId['MAXID']);
            }
            // var_dump($inclusions); die;
            if ($data['vacancylists'][0]['SKILL_ID'] != NUll) {
                $skills = explode(',', $data['vacancylists'][0]['SKILL_ID']);
                foreach($skills as $skill){
                    $aa[] = $this->VacancyModel->fetchSkills($skill);            
                }
                $data['vacancylists'][0]['SKILL_ID'] = $aa; 
            }
            // echo '<pre>';print_r($data['vacancylists']); die;

            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Apply',
                'Description' => 'Apply for vacancy'
            );
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply/apply', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }

    public function edit()
    {
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            if($this->input->post('applyedit')){
                // echo '<pre>'; print_r($_POST); die;
                $uid = $this->session->userdata('userId');
                $data['details'] = array(
                    'application_amount'  => strip_tags($this->input->post('inclusion_amount')),
                );
                // Skills
                $Appskills = $this->input->post('skills');
                if(!empty($Appskills)){
                    foreach($Appskills as $skills){
                        $appSkill[] =  ($skills);                        
                    }
                }else{
                    $appSkill[] = '';
                }
                $AppsIncs = $this->input->post('inclusion_id');
                if(!empty($AppsIncs)){
                    foreach($AppsIncs as $AppsInc){
                        $appInclusion[] =  ($AppsInc);                        
                    }
                }else{
                    $appInclusion[] = '';
                }
                $appSkill = implode(',',$appSkill);
                $appInclusions = implode(',',$appInclusion);
                $data['personal'] = array(
                    'skill_id'          => $appSkill,
                    'inclusion_id'      => $appInclusions,
                    'modified_date'     => date('Y-m-d')
                );
                // echo '<pre>'; print_r(($data)); die;
                $data['education_id']   = $this->input->post('education_id');
                $data['edu_institute']  = $this->input->post('edu_institute');
                $data['level_id']       = $this->input->post('level_id');
                $data['facalty']        = $this->input->post('facalty');
                $data['rank_type']      = $this->input->post('rank_type');
                $data['rank_value']     = $this->input->post('rank_value');
                $data['major_subject']  = $this->input->post('major_subject');
                $data['passed_year']    = $this->input->post('passed_year');
                $data['university_board'] = $this->input->post('university_board');
                $eduId   = $this->VacancyModel->getMaxIds('EDUCATION_ID','HRIS_REC_APPLICATION_EDUCATION');               
                $data['educations'] = [];
                for($i=0; $i < count($data['edu_institute']); $i++)
                    {
                        $data['educations'][$i]['education_id']        = (!empty($data['education_id'][$i])) ? ($data['education_id'][$i]) : ($eduId['MAXID'] + 1);
                        if(empty($data['education_id'][$i]))
                        {
                            $data['educations'][$i]['application_id']        = $this->input->post('application_id');
                            $data['educations'][$i]['user_id']               = $this->session->userdata('userId');
                            $data['educations'][$i]['ad_no']                 = $this->input->post('vacancy_id');
                        }
                        $data['educations'][$i]['education_institute'] = $data['edu_institute'][$i];
                        $data['educations'][$i]['level_id']            = $data['level_id'][$i];
                        $data['educations'][$i]['facalty']             = $data['facalty'][$i];
                        $data['educations'][$i]['rank_type']           = $data['rank_type'][$i];
                        $data['educations'][$i]['rank_value']          = $data['rank_value'][$i];
                        $data['educations'][$i]['major_subject']       = $data['major_subject'][$i];
                        $data['educations'][$i]['passed_year']         = $data['passed_year'][$i];
                        $data['educations'][$i]['university_board']    = $data['university_board'][$i];
                    }
                // Experience
                $data['experience_id']  = $this->input->post('experience_id');
                $data['org_name']       = $this->input->post('org_name');
                $data['post_name']      = $this->input->post('post_name');
                $data['service_name']   = $this->input->post('service_name');
                $data['org_level']      = $this->input->post('org_level');
                $data['employee_type']  = $this->input->post('employee_type');
                $data['from_date']      = $this->input->post('from_date');
                $data['to_date']        = $this->input->post('to_date');
                $expId   = $this->VacancyModel->getMaxIds('EXPERIENCE_ID','HRIS_REC_APPLICATION_EXPERIENCES');
                $data['experiences'] = [];
                if(isset($data['org_name'])) {
                    for($i=0; $i < count($data['org_name']); $i++)
                    {
                        $data['experiences'][$i]['experience_id']        = (!empty($data['experience_id'][$i])) ? ($data['experience_id'][$i]) : ($expId['MAXID'] + 1);
                        
                        if(empty($data['experience_id'][$i]))
                        {
                            $data['experiences'][$i]['application_id']        = $this->input->post('application_id');
                            $data['experiences'][$i]['user_id']               = $this->session->userdata('userId');
                        }
                        // $data['experiences'][$i]['experience_id']     = $data['experience_id'][$i];
                        $data['experiences'][$i]['organisation_name'] = $data['org_name'][$i];
                        $data['experiences'][$i]['post_name']         = $data['post_name'][$i];
                        $data['experiences'][$i]['service_name']      = $data['service_name'][$i];
                        $data['experiences'][$i]['level_id']          = $data['org_level'][$i];
                        $data['experiences'][$i]['employee_type_id']  = $data['employee_type'][$i];
                        $data['experiences'][$i]['from_date']         = $data['from_date'][$i];
                        $data['experiences'][$i]['to_date']           = $data['to_date'][$i];
                    }
                }                
                    // echo '<pre>'; print_r($data['experiences']); die;
                // Training
                $data['training_id']    = $this->input->post('training_id');
                $data['training_name']  = $this->input->post('training_name');
                $data['certificate']    = $this->input->post('certificate');
                $data['tr_from_date']   = $this->input->post('tr_from_date');
                $data['tr_to_date']     = $this->input->post('tr_to_date');
                $data['period']         = $this->input->post('period');
                $data['description']    = $this->input->post('description');
                $trnId   = $this->VacancyModel->getMaxIds('TRAINING_ID','HRIS_REC_APPLICATION_TRAININGS');
                $data['trainings'] = [];
                if(isset($data['training_name'])){
                    for($i=0; $i < count($data['training_name']); $i++)
                    {
                        $data['trainings'][$i]['training_id']  = (!empty($data['training_id'][$i])) ? ($data['training_id'][$i]) : ($trnId['MAXID'] + 1);
                        
                        if(empty($data['training_id'][$i]))
                        {
                            $data['trainings'][$i]['application_id']        = $this->input->post('application_id');
                            $data['trainings'][$i]['user_id']               = $this->session->userdata('userId');
                        }
                        $data['trainings'][$i]['training_id']   = $data['training_id'][$i];
                        $data['trainings'][$i]['training_name'] = $data['training_name'][$i];
                        $data['trainings'][$i]['certificate']   = $data['certificate'][$i];
                        $data['trainings'][$i]['from_date']     = $data['tr_from_date'][$i];
                        $data['trainings'][$i]['to_date']       = $data['tr_to_date'][$i];
                        $data['trainings'][$i]['total_days']    = $data['period'][$i];
                        $data['trainings'][$i]['description']   = $data['description'][$i];
                    }
                }
                
                $appId = $this->input->post('application_id');
                $vid = $this->input->post('vacancy_id');
                $update = $this->VacancyModel->updateapplication($data,$uid,$appId);
                // $update = true;
                if($update == true){
                    // echo '<pre>'; print_r($_FILES); die;
                    $files = $_FILES;
                    $doc_id = $this->input->post('doc_id[]');
                    $skill_id = $this->input->post('skill_id[]');
                    $certificates_id = $this->input->post('certificates_id[]');
                    $nagF = array_search('nagrita_front1', array_keys($files));   // nagF = Nagrita document first index
                    $nagL = array_search('left_finger_scan1', array_keys($files));   // nagL = Finger document Last index
                    $fileCount = count($files);
                    // echo '<pre>'; print_r($files); die;
                    if($files)
                    {
                        if($nagF != 0){
                            for($i=0; $i < $nagF; $i++){
                                if(!empty($skill_id[$i])){
                                    $files[array_keys($_FILES)[$i]]['skill_id'] = $skill_id[$i];
                                }                               
                                $files[array_keys($_FILES)[$i]]['folders'] = 'skills';
                                $files[array_keys($_FILES)[$i]]['input_names'] = array_keys($_FILES)[$i];
                            }                            
                        }
                        $certArray = 0;
                            for($i= $nagL+1; $i < $fileCount; $i++){
                                if(!empty($certificates_id[$certArray])){
                                    $files[array_keys($_FILES)[$i]]['certificates_id'] = $certificates_id[$certArray];
                                } 
                                $files[array_keys($_FILES)[$i]]['folders'] = 'certificates';
                                $files[array_keys($_FILES)[$i]]['input_names'] = array_keys($_FILES)[$i];
                                $certArray++;
                            }
                        // if()  
                            // Inserting Document Id to identify files to update
                            $files['nagrita_front1']['doc_id'] = $this->input->post('doc_id[0]');
                            $files['nagrita_back1']['doc_id'] = $this->input->post('doc_id[1]');
                            $files['recent_photo1']['doc_id'] = $this->input->post('doc_id[2]');
                            $files['signature1']['doc_id'] = $this->input->post('doc_id[3]');
                            $files['right_finger_scan1']['doc_id'] = $this->input->post('doc_id[4]');
                            $files['left_finger_scan1']['doc_id'] = $this->input->post('doc_id[5]');
                            // Inserting Folder name
                            $files['nagrita_front1']['folders'] = 'nagrita_front';
                            $files['nagrita_back1']['folders'] = 'nagrita_back';
                            $files['recent_photo1']['folders'] = 'photograph';
                            $files['signature1']['folders'] = 'signature';
                            $files['right_finger_scan1']['folders'] = 'fingerright';
                            $files['left_finger_scan1']['folders'] = 'fingerleft';
                            //Input Names
                            $files['nagrita_front1']['input_names'] = 'nagrita_front1';
                            $files['nagrita_back1']['input_names'] = 'nagrita_back1';
                            $files['recent_photo1']['input_names'] = 'recent_photo1';
                            $files['signature1']['input_names'] = 'signature1';
                            $files['right_finger_scan1']['input_names'] = 'right_finger_scan1';
                            $files['left_finger_scan1']['input_names'] = 'left_finger_scan1';
                            // echo '<pre>'; print_r($files); die;
                        foreach($files as $file)
                        {
                            if($file['error'] == 0 && $file['tmp_name'] != '')
                            {
                                if(!isset($files['skill_id'])){
                                    $upload_fun = $this->file_upload($file['input_names'],$file['folders'],$appId,$vid);
                                }else{
                                    $update_files = $this->file_update($file);
                                }                                
                            }   
                        }
                    }
                    $this->session->set_flashdata('msg', 'Your Application has been updated!');
                    redirect('vacancy/vacancylist'); 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                }
            }
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Edit',
                'Description' => 'Vacancy Edit'
            );
            $vid                            =  base64_decode($this->uri->segment('3'));
            $uid                            = $this->session->userdata('userId');
            $maxRegId                       = $this->VacancyModel->getMaxIdapplication($vid);
            $data['vacancylists']           = $this->VacancyModel->fetchVacancyById($vid);
            // echo '<pre>';print_r($data['vacancylists']); die;
            $data['vacancylists'][0]['maxregId'] = $maxRegId['MAXID'];
            $data['options']                = $this->VacancyModel->options($vid);
            $data['proviences']             = $this->VacancyModel->fetch_provience();
            $data['districts']              = $this->VacancyModel->districts();
            $data['degrees']                = $this->VacancyModel->degree();
            $data['divisions']              = $this->VacancyModel->division();
            $data['user_details']           = $this->UserModel->user($uid);
            $data['applications']           = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_PERSONAL');
            $data['Selectedinclusions']     = explode(',', $data['applications'][0]['INCLUSION_ID']);
            $data['educations']             = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_EDUCATION');
            $data['experiences']            = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_EXPERIENCES');
            $data['trainings']              = $this->VacancyModel->applicationById($vid,$uid,'HRIS_REC_APPLICATION_TRAININGS');
            $data['selectedskills']         = $this->VacancyModel->Vacancyskills($data['applications'][0]['APPLICATION_ID']);    // MS office package id: 3
            $data['selectedskills']         = explode(',', $data['selectedskills']['SKILL_ID']);
            $data['documents']['skills']    = $this->VacancyModel->ApplicationDocument($vid,$uid,'like','skills','HRIS_REC_APPLICATION_DOCUMENTS','REC_DOC_ID');
            $data['documents']['certificates']  = $this->VacancyModel->ApplicationDocument($vid,$uid,'like','certificates','HRIS_REC_APPLICATION_DOCUMENTS','REC_DOC_ID');
            $data['documents']['userdoc']    = $this->VacancyModel->ApplicationDocument($vid,$uid,'not in ',"certificates','skills",'HRIS_REC_APPLICATION_DOCUMENTS','REC_DOC_ID');
            // $data['inclusions']              = $this->VacancyModel->VacancyInclusions($data['applications'][0]['APPLICATION_ID'],$vid);  // Selected Inclusion per vacancies
            $data['certificates']            = $this->VacancyModel->academicDegree($data['vacancylists'][0]['ACADEMIC_DEGREE_CODE']);
            //Inclusion Data 
            $Vacancyinclusions      = explode(',',$data['vacancylists'][0]['INCLUSION_ID'] );
            foreach($Vacancyinclusions as $datainc){
                $Vacancyinclusion[] = $this->VacancyModel->fetchinclusions($datainc);
            }
            $data['vacancylists'][0]['INCLUSION_ID'] = $Vacancyinclusion;
            //Skills Data
            $skills     = explode(',',$data['vacancylists'][0]['SKILL_ID'] );
            foreach($skills as $VacancySkill){
                $Vskills[] = $this->VacancyModel->fetchSkills($VacancySkill);
            }
            // echo '<pre>';print_r($data['educations']); die;
            $data['vacancylists'][0]['SKILL_ID'] = $Vskills;
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply/edit', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('users/login');
        }
    }

    public function file_upload($input_id,$folder_name,$appId,$vid)
    {
        // echo'<pre>'; print_r($input_id) ; die; 
        $config = [
            'upload_path' => './uploads/noc_documents/users/'.$folder_name.'/',
            'allowed_types' => 'jpg|png|jpeg|pdf',
            'encrypt_name' => TRUE,
            'max_size'   => 1024,
            'file_ext_tolower' => TRUE,
        ];


        $this->load->library('upload',$config, $folder_name);
        $this->$folder_name->initialize($config);
        // echo $folder_name; die;
        if($this->$folder_name->do_upload($input_id))
        {
            $imageMaxId              = $this->VacancyModel->getMaxIds('REC_DOC_ID','HRIS_REC_APPLICATION_DOCUMENTS');
            $uploadData              = $this->$folder_name->data();
            $image['REC_DOC_ID']     = $imageMaxId['MAXID'] +1;
            $image['APPLICATION_ID'] = $appId['MAXID'] +1;
            $image['VACANCY_ID']     = $vid;
            $image['USER_ID']        = $this->session->userdata('userId');
            $image['oldname']        = $uploadData['orig_name'];
            $image['newname']        = $uploadData['raw_name'];
            $image['fullpath']       = base_url('uploads/noc_documents/users/'.$folder_name.'/'.$uploadData['raw_name'].$uploadData['file_ext']);
            $image['type']           = ltrim($uploadData['file_ext'], '.'); 
            $image['folder']         = $folder_name;
            // echo'<pre>'; print_r($image) ; die;
            $insert_img = $this->VacancyModel->insertimg($image);
            if($insert_img == true)
            {
                return true;
            }
            // echo'<pre>'; print_r($image) ; die;          
        }
        else{
            echo $this->$folder_name->display_errors('<p>', '</p>');
            return false;
        }
    }

    public function file_update($file)
    {
        // echo'<pre>'; print_r($file) ; die; 
        $folder_name = $file['folders'];
        $input_name = $file['input_names'];
        switch ($folder_name){
            case 'skills':
                $imageId = $file['skill_id'];
                break;
            case 'certificates':
                $imageId = $file['certificates_id'];
                break;
            default:
            $imageId = $file['doc_id'];
        }        
        $vid = [
            'columnid' => 'REC_DOC_ID',
            'valueid' => $imageId,
            'field' => 'DOC_NEW_NAME,DOC_TYPE',
        ];
        $docdetails     = $this->VacancyModel->applicationById($vid,'','HRIS_REC_APPLICATION_DOCUMENTS');
        $Oldimage = $docdetails[0]['DOC_NEW_NAME'].'.'.$docdetails[0]['DOC_TYPE'];
        // print_r($docdetails[0]['DOC_OLD_NAME']); die;
        $config = [
            'upload_path' => './uploads/noc_documents/users/'.$folder_name.'/',
            'allowed_types' => 'jpg|png|jpeg|pdf',
            'encrypt_name' => TRUE,
            'max_size'   => 1024,
            'file_ext_tolower' => TRUE,
        ];
        $this->load->library('upload',$config, $folder_name);
        $this->$folder_name->initialize($config);
        // echo $folder_name; die;
        if($this->$folder_name->do_upload($input_name))
        {
            $uploadData              = $this->$folder_name->data();
            $image['user_id']        = $this->session->userdata('userId');
            $image['doc_old_name']   = $uploadData['orig_name'];
            $image['doc_new_name']   = $uploadData['raw_name'];
            $image['doc_path']       = base_url('uploads/noc_documents/users/'.$folder_name.'/'.$uploadData['raw_name'].$uploadData['file_ext']);
            $image['doc_type']       = ltrim($uploadData['file_ext'], '.'); 
            // echo '<pre>'; print_r($image); die;
            $insert_img = $this->VacancyModel->updateimg($image,$imageId);
            if($insert_img == true)
            {
                if(file_exists("./uploads/noc_documents/users/".$folder_name.'/'.$Oldimage))
                {
                    unlink ("./uploads/noc_documents/users/".$folder_name.'/'.$Oldimage);
                }
                return true;
            }
        }
        else{
            echo $this->$folder_name->display_errors('<p>', '</p>');
            return false;
        }
    }

    // http://localhost/noc-recruitment/vacancy/payment_success?q=su&oid=2Q7UB8apE0nXeLb6&amt=1500.0&refId=0001V9T
    public function apply_success()
    {
        // print_r($detals); die;
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'Vacancy Applied',
                'Description' => 'vacancy Application has been submitted!'
            );
            $data['details'] = $this->VacancyModel->successdata($con['id']);
            // echo '<pre>';print_r($data['details' ]); die;
            $random =  random_string('alnum', 16);
            $random = $random.'aid'.$data['details'][0]['APPLICATION_ID'].'vid'.$data['details'][0]['VACANCY_ID'];
            // echo '<pre>';print_r($random); die;
            $payment = [
                'redirect' => 'https://uat.esewa.com.np/epay/main',
                'amount'   => $data['details'][0]['APPLICATION_AMOUNT'],
                'merchant_id' => 'EPAYTEST',
                'invoice'   => $random,
                'returnURl' => 'http://localhost/noc-recruitment/vacancy/payment_success?q=su',
                'cancelURL' => 'http://localhost/noc-recruitment/vacancy/payment_failed?q=fu',
 
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply/apply_success', $payment);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }

    


    public function DeleteEdu(){
        if ($this->input->post('edid')) {
            echo $this->VacancyModel->DeleteEdu($this->input->post('edid'));
        }
    }

    public function vacancyDetail(){
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $vid = base64_decode($this->uri->segment('3'));
            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Detail',
                'Description' => 'View and Apply for vacancy'
            );
           
            $data['details'] = $this->VacancyModel->vacancydetail($vid);
            
            if ($data['details'][0]['SKILL_ID'] != "") {
                $skills = explode(',', $data['details'][0]['SKILL_ID']);
                foreach($skills as $skill){
                    $aa[] = $this->VacancyModel->fetchSkills($skill);            
                }
                $data['details'][0]['SKILL_ID'] = $aa;
            }
           
            //iNCLUSION
            if ($data['details'][0]['INCLUSION_ID']) {
                $inclusions = explode(',', $data['details'][0]['INCLUSION_ID']);
                // echo '<pre>'; print_r($data['details']); die;
                foreach($inclusions as $inclusion){
                    $bb[] = $this->VacancyModel->fetchinclusions($inclusion);            
                }
                $data['details'][0]['INCLUSION_ID'] = $bb; 
            }
            // echo '<pre>'; print_r('$data'); die;
            $this->load->view('templates/header', $data);
            $this->load->view('pages/vacancydetail', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('users/login');
        }
    }
    // Fetch district & vdc list as per options for registration page - Address Fields
    public function fetch_district(){

        if ($this->input->post('province_id')) {
            echo $this->VacancyModel->fetch_district($this->input->post('province_id'));
        }
    }
    public function fetch_vdc(){

        if ($this->input->post('district_id')) {
            echo $this->VacancyModel->fetch_vdc($this->input->post('district_id'));
        }
    }
    // Applied Details for vacancy
    public function appliedDetails(){
        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );

            $data['user'] = $this->UserModel->getRows($con);
            $data['meta'] = array(
                'title' => 'NOC | Vacancy Apply',
                'Description' => 'Apply for vacancy'
            );
            $this->load->view('templates/header', $data);
            $this->load->view('pages/apply', $data);
            $this->load->view('templates/footer');
        }else
        {
            redirect('users/login');
        }
    }

    public function admitCard()
    {
        $appid  = base64_decode($this->uri->segment('3')); 
        $uid = $this->session->userdata('userId');
        $data['vacancydata'] = $this->VacancyModel->admitCardVacancy($uid,$appid);
        $data['documentdata'] = $this->VacancyModel->admitCardDocument($uid,$appid);
        // echo '<pre>'; print_r($data['documentdata']); die;
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);

        $mpdf->WriteHTML('      
       
        ');
        $mpdf->Output();
    }
    public function inclusionamount()
    {
        $position = $this->input->post('position_id');
        $level    = $this->input->post('level_id');
        
        echo json_encode($this->VacancyModel->inclusionamount($position,$level)[0]);
    }

    public function vacancyhtmlAdmit($aid)
    {
        $appid  = base64_decode($aid); 
        $uid = $this->session->userdata('userId');
        // var_dump($uid); die;
        $data['vacancydata'] = $this->VacancyModel->admitCardVacancy($uid,$appid);
        $data['documentdata'] = $this->VacancyModel->admitCardDocument($uid,$appid);
        $data['shortinstructions'] = $this->VacancyModel->shortInstruction();
        $data['longinstructions'] = $this->VacancyModel->longInstruction();
        $data['officename'] = $this->VacancyModel->officeName();
        // echo '<pre>'; var_dump($data['vacancydata'][0]); die;
        $this->load->view('pages/admitcard', $data);
		$html = $this->output->get_output();

        		// Load pdf library
		$this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
		$this->pdf->loadHtml($html);
		$this->pdf->setPaper('A4', 'portrait');
		$this->pdf->render();
		// Output the generated PDF (1 = download and 0 = preview)
		$this->pdf->stream("Admin_card.pdf", array("Attachment"=> 0));
    }





    public function connectIpsSuccess() {
        
        $returnTransactionID =  $_GET['TXNID'];

        // $con = array(
        //    'id' => $this->session->userdata('userId')
        // );

        $recentTransactionDetail = $this->VacancyModel->getTempPayment($returnTransactionID);

        // $string = "MERCHANTID=$m_id,APPID=$appId,REFERENCEID=$ref,TXNAMT=$amt";
        $string = "MERCHANTID=".$recentTransactionDetail['MERCHANT_ID'].
                  ",APPID=".$recentTransactionDetail['APP_ID'].
                  ",REFERENCEID=".$recentTransactionDetail['TXN_ID'].
                  ",TXNAMT=".$recentTransactionDetail['AMOUNT'];


        // echo '<pre>'; print_r($string); die;
        if (!$cert_store = file_get_contents(FCPATH."CREDITOR\CREDITOR.pfx")) {
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


        $verifyData = [
                        "merchantId" => $recentTransactionDetail['MERCHANT_ID'],
                        "appId" => $recentTransactionDetail['APP_ID'],
                        "referenceId" => $recentTransactionDetail['TXN_ID'],
                        "txnAmt" => $recentTransactionDetail['AMOUNT'],
                        "token" => $hash
                     ];




        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $curl = curl_init();
        $client_id   = $this->config->item('ips_username');
        $client_pass = $this->config->item('ips_password');
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://uat.connectips.com:7443/connectipswebws/api/creditor/validatetxn/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($verifyData),
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Authorization: Basic ' . base64_encode("$client_id:$client_pass")
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $responseObj = json_decode($response, true);

        echo "<pre>";
        print_r($responseObj);
        die;

        $response_code = $this->get_xml_node_value('response_code', $response);


        //----------------------------------- testing ----------------------
    
        if(isset($_GET['TXNID']))
        {
            // echo "<pre>";
            // print_r($_GET['TXNID']); die;
            $paymentId   = $this->VacancyModel->getMaxIds('PAYMENT_ID','HRIS_REC_TEMP_PAYMENT_TEST');

            $userId = ['id' => $this->session->userdata('userId')];
            
            // $oid = urldecode($_GET['oid']);
            // $aid = preg_replace( "/vid.?.?.?./", "", $oid );
            $userDetails = $this->VacancyModel->applicationDetailsRow($userId);

            // echo "<pre>";
            // print_r($userDetails['APPLICATION_ID']); die;
            // $application_id = 0; //UXzlaP5uCe6LKpBgaid1vid1
            // $vacancy_id = preg_replace( "#^[^:/.]*[:vid]+#i", "", $oid);

            // JUST CALLING 
            $connectIps = [
                'payment_id'     => $paymentId['MAXID'] + 1,
                'application_id' => $userDetails['APPLICATION_ID'],
                'user_id'        => $userId['id'],
                'vacancy_id'     => $userDetails['VACANCY_ID'], 
                'payment_type'   => 'ConnectIps',
                'payment_npr'    => $data['amt'],
                'merchantId'     => $dataIps['merchantId'],
                'app_id'         => $dataIps['appId'],
                'app_name'       => 'NOC Recruitment',
                'txn_id'         => $_GET['TXNID'],
                'txn_date'       => date('Y-m-d'),
                'txn_cur'        => 'NPR',
                'amount'         => $dataIps['txnAmt'],
                'reference_id'   => $dataIps['referenceId'],
                'remarks'        => 'RMKS-00',
                'particulars'    => 'PART-001',
                'token'          => $dataIps['token'],
                'status'         => 'success',
                'created_dt'   => date('Y-m-d'),
                'modified_dt'   => date('Y-m-d'),
            ];

           
            // $url = "https://uat.esewa.com.np/epay/transrec";
            // $dataEsewa =[
            //     'amt'=> $_GET['amt'],
            //     'rid'=> $_GET['refId'],
            //     'pid'=>$oid,
            //     'scd'=> 'EPAYTEST'
            // ];
            // $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $dataEsewa);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($curl);
            // echo $response;
            // curl_close($curl);
            if(true){
                if($this->UserModel->checkattributes('hris_rec_temp_payment_test','*','txn_id',$_GET['TXNID']) == false){
                    $payment_status = $this->VacancyModel->payment_insert_ips($connectIps);
                    if($payment_status == true)
                    {
                        $this->load->view('templates/header', $data);
                        $this->load->view('pages/payment/success_ips', $connectIps);
                        $this->load->view('templates/footer');
                    }
                    }else{
                        $this->session->set_flashdata('error_msg',"Some Error Occured!");
                        redirect('vacancy/vacancylist');
                    }                
            }else{
                echo "Some Error Occured!";
            }  
        }



        // ------------------------------------- testing ------------------------

        // echo '<pre>'; print_r($return); die;

        $this->load->view('templates/header',$data);
        $this->load->view('pages/paymentSuccess',$data);
        $this->load->view('templates/footer');
    }

    public function connectIpsDetail() {
        
        $returnTransactionID =  '6233171664524950';

        // $con = array(
        //    'id' => $this->session->userdata('userId')
        // );

        $recentTransactionDetail = $this->VacancyModel->getTempPayment($returnTransactionID);

        $verifyData = [
                        "merchantId" => $recentTransactionDetail['MERCHANT_ID'],
                        "appId" => $recentTransactionDetail['APP_ID'],
                        "referenceId" => $recentTransactionDetail['TXN_ID'],
                        "txnAmt" => $recentTransactionDetail['AMOUNT'],
                     ];

        


        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $curl = curl_init();
        $client_id   = $this->config->item('ips_username');
        $client_pass = $this->config->item('ips_password');
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://uat.connectips.com:7443/connectipswebws/api/creditor/gettxndetail',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($verifyData),
            CURLOPT_HTTPHEADER => array(
                'Content-type: application/json',
                'Authorization: Basic ' . base64_encode("$client_id:$client_pass")
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $responseObj = json_decode($response, true);

        echo "<pre>";
        echo $responseObj;
        die;

        $response_code = $this->get_xml_node_value('response_code', $response);


        //----------------------------------- testing ----------------------
    
        if(isset($_GET['TXNID']))
        {
            // echo "<pre>";
            // print_r($_GET['TXNID']); die;
            $paymentId   = $this->VacancyModel->getMaxIds('PAYMENT_ID','HRIS_REC_TEMP_PAYMENT_TEST');

            $userId = ['id' => $this->session->userdata('userId')];
            
            // $oid = urldecode($_GET['oid']);
            // $aid = preg_replace( "/vid.?.?.?./", "", $oid );
            $userDetails = $this->VacancyModel->applicationDetailsRow($userId);

            // echo "<pre>";
            // print_r($userDetails['APPLICATION_ID']); die;
            // $application_id = 0; //UXzlaP5uCe6LKpBgaid1vid1
            // $vacancy_id = preg_replace( "#^[^:/.]*[:vid]+#i", "", $oid);

            // JUST CALLING 
            $connectIps = [
                'payment_id'     => $paymentId['MAXID'] + 1,
                'application_id' => $userDetails['APPLICATION_ID'],
                'user_id'        => $userId['id'],
                'vacancy_id'     => $userDetails['VACANCY_ID'], 
                'payment_type'   => 'ConnectIps',
                'payment_npr'    => $data['amt'],
                'merchantId'     => $dataIps['merchantId'],
                'app_id'         => $dataIps['appId'],
                'app_name'       => 'NOC Recruitment',
                'txn_id'         => $_GET['TXNID'],
                'txn_date'       => date('Y-m-d'),
                'txn_cur'        => 'NPR',
                'amount'         => $dataIps['txnAmt'],
                'reference_id'   => $dataIps['referenceId'],
                'remarks'        => 'RMKS-00',
                'particulars'    => 'PART-001',
                'token'          => $dataIps['token'],
                'status'         => 'success',
                'created_dt'   => date('Y-m-d'),
                'modified_dt'   => date('Y-m-d'),
            ];

           
            // $url = "https://uat.esewa.com.np/epay/transrec";
            // $dataEsewa =[
            //     'amt'=> $_GET['amt'],
            //     'rid'=> $_GET['refId'],
            //     'pid'=>$oid,
            //     'scd'=> 'EPAYTEST'
            // ];
            // $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $dataEsewa);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($curl);
            // echo $response;
            // curl_close($curl);
            if(true){
                if($this->UserModel->checkattributes('hris_rec_temp_payment_test','*','txn_id',$_GET['TXNID']) == false){
                    $payment_status = $this->VacancyModel->payment_insert_ips($connectIps);
                    if($payment_status == true)
                    {
                        $this->load->view('templates/header', $data);
                        $this->load->view('pages/payment/success_ips', $connectIps);
                        $this->load->view('templates/footer');
                    }
                    }else{
                        $this->session->set_flashdata('error_msg',"Some Error Occured!");
                        redirect('vacancy/vacancylist');
                    }                
            }else{
                echo "Some Error Occured!";
            }  
        }



        // ------------------------------------- testing ------------------------

        // echo '<pre>'; print_r($return); die;

        $this->load->view('templates/header',$data);
        $this->load->view('pages/paymentSuccess',$data);
        $this->load->view('templates/footer');
    }

    public function connectIpsSuccess_copy() {
        
        $returnTransactionID =  $_GET['TXNID'];

        // echo $this->userId; die;

        // $con = array(
        //    'id' => $this->session->userdata('userId')
        // );

        $recentTransactionDetail = $this->VacancyModel->getTempPayment($returnTransactionID);

        // echo '<pre>'; print_r($recentTransactionDetail); die;

        // $data = [
        //             'm_id' => $dataIps['MERCHANT_ID'],
        //             'appId' => $dataIps['APP_ID'],
        //             'ref' => $dataIps['REFERENCE_ID'],
        //             'amt' => $dataIps['AMOUNT']
        //         ];

        // echo "<pre>"; print_r($data); die;
        
        // $string = "MERCHANTID=$m_id,APPID=$appId,REFERENCEID=$ref,TXNAMT=$amt";
        $string = "MERCHANTID=".$recentTransactionDetail['MERCHANT_ID'].
                  ",APPID=".$recentTransactionDetail['APP_ID'].
                  ",REFERENCEID=".$recentTransactionDetail['TXN_ID'].
                  ",TXNAMT=".$recentTransactionDetail['AMOUNT'];

        // echo '<pre>'; print_r($string); die;
        if (!$cert_store = file_get_contents("CREDITOR.pfx")) {
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


        $verifyData = [
                        "merchantId" => $recentTransactionDetail['MERCHANT_ID'],
                        "appId" => $recentTransactionDetail['APP_ID'],
                        "referenceId" => $recentTransactionDetail['TXN_ID'],
                        "txnAmt" => $recentTransactionDetail['AMOUNT'],
                        "token" => $hash
                     ];

        // $username = $this->config->item('ips_username');
        // $password = $this->config->item('ips_password');


        // $curl = curl_init();

        // curl_setopt_array($curl, array(

        //     CURLOPT_URL => $this->config->item('connectips_payment_validation_url'),
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => json_encode($verifyData),

        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json',
        //         'Authorization: Basic '."$username:$password"
        //     ),

        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_SSL_VERIFYHOST => false,

        // ));

        // $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // $response = curl_exec($curl);
        // curl_close($curl);

        // echo "<pre>";

        // print_r($status_code);

        // die;

        $curl = curl_init($this->config->item('connectips_payment_validation_url'));
        $headr = array(); //
        // $headr[] = 'Content-length: 0'; //
        $headr[] = 'Content-type: application/json'; //

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headr);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->item('ips_username') . ":" . $this->config->item('ips_password'));
        curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($verifyData));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($verifyData));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // ----- THIS BELOW LINE IS FOR LOCALHOST ONLY ----
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // ----- THIS ABOVE LINE IS FOR LOCALHOST ONLY ----
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response = curl_exec($curl);
        curl_close($curl);

        // $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // $response = curl_exec($curl);
        // curl_close($curl);

        print_r($response);
        die;

        echo "<pre>";
        echo $status_code;
        die;

        $response_code = $this->get_xml_node_value('response_code', $response);


        //----------------------------------- testing ----------------------
    
        if(isset($_GET['TXNID']))
        {
            // echo "<pre>";
            // print_r($_GET['TXNID']); die;
            $paymentId   = $this->VacancyModel->getMaxIds('PAYMENT_ID','HRIS_REC_TEMP_PAYMENT_TEST');

            $userId = ['id' => $this->session->userdata('userId')];
            
            // $oid = urldecode($_GET['oid']);
            // $aid = preg_replace( "/vid.?.?.?./", "", $oid );
            $userDetails = $this->VacancyModel->applicationDetailsRow($userId);

            // echo "<pre>";
            // print_r($userDetails['APPLICATION_ID']); die;
            // $application_id = 0; //UXzlaP5uCe6LKpBgaid1vid1
            // $vacancy_id = preg_replace( "#^[^:/.]*[:vid]+#i", "", $oid);

            // JUST CALLING 
            $connectIps = [
                'payment_id'     => $paymentId['MAXID'] + 1,
                'application_id' => $userDetails['APPLICATION_ID'],
                'user_id'        => $userId['id'],
                'vacancy_id'     => $userDetails['VACANCY_ID'], 
                'payment_type'   => 'ConnectIps',
                'payment_npr'    => $data['amt'],
                'merchantId'     => $dataIps['merchantId'],
                'app_id'         => $dataIps['appId'],
                'app_name'       => 'NOC Recruitment',
                'txn_id'         => $_GET['TXNID'],
                'txn_date'       => date('Y-m-d'),
                'txn_cur'        => 'NPR',
                'amount'         => $dataIps['txnAmt'],
                'reference_id'   => $dataIps['referenceId'],
                'remarks'        => 'RMKS-00',
                'particulars'    => 'PART-001',
                'token'          => $dataIps['token'],
                'status'         => 'success',
                'created_dt'   => date('Y-m-d'),
                'modified_dt'   => date('Y-m-d'),
            ];

           
            // $url = "https://uat.esewa.com.np/epay/transrec";
            // $dataEsewa =[
            //     'amt'=> $_GET['amt'],
            //     'rid'=> $_GET['refId'],
            //     'pid'=>$oid,
            //     'scd'=> 'EPAYTEST'
            // ];
            // $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $dataEsewa);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($curl);
            // echo $response;
            // curl_close($curl);
            if(true){
                if($this->UserModel->checkattributes('hris_rec_temp_payment_test','*','txn_id',$_GET['TXNID']) == false){
                    $payment_status = $this->VacancyModel->payment_insert_ips($connectIps);
                    if($payment_status == true)
                    {
                        $this->load->view('templates/header', $data);
                        $this->load->view('pages/payment/success_ips', $connectIps);
                        $this->load->view('templates/footer');
                    }
                    }else{
                        $this->session->set_flashdata('error_msg',"Some Error Occured!");
                        redirect('vacancy/vacancylist');
                    }                
            }else{
                echo "Some Error Occured!";
            }  
        }



        // ------------------------------------- testing ------------------------

        // echo '<pre>'; print_r($return); die;

        $this->load->view('templates/header',$data);
        $this->load->view('pages/paymentSuccess',$data);
        $this->load->view('templates/footer');
    }
    /*
     *  -- 9/23/2022
     *  
     */

    

    public function tokenGenerator()
    {
        $m_id  = $this->config->item('connectips_merchant_id');
        $appId = $this->config->item('connectips_app_id');
        $ref   = $this->input->post('referenceId');
        $amt   = $this->input->post('txnAmt');
        
        $string = "MERCHANTID=$m_id,APPID=$appId,REFERENCEID=$ref,TXNAMT=$amt";
        $hash = hash('sha256', $string);
        if (!$cert_store = file_get_contents("CREDITOR.pfx")) {
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
        echo json_encode($hash);
    }

   


    
}
