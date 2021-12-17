<?php
/***
 * Created by Bennito254
 *
 * Github: https://github.com/bennito254
 * E-Mail: bennito254@gmail.com
 */

namespace App\Libraries;


use App\Models\Deposits;
use App\Models\Withdraws;
use Carbon\Carbon;

class Metrics
{
    public function getMonths(): array
    {
        return ['-01-', '-02-', '-03-', '-04-', '-05-', '-06-', '-07-', '-08-', '-09-', '-10-', '-11-', '-12-'];
    }

    public function getLabels(): array
    {
        $mega = [];
        $n = 0;
        foreach ($this->getMonths() as $month) {
            $n++;
            $mega[] = Carbon::parse('2021'.$month.'01')->isoFormat('MMM');
        }

        return $mega;
    }
    public function getCurrentMonthDeposit($userID){
        $month = idate('m');
        $totalDeposit = (new Deposits())->like('date', $month, 'both')->where('status', 'completed')
         ->groupStart()           
           ->orWhere('user', $userID)
         ->groupEnd()->selectSum('amount', 'total') ->get()->getFirstRow()->total;
        return $totalDeposit;

    }
     public function getCurrentMonthWithdraw($userID){
        $month = idate('m');
        $totalDeposit = (new Withdraws())->like('date', $month, 'both')->where('status', 'completed')
         ->groupStart() 
           ->orWhere('status', 'pending')          
           ->orWhere('user', $userID)
         ->groupEnd()->selectSum('amount', 'total') ->get()->getFirstRow()->total;
        return $totalDeposit;

    }

    public function getMonthlyWithdraws(): array
    {
        $mega = [];
        foreach ($this->getMonths() as $month) {
            $mega[] = @(new Withdraws())-> where('status','completed')->like('date', $month, 'both')->selectSum('amount', 'total')->get()->getFirstRow()->total ?? 0;
        }

        return $mega;
    }
    public function getMonthlyWithdrawsChart(): array
    {
        $mega = [];
        foreach ($this->getMonths() as $month) {
            $mega[] = @(new Withdraws())->like('date', $month, 'both')->where('status', 'completed')->selectSum('amount', 'total')->get()->getFirstRow()->total ?? 0;
        }

        return $mega;
    }


    public function getMonthlyDeposits(): array
    {
        $mega = [];
        foreach ($this->getMonths() as $month) {
            $mega[] = @(new Deposits())->like('date', $month, 'both')->selectSum('amount', 'total')->get()->getFirstRow()->total ?? 0;
        }

        return $mega;
    }

     public function getDepositRate($userID, $amount){
        $total_withdrawals = (new \App\Models\Withdraws())->where('user', $userID)
        ->groupStart()
            ->where('status', 'completed')
            ->orWhere('status', 'pending')
        ->groupEnd()
        ->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws;
        $total_deposits = (new Deposits())->where('user', $userID)->selectSum('amount', 'total')->get()->getFirstRow()->total;
        if($total_deposits == 0){
            $deposit_rate = 0;
        }else{
            $deposit_rate = ((($total_deposits + $amount) - $total_withdrawals)/$total_deposits) * 100;
        } 
        return $deposit_rate;
    }

    public function getUserBonusTotals($userID)
    {
        return (new \App\Models\Transactions())->where('user', $userID)
            ->groupStart()
                ->where('type', 'referral')
                ->orWhere('type', 'bonus')
                ->orWhere('type', 'investment')
            ->groupEnd()
            ->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws ?? 0;
    }
    public function getUserInvestmentTotals($userID)
    {
        return (new \App\Models\Investments())->where('user', $userID)
            ->groupStart()
               ->where('status', 'pending')
            ->groupEnd()
            ->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws ?? 0;
    }
     public function getUserAccountBalance($userID)
    {
        return (new \App\Models\Users())->where('user', $userID)
           // ->groupStart()
          //     ->where('status', 'pending')
          //  ->groupEnd()
            ->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws ?? 0;
    }
    
    public function getUserReferralBonusTotals($userID)
    {
        return (new \App\Models\Transactions())->where('user', $userID)
            ->groupStart()
                ->where('type', 'referral')
                ->orWhere('type', 'bonus')
            ->groupEnd()
            ->selectSum('amount', 'totalWithdraws')->get()->getLastRow()->totalWithdraws ?? 0;
    }
    public function getDayTotalWithdrawals($userID){
        $withdrawsModel = new Withdraws();
        return  $withdrawsModel->selectSum('amount', 'totalAmount')
        ->where('user', $userID)
        ->groupStart()
            ->orWhere('status', 'completed')
            ->orWhere('status', 'pending')
        ->groupEnd()->like('date', date('Y-m-d'), 'after')->get()->getFirstRow('object')->totalAmount;
     
    }
}
