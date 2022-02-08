<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Entities;

use App\Models\Bitcoins;

class Bitcoin extends \CodeIgniter\Entity
{
    public function getBal()
    {
        $bal = (new Bitcoins())->find($this->attributes['user']);
        dd($bal);
        $balance = $bal->balance;
        return $balance;
    }
}
