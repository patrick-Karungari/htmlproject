<?php

namespace App\Libraries;

use App\Models\Currencies;
use App\Models\Withdraws;
use Carbon\Carbon;

class Converter
{
    public function convertoLocal($amount, $_currency)
    {
       $currenciesModel = (new \App\Models\Currencies());
        $currencies = $currenciesModel->where('currency', $_currency)->find();
        $local = null;
        foreach ($currencies as $currency) {
            $local = $currency->getSelling();
        }
        if ($amount <= 0) {
            return 0;
        }
        return ($amount * $local);


    }
     public function convertoLocalWithdraw($amount, $_currency)
    {
       $currenciesModel = (new \App\Models\Currencies());
        $currencies = $currenciesModel->where('currency', $_currency)->find();
        $local = null;
        foreach ($currencies as $currency) {
            $local = $currency->getBuying();
        }
        if ($amount <= 0) {
            return 0;
        }
        return ($amount * $local);


    }
    public function convertoUSD($amount, $_currency)
    {  
        $currenciesModel = (new \App\Models\Currencies());
        $currencies = $currenciesModel->where('currency', $_currency)->find();
        $local = null;
        foreach ($currencies as $currency) {
            $local = $currency->getSelling();
        }
        if ($amount <= 0){
            return 0;
        }
        return ($amount / $local);


    }
}
