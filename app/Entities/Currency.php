<?php


namespace App\Entities;

use App\Models\Currencies;


class Currency extends \CodeIgniter\Entity
{
    public function getBuying()
    {
        return (new Currencies())->find($this->attributes['buying']);
    }
    public function getSelling()
    {
        return (new Currencies())->find($this->attributes['selling']);
    }
}
