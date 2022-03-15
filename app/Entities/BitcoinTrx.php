<?php

namespace App\Entities;

use App\Models\Users;

class BitcoinTrx extends \CodeIgniter\Entity
{
    public function getSenderObject()
    {
        return (new Users())->find($this->attributes['sender']);
    }

    public function getReceiverObject()
    {
        return (new Users())->find($this->attributes['sender']);
    }
}