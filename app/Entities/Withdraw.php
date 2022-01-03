<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Entities;

use App\Models\Users;

class Withdraw extends \CodeIgniter\Entity
{
    protected $dates = [
        'date',
    ];

    public function getUser()
    {
       return (new Users())->find($this->attributes['user']);


    }
}
