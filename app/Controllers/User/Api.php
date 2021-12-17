<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers;

use App\Libraries\Mailer;
use App\Libraries\MpesaLibrary;
use App\Models\Deposits;
use App\Models\Transactions;
use App\Models\Users;
use App\Models\Withdraws;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\View\Parser;

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

    //ACcount reference is defined by env('MPESA_PREFIX', "USER") followed by the user ID

    /**
     * STK Push callback
     *
     * @param $userID int User ID
     */
    public function deposit($userID, $key = ''): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($key != $this->key) {
            return $this->response->setJSON([
                'ResultCode' => 403,
                'ResponseDesc' => "Forbidden"
            ])->setStatusCode(401);
        }

        $data = file_get_contents('php://input');
        $mpesaLibrary = new MpesaLibrary();

        try {
            $data = $mpesaLibrary->decodeLNMO($data);
            if ($data && $data->ResultCode == '0') {
                //we got a successful deposit, update user account
                $user = (new Users())->find($userID);
                if ($user) {
                    $amount = $data->Amount;
                    $account = $user->account;
                    $account = $account + $amount;

                    //Create deposit
                    $deposit = [
                        'user' => $user->id,
                        'trx_id'    => $data->MpesaReceiptNumber,
                        'phone'     => $data->PhoneNumber,
                        'amount'    => $amount,
                        'status'    => 'completed',
                        'description'   => "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $account"
                    ];

                    (new Deposits())->save($deposit);

                    $reg = FALSE;
                    if ($user->registration != '1') {
                        //Deduct the registration fee if money is enough
                        $registration_fee = get_option('registration_fee', 0);
                        if ($account >= $registration_fee) {
                            $account = $account - $registration_fee;
                            $reg = TRUE;
                        }
                    }

                    //Otherwise just fund their account
                    try {
                        if ($reg === TRUE) {
                            $update = ['account' => $account, 'registration' => '1'];
                        } else {
                            $update = ['account' => $account];
                        }
                        (new Users())->set($update)->where('id', $user->id)->update();
                        $new_acc = $user->account + $amount;
                        $transaction = [
                            'user' => $user->id,
                            'amount' => $data->Amount,
                            'type' => 'deposit',
                            'description' => "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $new_acc"
                        ];
                        (new Transactions())->save($transaction);

                        if ($reg === TRUE) {
                            $transaction = [
                                'user' => $user->id,
                                'amount' => $registration_fee,
                                'type' => 'registration',
                                'description' => "Registration fee of Kshs $registration_fee paid. New balance is Kshs $account"
                            ];
                            (new Transactions())->save($transaction);
                        }

                        //Send Email
                        $template = nl2br(get_option('deposit_email_template', ''));
                        $emails = get_option('deposit_emails_notifications', '');
                        if ($template != '' && $emails != '') {
                            $template_fields = [
                                'name'  => $user->name,
                                'phone' => $user->phone,
                                'deposit_phone' => $data->PhoneNumber,
                                'account_balance'   => $new_acc,
                                'deposit_amount'   => $data->Amount,
                                'transaction_id'    => $data->MpesaReceiptNumber,
                                'datetime'  => date('d/m/Y h:i A')
                            ];
                            $parser = $parser = \Config\Services::parser();;
                            $message = $parser->setData($template_fields)->renderString($template);
                            $subject = "[DEPOSIT] New Deposit from $user->username";
                            $emails = explode(',', $emails);
                            @(new Mailer())->sendMessage($emails, $subject, $message);
                        }

                        $template = nl2br(get_option('user_deposit_email_template', ''));
                        if ($template != '' && $user->email != '') {

                            $template_fields = [
                                'name'  => $user->name,
                                'phone' => $user->phone,
                                'deposit_phone' => $data->PhoneNumber,
                                'account_balance'   => $new_acc,
                                'deposit_amount'   => $data->Amount,
                                'transaction_id'    => $data->MpesaReceiptNumber,
                                'datetime'  => date('d/m/Y h:i A')
                            ];
                            $parser = $parser = \Config\Services::parser();;
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
    public function validation($key = ''): \CodeIgniter\HTTP\ResponseInterface
    {
        return $this->response->setJSON(['Result' => 0, "ResultDesc" => "Success"])->setContentType('application/json');
    }

    /**
     * withdraw callback
     */
    public function withdraw($userID, $key = ''): \CodeIgniter\HTTP\ResponseInterface
    {
        if ($key != $this->key) {
            return $this->response->setJSON([
                'ResultCode' => 403,
                'ResponseDesc' => "Forbidden"
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
                        'name'  => $user->name,
                        'phone' => $user->phone,
                        'withdraw_phone' => $user->phone,
                        'account_balance'   => $user->account,
                        'withdraw_amount'   => $data->TransactionAmount,
                        'transaction_id'    => $data->TransactionReceipt,
                        'datetime'  => date('d/m/Y h:i A'),
                        'mpesa_name'    => $data->ReceiverPartyPublicName
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
                        'name'  => $user->name,
                        'phone' => $user->phone,
                        'withdraw_phone' => $user->phone,
                        'account_balance'   => $user->account,
                        'withdraw_amount'   => $data->TransactionAmount,
                        'transaction_id'    => $data->TransactionReceipt,
                        'datetime'  => date('d/m/Y h:i A'),
                        'mpesa_name'    => $data->ReceiverPartyPublicName
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
                if($user) {
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
                        'name'  => $user->name,
                        'phone' => $user->phone,
                        'withdraw_phone' => $user->phone,
                        'account_balance'   => $user->account,
                        'withdraw_amount'   => @$data->TransactionAmount,
                        'transaction_id'    => @$data->TransactionReceipt,
                        'datetime'  => date('d/m/Y h:i A')
                    ];
                    $parser = $parser = \Config\Services::parser();;
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
        //$mail = $mailer->sendMessage(['benmuriithi929@gmail.com', 'admin@alpha-capital-investments.com'], "Testing Mail fuction", "THis is a test message. You can disregard");

        d($mailer->error);
        var_dump($mail);
        
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
                $dep->description = "[ERRONEOUS] ".$dep->description.". Kshs $amDeducted has been deducted for this transaction";
                (new Deposits())->save($dep);
            }
        }
        //dd($deps);
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
                $dep->description = "[ERRONEOUS] ".$dep->description.". Kshs $amDeducted has been deducted for this transaction";
                (new Deposits())->save($dep);
            }
        }
        //dd($deps);
        echo "All done";
    }
    
    public function manualfail()
    {
        $b2c = '{"Result":{"ResultType":404,ResultCode":23,"ResultDesc":"The service request has been rejected.","OriginatorConversationID":"19455-424535-1","ConversationID":"AG_20200329_00007c44b1e6be2e84d2","TransactionID":"LGH3197RIB","ResultParameters":{"ResultParameter":[{"Key":"TransactionReceipt","Value":"LGH3197RIB"},{"Key":"TransactionAmount","Value":8000},{"Key":"B2CWorkingAccountAvailableFunds","Value":150000},{"Key":"B2CUtilityAccountAvailableFunds","Value":133568},{"Key":"TransactionCompletedDateTime","Value":"17.07.2017 10:54:57"},{"Key":"ReceiverPartyPublicName","Value":"254708374149 - John Doe"},{"Key":"B2CChargesPaidAccountAvailableFunds","Value":0},{"Key":"B2CRecipientIsRegisteredCustomer","Value":"Y"}]},"ReferenceData":{"ReferenceItem":{"Key":"QueueTimeoutURL","Value":"https://internalsandbox.safaricom.co.ke/mpesa/b2cresults/v1/submit"}}}}';

        $withdraws = (new Withdraws())->where('status', 'pending')->findAll();
        foreach ($withdraws as $withdraw) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'http://localhost/tuma/api/withdraw/'.$withdraw->user->id.'/kurtAngl3numB3ROnE');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_USERAGENT, "BENNITO254.COM" );

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, FALSE);
            curl_setopt($curl, CURLOPT_AUTOREFERER, FALSE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $b2c);
            $response = curl_exec($curl);
            print_r(curl_error($curl));
            curl_close($curl);
            print_r($response);
        }
    }
}
                                                                                                                                                                                                                     