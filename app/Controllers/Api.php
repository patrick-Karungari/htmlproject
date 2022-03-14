<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers;

use App\Libraries\Mailer;
use App\Libraries\MpesaLibrary;
use App\Models\Deposits;
use App\Models\Transactions;
use App\Models\Users;
use App\Models\Withdraws;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\Converter;
use Carbon\Carbon;

use CodeIgniter\View\Parser;
use Twilio\TwiML\Voice\Echo_;

class Api extends BaseController
{
    /**
     * @var bool|mixed|string|null
     */
    public $key;

    public function __construct()
    {
        $this->key = env("MPESA_KEY", "kurtAngl3numB3ROnE");
    }

    //Account reference is defined by env('MPESA_PREFIX', "USER") followed by the user ID

    /**
     * STK Push callback
     *
     * @param $userID int User ID
     */
    public function deposit($userID, $key = ''): ResponseInterface
    {
        if ($key != $this->key) {
            return $this->response->setJSON([
                'ResultCode' => 403,
                'ResponseDesc' => "Forbidden",
            ])->setStatusCode(401);
        }

        $data = file_get_contents('php://input');
        $mpesaLibrary = new MpesaLibrary();

        try {
            $data = $mpesaLibrary->decodeLNMO($data);
            if ($data && $data->ResultCode == '0') {

                //Check if transaction ID exists
                $exisiting_id = (new Deposits())->where('trx_id', $data->MpesaReceiptNumber)->find();
                if ($exisiting_id) {
                    return $this->response->setJSON([
                        'ResultCode' => 200,
                        'ResponseDesc' => "Trx ID exists",
                    ])->setStatusCode(401);
                    exit;
                } // else continue

                //we got a successful deposit, update user account
                $user = (new Users())->find($userID);
                if ($user) {
                    $amount = $data->Amount;
                    $account = $user->account;
                    $account = $account + $amount;

                    //Create deposit
                    $deposit = [
                        'user' => $user->id,
                        'trx_id' => $data->MpesaReceiptNumber,
                        'phone' => $data->PhoneNumber,
                        'amount' => $amount,
                        'status' => 'completed',
                        'description' => "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $account",
                    ];

                    (new Deposits())->save($deposit);
                    user_notification($user->id, "M-Pesa Deposit", "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $account");
                    $reg = false;
                    if ($user->registration != '1') {
                        //Deduct the registration fee if money is enough
                        $registration_fee = get_option('registration_fee', 0);
                        if ($account >= $registration_fee) {
                            $account = $account - $registration_fee;
                            $reg = true;
                        }
                    }

                    //Otherwise just fund their account
                    try {
                        if ($reg === true) {
                            $update = ['account' => $account, 'registration' => '1'];
                        } else {
                            $update = ['account' => $account];
                        }
                        (new Users())->set($update)->where('id', $user->id)->update();
                        $new_acc = $user->account + $amount;
                        $transaction = [
                            'user' => $user->id,
                            'amount' => $data->Amount,
                            'status' => 'completed',
                            'trx' => $data->MpesaReceiptNumber,
                            'type' => 'deposit',
                            'description' => "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $new_acc",
                        ];
                        (new Transactions())->save($transaction);
                        user_notification($user->id, "M-Pesa Deposit", "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $account");

                        if ($reg === true) {
                            $secure_trx = 'REG' . $this->secure_random_string(7);

                            $transaction = [
                                'user' => $user->id,
                                'amount' => $registration_fee,
                                'trx' => $secure_trx,
                                'status' => 'completed',
                                'type' => 'registration',
                                'description' => "Registration fee of Kshs $registration_fee paid. New balance is Kshs $account",
                            ];
                            (new Transactions())->save($transaction);
                            user_notification($user->id, "M-Pesa Deposit", "Registration fee of Kshs $registration_fee paid. New balance is Kshs $account");
                        }

                        //Send Email
                        $template = nl2br(get_option('deposit_email_template', ''));
                        $emails = get_option('deposit_emails_notifications', '');
                        if ($template != '' && $emails != '') {
                            $template_fields = [
                                'name' => $user->name,
                                'phone' => $user->phone,
                                'deposit_phone' => $data->PhoneNumber,
                                'account_balance' => $new_acc,
                                'deposit_amount' => $data->Amount,
                                'transaction_id' => $data->MpesaReceiptNumber,
                                'datetime' => date('d/m/Y h:i A'),
                            ];
                            $parser = $parser = \Config\Services::parser();
                            $message = $parser->setData($template_fields)->renderString($template);
                            $subject = "[DEPOSIT] New Deposit from $user->username";
                            $emails = explode(',', $emails);
                            @(new Mailer())->sendMessage($emails, $subject, $message);
                        }

                        $template = nl2br(get_option('user_deposit_email_template', ''));
                        if ($template != '' && $user->email != '') {

                            $template_fields = [
                                'name' => $user->name,
                                'phone' => $user->phone,
                                'deposit_phone' => $data->PhoneNumber,
                                'account_balance' => $new_acc,
                                'deposit_amount' => $data->Amount,
                                'transaction_id' => $data->MpesaReceiptNumber,
                                'datetime' => date('d/m/Y h:i A'),
                            ];
                            $parser = $parser = \Config\Services::parser();
                            $message = $parser->setData($template_fields)->renderString($template);
                            $subject = "[DEPOSIT] New Deposit from $user->username";

                            @(new Mailer())->sendMessage($user->email, $subject, $message);
                        }

                    } catch (\Exception $exception) {

                    }
                }
            }

        } catch (\Exception $e) {

        }

        return $this->response->setJSON(['Result' => 0, "ResultDesc" => "Success"])->setContentType('application/json');
    }

