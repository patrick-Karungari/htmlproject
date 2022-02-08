<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Controllers\User;

use App\Models\Investments;
use App\Models\Plans;
use App\Models\Transactions;
use App\Models\Users;
use Carbon\Carbon;
use App\Libraries\Converter;



class Invest extends \App\Controllers\UserController

{
    public $converter;
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Investments";
        $this->converter = (new \App\Libraries\Converter());

    }

    public function index()
    {

        return $this->_renderPage('Invest/index', $this->data);
    }

    public function create()
    {
        

        if ($this->request->getPost()) {
            $plan = $this->request->getPost('plan');
            $amount = $this->request->getPost('amount');
            $usd = $this->converter->convertoUSD($amount, $this->currency);

            $plan = (new Plans())->find($plan);
            if (!$plan) {
                return redirect()->back()->with('error', "Investment plan not found");
            }

            if (!is_numeric($amount) || $usd < get_option('minimum_investment', 0)) {
                return redirect()->back()->with('error', "Investment amount is below the minimum");
            }

            if ($plan->returns >= 100 && $plan->returns <= 150) {
                $minimum_investment = 30000;
                if ($amount < $minimum_investment) {
                    return redirect()->back()->with('error', "Investment amount is below the minimum investment amount for this plan.");
                }
            } elseif ($plan->returns > 150 && $plan->returns <= 200) {
                $minimum_investment = 65000;
                if ($amount < $minimum_investment) {
                    return redirect()->back()->with('error', "Investment amount is below the minimum investment amount for this plan.");
                }
            } elseif ($plan->returns > 200) {
                $minimum_investment = 100000;
                if ($amount < $minimum_investment) {
                    return redirect()->back()->with('error', "Investment amount is below the minimum investment amount for this plan.");
                }
            }

            $return = ($plan->returns / 100) * $usd;
            $total = ($this->converter->convertoUSD($amount, $this->currency)) + $return;
            $start_time = time();
            $end_time = Carbon::now()->add($plan->days, 'day');

            if ($this->current_user->registration != 1) {
                return redirect()->back()->with('error', "Please pay the subscription fee before you purchase an investment plan");
            }

           //dd($this->current_user->account);
            if ($amount > $this->converter->convertoLocal($this->current_user->account, $this->currency)) {
                return redirect()->back()->with('error', "Your account balance is below Kshs $amount");
            }

            $to_db = [
                'user' => $this->current_user->id,
                'plan' => $plan->id,
                'amount' => $this->converter->convertoUSD($amount, $this->currency),
                'return' => $return,
                'total' => $total,
                'start_time' => $start_time,
                'end_time' => $end_time->getTimestamp(),
                'status' => 'pending',
            ];

            $model = new Investments();

            try {
                $users = new Users();
                $new_account = $this->current_user->account - ($this->converter->convertoUSD($amount, $this->currency));
                if ($users->set(['account' => $new_account])->where('id', $this->current_user->id)->update()) {
                    $model->save($to_db);
                    $transactions = new Transactions();
                    $trx = 'INV' . $this->secure_random_string(7);
                   // dd($trx);
                    $transaction = [
                        'user' => $this->current_user->id,
                        'type' => 'investment',
                        'status' => 'completed',
                        'trx' => $trx,
                        'amount' => $this->converter->convertoUSD($amount, $this->currency),
                        'description' => "Investment of {$this->currency} $amount. New balance {$this->currency} {$this->converter->convertoLocal($new_account, $this->currency)}",
                    ];
                    $transactions->save($transaction);

                    //Is this my first investment?
                    if ($model->where('user', $this->current_user->id)->countAllResults() == 1) {
                        //yes, give commission to my referrer
                        $referrer = $this->current_user->referred_by;
                        if (isset($referrer) && is_numeric($referrer)) {
                            $referrer = $users->find($referrer);
                            if ($referrer && $referrer->registration == 1) {
                                //referrer exists. Update account
                                $commission = get_option('referral_bonus', 0);
                                $bonus = 0;
                                if ($commission == '0') {
                                    $bonus = 0;
                                } else {
                                    $bonus = ($commission / 100) * $amount;
                                    $bonus = number_format($bonus, 2);
                                    $newbal = $referrer->account + $bonus;

                                    $users->set(['account' => $this->converter->convertoUSD($newbal, $this->currency)])->where('id', $referrer->id)->update();
                                    $trx = 'IB' . $this->secure_random_string(8);
                                    //dd($trx);
                                    $transaction = [
                                        'user' => $referrer->id,
                                        'type' => 'referral',
                                        'status' => 'completed',
                                        'trx' => $trx,
                                        'amount' => $this->converter->convertoUSD($bonus, $this->currency),
                                        'description' => "Investment bonus of {$referrer->usermeta('currency')} {$this->converter->convertoLocal($bonus, $referrer->usermeta('currency'))} for referring {$this->current_user->name}. New balance is {$referrer->usermeta('currency')} {$this->converter->convertoLocal($newbal, $referrer->usermeta('currency'))}",
                                    ];
                                    $transactions->save($transaction);

                                    $ref = (new \App\Models\Referrals())->where('user', $referrer->id)->where('ref', $this->current_user->id)->get()->getFirstRow();
                                    if ($ref) {
                                        $ref->first_amount = $this->converter->convertoUSD($amount, $this->currency);
                                        $ref->commission = $this->converter->convertoUSD($bonus, $this->currency);

                                        $ref->status = 'completed';

                                        (new \App\Models\Referrals())->save($ref);
                                    }
                                }

                                //The registration bonus (the 50bob)
                                //TODO: To be confirmed
                                $bonus = get_option('registration_bonus', 0);
                                if ($bonus && $bonus != 0) {
                                    $referrer = $users->find($referrer->id);
                                    $newbal = $referrer->account + $bonus;
                                    $users->set(['account' => $newbal])->where('id', $referrer->id)->update();
                                    $trx = 'RB' . $this->secure_random_string(8);

                                    $transaction = [
                                        'user' => $referrer->id,
                                        'type' => 'bonus',
                                        'status' => 'completed',
                                        'trx' => $trx,
                                        'amount' => $this->converter->convertoLocal($bonus, $referrer->usermeta('currency')),
                                        'description' => "Referral bonus of {$referrer->usermeta('currency')} {$this->converter->convertoLocal($bonus, $referrer->usermeta('currency'))} for referring {$this->current_user->name}. New balance is {$referrer->usermeta('currency')} {$this->converter->convertoLocal($newbal, $referrer->usermeta('currency'))}",
                                    ];
                                    $transactions->save($transaction);

                                    $ref = (new \App\Models\Referrals())->where('user', $referrer->id)->where('ref', $this->current_user->id)->get()->getFirstRow();
                                    if ($ref) {
                                        $ref->first_amount = $this->converter->convertoUSD($amount, $this->currency);

                                        $ref->bonus = $bonus;

                                        $ref->status = 'completed';

                                        (new \App\Models\Referrals())->save($ref);
                                    }
                                }
                            }
                        }
                    }
                    $_return = number_format($this->converter->convertoLocal($return, $this->currency),2);
                    return redirect()->back()->with('success', "Investment placed successfully. You will earn {$this->currency} $_return in $plan->days day(s)");
                }
                return redirect()->back()->with('success', "A technical error occurred");
            } catch (\ReflectionException $e) {
                return redirect()->back()->with('error', "Something went wrong");
            }
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

    public function investments()
    {
        $this->data['site_title'] = "My Investments";
        return $this->_renderPage('Invest/investments2', $this->data);
    }
     public function getInv($id)
    {
        $users = ((new \App\Models\Investments()))->select('id, plan, amount, return, total, status, created_at, end_time')->where('user', $id)->orderBy('id', 'DESC')->findAll();
        $i = 0;
        $users = json_decode(json_encode($users), true);

        foreach ($users as $user){
            $users[$i]['amount'] = $this->converter->convertoLocal($user['amount'], $this->currency);
             $users[$i]['return'] = $this->converter->convertoLocal($user['return'], $this->currency);
             $users[$i]['total'] = $this->converter->convertoLocal($user['total'], $this->currency);
             $i++;


        }
        $data['data'] = $users;

        echo json_encode($data);
    }
    public function getTotalInvestments($id){
        $model = new \App\Models\Investments();
        $dateStart = $this->request->getGet('start');
        $dateEnd = $this->request->getGet('end');
        if ($dateStart && $dateEnd) {
            $start_of_day = Carbon::parse($dateStart)->startOfDay()->getTimestamp();
            $end_of_day = Carbon::parse($dateEnd)->endOfDay()->getTimestamp();
            $amountCOB = $model->selectSum('total', 'totalAmount')->where('user', $id)->where('end_time >=', $start_of_day)->where('end_time <=', $end_of_day)->get()->getFirstRow('object')->totalAmount;
            echo $this->converter->convertoLocal($amountCOB, $this->currency);
            return;

        }
        return "null";

    }

}
