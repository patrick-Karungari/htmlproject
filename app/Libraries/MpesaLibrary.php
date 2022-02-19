<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Libraries;

use Exception;
use stdClass;

class MpesaLibrary
{
    /**
     * The MPesa Paybill number
     * @var int $paybill
     */
    public $paybill;
    /**
     * The Mpesa portal Username
     * @var string $initiator_username
     */
    public $initiator_username;
    /**
     * The signed API credentials
     * @var string $cred
     */
    public $cred;

    private $key = 'tH3L05tSoUL5';

    public $lnmo_callback_url;
    /**
     * The common part of the MPesa API endpoints
     * @var string $base_url
     */
    private $base_url;
    /**
     * The consumer key
     * @var string $consumer_key
     */
    public $consumer_key;
    /**
     * The consumer key secret
     * @var string $consumer_secret
     */
    public $consumer_secret;
    /**
     * The Lipa Na MPesa paybill number
     * @var int $lipa_na_mpesa
     */
    public $lipa_na_mpesa;
    /**
     * The Lipa Na MPesa paybill number SAG Key
     * @var string $lipa_na_mpesa_key
     */
    public $lipa_na_mpesa_key;
    /**
     * The Mpesa portal Password
     * @var string $initiator_password
     */
    public $initiator_password;
    /**
     * The Callback common part of the URL eg "https://domain.com/callbacks/"
     * @var string $initiator_password
     */
    private $callback_baseurl;
    /**
     * The test phone number provided by safaricom. For developers
     * @var string $test_msisdn
     */
    private $test_msisdn;
    public $result_url;

    public $stkCommandID;
    /**
     * @var string
     */
    public $environment;

    /**
     * Construct method
     *
     * Initializes the class with an array of API values.
     *
     * @param string $environment
     */

    public function __construct($environment = 'sandbox')
    {
        $this->environment = $environment;

        $this->base_url = $this->environment == 'sandbox' ? 'https://sandbox.safaricom.co.ke/mpesa/' : 'https://api.safaricom.co.ke/mpesa/'; //Base URL for the API endpoints. This is basically the 'common' part of the API endpoints
        $this->consumer_key = get_option('mpesa_consumer_key', ''); //App Key. Get it at https://developer.safaricom.co.ke
        $this->consumer_secret = get_option('mpesa_consumer_secret', ''); //App Secret Key. Get it at https://developer.safaricom.co.ke
        $this->paybill = get_option('mpesa_paybill', ''); //The paybill/till/lipa na mpesa number
        if (get_option('mpesa_type', 'paybill') == 'paybill') {
            $this->lipa_na_mpesa = $this->paybill;
            $this->stkCommandID = 'CustomerPayBillOnline';
        } else {
            $this->lipa_na_mpesa = get_option('mpesa_till');
            $this->stkCommandID = 'CustomerBuyGoodsOnline';
        }
        $this->lipa_na_mpesa_key = get_option('mpesa_passkey'); //Lipa Na Mpesa online checkout password
        $this->initiator_username = get_option('mpesa_username', ''); //Initiator Username. I dont where how to get this.
        //$this->initiator_password = 'CARDINALITY3';            //Initiator password. I dont know where to get this either.
        $this->cred = get_option('mpesa_credential', '');

    }

    /**
     * Request money
     *
     * @return object Curl Response from submit_request, FALSE on failure
     * @throws Exception
     */
    public function stkPush($amount, $phone, $ref = "Payment")
    {
        if (!is_numeric($amount) || $amount < 1 || !is_numeric($phone) && strlen($phone) != 12) {
            throw new Exception("Invalid amount and/or phone number. Amount should be 1 or more, phone number should be in the format 254xxxxxxxxx");
        }
        $timestamp = date('YmdHis');
        $passwd = base64_encode($this->paybill . $this->lipa_na_mpesa_key . $timestamp);
        $data = array(
            'BusinessShortCode' => $this->paybill,
            'Password' => $passwd,
            'Timestamp' => $timestamp,
            'TransactionType' => $this->stkCommandID,
            'Amount' => $amount,
            'PartyA' => $phone,
            'PartyB' => $this->lipa_na_mpesa,
            'PhoneNumber' => $phone,
            'CallBackURL' => $this->lnmo_callback_url,
            'AccountReference' => $ref,
            'TransactionDesc' => 'Request funds',
        );
        $data = json_encode($data);
        $url = $this->base_url . 'stkpush/v1/processrequest';
        //$result = json_decode($response);

        return $this->submit_request($url, $data);
    }

    /**
     * Check Balance
     *
     * Check Paybill balance
     *
     * @return object Curl Response from submit_request, FALSE on failure
     * @throws Exception
     */
    public function checkBalance()
    {
        $data = array(
            'CommandID' => 'AccountBalance',
            'PartyA' => $this->paybill,
            'IdentifierType' => '4',
            'Remarks' => 'Remarks or short description',
            'Initiator' => $this->initiator_username,
            'SecurityCredential' => $this->cred,
            'QueueTimeOutURL' => 'https://dev.pkarungari.co.ke/cb.php',
            'ResultURL' => site_url(route_to('api.mpesa.balance', $this->paybill, $this->key), 'https'),
        );
        $data = json_encode($data);
        $url = $this->base_url . 'accountbalance/v1/query';

        return $this->submit_request($url, $data);
    }