    /**
     * Confirmation Url
     */
    public function confirm($key = '')
    {

    }

    /**
     * Validation Url
     */
    public function validation($key = ''): ResponseInterface
    {
        return $this->response->setJSON(['Result' => 0, "ResultDesc" => "Success"])->setContentType('application/json');
    }

    /**
     * withdraw callback
     * @param $userID
     * @param string $key
     * @return ResponseInterface
     */
    public function withdraw($userID, $key = ''): ResponseInterface
    {
        if ($key != $this->key) {
            return $this->response->setJSON([
                'ResultCode' => 403,
                'ResponseDesc' => "Forbidden",
            ])->setStatusCode(401);
        }

        $data = file_get_contents('php://input');
        $mpesaLibrary = new MpesaLibrary();

        try {
            $data = $mpesaLibrary->decodeBalance($data);
            $withdrawModel = new Withdraws();
            $entry = $withdrawModel->where('user', $userID)->where('status', 'pending')->orderBy('id', 'DESC')->get()->getFirstRow();
            if ($entry && $data && $data->ResultCode == '0') {

                $entry->status = 'completed';
                $entry->trx_id = $data->TransactionReceipt;
                $withdrawModel->save($entry);

                $user = (new Users())->find($userID);

                //Send Email
                $template = get_option('withdraw_email_template', '');
                $emails = get_option('withdraw_emails_notifications', '');
                if ($template != '' && $emails != '') {
                    $template_fields = [
                        'name' => $user->name,
                        'phone' => $user->phone,
                        'withdraw_phone' => $user->phone,
                        'account_balance' => $user->account,
                        'withdraw_amount' => $data->TransactionAmount,
                        'transaction_id' => $data->TransactionReceipt,
                        'datetime' => date('d/m/Y h:i A'),
                        'mpesa_name' => $data->ReceiverPartyPublicName,
                    ];
                    $parser = $parser = \Config\Services::parser();
                    $template = nl2br($template);
                    $message = $parser->setData($template_fields)->renderString($template);
                    $subject = "[WITHDRAW] New Withdraw from $user->username";
                    $emails = explode(',', $emails);
                    @(new Mailer())->sendMessage($emails, $subject, $message);
                }

                $template = get_option('user_withdraw_email_template', '');
                $email = $user->email;
                if ($template != '' && $email != '') {
                    $template_fields = [
                        'name' => $user->name,
                        'phone' => $user->phone,
                        'withdraw_phone' => $user->phone,
                        'account_balance' => $user->account,
                        'withdraw_amount' => $data->TransactionAmount,
                        'transaction_id' => $data->TransactionReceipt,
                        'datetime' => date('d/m/Y h:i A'),
                        'mpesa_name' => $data->ReceiverPartyPublicName,
                    ];
                    $parser = $parser = \Config\Services::parser();
                    $template = nl2br($template);
                    $message = $parser->setData($template_fields)->renderString($template);
                    $subject = "[WITHDRAW] New Withdraw from $user->username";
                    $emails = explode(',', $emails);
                    @(new Mailer())->sendMessage($email, $subject, $message);
                }

            } else {
                //Return back the money
                $user = (new Users())->find($userID);
                if ($user) {
                    $trx_fee = ($entry->amount > 1000 ? 22 : 15);
                    $refundable = $trx_fee + $entry->amount;

                    $new_account = $user->account + $refundable;

                    $entry->status = 'failed';
                    $entry->description .= " Refunded Kshs $refundable. Balance $new_account";
                    $withdrawModel->save($entry);

                    (new Users())->set(['account' => $new_account])->where('id', $user->id)->update();
                }

                //Send Email
                $template = get_option('withdraw_email_template', '');
                $emails = get_option('withdraw_emails_notifications', '');
                if ($template != '' && $emails != '') {
                    $template_fields = [
                        'name' => $user->name,
                        'phone' => $user->phone,
                        'withdraw_phone' => $user->phone,
                        'account_balance' => $user->account,
                        'withdraw_amount' => @$data->TransactionAmount,
                        'transaction_id' => @$data->TransactionReceipt,
                        'datetime' => date('d/m/Y h:i A'),
                    ];
                    $parser = $parser = \Config\Services::parser();
                    $message = $parser->setData($template_fields)->renderString($template);
                    $subject = "[WITHDRAW FAILED] Withdraw from $user->username";
                    $emails = explode(',', $emails);
                    @(new Mailer())->sendMessage($emails, $subject, "A withdraw of Kshs $entry->amount failed and the money refunded to the user.\n The error returned from M-Pesa was:\n\n $data->ResultDesc");
                }

            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['Result' => 0, "ResultDesc" => $e->getMessage()])->setContentType('application/json');
        }

        return $this->response->setJSON(['Result' => 0, "ResultDesc" => "success"])->setContentType('application/json');
    }

