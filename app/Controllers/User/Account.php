<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;
use App\Libraries\Converter;
use App\Models\WithdrawAccounts;

class Account extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->_renderPage('Account/index2', $this->data);
    }
    public function getStat(){
        $converter = new Converter(); 
        $id = $this->request->getGet('id');
        if($this->request->getGet('id')){
          $inv =  (new \App\Models\Investments())->where('user', $id)->where('status', 'pending')->selectSum('total', 'totalInvestments')->get()->getLastRow()->totalInvestments;
          $profit = (new \App\Models\Investments())->where('user', $id)->where('status', 'completed')->selectSum('return', 'totalInvestments')->get()->getLastRow()->totalInvestments;
          $referrals = count((new \App\Models\Referrals())->where('user', $id)->where('status', 'completed')->orderBy('id', 'DESC')->findAll()); 
          $bonus = (new \App\Libraries\Metrics())->getUserReferralBonusTotals($id);
         $timezone = $this->request->getGet('timezone');
         date_default_timezone_set($timezone);         
          $data = ['investment' => $converter->convertoLocal($inv, $this->currency),
                    'profit' => $converter->convertoLocal($profit, $this->currency),
                    'referrals' => $referrals,
                    'date'=> date('Y.m.d H:i:s'),
                    'bonus' =>$converter->convertoLocal($bonus, $this->currency) ];
          return json_encode($data);

        }

    }

    public function withdraw_accounts()
    {
        if ($this->request->getPost()) {
            $method = trim($this->request->getPost('method'));
            $name   = trim($this->request->getPost('name'));
            $account    = trim($this->request->getPost('account'));

            try {
                (new WithdrawAccounts())->save([
                    'user' => $this->current_user->id,
                    'method' => $method,
                    'name' => $name,
                    'account' => $account
                ]);
                return redirect()->back()->with('success', "Withdraw account added successfully");
            } catch (\ReflectionException $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        //List and manage withdraw accounts
    }
}
