<?php


namespace App\Entities;

use App\Models\Currencies;


class Currency extends \CodeIgniter\Entity
{
    public function getBuying()
    {
        $buy = (new Currencies())->find($this->attributes['id']);
        $buying = $buy->buy;
        return $buying;
    }
    public function getSelling()
    {
        $sell = (new Currencies())->find($this->attributes['id']);
        $selling = $sell->sell;
        return $selling;
    }
}