    public function email()
    {
        $mailer = new Mailer();
        $mail = $mailer->sendMessage(['admin@alpha-capital-investments.com', 'admin@alpha-capital-investments.com'], "Testing Mail fuction", "THis is a test message. You can disregard");

        d($mailer->error);
        d($mail);
    }

    public function fixduplicates()
    {
        $deps = (new Deposits())->select("*, COUNT(trx_id) as count")->groupBy('trx_id')->findAll();
        $usersModel = new Users();

        foreach ($deps as $dep) {
            //dd($dep);
            if ($dep->count > 1) {
                //Reverse
                $user = $usersModel->find($dep->user->id);
                $newAccount = $user->account - $dep->amount;
                $amDeducted = $dep->amount;

                $user->account = $newAccount;
                (new Users())->save($user);

                $dep->amount = 0;
                $dep->description = "[ERRONEOUS] " . $dep->description . ". Kshs $amDeducted has been deducted for this transaction";
                (new Deposits())->save($dep);
            }
        }
        //dd($deps);

    }

    public function manualfail()
    {
        $b2c = '{"Result":{"ResultType":404,ResultCode":23,"ResultDesc":"The service request has been rejected.","OriginatorConversationID":"19455-424535-1","ConversationID":"AG_20200329_00007c44b1e6be2e84d2","TransactionID":"LGH3197RIB","ResultParameters":{"ResultParameter":[{"Key":"TransactionReceipt","Value":"LGH3197RIB"},{"Key":"TransactionAmount","Value":8000},{"Key":"B2CWorkingAccountAvailableFunds","Value":150000},{"Key":"B2CUtilityAccountAvailableFunds","Value":133568},{"Key":"TransactionCompletedDateTime","Value":"17.07.2017 10:54:57"},{"Key":"ReceiverPartyPublicName","Value":"254708374149 - John Doe"},{"Key":"B2CChargesPaidAccountAvailableFunds","Value":0},{"Key":"B2CRecipientIsRegisteredCustomer","Value":"Y"}]},"ReferenceData":{"ReferenceItem":{"Key":"QueueTimeoutURL","Value":"https://internalsandbox.safaricom.co.ke/mpesa/b2cresults/v1/submit"}}}}';

        $withdraws = (new Withdraws())->where('status', 'pending')->where('id > ', 260)->findAll();
        foreach ($withdraws as $withdraw) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'http://localhost/tuma/api/withdraw/' . $withdraw->user->id . '/kurtAngl3numB3ROnE');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_USERAGENT, "pkarungari.co.ke");

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
            curl_setopt($curl, CURLOPT_AUTOREFERER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $b2c);
            $response = curl_exec($curl);
            print_r(curl_error($curl));
            curl_close($curl);
            print_r($response);
        }
    }
    public function getusers()
    {
        $users = (new \App\Libraries\Auth())->select('users.id, username, email, phone, account, registration, referred_by, first_name, last_name, avatar')->users(2);
        $i = 0;
        $n_users = array();
        foreach ($users as $user) {
            $referrals = count((new \App\Models\Referrals())->where('user', $user->id)->where('status', 'completed')->orderBy('id', 'DESC')->findAll());
            // dd($referrals);
            $array = json_decode(json_encode($user), true);
            $n_users[$i++] = array_merge($array, array("referrals" => $referrals));
        }

        $data['data'] = $n_users;
        //dd($data);
        echo json_encode($data);

    }
    public function getWithdraws()
    {
        $id = $this->request->getPost('id');

        if ($this->request->getPost('id')) {
            $users = ((new \App\Models\Transactions()))->select('id, amount, trx, status, type, description, date')->where('user', $id)->orderBy('id', 'DESC')->findAll();
            $data['data'] = $users;
            //dd($data);
            echo $id;
            echo json_encode($data);
        } else {
            echo json_encode($this->request->getPost(''));
        }

    }

    public function secure_random_string($length)
    {
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }
        return strtoupper($random_string);
    }
    public function getStat(){
        $id = $this->request->getGet('id');
        //dd($this->request->getGet('id'));
        if($this->request->getGet('id')){
            $inv =  number_format((new \App\Models\Investments())->where('user', $id)->where('status', 'pending')->selectSum('total', 'totalInvestments')->get()->getLastRow()->totalInvestments, 2);
            $profit = number_format((new \App\Models\Investments())->where('user', $id)->where('status', 'completed')->selectSum('return', 'totalInvestments')->get()->getLastRow()->totalInvestments, 2);
            $referrals = count((new \App\Models\Referrals())->where('user', $id)->where('status', 'completed')->orderBy('id', 'DESC')->findAll()); 
            $bonus = number_format((new \App\Libraries\Metrics())->getUserReferralBonusTotals($id), 2);
            $data = array('investment' => $inv,
                        'profit' => $profit,
                        'referrals' => $referrals,
                        'date'=> date('Y-m-d H:i:s'),
                        'bonus' =>$bonus );
            return json_encode($data);

        }

    }
    public function getRef($id)
    {
        $Referrals = (new \App\Models\Referrals())->where('user', $id)->orderBy('date', 'DESC')->findAll();
        $Referrals = json_encode($Referrals);
        
        $Referrals = json_decode($Referrals, true);

        $i = 0;

        foreach ($Referrals as $referral) {
            
            echo $i;
            if($referral['ref'] != null){
                $ref = ['id' => $referral['ref']['id'],
                'first_name' => $referral['ref']['first_name'],
                'last_name' => $referral['ref']['last_name'],
                'avatar' => $referral['ref']['avatar'],
                'username' => $referral['ref']['username']];
               $Referrals[$i]['ref'] = $ref;
                
            }else{
                $ref = ['id' => null,
                    'first_name' => 'Unknown',
                    'last_name' => 'Downline',
                    'avatar' => null,
                    'username' => 'unknownDownline'];
                $Referrals[$i]['ref'] = $ref;              
            }
            $user = ['id' => $referral['user']['id'],
                'first_name' => $referral['user']['first_name'],
                'last_name' => $referral['user']['last_name'],
                'avatar' => $referral['user']['avatar'],
                'username' => $referral['user']['username']];

            $Referrals[$i]['user'] = $user; 
            $i++;
        
        } 
       dd( $Referrals);
        //dd($deposits);
        $data['data'] = $Referrals;
        return json_encode($data);

    }
    public function updateExchangeRates(){
        $currenciesModel = (new \App\Models\Currencies());
        $currencies = $currenciesModel->findAll();
        foreach($currencies as $currency){
            
           // dd()
            $to = $currency->currency;
            //$response = ['result'=> [$to=> 130.23]];
            $client = \Config\Services::curlrequest();

            $response = $client->request('GET', 'https://api.fastforex.io/fetch-one?from=usd&to='.$currency->currency.'&api_key=4fa0babdb5-48795521c0-r69mgb', ['headers' => ['Accept' => 'application/json']]);
            $response = json_decode($response->getBody());
            $response = json_decode(json_encode($response) , true);
            //dd($response);
            if ($currency->currency != 'USD'){
                $entry = $currenciesModel->find($currency->id);
           
                //dd($entry);
               
                if($entry){
                    //$entry->currency = $currency->currency;
                    $entry->buying = 0.98 * ($response['result'][$to]);
                    $entry->selling = ($response['result'][$to]);
                    $currenciesModel->save($entry);
                    echo number_format(0.98 * ($response['result'][$to]), 4).'\n';

                    //dd($currencies);
                }
            }
            //dd($response->result->$currency);

        }

    }
    public function convertoUSD($amount, $_currency)
    {  
    
        $currenciesModel = (new \App\Models\Currencies());
        $currencies = $currenciesModel->where('currency', $_currency)->find();
        $local = null;  
        foreach ($currencies as $currency) {
           $local= $currency->getSelling();
        }
        echo ($amount / $local );
        return ($amount / $local );

    }
    public function getTotalWithdraws($id){
        
        $model = new \App\Models\Withdraws();
        $converter = new Converter(); 
        $dateStart = '2022-01-25';
        $dateEnd = '2021-01-26';
        if ($dateStart && $dateEnd) {   
            $dateStart = Carbon::parse($dateStart)->startOfDay()->getTimestamp();
            $dateEnd = Carbon::parse($dateEnd)->endOfDay()->getTimestamp();
        
            $amountCOB = $model->selectSum('amount', 'totalAmount')->where('user', $id)->where('date >=', $dateStart)->where('date <=', $dateEnd)->get()->getFirstRow('object')->totalAmount;
            dd($amountCOB); 
            echo $converter->convertoUSD($amountCOB, 'kes');
            return;
        }
        

        return "null";

    }

}
