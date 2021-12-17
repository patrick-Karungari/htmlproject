<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Controllers;


use App\Models\Investments;
use App\Models\Transactions;
use App\Models\Users;
use Carbon\Carbon;
use App\Models\Withdraws;

class Cron extends BaseController
{
    public function index()
    {
        $investmentsModel = new Investments();
        //fetch all investments that expired in the last 3 minutes
        $right_now = time();
        $three_mins_ago = Carbon::now()->subMinutes(2)->getTimestamp();

        // The cron job should run every three minutes.

        $investments = $investmentsModel
            //->where('end_time >=', $three_mins_ago) //What if we just kept on retrying failed settlements?
            ->where('end_time <=', $right_now)
            ->where('status', 'pending')
            ->findAll();

        /*$deps = (new withdraws())->where('status', 'pending')->findAll();
        $usersModel = new Users();

        foreach ($deps as $dep) {
            //dd($dep);
            if (count((array)$dep) > 1) {
                //Reverse
                $user = $usersModel->find($dep->user->id);
                $current = $user->account;
                $newAccount = $user->account + $dep->amount;
                $amDeducted = $dep->amount;

                $user->account = $newAccount;
               

                $dep->status = "failed";
                $dep->description = "[FAILED] ".$dep->description.". Kshs $amDeducted has been refunded for this transaction";
                //dd(count((array)$dep));
                

                $trx =[
                'user' => $dep->user->id,
                 'type' => "withdrawal",
                'amount' => $dep->amount,
                'date' => date("Y/m/d H:i:s"),
                'description' => "[FAILED] Withdrawal of Kshs $amDeducted has been refunded for this transaction. New account balance is $newAccount"
                ];
                // dd($trx);
                (new Users())->save($user);
                (new withdraws())->save($dep);
                (new transactions())->save($trx);
            }
        }*/
        //dd($deps);
        if (count($investments) > 0) {
            // we got some work
            $usersModel = new Users();
            $transactionsModel = new Transactions();
            foreach ($investments as $investment) {
                $new_account = $investment->user->account + $investment->total;
                $transaction = [
                    'user'  => $investment->user->id,
                    'amount'    => $investment->total,
                    'type'  => 'returns',
                    'description'   => "An investment of Kshs $investment->amount returned Kshs $investment->total. New account balance is Kshs $new_account"
                ];
                try {
                    $usersModel->set('account', $new_account)->where('id', $investment->user->id)->update();
                    $transactionsModel->save($transaction);
                    $investment->status = 'completed';
                    $investmentsModel->save($investment);
                } catch (\ReflectionException $e) {
                    //fail silently. Admin will work this out
                    //TODO: Add manual settlements in case automatic settlements dont work. May not fail because we keep retrying though, but, shit happens
                }
            }
        } else {
            //go back to sleep
        }

        update_option('cron_run_time', time());
    }
}