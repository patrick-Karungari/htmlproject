<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

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
        $id = $this->request->getGet('id');
        if($this->request->getGet('id')){
          $inv =  (new \App\Models\Investments())->where('user', $id)->where('status', 'pending')->selectSum('total', 'totalInvestments')->get()->getLastRow()->totalInvestments;
          $profit = (new \App\Models\Investments())->where('user', $id)->where('status', 'completed')->selectSum('return', 'totalInvestments')->get()->getLastRow()->totalInvestments;
          $referrals = count((new \App\Models\Referrals())->where('user', $id)->where('status', 'completed')->orderBy('id', 'DESC')->findAll()); 
          $bonus = (new \App\Libraries\Metrics())->getUserReferralBonusTotals($id);
         $timezone = $this->request->getGet('timezone');
         date_default_timezone_set($timezone);         
          $data = ['investment' => $inv,
                    'profit' => $profit,
                    'referrals' => $referrals,
                    'date'=> date('Y.m.d H:i:s'),
                    'bonus' =>$bonus ];
          return json_encode($data);

        }

    }
}