    /**
     * @param $phone
     * @param $amount
     * @return bool|object
     * @throws Exception
     */
    public function sendMoney($phone, $amount)
    {
        $request_data = array(
            'InitiatorName' => $this->initiator_username,
            'SecurityCredential' => $this->cred,
            'CommandID' => 'PromotionPayment', //Check for other Command IDs
            'Amount' => $amount,
            'PartyA' => $this->paybill,
            'PartyB' => $phone,
            'Remarks' => 'This is a test comment or remark',
            'QueueTimeOutURL' => 'https://dev.pkarungari.co.ke/cb.php',
            'ResultURL' => $this->result_url,
            'Occasion' => '', //Optional
        );
        $data = json_encode($request_data);
        $url = $this->base_url . 'b2c/v1/paymentrequest';

        return $this->submit_request($url, $data);
    }

    /**
     * Transaction Reversal
     *
     * This method is used to reverse a transaction
     *
     * @param int $receiver Phone number in the format 2547xxxxxxxx
     * @param string $trx_id Transaction ID of the Transaction you want to reverse eg LH7819VXPE
     * @param int $amount The amount from the transaction to reverse
     * @return object Curl Response from submit_request, FALSE on failure
     * @throws Exception
     */

    public function reverseTransaction($receiver, $trx_id, $amount, $id, $receiverType = 1)
    {
        $data = array(
            'CommandID' => 'TransactionReversal',
            'ReceiverParty' => $receiver,
            'RecieverIdentifierType' => $receiverType, //1=MSISDN, 2=Till_Number, 4=Shortcode
            'Remarks' => 'Testing',
            'Amount' => $amount,
            'Initiator' => $this->initiator_username,
            'SecurityCredential' => $this->cred,
            'QueueTimeOutURL' => site_url(route_to('api.mpesa.timeout', $id, $this->paybill, $this->consumer_secret), 'https'),
            'ResultURL' => site_url(route_to('api.mpesa.reversal', $id, $this->paybill, $this->consumer_secret), 'https'),
            'TransactionID' => $trx_id,
        );
        $data = json_encode($data);
        $url = $this->base_url . 'reversal/v1/request';

        return $this->submit_request($url, $data);
    }

    public function decodeBalance($data = false)
    {
        if (!$data) {
            return false;
        }

        $data = json_decode($data);
        if (!$data) {
            return false;
        }

        $master = new stdClass;
        $master->ResultType = $data->Result->ResultType;
        $master->ResultCode = $data->Result->ResultCode;
        $master->ResultDesc = $data->Result->ResultDesc;
        $master->OriginatorConversationID = $data->Result->OriginatorConversationID;
        $master->ConversationID = $data->Result->ConversationID;
        $master->TransactionID = $data->Result->TransactionID;

        if ($master->ResultCode == 0) {
            if (isset($data->Result->ResultParameters->ResultParameter)) {
                foreach ($data->Result->ResultParameters->ResultParameter as $item) {
                    $item = (array) $item;
                    $key = $item['Key'];
                    $master->$key = (isset($item['Value'])) ? $item['Value'] : null;
                }
            }

            if (isset($master->AccountBalance)) {
                $x = $master->AccountBalance;
                $b = explode('&', $x);
                $amount = new stdClass;
                foreach ($b as $i) {
                    $item = explode('|', $i);
                    $key = $item[0];
                    unset($item[0]);
                    $xitem['Currency'] = $item[1];
                    $xitem['Balance'] = $item[2];
                    unset($item[1]);
                    unset($item[2]);
                    $amount->$key = (object) $xitem;
                }
                //print_r($amount);
                $master->Balance = $amount;
            }
        }

        return $master;
    }

    public function decodeLNMO($data)
    {
        $data = json_decode($data);
        if (!$data) {
            throw new Exception("Invalid JSON provided");
        }
        $master = array();
        if (isset($data->Body->stkCallback)) {
            $tmp = $data->Body->stkCallback;
            if (isset($data->Body->stkCallback->CallbackMetadata)) {
                foreach ($data->Body->stkCallback->CallbackMetadata->Item as $item) {
                    $item = (array) $item;
                    $master[$item['Name']] = ((isset($item['Value'])) ? $item['Value'] : null);

                }
            }
            $master = (object) $master;
            $master->ResultCode = $tmp->ResultCode;
            $master->MerchantRequestID = $tmp->MerchantRequestID;
            $master->CheckoutRequestID = $tmp->CheckoutRequestID;
            $master->ResultDesc = $tmp->ResultDesc;
            return $master; //or cast to array for array
        }

        throw new Exception("Invalid data");
    }

    /**
     * Submit Request
     *
     * Handles submission of all API endpoints queries
     *
     * @param string $url The API endpoint URL
     * @param json|string $data The data to POST to the endpoint $url
     * @return object|boolean Curl response or FALSE on failure
     * @throws Exception if the Access Token is not valid
     */

    private function submit_request($url, $data)
    { // Returns cURL response

        $credentials = base64_encode($this->consumer_key . ':' . $this->consumer_secret);

        $cred_url = $this->environment == 'sandbox' ? 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials' : 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $cred_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials, 'Content-Type: application/json'));
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        $access_token = $response->access_token;

        // The above $access_token expires after an hour, find a way to cache it to minimize requests to the server
        if (!$access_token) {
            throw new Exception("Invalid access token generated");
        }

        if ($access_token != '' || $access_token !== false) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        } else {
            return false;
        }
    }
}
