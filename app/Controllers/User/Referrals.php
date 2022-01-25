<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

class Referrals extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "My Referrals";
    }

    public function index()
    {
        return $this->_renderPage('Referrals/index2', $this->data);
    }
    public function getRef($id)
    {
        $Referrals = (new \App\Models\Referrals())->where('user', $id)->orderBy('date', 'DESC')->findAll();
        $Referrals = json_encode($Referrals);
        
        $Referrals = json_decode($Referrals, true);

        $i = 0;

        foreach ($Referrals as $referral) {
            
           // echo $i;
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
        $data['data'] = $Referrals;
        return json_encode($data);

    }
}
