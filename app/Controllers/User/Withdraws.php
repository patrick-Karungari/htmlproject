<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers\User;


use App\Libraries\Metrics;
use App\Libraries\MpesaLibrary;
use App\Models\Users;
use App\Libraries\Mailer;

class Withdraws extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "My Withdraws";
    }

    public function index(): string
    {

        return $this->_renderPage('Withdraws/index', $this->data);
    }

    public function create()
    {
        if ($this->request->getPost()) {
            
           // return redirect()->back()->with('error', "Temporarily disabled. We are fixing the erroneous double deposits incurred from yesterday");

            $minimum_withdraw_amount = get_option('minimum_bonus_withdraw', 0);

          /***   if($minimum_withdraw_amount > (new Metrics())->getUserBonusTotals($this->current_user->id)) {
                return redirect()->back()->with('error', "You can only withdraw if your investments total to Kshs $minimum_withdraw_amount");
            }        
           */

            $amount = $this->request->getPost('amount');
            $running_investments = (new Metrics())->getUserInvestmentTotals($this->current_user->id);
            $current_withdrawal = (new Metrics())-> getDayTotalWithdrawals($this->current_user->id);
            $available_withdrawal = intval(trim($running_investments - $current_withdrawal));
            if($current_withdrawal + $amount > $running_investments){
               
                 if($available_withdrawal<0){
                     return redirect()->back()->with('error', "Your remaining withdraw limit is KES 0. Your limit is equal to your running investment of KES $running_investments. Please invest more to withdraw more. Today's withdrawal: $current_withdrawal");
                 }
                return redirect()->back()->with('error', "Your remaining withdraw limit is KES $available_withdrawal. Your limit is equal to your running investment of KES $running_investments. Please try a lower amount.Today's withdrawal: $current_withdrawal");

            }

            $deposit_rate = (new Metrics())->getDepositRate($this->current_user->id, $amount);
             $deposit_rate = number_format($deposit_rate, 1);
            if($deposit_rate<-20){
                 return redirect()->back()->with('error', "Your remaining withdraw limit is KES 0. Deposit Rate: You have a negative deposit rate of $deposit_rate %. Please deposit and re-invest.");

            }

             if($amount > (new Metrics())->getUserInvestmentTotals($this->current_user->id)) {
                $running_investments = (new Metrics())->getUserInvestmentTotals($this->current_user->id);
                return redirect()->back()->with('error', "You cannot withdraw more than your running investments. Your running investment is KES $running_investments");
            }
            if (!is_numeric($amount) || $amount < 50) {
                return redirect()->back()->with('error', "Withdrawal amount must be Kshs 50 or more");
            }

            $trx_fee = 0;
            if($amount <= 100){
                $trx_fee = 0;
            }elseif($amount > 100 && $amount <= 500 ) {
               $trx_fee = 6;
            } elseif($amount > 500 && $amount <= 1000 ) {
               $trx_fee = 12;
            }elseif($amount > 1000 && $amount <= 1500 ) {
               $trx_fee = 22;
            }elseif($amount > 1500 && $amount <= 2500 ) {
               $trx_fee = 32;
            }
            elseif($amount > 2500 && $amount <= 3500 ) {
               $trx_fee = 51;
            }  
            elseif($amount > 3500 && $amount <= 5000 ) {
               $trx_fee =55;
            }  elseif($amount > 5000 && $amount <= 7500 ) {
               $trx_fee = 75;
            } elseif($amount > 7500 && $amount <= 10000 ) {
               $trx_fee = 87;
            } elseif($amount > 10000 && $amount <= 15000 ) {
               $trx_fee = 97;
            } elseif($amount > 15000 && $amount <= 20000 ) {
               $trx_fee = 102;
            } else{
                $trx_fee = 105;
            }  
            $withdraw_plus_transaction_fee = $amount + $trx_fee;

            if ($this->current_user->account < $withdraw_plus_transaction_fee) {
                return redirect()->back()->with('error', "You do not have sufficient balance to withdraw Kshs $amount and pay a transaction cost of Kshs $trx_fee");
            }

            try {
                $mpesa = new MpesaLibrary(get_option('mpesa_b2c_env', 'sandbox'));
                $mpesa->consumer_key = get_option('mpesa_b2c_consumer_key');
                $mpesa->consumer_secret = get_option('mpesa_b2c_consumer_secret');
                $mpesa->initiator_username = get_option('mpesa_b2c_username');
                $mpesa->cred = get_option('mpesa_b2c_credential');
                $mpesa->paybill = get_option('mpesa_b2c_paybill');
                $mpesa->result_url = site_url('api/withdraw/' . $this->current_user->id . '/' . env("MPESA_KEY", "kurtAngl3numB3ROnE"), 'https');

                $phone_number = substr_replace($this->current_user->phone, '254', 0, 1);

                //$response = $mpesa->sendMoney($phone_number, $amount);

                //if ($res = json_decode($response)) {
                if (TRUE) {
                    //if (isset($res->ResponseCode) && $res->ResponseCode == 0) {
                    if (TRUE) {
                        $new_balance = $this->current_user->account - $withdraw_plus_transaction_fee;
                        $withdraw = [
                            'user' => $this->current_user->id,
                            'amount' => $amount,
                            'phone' => $phone_number,
                            'description' => "Withdraw Kshs $amount. Transaction cost $trx_fee. New Balance $new_balance"
                        ];

                        (new \App\Models\Withdraws())->save($withdraw);
                        (new Users())->set(['account' => $new_balance])->where('id', $this->current_user->id)->update();
                        //Send Email
                        $template = get_option('withdraw_email_template', '');
                        $emails = get_option('withdraw_emails_notifications', '');
                        /*if ($template != '' && $emails != '') {
                            $template_fields = [
                                'name'  => $this->current_user->name,
                                'phone' => $this->current_user->phone,
                                'withdraw_phone' => $phone_number,
                                'account_balance'   =>$this->current_user->account,
                                'withdraw_amount'   => $amount,
                                'transaction_id'    => "TransactionReceipt",
                                'datetime'  => date('d/m/Y h:i A'),
                                'mpesa_name'    => $this->current_user->name
                            ];
                            $name =$this->current_user->name;
                            $parser = $parser = \Config\Services::parser();;
                            $message = $parser->setData($template_fields)->renderString($template);
                            $subject = "[REQUEST FOR WITHDRAW] New Withdraw request from $phone_number, $name";
                            $emails = explode(',', $emails);
                            @(new Mailer())->sendMessage($emails, $subject, $message);
                        }*/
                        return redirect()->back()->with('success', "Your request has been received and is being processed.");
                    } else {
                        return redirect()->back()->with('error', "Something went wrong. Kindly be patient while we fix the issue");
                    }
                } else {
                    return redirect()->back()->with('error', "Something went wrong. Kindly be patient while we fix the issue");
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Something went wrong. Kindly be patient while we fix the issue $e");
            }
        }

        $this->data['site_title'] = "Withdraw Money";
        return $this->_renderPage('Withdraws/create', $this->data);
    }
}