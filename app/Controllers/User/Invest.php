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

class Invest extends \App\Controllers\UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->data['site_title'] = "Investments";
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

            $plan = (new Plans())->find($plan);
            if (!$plan) {
                return redirect()->back()->with('error', "Investment plan not found");
            }

            if (!is_numeric($amount) || $amount < get_option('minimum_investment', 0)) {
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

            $return = ($plan->returns / 100) * $amount;
            $total = $amount + $return;
            $start_time = time();
            $end_time = Carbon::now()->add($plan->days, 'day');

            if ($this->current_user->registration != 1) {
                return redirect()->back()->with('error', "Please pay the subscription fee before you purchase an investment plan");
            }

            if ($amount > $this->current_user->account) {
                return redirect()->back()->with('error', "Your account balance is below Kshs $amount");
            }

            $to_db = [
                'user' => $this->current_user->id,
                'plan' => $plan->id,
                'amount' => $amount,
                'return' => $return,
                'total' => $total,
                'start_time' => $start_time,
                'end_time' => $end_time->getTimestamp(),
                'status' => 'pending',
            ];

            $model = new Investments();

            try {
                $users = new Users();
                $new_account = $this->current_user->account - $amount;
                if ($users->set(['account' => $new_account])->where('id', $this->current_user->id)->update()) {
                    $model->save($to_db);
                    $transactions = new Transactions();
                    $trx = 'INV' . $this->secure_random_string(7);
                    $transaction = [
                        'user' => $this->current_user->id,
                        'type' => 'investment',
                        'status' => 'completed',
                        'trx' => $trx,
                        'amount' => $amount,
                        'description' => "Investment of Kshs $amount. New balance Kshs $new_account",
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

                                    $users->set(['account' => $newbal])->where('id', $referrer->id)->update();
                                    $trx = 'IB' . $this->secure_random_string(8);

                                    $transaction = [
                                        'user' => $referrer->id,
                                        'type' => 'referral',
                                        'status' => 'completed',
                                        'trx' => $trx,
                                        'amount' => $bonus,
                                        'description' => "Investment bonus of Kshs $amount for referring {$this->current_user->name}. New balance is Kshs $newbal ",
                                    ];
                                    $transactions->save($transaction);

                                    $ref = (new \App\Models\Referrals())->where('user', $referrer->id)->where('ref', $this->current_user->id)->get()->getFirstRow();
                                    if ($ref) {
                                        $ref->first_amount = $amount;
                                        $ref->commission = $bonus;
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
                                        'amount' => $bonus,
                                        'description' => "Referral bonus of Kshs $amount for referring {$this->current_user->name}. New balance is Kshs $newbal ",
                                    ];
                                    $transactions->save($transaction);

                                    $ref = (new \App\Models\Referrals())->where('user', $referrer->id)->where('ref', $this->current_user->id)->get()->getFirstRow();
                                    if ($ref) {
                                        $ref->first_amount = $amount;
                                        $ref->bonus = $bonus;
                                        $ref->status = 'completed';

                                        (new \App\Models\Referrals())->save($ref);
                                    }
                                }
                            }
                        }
                    }

                    return redirect()->back()->with('success', "Investment placed successfully. You will earn Kshs $return in $plan->days day(s)");
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
        return $this->_renderPage('Invest/investments', $this->data);
    }
}
