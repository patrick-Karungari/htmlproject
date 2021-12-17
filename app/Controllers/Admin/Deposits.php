<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers\Admin;

use App\Libraries\Mailer;
use App\Libraries\MpesaLibrary;
use App\Models\Transactions;
use App\Models\Users;
use App\Models\Withdraws;
use CodeIgniter\View\Parser;


class Deposits extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Deposits";
    }

    public function index()
    {

        return $this->_renderPage('Deposits/index', $this->data);
    }

    public function approve(int $id) {
        $model = new \App\Models\Deposits();
        $dep = $model->find($id);
        if($dep) {
            $dep->status = "completed";
            $dep->trx_id = "MA_".$this->secure_random_string(8);;

            try {
               
                $user = $dep->user;
                //START COPY
                $data = new \stdClass;
                $data->Amount = $dep->amount;
                $data->MpesaReceiptNumber = $dep->trx_id;
                $data->PhoneNumber = $dep->phone;

                 if ($user) {
                    $amount = $data->Amount;
                    $account = $user->account;
                    $account = $account + $amount;

                    //Create deposit
                    $deposit = [
                        'id'    => $dep->id,
                        'user' => $user->id,
                        'trx_id'    => $data->MpesaReceiptNumber,
                        'phone'     => $data->PhoneNumber,
                        'amount'    => $amount,
                        'status'    => 'completed',
                        'description'   => "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $account"
                    ];

                    $model->save($dep);

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
                            'trx' => $data->MpesaReceiptNumber,
                            'status' => 'completed',
                            'type' => 'deposit',
                            'description' => "Deposit of Kshs $data->Amount via M-pesa with transaction ID $data->MpesaReceiptNumber. New balance is Kshs $new_acc"
                        ];
                        (new Transactions())->save($transaction);
                       
                        if ($reg === TRUE) {
                            $secure_trx = 'REG'.$this->secure_random_string(7);
                            $transaction = [
                                'user' => $user->id,
                                'amount' => $registration_fee,
                                'trx' => $secure_trx,
                                'status' => 'completed',
                                'type' => 'registration',
                                'description' => "Registration fee of Kshs $registration_fee paid. New balance is Kshs $account"
                            ];
                            (new Transactions())->save($transaction);
                        }

                        //Send Email
                        $template = get_option('deposit_email_template', '');
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

                        $template = get_option('user_deposit_email_template', '');
                        $email = $user->email;
                        if ($template != '' && $email != '') {
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
                           // $emails = explode(',', $emails);
                            @(new Mailer())->sendMessage($email, $subject, $message);
                        }

                    } catch (\Exception $exception) {
                         return redirect()->back()->with('error', $e->getMessage());
                    }
                }
                //END COPY

                 return redirect()->back()->with('success', "Approved successfully");
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

         return redirect()->back()->with('error', "Something went wrong");
    }
    
    function secure_random_string($length){
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $number = random_int(0, 36);
            $character = base_convert($number, 10, 36);
            $random_string .= $character;
        }

        return strtoupper($random_string);
    }

}
