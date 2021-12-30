<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\Admin;
use Carbon\Carbon;

use App\Models\Transactions;


use App\Models\Users;

class Withdraws extends \App\Controllers\AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Withdraws";
    }
    public function manualwithdraw()
    {
        if ($this->request->getPost()) {

            $userID = $this->request->getPost('user_id');
            $withdraw_id = $this->request->getPost('id');
            $TransactionReceipt = $this->request->getPost('trx_id');

            try {
                // if($ReceiverPartyPublicName != null && $TransactionAmount != null
                // && $userID !=  null
                // && $withdraw_id != null
                // && $TransactionReceipt != null){

                $withdrawModel = new \App\Models\Withdraws();
                $withdraw_id = $withdraw_id;

                $entry = $withdrawModel->where('user', $userID)->where('status', 'pending')->find($withdraw_id);

                if ($entry) {
                    $entry->trx_id = $TransactionReceipt;
                    $entry->status = "completed";

                    $withdrawModel->save($entry);

                    $user = (new Users())->find($entry->user->id);

                    $transaction = [
                        'user' => $userID,
                        'amount' => $entry->amount,
                        'trx' => $TransactionReceipt,
                        'status' => 'completed',
                        'type' => 'withdraw',
                        'description' => "Withdrawal of Kshs $entry->amount via M-pesa with transaction ID $TransactionReceipt. New balance is Kshs $user->account",
                    ];
                    (new Transactions())->save($transaction);

                    //Send Email
                    /* $template = get_option('withdraw_email_template', '');
                $emails = get_option('withdraw_emails_notifications', '');
                if ($template != '' && $emails != '') {
                $template_fields = [
                'name'  => $user->name,
                'phone' => $user->phone,
                'withdraw_phone' => $user->phone,
                'account_balance'   => $user->account,
                'withdraw_amount'   => $entry->amount,
                'transaction_id'    => $TransactionReceipt,
                'datetime'  => date('d/m/Y h:i A'),
                'mpesa_name'    => $user->name
                ];
                $parser = $parser = \Config\Services::parser();;
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
                'withdraw_amount'   => $entry->amount,
                'transaction_id'    => $TransactionReceipt,
                'datetime'  => date('d/m/Y h:i A'),
                'mpesa_name'    => $user->name
                ];
                $parser = $parser = \Config\Services::parser();;
                $message = $parser->setData($template_fields)->renderString($template);
                $subject = "[WITHDRAW] New Withdraw from $user->username";
                //$emails = explode(',', $emails);
                @(new Mailer())->sendMessage($email, $subject, $message);
                }*/
                } else {
                    return redirect()->back()->with('error', "Withdraw not found");
                }
                // }else{
                //      return redirect()->back()->with('Error', "Please input all fields");
                // }
            } catch (Exception $e) {
                return redirect()->back()->with('error', "Something went awfully wrong");
            }

        }
        return redirect()->back()->with('success', "Withdrawal successful");
    }
    

    public function index()
    {

        return $this->_renderPage('Withdraws/index2', $this->data);
    }
    public function getWith()
    {
       $withdraws = (new \App\Models\Withdraws())->orderBy('date', 'DESC')->findAll();
       $withdraws = json_encode($withdraws);
       $withdraws = json_decode($withdraws, TRUE);

       $i = 0;

       foreach($withdraws as $withdraw) {
           $user =  ['id' => $withdraw['user']['id'], 
                     'first_name' =>  $withdraw['user']['first_name'],
                     'last_name' => $withdraw['user']['last_name'],
                     'avatar' => $withdraw['user']['avatar'],
                    'username' => $withdraw['user']['username'] ];
                     
            $withdraws[$i++]['user'] = $user;
          
       }
       $data ['data'] = $withdraws;
       return json_encode($data);

    }
    public function getTotalWithdrawals(){
        
        $model = new \App\Models\Withdraws();
        $dateStart = $this->request->getGet('start');
        $dateEnd = $this->request->getGet('end');
        if ($dateStart && $dateEnd) {           
            
            $amountCOB = $model->selectSum('amount', 'totalAmount')->where('date >=', $dateStart)->where('date <=', $dateEnd)->get()->getFirstRow('object')->totalAmount;
            return $amountCOB;
        }
        return "null";

    }


}
