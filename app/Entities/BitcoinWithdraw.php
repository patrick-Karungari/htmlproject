<?php

namespace App\Entities;

use App\Models\Users;

class BitcoinWithdraw extends \CodeIgniter\Entity
{
    public function getUser()
    {
        return (new Users())->find($this->attributes['user']);
    }
}